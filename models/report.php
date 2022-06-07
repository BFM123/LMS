<?php
//show all types of errors but notices, warnings and deprecated messages
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

require_once "toolbox/fpdf.php";
require_once "toolbox/PHP_XLSXWriter-master/xlsxwriter.class.php";
require_once "toolbox/PHP_XLSXWriter-master/xlsxwriterplus.class.php";
require_once "organization.php";
require_once "leave.php";
require_once "certificate.php";
require_once "payment.php";
require_once "invoice.php";

require_once "indicator.php";
require_once "indicator_value.php";
require_once "district.php";
require_once "zone.php";
require_once "region.php";
require_once "user.php";

class PDF_MC_Table extends FPDF {
	var $widths;
	var $aligns;
	
	private $my_title;
	private $system_title;
	private $logo;

	function _construct($licensee, $logo, $title, $system_title, $printed_by){
    	$this->licensee = $licensee;
    	$this->logo = $logo;
		$this->my_title = $title;
		$this->system_title = $system_title;
		$this->printed_by = $printed_by;
	}

	function Header() {
		//Logo
		$ident = 83;
		$ident = (strcasecmp($this->CurOrientation, "L") == 0) ? $ident + 44: $ident;
		$top = 10; $width = 40;
		$ln_break = 35;
		$ln_break_2 = 20;
		$ln_break_3 = 15;
		$font_size = 14;
		$align = "C";
		$licensee = $this->licensee;
		$print_address = false;
		$print_title = true;

		if (in_array(strtolower($this->my_title), array(strtolower(CERTIFICATE_REGISTRATION), strtolower(CERTIFICATE_LICENSE)))) {
			// certificate
			$top = 20;
			$ident = 78;
			$width = 55;
			$ln_break = 60;
			$ln_break_2 = 20;
			$font_size = 16;
			
			// draw a border around the paper
			// outer thick border
			$this->SetLineWidth(1);
			$this->Cell(190, 275, "", 1, 0);
		} elseif (in_array(strtolower($this->my_title), array(strtolower(CERTIFICATE_TEP), strtolower("Invoice"), strtolower("Proforma Invoice")))) {
			// certificate
			$top = 10;
			$ident = 10;
			$width = 40;
			$ln_break = 5;
			$ln_break_2 = 8;
			$font_size = 14;
			$align = "R";
			$licensee = strtoupper($licensee);
			$print_address = true;
		} elseif (in_array(strtolower($this->my_title), array(strtolower("Leave Application Form"), strtolower("Annual Return Form")))) {
			// registration form or annual return form
			$top = 11;
			$ident = 11;
			$width = 27;
			$ln_break = 5;
			$ln_break_2 = 8;
			$ln_break_3 = 0;
			$font_size = 14;
			$align = "R";
			$licensee = strtoupper($licensee);
			$print_address = true;
			$print_title = false;
		}
		
		$this->Image(LOGO_UPLOAD_PATH . $this->logo, $ident, $top, $width);
		
		$this->SetFont("Arial", "B", $font_size);

		//Line break
		$this->Ln($ln_break);
		$this->SetTextColor(0, 0, 255);
		$this->Cell(0, 10, strtoupper($licensee), 0, 0, $align);
				
		//Line break
		$this->Ln($ln_break_2);
	
		if ($print_address) {
			// address
			$slogan = common::getFieldValue("system", "slogan");
			$address = common::getFieldValue("system", "address");
			$telephone = common::getFieldValue("system", "CONCAT('Tel: ', telephone)");								
			$email = common::getFieldValue("system", "CONCAT('Email: ', email)");								
			$website = common::getFieldValue("system", "CONCAT('Website: ', website)");								

			$this->SetFont("Times", "I", 11);
			$this->SetTextColor(255, 0, 0);
			$this->Cell(190, $ln_break, $slogan, 0, 1, $align);
			$this->SetFont("Arial", "", 11);
			$this->SetTextColor(0, 0, 0);
			$this->Cell(190, $ln_break, $address, 0, 1, $align);
			$this->Cell(190, $ln_break, $telephone, 0, 1, $align);
			$this->Cell(190, $ln_break, $email, 0, 1, $align);
			$this->Cell(190, $ln_break, $website, 0, 1, $align);
			$this->SetDrawColor(0, 0, 0);
			$this->Line(10, 50, 200, 50);

			$this->Ln($ln_break_2);
			$align = "C";
			$font_size = 14;
			$this->SetFont("Arial", "B", $font_size);
		}

		$this->SetTextColor(0, 0, 0);
		if ($print_title) {
			//Title
			$this->Cell(0, 10, $this->my_title, 0, 0, $align);
		}
		
		//Line break		
		$this->Ln($ln_break_3);
	}

	//Page footer
	function Footer(){
		$this->SetTextColor(0, 0, 0);
		if (!in_array(strtolower($this->my_title), array(strtolower(CERTIFICATE_REGISTRATION), strtolower(CERTIFICATE_LICENSE), strtolower(CERTIFICATE_TEP)))) {
			// do not include footer when printing registration and compliance certificates
			//Position at 1.5 cm from bottom
			$this->SetY(-15);
	
			$ident = ($this->CurOrientation === "L") ? 100: 0;
			$ln_ident = ($this->CurOrientation === "L") ? 88: 0;
	
			$this->SetFont("Arial", "I", 8);
			$this->SetDrawColor(0, 0, 0);
			$this->Line(10, 280 - $ln_ident, 200 + $ln_ident, 280 - $ln_ident);
	
			// set the default time zone to be that for Malawi
			date_default_timezone_set("Africa/Blantyre");
			$full_screen = 190 + $ident;
			$half_screen = $full_screen / 2;
			
			$printed_by = "";
			$pages = "";
			
			if (!in_array(strtolower($this->my_title), array(strtolower("Invoice"), strtolower("Proforma Invoice")))) {
				$printed_by = "Printed by " . $this->printed_by . " on " . date("d M Y @ h:iA");
				$pages = "Page " . $this->PageNo() . " of {nb}";
			} else {
				$licensee_contact_details = common::getFieldValue("system", "CONCAT(address, '. Tel: ', telephone, ' Email: ', email, ' Website: ', website)");				
				$this->Cell($full_screen, 3,  str_replace("\r\n", ", ", $licensee_contact_details), 0, 1, "C");				
			}
			
			$this->Cell($half_screen - 20, 3, $printed_by, 0, 0, "L");
			$this->Cell($half_screen, 3, $pages, 0, 1, "R");
			$this->Cell($full_screen, 3, $this->system_title . " � " . date("Y") . ". Powered by Idias | info@idiasmw.com | www.idiasmw.com", 0, 1, "C");
		}
	}

	function SetWidths($w) {
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a) {
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function SetBorders($b) {
		//Set the array of borders
		$this->borders=$b;
	}

	function Row($rpt, $data, $ln_break) {
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		//$ln_height = (strcasecmp($rpt, "roles") == 0) ? 3 : 4;	
		if (strcasecmp($rpt, "roles") == 0)
			$ln_height = 3;
		elseif (is_numeric($rpt))
			$ln_height = $rpt;
		else
			$ln_height = 5;
			
		$h=$ln_height*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++) {
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			$b=isset($this->borders[$i]) ? $this->borders[$i] : 2;
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,$ln_height,$data[$i],$b,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line, if required
		if (strcasecmp($ln_break, "1") == 0)
			$this->Ln($h);
	}
	
	function CheckPageBreak($h) {
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt) {
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont["cw"];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb) {
			$c=$s[$i];
			if($c=="\n") {
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax) {
				if($sep==-1) {
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}

class PDF_Diag extends PDF_MC_Table {
    var $legends;
    var $wLegend;
    var $sum;
    var $NbVal;

	function ColumnChart($w, $h, $data, $legs, $format, $color=null, $orientation, $maxVal=0, $nbDiv=4)
    {

        // RGB for color 0 = yellow
        $colors[0][0] = 240; //255;
        $colors[0][1] = 213; //255;
        $colors[0][2] = 15; //0;

        // RGB for color 1 = blue
        $colors[1][0] = 0;
        $colors[1][1] = 115; //0;
        $colors[1][2] = 183; //255;

        // RGB for color 2 = red
        $colors[2][0] = 221; //255;
        $colors[2][1] = 75; //0;
        $colors[2][2] = 57; //0;

        // RGB for color 3 = green
        $colors[3][0] = 0;
        $colors[3][1] = 221;
        $colors[3][2] = 0;

        // RGB for color 4 = purple
        $colors[4][0] = 204;
        $colors[4][1] = 0;
        $colors[4][2] = 204;

	
        $this->SetFont("Arial", "B", 8);
        $this->SetLegendsColChart($data,$format);

        // Starting corner (current page position where the chart has been inserted)
        $XPage = $this->GetX();
        $YPage = $this->GetY();
        $margin = 0; //2; 

        // Y position of the chart
        $YDiag = $YPage + $margin;

        // chart HEIGHT
        $hDiag = floor($h - $margin * 2);

        // X position of the chart
        $XDiag = $XPage + $margin;

        // chart LENGTH
        $lDiag = floor($w - $margin * 3 - $this->wLegend);

        if($color == null)
            $color=array(155,155,155);
        if ($maxVal == 0) 
        {
            foreach($data as $val)
            {
                if(max($val) > $maxVal)
                {
                    $maxVal = max($val);
                }
            }
        }

        // define the distance between the visual reference lines (the lines which cross the chart's internal area and serve as visual reference for the column's heights)
        $valIndRepere = ceil($maxVal / $nbDiv);

        // adjust the maximum value to be plotted (recalculate through the newly calculated distance between the visual reference lines)
        $maxVal = $valIndRepere * $nbDiv;

        // define the distance between the visual reference lines (in milimeters)
        $hRepere = floor($hDiag / $nbDiv);

        // adjust the chart HEIGHT
        $hDiag = $hRepere * $nbDiv;

        // determine the height unit (milimiters/data unit)
        $unit = $hDiag / (($maxVal == 0) ? 1 : $maxVal);

        // determine the bar's thickness
        $lBar = floor($lDiag / ($this->NbVal + 1));
        $lDiag = $lBar * ($this->NbVal + 1);
        $eColumn = floor($lBar * 80 / 100);

        // draw the chart border
        $this->SetLineWidth(0.2);
        $this->SetDrawColor(134, 134, 134);
        $this->Rect($XDiag, $YDiag, $lDiag, $hDiag);

        $this->SetFont('Arial', '', 9);
        $this->SetFillColor($color[0],$color[1],$color[2]);
        $i=0;
        
		foreach($data as $key => $val) //foreach($data as $val)
        {
            //Column
            $yval = $YDiag + $hDiag;
            $xval = $XDiag + ($i + 1) * $lBar - $eColumn/2;
            $lval = floor($eColumn/(count($val)));
            $j=0;
            foreach($val as $v)
            {
                $hval = (int)($v * $unit);
                $this->SetFillColor($colors[$j][0], $colors[$j][1], $colors[$j][2]);
		        $this->SetDrawColor($colors[$j][0], $colors[$j][1], $colors[$j][2]); // draw the chart bars with borders having the color of the bars i.e. without borders
                $this->Rect($xval+($lval*$j), $yval, $lval, -$hval, 'DF');
                $j++;
            }

            //Legend - show labels along the y-axis
            $this->SetXY($xval, $yval + $margin);
			
			if ($legs == null) {
				// this graph has no legends, most likely this is a small graph and small fonts should be used
				$cell_width = $lval * 2 + 10 - 1; // the 1 is specifically subtracted to unhide borders...confusing right, yeah :)
				$font_size = 6;
				$text_align = "L";
			} else {
				$cell_width = $lval * 2;
				$font_size = 7;
				$text_align = "C";
			}			
			$this->SetFont('Arial', '', $font_size + 2); // 2 specifically added to increase the x-axis label font size for reporting rate graph
			$this->SetWidths(array($cell_width + 4)); // 4 added specifically added to increase the x-axis label width for reporting rate graph
			$this->SetAligns(array($text_align));
			$indicator = $key;
			$indicator = is_numeric(strpos($indicator, INDICATOR_START_STR)) ? substr($indicator, strlen(INDICATOR_START_STR)) : $indicator;	
			$indicator = is_numeric(strpos($indicator, INDICATOR_START_STR2)) ? substr($indicator, strlen(INDICATOR_START_STR2)) : $indicator;	
			$indicator = is_numeric(strpos($indicator, INDICATOR_START_STR3)) ? substr($indicator, strlen(INDICATOR_START_STR3)) : $indicator;	
	        $this->SetDrawColor(255, 255, 255); // set the border color for labels to white
			$this->Row("", array(ucfirst($indicator)), 1);
	        $this->SetDrawColor(134, 134, 134); // reset border color to grey

            $i++;
        }
		
        //Scales
        for ($i = 0; $i <= $nbDiv; $i++) 
        {
            $ypos = $YDiag + $hRepere * $i;
            $this->Line($XDiag, $ypos, $XDiag + $lDiag, $ypos);
            $val = ($nbDiv - $i) * $valIndRepere;
            $ypos = $YDiag + $hRepere * $i;
            $xpos = $XDiag - $margin - $this->GetStringWidth($val);
            $this->Text($xpos, $ypos, number_format($val, 0));
        }
		
		//show the legend at the bottom of the chart
        $this->ShowLegendsColChart($legs, $colors, $orientation);
    }
	
	function SetLegendsColChart($data, $format)
    {
		$this->legends=array();
        $this->wLegend=0;
        $this->sum=array_sum($data);
        $this->NbVal=count($data);
		
        foreach($data as $l=>$val)
        {
         	$p="";//sprintf('%.3f',$val/$this->sum*100).'%';
            $legend=str_replace(array('%l','%v','%p'),array($l,$val,$p),$format);
            $this->legends[]=$legend;
            $this->wLegend=max($this->GetStringWidth($legend),$this->wLegend);
        }
    }

	function ShowLegendsColChart($legends, $colors, $orientation) {
		if ($legends == null) {
			//no legends available...do not print legends
		} else {
			//print legends
			$this->Ln(2); //$this->Ln(10);
			$this->SetFont('Arial', 'B', 9);
			$this->Cell(7, 5, '', 0, 0, 'L'); // distance from left margin (identation)
			$this->Cell(58, 5, 'Key', 0, 1, 'L');
	
			$this->SetFont('Arial', '', 9);
			for ($i = 0; $i < count($legends); $i++) {
				$this->SetFillColor($colors[$i][0], $colors[$i][1], $colors[$i][2]);
				$this->Cell(7, 5, '', 0, 0); // distance from left margin (identation)
				$this->Cell(8, 8, '' , 0, 0, '', true); // box of chart legend is printed here
				$ln_break = ($orientation == "P") ? "1" : "0";
				$this->Cell(20, 8, $legends[$i], 0, $ln_break, 'L');
				if ($orientation == "P") $this->Ln(1);
			}
		}
		if (($this->CurOrientation === "P" && $this->GetY() > 220) || ($this->CurOrientation === "L" && $this->GetY() > 180))
			$this->AddPage($this->CurOrientation); // add a page break if the graph is close to the bottom of the page
		else 
			$this->Ln(20); // else just print a blank line at the bottom to create space
	}
}

class report
{
  /**
	* declarations
	*/
	private $report_id;
	private $records;
	private $report_name;
	private $custom_title;
	private $destination;		
	private $return_report;		
	private $printed_by;
	private $captured_by;
	private $last_edited_by;
	private $deleted_by;
	private $certificate_id;
    private $organization_id;
    private $licensing_organization_id;
    private $fee_category;
    private $fee_amount;
    private $currency;
    private $invoice_number;
    private $district_id;
    private $zone_id;
    private $region_id;
    private $role_id;
    private $period;
    private $reporting_year;
    private $reporting_rate_format;
	
   /**
	* Get the value of report_id
	*
	* @return mixed
	*/
	public function getReportID()
	{
		return $this->report_id;
	}

   /**
	* Set the value of report_id
	*
	* @param mixed report_id
	*
	* @return self
	*/
	public function setReportID($report_id)
	{
		$this->report_id = $report_id;

		return $this;
	}

   /**
	* Get the value of records
	*
	* @return mixed
	*/
	public function getRecords()
	{
		return $this->records;
	}

   /**
	* Set the value of records
	*
	* @param mixed records
	*
	* @return self
	*/
	public function setRecords($records)
	{
		$this->records = $records;

		return $this;
	}

   /**
	* Get the value of report_name
	*
	* @return mixed
	*/
	public function getReportName()
	{
		return $this->report_name;
	}

   /**
	* Set the value of report_name
	*
	* @param mixed report_name
	*
	* @return self
	*/
	public function setReportName($report_name)
	{
		$this->report_name = $report_name;

		return $this;
	}

   /**
	* Get the value of custom_title
	*
	* @return mixed
	*/
	public function getCustomTitle()
	{
		return $this->custom_title;
	}

   /**
	* Set the value of custom_title
	*
	* @param mixed custom_title
	*
	* @return self
	*/
	public function setCustomTitle($custom_title)
	{
		$this->custom_title = $custom_title;

		return $this;
	}

   /**
	* Get the value of destination
	*
	* @return mixed
	*/
	public function getDestination()
	{
		return $this->destination;
	}

   /**
	* Set the value of destination
	*
	* @param mixed destination
	*
	* @return self
	*/
	public function setDestination($destination)
	{
		$this->destination = $destination;

		return $this;
	}
	
   /**
	* Get the value of return_report
	*
	* @return mixed
	*/
	public function getReturnReport()
	{
		return $this->return_report;
	}

   /**
	* Set the value of return_report
	*
	* @param mixed return_report
	*
	* @return self
	*/
	public function setReturnReport($return_report)
	{
		$this->return_report = $return_report;

		return $this;
	}

   /**
	* Get the value of printed_by
	*
	* @return mixed
	*/
	public function getPrintedBy()
	{
		return $this->printed_by;
	}

   /**
	* Set the value of printed_by
	*
	* @param mixed printed_by
	*
	* @return self
	*/
	public function setPrintedBy($printed_by)
	{
		$this->printed_by = $printed_by;

		return $this;
	}

   /**
	* Get the value of sort_order
	*
	* @return mixed
	*/
    public function getSortOrder()
    {
        return $this->sort_order;
	}

   /**
	* Set the value of sort_order
	*
	* @param mixed sort_order
	*
	* @return self
	*/
    public function setSortOrder($sort_order)
    {
        $this->sort_order = $sort_order;

        return $this;
    }
	
	
   /**
	* Get the value of captured_by
	*
	* @return mixed
	*/
    public function getCapturedBy()
    {
        return $this->captured_by;
	}

   /**
	* Set the value of captured_by
	*
	* @param mixed captured_by
	*
	* @return self
	*/
    public function setCapturedBy($captured_by)
    {
        $this->captured_by = $captured_by;

        return $this;
    }
	
   /**
	* Get the value of last_edited_by
	*
	* @return mixed last_edited_by
	*/
    public function getLastEditedBy()
    {
        return $this->last_edited_by;
    }

   /**
	* Set the value of last_edited_by
	*
	* @param mixed last_edited_by
	*
	* @return self
	*/
    public function setLastEditedBy($last_edited_by)
    {
        $this->last_edited_by = $last_edited_by;

        return $this;
    }

   /**
	* Get the value of deleted_by
	*
	* @return mixed deleted_by
	*/
    public function getDeletedBy()
    {
        return $this->deleted_by;
    }

   /**
	* Set the value of deleted_by
	*
	* @param mixed deleted_by
	*
	* @return self
	*/
    public function setDeletedBy($deleted_by)
    {
        $this->deleted_by = $deleted_by;

        return $this;
    }

    /**
     * Get the value of user_id
     *
     * @return mixed
     */
    public function getUserID()
    {
        return $this->user_id;
    }
 
    /**
     * Set the value of user_id
     *
     * @param mixed user_id
     *
     * @return self
     */
    public function setUserID($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
	 
    /**
     * Get the value of leave_id
     *
     * @return mixed
     */
    public function getLeaveID()
    {
        return $this->leave_id;
    }
 
    /**
     * Set the value of leave_id
     *
     * @param mixed leave_id
     *
     * @return self
     */
    public function setLeaveID($leave_id)
    {
        $this->leave_id = $leave_id;

        return $this;
    }
		
    /**
     * Get the value of start_date
     *
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }
 
    /**
     * Set the value of start_date
     *
     * @param mixed start_date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }
		
    /**
     * Get the value of end_date
     *
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @param mixed end_date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }
	
    /**
     * Get the value of duration
     *
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of duration
     *
     * @param mixed duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }
	
    /**
     * Get the value of currency
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @param mixed currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }
	
	/**
     * Get the value of leave_type
     *
     * @return mixed
     */
    public function getLeaveType()
    {
        return $this->leave_type;
    }

    /**
     * Set the value of leave_type
     *
     * @param mixed leave_type
     *
     * @return self
     */
    public function setLeaveType($leave_type)
    {
        $this->leave_type = $leave_type;

        return $this;
    }
 
    /**
     * Get the value of district_id
     *
     * @return mixed
     */
    public function getDistrictID()
    {
        return $this->district_id;
    }
 
    /**
     * Set the value of district_id
     *
     * @param mixed district_id
     *
     * @return self
     */
    public function setDistrictID($district_id)
    {
        $this->district_id = $district_id;

        return $this;
    }
 
    /**
     * Get the value of zone_id
     *
     * @return mixed
     */
    public function getZoneID()
    {
        return $this->zone_id;
    }
 
    /**
     * Set the value of zone_id
     *
     * @param mixed zone_id
     *
     * @return self
     */
    public function setZoneID($zone_id)
    {
        $this->zone_id = $zone_id;

        return $this;
    }
 
    /**
     * Get the value of region_id
     *
     * @return mixed
     */
    public function getRegionID()
    {
        return $this->region_id;
    }
 
    /**
     * Set the value of region_id
     *
     * @param mixed region_id
     *
     * @return self
     */
    public function setRegionID($region_id)
    {
        $this->region_id = $region_id;

        return $this;
    }
 
    /**
     * Get the value of role_id
     *
     * @return mixed
     */
    public function getRoleID()
    {
        return $this->role_id;
    }
 
    /**
     * Set the value of role_id
     *
     * @param mixed role_id
     *
     * @return self
     */
    public function setRoleID($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }
 
    /**
     * Get the value of period
     *
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }
 
    /**
     * Set the value of period
     *
     * @param mixed period
     *
     * @return self
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }
 
    /**
     * Get the value of reporting_year
     *
     * @return mixed
     */
    public function getReportingYear()
    {
        return $this->reporting_year;
    }
 
    /**
     * Set the value of reporting_year
     *
     * @param mixed reporting_year
     *
     * @return self
     */
    public function setReportingYear($reporting_year)
    {
        $this->reporting_year = $reporting_year;

        return $this;
    }
	
	 /**
     * Get the value of reporting_rate_format
     *
     * @return mixed
     */
    public function getReportingRateFormat()
    {
        return $this->reporting_rate_format;
    }
 
    /**
     * Set the value of reporting_rate_format
     *
     * @param mixed reporting_rate_format
     *
     * @return self
     */
    public function setReportingRateFormat($reporting_rate_format)
    {
        $this->reporting_rate_format = $reporting_rate_format;

        return $this;
    }
	
   /**
	* generate report
	*/
	public function generate()
	{
		global $APPROVAL_STATUS;
		$approved = array_keys($APPROVAL_STATUS)[4];
		$disabled = array_keys($APPROVAL_STATUS)[5];
	
		// set the default time zone to be that for Malawi
		date_default_timezone_set("Africa/Blantyre");

		$title = (strlen($this->custom_title) > 0) ? $this->custom_title : $this->report_name;
		$report_title = $title;
	 	$report_name = $this->report_name . ".". strtolower($this->destination);
		
		// by default all reports are printed in portrait orientation	 
		$report_orientation = "P";

		$report_str	= " report";
		$action = "Download Report";
		
		if ($this->destination === PDF_FILE_EXT) {
			// generate PDF reports
			if (in_array($this->report_name, array("Leave Application Form", "Annual Return Form"))) {
				$title = strtoupper($this->report_name);
				$sub_title = $title;

				$blanks = "";
				
				if ($this->report_name === "Leave Application Form") {
					$entity = "leave";
					$entity_id = $this->leave_id;

					//$records = $entity::all($entity_id, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
					$records = $entity::all($entity_id, $blanks);
				} elseif ($this->report_name === "Annual Return Form") {
					$entity = "licensing_organization";
					$entity_id = $this->licensing_organization_id;
					$table_prefix = "licensing_";
					$records = $entity::all($blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED, $entity_id);
				}
							
				if (empty($records)) {
					$_SESSION["message"] = "No " . strtolower($title) . " details available";
					$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
					
					// log the user activity
					audit_trail::log_trail("Generate Report", $_SESSION["message"], $this->printed_by, "Reports");
  
					return;
				}

	 			$system_title = common::getFieldValue("system", "title");
				$licensee = common::getFieldValue("system", "licensee");
				
				$logo = "idias-logo.png";			
				$printed_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $this->printed_by); 
	
				// print report header
				$tpdf = new PDF_MC_Table("P", "mm", "A4");
				$tpdf->_construct($licensee, $logo, $title, $system_title, $printed_by);
				$tpdf->AliasNbPages();											
				
				$i = 0;
				$tpdf->SetDrawColor(0, 0, 0);
				foreach ($records as $r) :
					$i ++;
					
					$tpdf->AddPage();
									
					// print form status
					$approval_status = ($r->status === STATUS_REJECTED) ? strtolower($r->status) : strtolower($APPROVAL_STATUS[$r->record_control]);
					
					$form_color = array();
					if ($approval_status === STATUS_REJECTED) {
						$form_color[0] = 255; $form_color[1] = 0; $form_color[2] = 0; // rejected...red
					} elseif ($r->record_control == $approved) {
						$form_color[0] = 0; $form_color[1] = 255; $form_color[2] = 0; // approved...green
					} elseif ($r->record_control == $disabled) {
						$form_color[0] = 204; $form_color[1] = 204; $form_color[2] = 204; // disabled...grey
					} else {
						$form_color[0] = 255; $form_color[1] = 150; $form_color[2] =  0;  // awaiting approval and other...amber
					}
					
					$tpdf->SetFont("Arial", "", 12);
					$tpdf->SetFillColor($form_color[0], $form_color[1], $form_color[2]);
					$tpdf->Cell(10, 10, "", 1, 0, "C", true);
					$tpdf->Cell(5, 10, "");
					$tpdf->Cell(175, 10, ucwords($approval_status));
					$tpdf->Ln(2);
					$tpdf->SetTextColor(0, 0, 0);

					// print form header					
					$tpdf->SetFont("Arial", "B", 14);
					if ($entity === "licensing_organization")	{
						$tpdf->MultiCell(190, 5, strtoupper($this->report_name . " year " . $r->reporting_year), 0, "C");
						$tpdf->Ln(2);
					}
										
					$text1 = common::getFieldValue("template", "text1", "template", $this->report_name);
					$text2 = common::getFieldValue("template", "text2", "template", $this->report_name);
					$text3 = common::getFieldValue("template", "text3", "template", $this->report_name);
					$name_of_applicant = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "user_id", $r->user_id);
					$applicant_position = common::getFieldValue("user", "position", "user_id", $r->user_id);
					$leave_entitlement = common::getFieldValue("user", "leave_entitlement", "user_id", $r->user_id);
					//$used_to_date = common::getFieldValue("user", "position", "user_id", $r->user_id);
					
					/*$tpdf->SetFont("Arial", "B", 12);
					$tpdf->MultiCell(190, 5, strtoupper(	$text1), 0, "C");
					$tpdf->Ln(5);				
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(190, 5, $text2, 0, "L");
					$tpdf->Ln(5);
					$bullet = chr(149);
					$text3 = "$bullet " . str_replace("\r\n", "\r\n$bullet ", $text3);
					$tpdf->MultiCell(190, 5, $text3 , 0, "L");
					$tpdf->Ln(5);*/
					
					// leave application details					
					$tpdf->SetFont("Arial", "B", 11);
					$tpdf->SetTextColor(0, 0, 255);			
					$tpdf->Cell(190, 5, "LEAVE APPLICATION DETAILS");
					$tpdf->SetTextColor(0, 0, 0);			
					$tpdf->Ln(7);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(60, 5, "Name of Applicant");
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(130, 5, $name_of_applicant, 0, "L");
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(60, 5, "Position"); 
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(130, 5, $applicant_position, 0, "L");
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(80, 5, "Leave Entitlement");
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(110, 5, $leave_entitlement, 0, "L");
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(60, 5, "Used To Date"); 
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(130, 5, $r->duration, 0, "L");
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(60, 5, "Balance");
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(130, 5, $r->balance, 0, "L");
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(60, 5, "Dates Requested From"); 
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(130, 5, $r->start_date, 0, "L");
					$tpdf->Ln(3);
					$tpdf->SetFont("Arial", "B", 12);				
					$tpdf->Cell(60, 5, "Dates Requested To");
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(130, 5, $r->end_date, 0, "L");
					
					$tpdf->SetDrawColor(191, 191, 191);
					//registration / annual return form
					$headings = array(
						"trustee" => array(
										"description" => "Directors/Trustee Details (for International include Directors on Affidavits)",
										"headings" => array("", "fullname", "telephone", "email", "occupation", "nationality", "national_id", "position", "timeframe"),
										"widths" => array(7, 23, 23, 23, 23, 23, 23, 23, 22),
										"aligns" => array("R", "L", "L", "L", "L", "L", "L", "L", "L")
									),
						"objective" => array(
										"description" => "Objectives of the Organization",
										"headings" => array("", "objective"),
										"widths" => array(7, 183),
										"aligns" => array("R", "L")
									), 
						"sector" => array(
										"description" => "Sectors engaged in (These are Government approved Sectors)",
										"headings" => array("", "sector"),
										"widths" => array(7, 183),
										"aligns" => array("R", "L")
									), 
						"location activity" => array(
										"description" => "Location of Activities",
										"headings" => array("", "vdc", "adc", "district_id"),
										"widths" => array(7, 70, 70, 43),
										"aligns" => array("R", "L", "L", "L")
									), 
						"source funding" => array(
										"description" => "Source of Funding",
										"headings" => array("", "donor_id", "contact_details", "funding_currency", "funding_amount"),
										"widths" => array(7, 65, 65, 18, 35),
										"aligns" => array("R", "L", "L", "R", "R")
									), 
						"auditor" => array(										
										"description" => "Auditors' Details",
										"headings" => array("", "name", "address", "telephone", "email"),
										"widths" => array(7, 58, 65, 25, 35),
										"aligns" => array("R", "L", "L", "L", "L")
									),
						"bank" => array(
										"description" => "Banks' Details",
										"headings" => array("", "bank_id", "address", "telephone", "email"),
										"widths" => array(7, 58, 65, 25, 35),
										"aligns" => array("R", "L", "L", "L", "L")
									),											
						"executive director" => array(
										"description" => "Executive Director/Country Director/Country Representative Details",
										"headings" => array("fullname", "nationality", "national_id", "highest_qualification", "email", "telephone"),
										"widths" => array(35, 30, 35, 30, 30, 30),
										"aligns" => array("L", "L", "L", "L", "L", "L")
									),
						"financial year" => array(
										"description" => "NGO Financial Year",
										"headings" => array("start_month", "end_month"),
										"widths" => array(95, 95),
										"aligns" => array("L", "L")
									),
						"registration type" => array(
										"description" => "Type of NGO Registration",
										"headings" => array("registration_type"),
										"widths" => array(190),
										"aligns" => array("L")
									),
						"target group" => array(
										"description" => "Target Groups",
										"headings" => array("", "target_group"),
										"widths" => array(7, 183),
										"aligns" => array("R", "L")
									),					
						"staff capacity" => array(
										"description" => "Staff Capacities",
										"headings" => array("", "staff_type", "staff_number"),
										"widths" => array(7, 30, 35),
										"aligns" => array("R", "L", "R")
									)
					);	
					
					/*foreach (array_keys($headings) as $data) :						
						$data_details = array();
						foreach ($headings as $key => $value) :	
							if (in_array($key, array("executive director", "financial year", "registration type"))) {								
								$data_details_temp = array();
								foreach (array_filter($headings[$key]["headings"]) as $k => $v) :
									$field_name = (in_array($key, array("executive director", "financial year"))) ? str_replace(" ", "_", $key) . "_" . $v : $v;
									$data_details_temp[$v] = $r->$field_name;
								endforeach;
								$data_details[$key][] = (object) $data_details_temp;						
							} else {	
								$data_details[$key] = $entity::getOrganizationData($entity_id, $key, implode(", ", array_filter($value["headings"])), 
																				   STATUS_ACTIVE . "', '" . STATUS_REJECTED);						
							}
						endforeach;

						$j = 0;
						$tpdf->SetWidths($headings[$data]["widths"]);
						$tpdf->SetAligns($headings[$data]["aligns"]);
											
						$tpdf->SetFont("Arial", "B", 11);
						$tpdf->SetTextColor(0, 0, 255);			
						$tpdf->Ln(7);					
						$tpdf->Cell(190, 5, strtoupper($headings[$data]["description"]));
						$tpdf->Ln(7);					
						$tpdf->SetFont("Arial", "B", 10);
						$tpdf->SetTextColor(0, 0, 0);			

						$section_headings = array();
						//$section_headings = str_replace(" id", " ID", str_replace("_", " ", array_map("ucfirst", $headings[$data]["headings"])));
						foreach ($headings[$data]["headings"] as $section_heading) :
							$sh = ucwords(str_replace("_", " ", $section_heading));
							
							if (common::endsWith(strtolower($sh), " id")) {
								$replace_char = (in_array(strtolower($sh), array("national id"))) ? " ID" : "";
								$sh = str_replace(" Id", $replace_char, $sh);
							}
							if (strtolower($sh) === "vdc") 
								$sh = "Village Development Committee (" . strtoupper($sh) . ")";
							elseif (strtolower($sh) === "adc") 								
								$sh = "Area Development Committee (" . strtoupper($sh) . ")";
							
							$sh = str_replace("Funding ", "", $sh);								
							$sh = str_replace("Staff ", "", $sh);								
							$section_headings[] = $sh;
						endforeach;
						
						$tpdf->Row("", $section_headings, 1);					
						$tpdf->SetFont("Arial", "", 10);
						foreach ($data_details[$data] as $key => $value) :
							$j++;
							$details = array();
							if (!in_array($data, array("executive director", "financial year", "registration type")))
								$details[] = number_format($j, 0) . ".";
	
							foreach (array_filter($headings[$data]["headings"]) as $k => $v) :
								$field_value = $value->$v;
								
								if (common::endsWith($v, "_id") && !in_array($v, array("national_id"))) {
									$table_name = str_replace("_id", "", $v);
									$field_name = (in_array($table_name, array("district", "bank"))) ? $table_name . "_name" : $table_name;
									$table_id = $v;
									$field_value = common::getFieldValue($table_name, $field_name, $table_id, $field_value);
								} elseif (in_array($v, array("funding_amount", "staff_number"))) {
									// format funding amounts as money
									$field_value = number_format($field_value, 0);
								} elseif (in_array($v, array("start_month", "end_month"))) {
									// format months to month names
									$field_value = date("F", mktime(0, 0, 0, $field_value, 10));
								}
								
								$details[] = $field_value;
							endforeach;
							$tpdf->Row("", $details, 1);
						endforeach;
					endforeach;*/
					
					// print form footer
					$text4 = common::getFieldValue("template", "text4", "template", $this->report_name);
					$text5 = common::getFieldValue("template", "text5", "template", $this->report_name);
					$text6 = common::getFieldValue("template", "text6", "template", $this->report_name);
					$text7 = common::getFieldValue("template", "text7", "template", $this->report_name);
					$text8 = common::getFieldValue("template", "text8", "template", $this->report_name);
					$text9 = common::getFieldValue("template", "text9", "template", $this->report_name);
					
					$tpdf->Ln(7);
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->MultiCell(190, 5, $text4, 0, "L");
					$tpdf->Ln(5);				
					$tpdf->MultiCell(190, 5, $text5, 0, "L");
					$tpdf->Ln(7);
					
					//name and signature	
					$tpdf->SetDrawColor(0, 0, 0);		
					$tpdf->SetFont("Arial", "B", 11);
					$tpdf->SetTextColor(0, 0, 255);				
					$tpdf->MultiCell(190, 5, strtoupper($text6), 0, "L");
					$tpdf->SetFont("Arial", "", 12);				
					$tpdf->SetTextColor(0, 0, 0);
					$tpdf->Ln(5);
					$captured_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $r->captured_by, $blanks, $blanks, $blanks, $blanks, $blanks, 
														  $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_DELETED);
					$tpdf->Cell(20, 10, "Name");
					$tpdf->Cell(65, 10, $captured_by, "B");
					$tpdf->Cell(10, 10, "");
					$tpdf->Cell(20, 10, "Signature");
					$tpdf->Cell(65, 10, "", "B");
					$tpdf->Ln(10);
					
					// position and date
					$position = common::getFieldValue("user", "position", "username", $r->captured_by, $blanks, $blanks, $blanks, $blanks, $blanks, 
													  $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_DELETED);
					$date = date_format(date_create($r->captured_date), "j F Y"); 
					$tpdf->Cell(20, 10, "Position");
					$tpdf->Cell(65, 10, $position, "B");
					$tpdf->Cell(10, 10, "");
					$tpdf->Cell(20, 10, "Date");
					$tpdf->Cell(65, 10, $date, "B");
					$tpdf->Ln(10);
					
					// phone numbers and email
					$tpdf->Cell(20, 10, "Phone");
					$tpdf->Cell(65, 10, $r->telephone, "B");
					$tpdf->Cell(10, 10, "");
					$tpdf->Cell(20, 10, "Email");
					$tpdf->Cell(65, 10, $r->email, "B");
					$tpdf->Ln(20);
					
					// continue printing form footer
					$tpdf->MultiCell(190, 5, $text7, 0, "L");
					$tpdf->Ln(5);
					$account_details = explode("\r\n", $text8);
					foreach ($account_details as $account_detail) :
						$pos = strpos($account_detail, ":");
						$key = trim(substr($account_detail, 0, $pos));
						$value = trim(substr($account_detail, $pos + 1));
						$tpdf->SetFont("Arial", "B", 12);				
						$tpdf->Cell(50, 5, $key);
						$tpdf->SetFont("Arial", "", 12);				
						$tpdf->Cell(50, 5, $value);
						$tpdf->Ln(5);
					endforeach;
					
					// for offical use
					$tpdf->SetDrawColor(191, 191, 191);
					$tpdf->Ln(5);
					$tpdf->SetFont("Arial", "B", 11);
					$tpdf->SetTextColor(0, 0, 255);							
					$tpdf->MultiCell(190, 5, strtoupper($text9), 0, "L");
					$tpdf->Ln(5);
					
					$tpdf->SetFont("Arial", "", 10);	
					$tpdf->SetTextColor(0, 0, 0);							
					$approved1_by = $approved2_by = $rejected_by = $approved1_comments = $approved2_comments = $rejected_comments = "";
					$for_offical_use = array();
					if (strlen($r->approved1_by) > 0) {
						$approved1_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $r->approved1_by, $blanks, $blanks, $blanks, $blanks, 
															  $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_DELETED);
						$approved1_date = date_format(date_create($r->approved1_date), "d F Y");
						$approved1_by  = "$approved1_by / $approved1_date";
					}					
					$for_offical_use[] = array("First Approver", $approved1_by, $approved1_comments);
										
					if (strlen($r->approved2_by) > 0) {
						$approved2_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $r->approved2_by, $blanks, $blanks, $blanks, $blanks, 
															  $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_DELETED);						
						$approved2_date = date_format(date_create($r->approved2_date), "d F Y");
						$approved2_by  = "$approved2_by / $approved2_date";
					}					
					$for_offical_use[] = array("Second Approver", $approved2_by, $approved2_comments);

					if ($approval_status === STATUS_REJECTED) {
						$rejected_by = common::getFieldValue("user", "CONCAT(firstname, ' ', lastname)", "username", $r->rejected_by, $blanks, $blanks, $blanks, $blanks, 
															  $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_DELETED);
						$rejected_date = date_format(date_create($r->rejected_date), "d F Y");
						$rejected_by  = "$rejected_by / $rejected_date";
						$rejected_comments = $r->rejected_comments;
						
						$for_offical_use[] = array("Rejected By", $rejected_by, $rejected_comments);
					}
					
					$for_offical_use[] = array("Filed By", "", "");
					$for_offical_use[] = array("Notes", "", "");
					
					$tpdf->SetWidths(array(40, 90, 60));
					$tpdf->SetAligns(array("L", "L", "L"));										
					foreach ($for_offical_use as $o) :					
						$tpdf->Row(5, $o, 1);
					endforeach;
				endforeach;
				
				// qualify report name so that it is descriptive when the user activity is logged
				$report_title = "$this->report_name for ";
				$report_title .= (strlen($organization_name) > 0) ? "'$organization_name'" : "new organization";
				$report_str = "";				
				$action = "Download $this->report_name";
			}

			// download the report
			if ($this->return_report)
				return $tpdf->Output($title, "S"); // return back the report. for example, to be attached to an email
			else
				$tpdf->Output($title, "D");
		}
		
		$_SESSION["message"] = "$report_title$report_str" . MESSAGE_SUCCESS . "generated";
		$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		
		// log the user activity
		audit_trail::log_trail($action, $_SESSION["message"], $this->printed_by, "Reports");
	}
	
	/**
	 * Add report
	 *
	 */
	public function add()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("report", 0, "report_name", $this->report_name);
		
		if ($exists) {											
			$_SESSION["message"] = "Report '$this->report_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "INSERT INTO {$table_prefix}report (report_name, description, destination, sort_order, captured_by, captured_date, status) VALUES('";
		$sql .= $conn->real_escape_string($this->report_name) . "', '" . $conn->real_escape_string($this->description)."', '".$conn->real_escape_string($this->destination)."', '";
		$sql .= $conn->real_escape_string($this->sort_order) . "', '" . $conn->real_escape_string($this->captured_by) ."', NOW(), '".$conn->real_escape_string(STATUS_ACTIVE)."')";
		
		$result = $conn->query($sql);
		if ($result) {
			$_SESSION["message"] = "Report '$this->report_name'" . MESSAGE_SUCCESS . "added";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
					
		// log the user activity
		audit_trail::log_trail("Add", $_SESSION["message"], $this->captured_by, "Reports", mysqli_insert_id($conn));
	}
	
	/**
	 * Edit report
	 * 
	 */
	public function edit()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("report", $this->report_id, "report_name", $this->report_name);
		
		if ($exists) {											
			$_SESSION["message"] = "Report '$this->report_name'" . MESSAGE_EXIST;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}
		
		$sql = "UPDATE {$table_prefix}report SET report_name = '" . $conn->real_escape_string($this->report_name) . "', description = '";
		$sql .= $conn->real_escape_string($this->description) . "', destination = '" . $conn->real_escape_string($this->destination) . "', sort_order = '";
		$sql .= $conn->real_escape_string($this->sort_order) . "', last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() WHERE ";
		$sql .= "report_id = '" . $conn->real_escape_string($this->report_id) . "'";
	  	
		$result = $conn->query($sql);
		
		if ($result) {
			$_SESSION["message"] =  "Report '$this->report_name'" . MESSAGE_SUCCESS . "updated";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
					
		// log the user activity
		audit_trail::log_trail("Update", $_SESSION["message"], $this->last_edited_by, "Reports", $this->report_id);
	}
	
   /**
	 * Delete report
	 *
	 */
	public function delete()
	{
		
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		// check if this report is in use
        $is_used = false;

		if ($is_used) {											
			$_SESSION["message"] = "Report '$this->report_name'" . MESSAGE_IN_USE;
			$_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
			return;
		}

		$sql = "UPDATE {$table_prefix}report SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '" .$conn->real_escape_string($this->deleted_by)."', ";
		$sql .= "deleted_date = NOW() WHERE report_id = '" . $conn->real_escape_string($this->report_id) . "'";
		
		$result = $conn->query($sql);
	
		if ($result) {
			$_SESSION["message"] = "Report '$this->report_name'" . MESSAGE_SUCCESS . "deleted";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Reports", $this->report_id);
	}
	
    /**
	 * List all reports
	 *
 	 * @param report_id
	 *
 	 * @return array of reports
	 */
	public static function all($report_id = "")
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
       
	    $reports = array();
		$sql = "SELECT * FROM {$table_prefix}report WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($report_id) > 0) $sql .= "AND report_id = '" . $conn->real_escape_string($report_id) . "' ";
		$sql .= "ORDER BY sort_order, report_name";
		
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $reports[] = $row;
        }
        return $reports;
    }
	
	/**
	 * List all report destinations
	 *
	 * @param display_section
	 *
 	 * @return array of report destinations
	 */
	public static function getReportDestinations($display_section = "")
    {
        $conn = config::connect();
		$table_prefix = TABLE_PREFIX;		
       
	    $destinations = array();
		$sql = "SELECT * FROM {$table_prefix}report_destination WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		if (strlen($display_section) > 0) $sql .= "AND display_section = '" . $conn->real_escape_string($display_section) . "' ";
		$sql .= "ORDER BY sort_order";
		
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            $destinations[] = $row;
        }
        return $destinations;
    }

    /**
	 * Print column chart
	 *
	 */	
	public static function printColumnChart($pdf, $data, $w = 0, $h = 0, $x = 0, $y = 0, $legends = null) {
		$orientation_width_height = report::GetOrientationWidthHeight($data);
		$orientation = $orientation_width_height[0];
		if ($w > 0 && $h > 0) {
			$width = $w;
			$height = $h;
		} else {
			$width = $orientation_width_height[1];
			$height = $orientation_width_height[2];
		}
			
		$pdf->Ln(10);
		$valX = $pdf->GetX() + $x; // +5 distance from left margin (identation)
		$valY = $pdf->GetY() - $y; // distance from top margin 
		$pdf->SetXY($valX, $valY);
		$pdf->ColumnChart($width, $height, $data, $legends, null, array(255,175,100), $orientation);
	}
	
	/**
	 * Get orientation, width and height
	 *
	 */
	public static function GetOrientationWidthHeight($data) {
		$items_in_graph = count($data);
		if ($items_in_graph > MAX_ITEMS_IN_GRAPH) {
			$orientation = "L";
			$width = 272;
			$height = 90;	
		} else {
			$orientation = "P";
			$width = 185;
			$height = 100;	
		}
		$orientation_width_height = array($orientation, $width, $height);
		return $orientation_width_height;
	}	
}