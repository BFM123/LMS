<?php
require_once "common.php";
require_once "user.php";
require_once "certificate.php";
require_once "fee.php";
require_once "invoice.php";
require_once "send_email.php";

/**
 * organization class
 */
class organization
{
   /**
	* declarations
	*/
    private $organization_id;
    private $organization_name;
    private $abbreviation;
    private $charity_number;
    private $telephone;
    private $email;
    private $organization_type;
    private $registration_type;
    private $postal_address;
    private $district_id;
    private $physical_address;
    private $objective_id;
    private $objectives;
    private $staff_capacity_id;
    private $staff_capacity_type;
    private $staff_capacity_number;
    private $sector_id;
    private $sectors;
    private $location_activity_id;
    private $location_activities_vdc;
    private $location_activities_adc;
    private $location_activities_district_id;
    private $target_group_id;
    private $target_groups;
    private $executive_director_fullname;
    private $executive_director_nationality;
	private $executive_director_national_id;
    private $executive_director_highest_qualification;
    private $executive_director_email;
    private $executive_director_telephone;
    private $trustee_id;
    private $directors_trustees_fullname;
    private $directors_trustees_telephone;
    private $directors_trustees_email;
    private $directors_trustees_occupation;
    private $directors_trustees_nationality;
    private $directors_trustees_national_id;
    private $directors_trustees_position;
    private $directors_trustees_timeframe;
    private $financial_year_start_month;
    private $financial_year_end_month;
    private $annual_income;
    private $source_funding_id;
    private $source_funding_donor_id;
    private $source_funding_contact_details;
    private $source_funding_currency;
    private $source_funding_amount;
    private $auditor_id;
    private $auditor_name;
    private $auditor_address;
    private $auditor_telephone;
    private $auditor_email;
    private $organization_bank_id;
    private $bank_id;
    private $bank_address;
    private $bank_telephone;
    private $bank_email;	
	private $tep_id;
    private $tep_fullname;
    private $tep_nationality;
    private $tep_passport_number;   
    private $document_id;
    private $documents;
    private $record_control;
    private $update_annual_return_info;
    private $captured_by;
    private $action;
    private $user_action;
    private $last_edited_by;
    private $approved_by;
    private $rejected_comments;
    private $deleted_by;
    private $status;

    /**
     * Get the value of organization_id
     *
     * @return mixed
     */
    public function getOrganizationID()
    {
        return $this->organization_id;
    }
 
    /**
     * Set the value of organization_id
     *
     * @param mixed organization_id
     *
     * @return self
     */
    public function setOrganizationID($organization_id)
    {
        $this->organization_id = $organization_id;

        return $this;
    }
 
    /**
     * Get the value of organization_name
     *
     * @return mixed
     */
    public function getOrganizationName()
    {
        return $this->organization_name;
    }
 
    /**
     * Set the value of organization_name
     *
     * @param mixed organization_name
     *
     * @return self
     */
    public function setOrganizationName($organization_name)
    {
        $this->organization_name = $organization_name;

        return $this;
    }
 
    /**
     * Get the value of abbreviation
     *
     * @return mixed
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }
 
    /**
     * Set the value of abbreviation
     *
     * @param mixed abbreviation
     *
     * @return self
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }
 
    /**
     * Get the value of charity_number
     *
     * @return mixed
     */
    public function getCharityNumber()
    {
        return $this->charity_number;
    }
 
    /**
     * Set the value of charity_number
     *
     * @param mixed charity_number
     *
     * @return self
     */
    public function setCharityNumber($charity_number)
    {
        $this->charity_number = $charity_number;

        return $this;
    }
 
    /**
     * Get the value of telephone
     *
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
 
    /**
     * Set the value of telephone
     *
     * @param mixed telephone
     *
     * @return self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }
 
    /**
     * Get the value of email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
 
    /**
     * Set the value of email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
 
    /**
     * Get the value of organization_type
     *
     * @return mixed
     */
    public function getOrganizationType()
    {
        return $this->organization_type;
    }
 
    /**
     * Set the value of organization_type
     *
     * @param mixed organization_type
     *
     * @return self
     */
    public function setOrganizationType($organization_type)
    {
        $this->organization_type = $organization_type;

        return $this;
    }
 
    /**
     * Get the value of registration_type
     *
     * @return mixed
     */
    public function getRegistrationType()
    {
        return $this->registration_type;
    }
 
    /**
     * Set the value of registration_type
     *
     * @param mixed registration_type
     *
     * @return self
     */
    public function setRegistrationType($registration_type)
    {
        $this->registration_type = $registration_type;

        return $this;
    }
 
    /**
     * Get the value of postal_address
     *
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->postal_address;
    }
 
    /**
     * Set the value of postal_address
     *
     * @param mixed postal_address
     *
     * @return self
     */
    public function setPostalAddress($postal_address)
    {
        $this->postal_address = $postal_address;

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
     * Get the value of physical_address
     *
     * @return mixed
     */
    public function getPhysicalAddress()
    {
        return $this->physical_address;
    }
 
    /**
     * Set the value of physical_address
     *
     * @param mixed physical_address
     *
     * @return self
     */
    public function setPhysicalAddress($physical_address)
    {
        $this->physical_address = $physical_address;

        return $this;
    }
 
    /**
     * Get the value of objective_id
     *
     * @return mixed
     */
    public function getObjectiveID()
    {
        return $this->objective_id;
    }
 
    /**
     * Set the value of objective_id
     *
     * @param mixed objective_id
     *
     * @return self
     */
    public function setObjectiveID($objective_id)
    {
        $this->objective_id = $objective_id;

        return $this;
    }
 
    /**
     * Get the value of objectives
     *
     * @return mixed
     */
    public function getObjectives()
    {
        return $this->objectives;
    }
 
    /**
     * Set the value of objectives
     *
     * @param mixed objectives
     *
     * @return self
     */
    public function setObjectives($objectives)
    {
        $this->objectives = $objectives;

        return $this;
    }
 
    /**
     * Get the value of staff_capacity_id
     *
     * @return mixed
     */
    public function getStaffCapacityID()
    {
        return $this->staff_capacity_id;
    }
 
    /**
     * Set the value of staff_capacity_id
     *
     * @param mixed staff_capacity_id
     *
     * @return self
     */
    public function setStaffCapacityID($staff_capacity_id)
    {
        $this->staff_capacity_id = $staff_capacity_id;

        return $this;
    }
 
    /**
     * Get the value of staff_capacity_type
     *
     * @return mixed
     */
    public function getStaffCapacityType()
    {
        return $this->staff_capacity_type;
    }
 
    /**
     * Set the value of staff_capacity_type
     *
     * @param mixed staff_capacity_type
     *
     * @return self
     */
    public function setStaffCapacityType($staff_capacity_type)
    {
        $this->staff_capacity_type = $staff_capacity_type;

        return $this;
    }
 
    /**
     * Get the value of staff_capacity_number
     *
     * @return mixed
     */
    public function getStaffCapacityNumber()
    {
        return $this->staff_capacity_number;
    }
 
    /**
     * Set the value of staff_capacity_number
     *
     * @param mixed staff_capacity_number
     *
     * @return self
     */
    public function setStaffCapacityNumber($staff_capacity_number)
    {
        $this->staff_capacity_number = $staff_capacity_number;

        return $this;
    }
  
    /**
     * Get the value of sector_id
     *
     * @return mixed
     */
    public function getSectorID()
    {
        return $this->sector_id;
    }
 
    /**
     * Set the value of sector_id
     *
     * @param mixed sector_id
     *
     * @return self
     */
    public function setSectorID($sector_id)
    {
        $this->sector_id = $sector_id;

        return $this;
    }
	
    /**
     * Get the value of sectors
     *
     * @return mixed
     */
    public function getSectors()
    {
        return $this->sectors;
    }
 
    /**
     * Set the value of sectors
     *
     * @param mixed sectors
     *
     * @return self
     */
    public function setSectors($sectors)
    {
        $this->sectors = $sectors;

        return $this;
    }
 
    /**
     * Get the value of location_activity_id
     *
     * @return mixed
     */
    public function getLocationActivityID()
    {
        return $this->location_activity_id;
    }
 
    /**
     * Set the value of location_activity_id
     *
     * @param mixed location_activity_id
     *
     * @return self
     */
    public function setLocationActivityID($location_activity_id)
    {
        $this->location_activity_id = $location_activity_id;

        return $this;
    }
	
    /**
     * Get the value of location_activities_vdc
     *
     * @return mixed
     */
    public function getLocationActivitiesVDC()
    {
        return $this->location_activities_vdc;
    }
 
    /**
     * Set the value of location_activities_vdc
     *
     * @param mixed location_activities_vdc
     *
     * @return self
     */
    public function setLocationActivitiesVDC($location_activities_vdc)
    {
        $this->location_activities_vdc = $location_activities_vdc;

        return $this;
    }
 
    /**
     * Get the value of location_activities_adc
     *
     * @return mixed
     */
    public function getLocationActivitiesADC()
    {
        return $this->location_activities_adc;
    }
 
    /**
     * Set the value of location_activities_adc
     *
     * @param mixed location_activities_adc
     *
     * @return self
     */
    public function setLocationActivitiesADC($location_activities_adc)
    {
        $this->location_activities_adc = $location_activities_adc;

        return $this;
    }
 
    /**
     * Get the value of location_activities_district_id
     *
     * @return mixed
     */
    public function getLocationActivitiesDistrictID()
    {
        return $this->location_activities_district_id;
    }
 
    /**
     * Set the value of location_activities_district_id
     *
     * @param mixed location_activities_district_id
     *
     * @return self
     */
    public function setLocationActivitiesDistrictID($location_activities_district_id)
    {
        $this->location_activities_district_id = $location_activities_district_id;

        return $this;
    }
 
    /**
     * Get the value of target_group_id
     *
     * @return mixed
     */
    public function getTargetGroupID()
    {
        return $this->target_group_id;
    }
 
    /**
     * Set the value of target_group_id
     *
     * @param mixed target_group_id
     *
     * @return self
     */
    public function setTargetGroupID($target_group_id)
    {
        $this->target_group_id = $target_group_id;

        return $this;
    }
	
    /**
     * Get the value of target_groups
     *
     * @return mixed
     */
    public function getTargetGroups()
    {
        return $this->target_groups;
    }
 
    /**
     * Set the value of target_groups
     *
     * @param mixed target_groups
     *
     * @return self
     */
    public function setTargetGroups($target_groups)
    {
        $this->target_groups = $target_groups;

        return $this;
    }
 
    /**
     * Get the value of executive_director_fullname
     *
     * @return mixed
     */
    public function getExecutiveDirectorFullname()
    {
        return $this->executive_director_fullname;
    }
 
    /**
     * Set the value of executive_director_fullname
     *
     * @param mixed executive_director_fullname
     *
     * @return self
     */
    public function setExecutiveDirectorFullname($executive_director_fullname)
    {
        $this->executive_director_fullname = $executive_director_fullname;

        return $this;
    }
 
    /**
     * Get the value of executive_director_nationality
     *
     * @return mixed
     */
    public function getExecutiveDirectorNationality()
    {
        return $this->executive_director_nationality;
    }
 
    /**
     * Set the value of executive_director_nationality
     *
     * @param mixed executive_director_nationality
     *
     * @return self
     */
    public function setExecutiveDirectorNationality($executive_director_nationality)
    {
        $this->executive_director_nationality = $executive_director_nationality;

        return $this;
    }
	
	/**
     * Get the value of executive_director_national_id
     *
     * @return mixed
     */
    public function getExecutiveDirectorNationalID()
    {
        return $this->executive_director_national_id;
    }
 
    /**
     * Set the value of executive_director_national_id
     *
     * @param mixed executive_director_national_id
     *
     * @return self
     */
    public function setExecutiveDirectorNationalID($executive_director_national_id)
    {
        $this->executive_director_national_id = $executive_director_national_id;

        return $this;
    }
 
    /**
     * Get the value of executive_director_highest_qualification
     *
     * @return mixed
     */
    public function getExecutiveDirectorHighestQualification()
    {
        return $this->executive_director_highest_qualification;
    }
 
    /**
     * Set the value of executive_director_highest_qualification
     *
     * @param mixed executive_director_highest_qualification
     *
     * @return self
     */
    public function setExecutiveDirectorHighestQualification($executive_director_highest_qualification)
    {
        $this->executive_director_highest_qualification = $executive_director_highest_qualification;

        return $this;
    }
 
    /**
     * Get the value of executive_director_email
     *
     * @return mixed
     */
    public function getExecutiveDirectorEmail()
    {
        return $this->executive_director_email;
    }
 
    /**
     * Set the value of executive_director_email
     *
     * @param mixed executive_director_email
     *
     * @return self
     */
    public function setExecutiveDirectorEmail($executive_director_email)
    {
        $this->executive_director_email = $executive_director_email;

        return $this;
    }
 
    /**
     * Get the value of executive_director_telephone
     *
     * @return mixed
     */
    public function getExecutiveDirectorTelephone()
    {
        return $this->executive_director_telephone;
    }
 
    /**
     * Set the value of executive_director_telephone
     *
     * @param mixed executive_director_telephone
     *
     * @return self
     */
    public function setExecutiveDirectorTelephone($executive_director_telephone)
    {
        $this->executive_director_telephone = $executive_director_telephone;

        return $this;
    }
	
	/**
     * Get the value of trustee_id
     *
     * @return mixed
     */
    public function getTrusteeID()
    {
        return $this->trustee_id;
    }
 
    /**
     * Set the value of trustee_id
     *
     * @param mixed trustee_id
     *
     * @return self
     */
    public function setTrusteeID($trustee_id)
    {
        $this->trustee_id = $trustee_id;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_fullname
     *
     * @return mixed
     */
    public function getDirectorsTrusteesFullname()
    {
        return $this->directors_trustees_fullname;
    }
 
    /**
     * Set the value of directors_trustees_fullname
     *
     * @param mixed directors_trustees_fullname
     *
     * @return self
     */
    public function setDirectorsTrusteesFullname($directors_trustees_fullname)
    {
        $this->directors_trustees_fullname = $directors_trustees_fullname;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_telephone
     *
     * @return mixed
     */
    public function getDirectorsTrusteesTelephone()
    {
        return $this->directors_trustees_telephone;
    }
 
    /**
     * Set the value of directors_trustees_telephone
     *
     * @param mixed directors_trustees_telephone
     *
     * @return self
     */
    public function setDirectorsTrusteesTelephone($directors_trustees_telephone)
    {
        $this->directors_trustees_telephone = $directors_trustees_telephone;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_email
     *
     * @return mixed
     */
    public function getDirectorsTrusteesEmail()
    {
        return $this->directors_trustees_email;
    }
 
    /**
     * Set the value of directors_trustees_email
     *
     * @param mixed directors_trustees_email
     *
     * @return self
     */
    public function setDirectorsTrusteesEmail($directors_trustees_email)
    {
        $this->directors_trustees_email = $directors_trustees_email;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_occupation
     *
     * @return mixed
     */
    public function getDirectorsTrusteesOccupation()
    {
        return $this->directors_trustees_occupation;
    }
 
    /**
     * Set the value of directors_trustees_occupation
     *
     * @param mixed directors_trustees_occupation
     *
     * @return self
     */
    public function setDirectorsTrusteesOccupation($directors_trustees_occupation)
    {
        $this->directors_trustees_occupation = $directors_trustees_occupation;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_nationality
     *
     * @return mixed
     */
    public function getDirectorsTrusteesNationality()
    {
        return $this->directors_trustees_nationality;
    }
 
    /**
     * Set the value of directors_trustees_nationality
     *
     * @param mixed directors_trustees_nationality
     *
     * @return self
     */
    public function setDirectorsTrusteesNationality($directors_trustees_nationality)
    {
        $this->directors_trustees_nationality = $directors_trustees_nationality;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_national_id
     *
     * @return mixed
     */
    public function getDirectorsTrusteesNationalID()
    {
        return $this->directors_trustees_national_id;
    }
 
    /**
     * Set the value of directors_trustees_national_id
     *
     * @param mixed directors_trustees_national_id
     *
     * @return self
     */
    public function setDirectorsTrusteesNationalID($directors_trustees_national_id)
    {
        $this->directors_trustees_national_id = $directors_trustees_national_id;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_position
     *
     * @return mixed
     */
    public function getDirectorsTrusteesPosition()
    {
        return $this->directors_trustees_position;
    }
 
    /**
     * Set the value of directors_trustees_position
     *
     * @param mixed directors_trustees_position
     *
     * @return self
     */
    public function setDirectorsTrusteesPosition($directors_trustees_position)
    {
        $this->directors_trustees_position = $directors_trustees_position;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_timeframe
     *
     * @return mixed
     */
    public function getDirectorsTrusteesTimeframe()
    {
        return $this->directors_trustees_timeframe;
    }
 
    /**
     * Set the value of directors_trustees_timeframe
     *
     * @param mixed directors_trustees_timeframe
     *
     * @return self
     */
    public function setDirectorsTrusteesTimeframe($directors_trustees_timeframe)
    {
        $this->directors_trustees_timeframe = $directors_trustees_timeframe;

        return $this;
    }
 
    /**
     * Get the value of financial_year_start_month
     *
     * @return mixed
     */
    public function getFinancialYearStartMonth()
    {
        return $this->financial_year_start_month;
    }
 
    /**
     * Set the value of financial_year_start_month
     *
     * @param mixed financial_year_start_month
     *
     * @return self
     */
    public function setFinancialYearStartMonth($financial_year_start_month)
    {
        $this->financial_year_start_month = $financial_year_start_month;

        return $this;
    }
 
    /**
     * Get the value of financial_year_end_month
     *
     * @return mixed
     */
    public function getFinancialYearEndMonth()
    {
        return $this->financial_year_end_month;
    }
 
    /**
     * Set the value of financial_year_end_month
     *
     * @param mixed financial_year_end_month
     *
     * @return self
     */
    public function setFinancialYearEndMonth($financial_year_end_month)
    {
        $this->financial_year_end_month = $financial_year_end_month;

        return $this;
    }

    /**
     * Get the value of annual_income
     *
     * @return mixed
     */
    public function getAnnualIncome()
    {
        return $this->annual_income;
    }
 
    /**
     * Set the value of annual_income
     *
     * @param mixed annual_income
     *
     * @return self
     */
    public function setAnnualIncome($annual_income)
    {
        $this->annual_income = $annual_income;

        return $this;
    }

    /**
     * Get the value of source_funding_id
     *
     * @return mixed
     */
    public function getSourceFundingID()
    {
        return $this->source_funding_id;
    }
 
    /**
     * Set the value of source_funding_id
     *
     * @param mixed source_funding_id
     *
     * @return self
     */
    public function setSourceFundingID($source_funding_id)
    {
        $this->source_funding_id = $source_funding_id;

        return $this;
    }
 
    /**
     * Get the value of source_funding_donor_id
     *
     * @return mixed
     */
    public function getSourceFundingDonorID()
    {
        return $this->source_funding_donor_id;
    }
 
    /**
     * Set the value of source_funding_donor_id
     *
     * @param mixed source_funding_donor_id
     *
     * @return self
     */
    public function setSourceFundingDonorID($source_funding_donor_id)
    {
        $this->source_funding_donor_id = $source_funding_donor_id;

        return $this;
    }
 
    /**
     * Get the value of source_funding_contact_details
     *
     * @return mixed
     */
    public function getSourceFundingContactDetails()
    {
        return $this->source_funding_contact_details;
    }
 
    /**
     * Set the value of source_funding_contact_details
     *
     * @param mixed source_funding_contact_details
     *
     * @return self
     */
    public function setSourceFundingContactDetails($source_funding_contact_details)
    {
        $this->source_funding_contact_details = $source_funding_contact_details;

        return $this;
    }
 
    /**
     * Get the value of source_funding_currency
     *
     * @return mixed
     */
    public function getSourceFundingCurrency()
    {
        return $this->source_funding_currency;
    }
 
    /**
     * Set the value of source_funding_currency
     *
     * @param mixed source_funding_currency
     *
     * @return self
     */
    public function setSourceFundingCurrency($source_funding_currency)
    {
        $this->source_funding_currency = $source_funding_currency;

        return $this;
    }
 
    /**
     * Get the value of source_funding_amount
     *
     * @return mixed
     */
    public function getSourceFundingAmount()
    {
        return $this->source_funding_amount;
    }
 
    /**
     * Set the value of source_funding_amount
     *
     * @param mixed source_funding_amount
     *
     * @return self
     */
    public function setSourceFundingAmount($source_funding_amount)
    {
        $this->source_funding_amount = $source_funding_amount;

        return $this;
    }
 
    /**
     * Get the value of auditor_id
     *
     * @return mixed
     */
    public function getAuditorID()
    {
        return $this->auditor_id;
    }
 
    /**
     * Set the value of auditor_id
     *
     * @param mixed auditor_id
     *
     * @return self
     */
    public function setAuditorID($auditor_id)
    {
        $this->auditor_id = $auditor_id;

        return $this;
    }
	
    /**
     * Get the value of auditor_name
     *
     * @return mixed
     */
    public function getAuditorName()
    {
        return $this->auditor_name;
    }
 
    /**
     * Set the value of auditor_name
     *
     * @param mixed auditor_name
     *
     * @return self
     */
    public function setAuditorName($auditor_name)
    {
        $this->auditor_name = $auditor_name;

        return $this;
    }
 
    /**
     * Get the value of auditor_address
     *
     * @return mixed
     */
    public function getAuditorAddress()
    {
        return $this->auditor_address;
    }
 
    /**
     * Set the value of auditor_address
     *
     * @param mixed auditor_address
     *
     * @return self
     */
    public function setAuditorAddress($auditor_address)
    {
        $this->auditor_address = $auditor_address;

        return $this;
    }
 
    /**
     * Get the value of auditor_telephone
     *
     * @return mixed
     */
    public function getAuditorTelephone()
    {
        return $this->auditor_telephone;
    }
 
    /**
     * Set the value of auditor_telephone
     *
     * @param mixed auditor_telephone
     *
     * @return self
     */
    public function setAuditorTelephone($auditor_telephone)
    {
        $this->auditor_telephone = $auditor_telephone;

        return $this;
    }
 
    /**
     * Get the value of auditor_email
     *
     * @return mixed
     */
    public function getAuditorEmail()
    {
        return $this->auditor_email;
    }
 
    /**
     * Set the value of auditor_email
     *
     * @param mixed auditor_email
     *
     * @return self
     */
    public function setAuditorEmail($auditor_email)
    {
        $this->auditor_email = $auditor_email;

        return $this;
    }
 
    /**
     * Get the value of organization_bank_id
     *
     * @return mixed
     */
    public function getOrganizationBankID()
    {
        return $this->organization_bank_id;
    }
 
    /**
     * Set the value of organization_bank_id
     *
     * @param mixed organization_bank_id
     *
     * @return self
     */
    public function setOrganizationBankID($organization_bank_id)
    {
        $this->organization_bank_id = $organization_bank_id;

        return $this;
    }
	
    /**
     * Get the value of bank_id
     *
     * @return mixed
     */
    public function getBankID()
    {
        return $this->bank_id;
    }
 
    /**
     * Set the value of bank_id
     *
     * @param mixed bank_id
     *
     * @return self
     */
    public function setBankID($bank_id)
    {
        $this->bank_id = $bank_id;

        return $this;
    }
 
    /**
     * Get the value of bank_address
     *
     * @return mixed
     */
    public function getBankAddress()
    {
        return $this->bank_address;
    }
 
    /**
     * Set the value of bank_address
     *
     * @param mixed bank_address
     *
     * @return self
     */
    public function setBankAddress($bank_address)
    {
        $this->bank_address = $bank_address;

        return $this;
    }
 
    /**
     * Get the value of bank_telephone
     *
     * @return mixed
     */
    public function getBankTelephone()
    {
        return $this->bank_telephone;
    }
 
    /**
     * Set the value of bank_telephone
     *
     * @param mixed bank_telephone
     *
     * @return self
     */
    public function setBankTelephone($bank_telephone)
    {
        $this->bank_telephone = $bank_telephone;

        return $this;
    }
 
    /**
     * Get the value of bank_email
     *
     * @return mixed
     */
    public function getBankEmail()
    {
        return $this->bank_email;
    }
 
    /**
     * Set the value of bank_email
     *
     * @param mixed bank_email
     *
     * @return self
     */
    public function setBankEmail($bank_email)
    {
        $this->bank_email = $bank_email;

        return $this;
    }
	
	/**
     * Get the value of tep_id
     *
     * @return mixed
     */
    public function getTEPID()
    {
        return $this->tep_id;
    }

    /**
     * Set the value of tep_id
     *
     * @param mixed tep_id
     *
     * @return self
     */
    public function setTEPID($tep_id)
    {
        $this->tep_id = $tep_id;

        return $this;
    }

    /**
     * Get the value of tep_fullname
     *
     * @return mixed
     */
    public function getTEPFullname()
    {
        return $this->tep_fullname;
    }

    /**
     * Set the value of tep_fullname
     *
     * @param mixed tep_fullname
     *
     * @return self
     */
    public function setTEPFullname($tep_fullname)
    {
        $this->tep_fullname = $tep_fullname;

        return $this;
    }

    /**
     * Get the value of tep_nationality
     *
     * @return mixed
     */
    public function getTEPNationality()
    {
        return $this->tep_nationality;
    }

    /**
     * Set the value of tep_nationality
     *
     * @param mixed tep_nationality
     *
     * @return self
     */
    public function setTEPNationality($tep_nationality)
    {
        $this->tep_nationality = $tep_nationality;

        return $this;
    }

    /**
     * Get the value of tep_passport_number
     *
     * @return mixed
     */
    public function getTEPPassportNumber()
    {
        return $this->tep_passport_number;
    }

    /**
     * Set the value of tep_passport_number
     *
     * @param mixed tep_passport_number
     *
     * @return self
     */
    public function setTEPPassportNumber($tep_passport_number)
    {
        $this->tep_passport_number = $tep_passport_number;

        return $this;
    }
 
    /**
     * Get the value of document_id
     *
     * @return mixed
     */
    public function getDocumentID()
    {
        return $this->document_id;
    }
 
    /**
     * Set the value of document_id
     *
     * @param mixed document_id
     *
     * @return self
     */
    public function setDocumentID($document_id)
    {
        $this->document_id = $document_id;

        return $this;
    }
 
    /**
     * Get the value of documents
     *
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }
 
    /**
     * Set the value of documents
     *
     * @param mixed documents
     *
     * @return self
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;

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
     * Get the value of action
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
 
    /**
     * Set the value of action
     *
     * @param mixed action
     *
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }  
  
   /**
     * Get the value of user_action
     *
     * @return mixed
     */
    public function getUserAction()
    {
        return $this->user_action;
    }
 
    /**
     * Set the value of user_action
     *
     * @param mixed user_action
     *
     * @return self
     */
    public function setUserAction($user_action)
    {
        $this->user_action = $user_action;

        return $this;
    }  
  
    /**
     * Get the value of last_edited_by
     *
     * @return mixed
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
     * Get the value of approved_by
     *
     * @return mixed
     */
    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    /**
     * Set the value of approved_by
     *
     * @param mixed approved_by
     *
     * @return self
     */
    public function setApprovedBy($approved_by)
    {
        $this->approved_by = $approved_by;

        return $this;
    }

    /**
     * Get the value of deleted_by
     *
     * @return mixed
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
     * Get the value of rejected_comments
     *
     * @return mixed
     */
    public function getRejectedComments()
    {
        return $this->rejected_comments;
    }

    /**
     * Set the value of rejected_comments
     *
     * @param mixed rejected_comments
     *
     * @return self
     */
    public function setRejectedComments($rejected_comments)
    {
        $this->rejected_comments = $rejected_comments;

        return $this;
    }

	/**
     * Get the value of record_control
     *
     * @return mixed
     */
    public function getRecordControl()
    {
        return $this->record_control;
    }

    /**
     * Set the value of record_control
     *
     * @param mixed record_control
     *
     * @return self
     */
    public function setRecordControl($record_control)
    {
        $this->record_control = $record_control;

        return $this;
    }
	
	
	/**
     * Get the value of update_annual_return_info
     *
     * @return mixed
     */
    public function getUpdateAnnualReturnInfo()
    {
        return $this->update_annual_return_info;
    }

    /**
     * Set the value of update_annual_return_info
     *
     * @param mixed update_annual_return_info
     *
     * @return self
     */
    public function setUpdateAnnualReturnInfo($update_annual_return_info)
    {
        $this->update_annual_return_info = $update_annual_return_info;

        return $this;
    }

    /**
     * Register organization
	 *
     */
    public function register()
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0];
		
		$exists = common::exists("organization", 0, "organization_name", $this->organization_name);

        if ($exists) {
            $_SESSION["message"] = "NGO '$this->organization_name'" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
				
		// 1. submit organization for registtration
		$sql = "INSERT INTO {$table_prefix}organization (abbreviation, organization_name, charity_number, telephone, email, registration_type, postal_address, physical_address, ";
		$sql .= "district_id, executive_director_fullname, executive_director_nationality, executive_director_national_id, executive_director_highest_qualification, ";
		$sql .= "executive_director_email, executive_director_telephone, financial_year_start_month, financial_year_end_month, annual_income, organization_type, record_control, ";
		$sql .= "captured_by, captured_date, status) VALUES('" . $conn->real_escape_string($this->abbreviation) ."', '".$conn->real_escape_string($this->organization_name)."', '";
		$sql .= $conn->real_escape_string($this->charity_number) . "', '" . $conn->real_escape_string($this->telephone) . "', '";
		$sql .= $conn->real_escape_string($this->email) . "', '" . $conn->real_escape_string($this->registration_type) . "', '";
		$sql .= $conn->real_escape_string($this->postal_address) . "', '" . $conn->real_escape_string($this->physical_address) . "', '";
		$sql .= $conn->real_escape_string($this->district_id) . "', '" . $conn->real_escape_string($this->executive_director_fullname) . "', '";
		$sql .= $conn->real_escape_string($this->executive_director_nationality) . "', '" . $conn->real_escape_string($this->executive_director_national_id) . "', '";
		$sql .= $conn->real_escape_string($this->executive_director_highest_qualification) . "', '";
		$sql .= $conn->real_escape_string($this->executive_director_email) . "', '" . $conn->real_escape_string($this->executive_director_telephone) . "', '";
		$sql .= $conn->real_escape_string($this->financial_year_start_month) . "', '" . $conn->real_escape_string($this->financial_year_end_month) . "', '";
		$sql .= $conn->real_escape_string($this->annual_income) . "', '" . $conn->real_escape_string($this->organization_type) . "', '";
		$sql .= $conn->real_escape_string($this->record_control) . "', '" . $conn->real_escape_string($this->captured_by) . "', NOW(), '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";		
		$result = $conn->query($sql);
		
		$organization_id = mysqli_insert_id($conn);		
		if ($result) {
			// successfully submitted organization for registration
			
			$log_data_activity = false;
			$action = "register";
			// 2. save organizational objectives
			self::processOrganizationData($organization_id, "objective", $this->objectives, $action, $this->captured_by, $log_data_activity);

			// 3. save staff capacity
			self::processOrganizationData($organization_id, "staff capacity", $this->staff_capacity_type, $action, $this->captured_by, $log_data_activity, 
									 	  $this->staff_capacity_number);	
									  		
			// 4. save sectors
			self::processOrganizationData($organization_id, "sector", $this->sectors, $action, $this->captured_by, $log_data_activity);

			// 5. save location activities
			self::processOrganizationData($organization_id, "location activity", $this->location_activities_vdc, $action, $this->captured_by, $log_data_activity, 
									 	  $this->location_activities_adc, $this->location_activities_district_id);	
									  		
			// 6. save target groups
			self::processOrganizationData($organization_id, "target group", $this->target_groups, $action, $this->captured_by, $log_data_activity);

			// 7. save directors/trustees
			self::processOrganizationData($organization_id, "trustee", $this->directors_trustees_fullname, $action, $this->captured_by, $log_data_activity, 
										  $this->directors_trustees_telephone, $this->directors_trustees_email, $this->directors_trustees_occupation, 
									 	  $this->directors_trustees_nationality, $this->directors_trustees_national_id, $this->directors_trustees_position, 
										  $this->directors_trustees_timeframe);
									  
			// 8. save source of funding
			self::processOrganizationData($organization_id, "source funding", $this->source_funding_donor_id, $action, $this->captured_by, $log_data_activity, 
									 	  $this->source_funding_contact_details, $this->source_funding_currency, $this->source_funding_amount);

			// 9. save auditor's details 
			self::processOrganizationData($organization_id, "auditor", $this->auditor_name, $action, $this->captured_by, $log_data_activity, $this->auditor_address, 
									 	  $this->auditor_telephone, $this->auditor_email);
			// 10. save bank details
			self::processOrganizationData($organization_id, "bank", $this->bank_id, $action, $this->captured_by, $log_data_activity, $this->bank_address, $this->bank_telephone, 
									  	  $this->bank_email);

			// 11. save temporary employment permit applications
			self::processOrganizationData($organization_id, "tep", $this->tep_fullname, $action, $this->captured_by, $log_data_activity, $this->tep_nationality, 
										  $this->tep_passport_number);
									  									  
			// 12. save documents
			self::processOrganizationDocuments($organization_id, $this->documents, $action, $this->captured_by, $log_data_activity);
			
			// 13. if this is an NGO user, then assign the user to the newly created organization
			if (user::isNGOUser($this->captured_by)) {
				$user = new user();
				$user->updateUser($this->captured_by, $organization_id, "organization_id");
			}
			
			// confirmation message to the user
			if ($this->record_control == $draft) {
				$message = "Organization '$this->organization_name'" . MESSAGE_SUCCESS . "saved as draft";
				$log_message = $message;
			} else {
				$subject_str = "NGO Registration - $this->organization_name";
				$licensee = common::getFieldValue("system", "licensee");
				$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
				$technical_support_telephone = common::getFieldValue("system", "telephone");
				$technical_support_email = common::getFieldValue("system", "email");
				$technical_support_website = common::getFieldValue("system", "website");
				
				$technical_support_contact_str = "<i class=\"fa fa-user-o\"></i> $technical_support_contact";
				$technical_support_email_str = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email?subject=$subject_str\">$technical_support_email</a>";
				$technical_support_telephone_str = " <i class=\"fa fa-phone\"></i> $technical_support_telephone";				
				$technical_support_str = "$technical_support_contact_str $technical_support_email_str $technical_support_telephone_str";
	
				$message = "Thank you for submitting your application for the registration of '$this->organization_name'. You can track the status of your application by ";				
				$message_email = "<p>" . $message . "login to <a href=\"" . SYS_URL . VIEWS_PATH . "registration\">myNGO</a>.</p>";
				$message .= "clicking on the information button. If in doubt, you may contact us. <b>$technical_support_str</b>";			
				
				$log_message = "Organization '$this->organization_name'" . MESSAGE_SUCCESS . "submitted for registration";
				
				// email confirmation to user
				$to_email_e = common::getFieldValue("user", "email", "username", $this->captured_by, "organization_id", $organization_id);	
				if (!empty($to_email_e)) {
					$to_email[] = array($to_email_e);
					$subject[] = $subject_str;		
					$to_firstname = common::getFieldValue("user", "firstname", "username", $this->captured_by, "organization_id", $organization_id);
					$email_body[] = "Dear $to_firstname,</p>" . $message_email;
				}

				// email approvers
				$page_id_awaiting_approval_1 = 52;
				$blanks = "";
				$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
				$search_query .= "'%|$page_id_awaiting_approval_1" . "RW|%' AND email IS NOT NULL)";														 
				$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				$subject_str = "NGO Awaiting Approval - $this->organization_name";
				$message_email = "Dear Approver,</p><p>A new NGO '$this->organization_name' has been submitted for registration awaiting your approval. To approve, login to ";
				$message_email .= "<a href=\"" . SYS_URL . VIEWS_PATH . "registration_approval_1\">myNGO</a>.</p>";				
				if (!empty($approver_emails)) {	
					$to_email[] = $approver_emails;
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
				}
								
				if (!empty($to_email)) {
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->send();
				}	
			}
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			$log_message = MESSAGE_ERROR;
		}
		
		// log the user activity
		audit_trail::log_trail("Register", $log_message, $this->captured_by, "Organization", $organization_id);
	}
	
	/**
     * Edit organization
	 *
     */
    public function edit()
	{
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0]; 
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[1];
		$payment_processed = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
	
		$exists = common::exists("organization", $this->organization_id, "organization_name", $this->organization_name);

        if ($exists) {
            $_SESSION["message"] = "NGO '$this->organization_name'" . MESSAGE_EXIST;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
		// 1. edit organization details
		// if NGO is already approved state, only update selected fields
		$sql = "UPDATE {$table_prefix}organization SET telephone = '" . $conn->real_escape_string($this->telephone) . "', ";
		$sql .= "email = '".$conn->real_escape_string($this->email) . "', postal_address = '" . $conn->real_escape_string($this->postal_address) . "', ";
		$sql .= "executive_director_fullname = '" . $conn->real_escape_string($this->executive_director_fullname) . "', ";
		$sql .= "executive_director_nationality = '" . $conn->real_escape_string($this->executive_director_nationality) . "', ";
		$sql .= "executive_director_national_id = '" . $conn->real_escape_string($this->executive_director_national_id) . "', ";
		$sql .= "executive_director_highest_qualification = '" . $conn->real_escape_string($this->executive_director_highest_qualification) . "', ";
		$sql .= "executive_director_email = '" . $conn->real_escape_string($this->executive_director_email) . "', ";
		$sql .= "executive_director_telephone = '" . $conn->real_escape_string($this->executive_director_telephone) . "', ";
		$sql .= "financial_year_start_month = '" . $conn->real_escape_string($this->financial_year_start_month) . "', ";
		$sql .= "financial_year_end_month = '" . $conn->real_escape_string($this->financial_year_end_month) . "', ";
		$sql .= "annual_income = '" . $conn->real_escape_string($this->annual_income) . "', ";
		$sql .= "last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() ";
		
		if ($this->record_control == $draft || $this->update_annual_return_info === "Yes") {
			// if NGO is in draft state or annual return info should be updated, update all fields	
			$sql .= ", abbreviation = '" . $conn->real_escape_string($this->abbreviation) . "', ";
			$sql .= "organization_name = '" .$conn->real_escape_string($this->organization_name)."', charity_number = '" . $conn->real_escape_string($this->charity_number) ."', ";
			$sql .= "organization_type = '" . $conn->real_escape_string($this->organization_type) . "', ";
			$sql .= "registration_type = '" . $conn->real_escape_string($this->registration_type) . "', ";
			$sql .= "physical_address = '" . $conn->real_escape_string($this->physical_address) . "', district_id = '" . $conn->real_escape_string($this->district_id) . "' ";
		}
		
		// if action is to register and NGO is in draft state, or if annual return info should be updated, update the record control as well	
		if (($this->user_action === "register" && $this->record_control == $draft) || $this->update_annual_return_info === "Yes")  {			
			// if record control is in draft state set it to awaiting first level approval...
			// else if annual return info should be updated, update the record control to payment processed
			if ($this->user_action === "register" && $this->record_control == $draft) {
				$sql .= ", record_control = '" . $conn->real_escape_string($awaiting_approval_level1) . "', ";
				
				// clear rejected fields as well, just in case the NGO was previously rejected
				$sql .= "rejected_by = NULL, rejected_date = NULL, rejected_comments = NULL, status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
			} elseif ($this->update_annual_return_info === "Yes") {
				$sql .= ", record_control = '" . $conn->real_escape_string($payment_processed) . "' ";
			}
		}
		$sql .= "WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "'";

		$result = $conn->query($sql);

        if ($result) {
			// successfully edited organization
			$log_data_activity = false;

			if ($this->record_control == $draft) {
				// if NGO is in draft state, update all fields
				$action = "edit";
				// 2. edit organizational objectives
				self::processOrganizationData($this->organization_id, "objective", $this->objectives, $action, $this->last_edited_by, $log_data_activity, $this->objective_id);
				
				// 3. edit staff capacity
				self::processOrganizationData($this->organization_id, "staff capacity", $this->staff_capacity_type, $action, $this->last_edited_by, $log_data_activity, 
										  	  $this->staff_capacity_id, $this->staff_capacity_number);
									  		
				// 4. edit sectors
				self::processOrganizationData($this->organization_id, "sector", $this->sectors, $action, $this->last_edited_by, $log_data_activity, $this->sector_id);
				
				// 5. edit location activities
				self::processOrganizationData($this->organization_id, "location activity", $this->location_activities_vdc, $action, $this->last_edited_by, $log_data_activity, 
										 	  $this->location_activity_id, $this->location_activities_adc, $this->location_activities_district_id);	
												
				// 6. edit target groups
				self::processOrganizationData($this->organization_id, "target group", $this->target_groups, $action, $this->last_edited_by, $log_data_activity, 
											  $this->target_group_id);
				
				// 7. edit directors/trustees
				self::processOrganizationData($this->organization_id, "trustee", $this->directors_trustees_fullname, $action, $this->last_edited_by, $log_data_activity, 
											  $this->trustee_id, $this->directors_trustees_telephone, $this->directors_trustees_email, $this->directors_trustees_occupation, 
											  $this->directors_trustees_nationality, $this->directors_trustees_national_id, $this->directors_trustees_position, 
											  $this->directors_trustees_timeframe);
									  
				// 8. edit source of funding
				self::processOrganizationData($this->organization_id, "source funding", $this->source_funding_donor_id, $action, $this->last_edited_by, $log_data_activity, 
											  $this->source_funding_id, $this->source_funding_contact_details, $this->source_funding_currency, $this->source_funding_amount);
	
				// 9. edit auditor's details 
				self::processOrganizationData($this->organization_id, "auditor", $this->auditor_name, $action, $this->last_edited_by, $log_data_activity, $this->auditor_id,
											  $this->auditor_address, $this->auditor_telephone, $this->auditor_email);
				// 10. edit bank details
				self::processOrganizationData($this->organization_id, "bank", $this->bank_id, $action, $this->last_edited_by, $log_data_activity, $this->organization_bank_id,
											  $this->bank_address, $this->bank_telephone, $this->bank_email);

				// 11. edit temporary employment permit applications
				self::processOrganizationData($this->organization_id, "tep", $this->tep_fullname, $action, $this->last_edited_by, $log_data_activity, $this->tep_id, 
											  $this->tep_nationality, $this->tep_passport_number);
										  										  
				// 12. edit documents
				self::processOrganizationDocuments($this->organization_id, $this->documents, $action, $this->last_edited_by, $log_data_activity);
			} elseif ($this->update_annual_return_info === "Yes") {
				// if annual return info should be updated, update all fields
				
				// A. delete all organization data first			
				$action = "delete";
				$no_data = array();
				// 2. delete organizational objectives
				self::processOrganizationData($this->organization_id, "objective", $no_data, $action, $this->last_edited_by, $log_data_activity);
	
				// 3. delete staff capacity
				self::processOrganizationData($this->organization_id, "staff capacity", $no_data, $action, $this->last_edited_by, $log_data_activity);
											
				// 4. delete sectors
				self::processOrganizationData($this->organization_id, "sector", $no_data, $action, $this->last_edited_by, $log_data_activity);
				
				// 5. delete location activities
				self::processOrganizationData($this->organization_id, "location activity", $no_data, $action, $this->last_edited_by, $log_data_activity);	
												
				// 6. delete target groups
				self::processOrganizationData($this->organization_id, "target group", $no_data, $action, $this->last_edited_by, $log_data_activity);
				
				// 7. delete directors/trustees
				self::processOrganizationData($this->organization_id, "trustee", $no_data, $action, $this->last_edited_by, $log_data_activity);
									  
				// 8. delete source of funding
				self::processOrganizationData($this->organization_id, "source funding", $no_data, $action, $this->last_edited_by, $log_data_activity);
	
				// 9. delete auditor's details 
				self::processOrganizationData($this->organization_id, "auditor", $no_data, $action, $this->last_edited_by, $log_data_activity);
				
				// 10. delete bank details
				self::processOrganizationData($this->organization_id, "bank", $no_data, $action, $this->last_edited_by, $log_data_activity);
				
				// 11. delete temporary employment permit applications
				// do not delete previous temporary employment permit applications
				// self::processOrganizationData($this->organization_id, "tep", $no_data, $action, $this->last_edited_by, $log_data_activity);
				
				// B. insert the new annual return info organization data
				$action = "register";
				// 2. save organizational objectives
				self::processOrganizationData($this->organization_id, "objective", $this->objectives, $action, $this->last_edited_by, $log_data_activity);
	
				// 3. save staff capacity
				self::processOrganizationData($this->organization_id, "staff capacity", $this->staff_capacity_type, $action, $this->last_edited_by, $log_data_activity, 
											  $this->staff_capacity_number);	
												
				// 4. save sectors
				self::processOrganizationData($this->organization_id, "sector", $this->sectors, $action, $this->last_edited_by, $log_data_activity);
	
				// 5. save location activities
				self::processOrganizationData($this->organization_id, "location activity", $this->location_activities_vdc, $action, $this->last_edited_by, $log_data_activity, 
											  $this->location_activities_adc, $this->location_activities_district_id);	
												
				// 6. save target groups
				self::processOrganizationData($this->organization_id, "target group", $this->target_groups, $action, $this->last_edited_by, $log_data_activity);
	
				// 7. save directors/trustees
				self::processOrganizationData($this->organization_id, "trustee", $this->directors_trustees_fullname, $action, $this->last_edited_by, $log_data_activity, 
											  $this->directors_trustees_telephone, $this->directors_trustees_email, $this->directors_trustees_occupation, 
											  $this->directors_trustees_nationality, $this->directors_trustees_national_id, $this->directors_trustees_position, 
											  $this->directors_trustees_timeframe);
										  
				// 8. save source of funding
				self::processOrganizationData($this->organization_id, "source funding", $this->source_funding_donor_id, $action, $this->last_edited_by, $log_data_activity, 
											  $this->source_funding_contact_details, $this->source_funding_currency, $this->source_funding_amount);
	
				// 9. save auditor's details 
				self::processOrganizationData($this->organization_id, "auditor", $this->auditor_name, $action, $this->last_edited_by, $log_data_activity, $this->auditor_address, 
											  $this->auditor_telephone, $this->auditor_email);
				// 10. save bank details
				self::processOrganizationData($this->organization_id, "bank", $this->bank_id, $action, $this->last_edited_by, $log_data_activity, $this->bank_address,
											  $this->bank_telephone, $this->bank_email);
											  
				// 11. save temporary employment permit applications
				// do not save temporary employment permit applications
				//self::processOrganizationData($this->organization_id, "tep", $this->tep_fullname, $action, $this->last_edited_by, $log_data_activity, $this->tep_nationality, 
				//							  $this->tep_passport_number);
			}
			
			// confirmation message to the user
			$message = "Organization '$this->organization_name'" . MESSAGE_SUCCESS;
			$message .= ($this->record_control == $draft) ? "saved as draft" : "updated";
			$log_message = $message;
			
			if ($this->user_action === "register" && $this->record_control == $draft) {
				$subject_str = "NGO Registration - $this->organization_name";
				$licensee = common::getFieldValue("system", "licensee");
				$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
				$technical_support_telephone = common::getFieldValue("system", "telephone");
				$technical_support_email = common::getFieldValue("system", "email");
				$technical_support_website = common::getFieldValue("system", "website");
				
				$technical_support_contact_str = "<i class=\"fa fa-user-o\"></i> $technical_support_contact";
				$technical_support_email_str = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email?subject=$subject_str\">$technical_support_email</a>";
				$technical_support_telephone_str = " <i class=\"fa fa-phone\"></i> $technical_support_telephone";				
				$technical_support_str = "$technical_support_contact_str $technical_support_email_str $technical_support_telephone_str";
	
				$message = "Thank you for submitting your application for the registration of '$this->organization_name'. You can track the status of your application by ";				
				$message_email = "<p>" . $message . "login to <a href=\"" . SYS_URL . VIEWS_PATH . "registration\">myNGO</a>.</p>";
				$message .= "clicking on the information button. If in doubt, you may contact us. <b>$technical_support_str</b>";			
				
				$log_message = "Organization '$this->organization_name'" . MESSAGE_SUCCESS . "submitted for registration";
				
				// email confirmation to user
				$to_email_e = common::getFieldValue("user", "email", "username", $this->last_edited_by, "organization_id", $this->organization_id);	
				
				if (!empty($to_email_e)) {
					$to_email[] = array($to_email_e);
					$subject[] = $subject_str;		
					$to_firstname = common::getFieldValue("user", "firstname", "username", $this->last_edited_by, "organization_id", $this->organization_id);
					$email_body[] = "Dear $to_firstname,</p>" . $message_email;
				}

				// email approvers
				$page_id_awaiting_approval_1 = 52;
				$blanks = "";
				$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
				$search_query .= "'%|$page_id_awaiting_approval_1" . "RW|%' AND email IS NOT NULL)";														 
				$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				$subject_str = "NGO Awaiting  Approval - $this->organization_name";
				$message_email = "Dear Approver,</p><p>A new NGO '$this->organization_name' has been submitted for registration awaiting your approval. To approve, login to ";
				$message_email .= "<a href=\"" . SYS_URL . VIEWS_PATH . "registration_approval_1\">myNGO</a>.</p>";				
				
				if (!empty($approver_emails)) {	
					$to_email[] = $approver_emails;
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
				}
								
				if (!empty($to_email)) {
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->send();
				}
			}
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;					
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			$log_message = MESSAGE_ERROR;
        }
				
		// log the user activity
		audit_trail::log_trail(ucwords($this->user_action), $log_message, $this->last_edited_by, "Organization", $this->organization_id);
	}
	
	/**
     * Approve organization
	 *
     */
    public function approve()
	{
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[3];
		$payment_processed = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$level_str = "";
		$generate_certificate = false;
		$generate_registration_number = false;
		$payment_processed_sql = "";
		 
		if ($this->action === "approve") {
			$level_str = " (Level $this->record_control)";
			$new_record_control = $this->record_control + 1;
			$record_control_sql = "record_control = '" . $conn->real_escape_string($new_record_control) . "', ";
			$rejection_sql = "";
			$actioned = $this->action . "d";
			$field_approved_by = $actioned . $this->record_control . "_by";
			$field_approved_date = $actioned . $this->record_control . "_date";
			
			if ($new_record_control == $approved) {
				$generate_certificate = true;
				$generate_registration_number = true;
			} elseif ($new_record_control == $payment_processed) {
				$field_approved_by = "payment_processed_by";
				$field_approved_date = "payment_processed_date";
				$payment_processed_sql = " AND record_control <> '" . $conn->real_escape_string($new_record_control) . "'";
			}
		} elseif ($this->action === "reject") {
			$record_control_sql = "";
			$rejection_sql = "rejected_comments = '" . $conn->real_escape_string($this->rejected_comments) . "', status= '" . $conn->real_escape_string(STATUS_REJECTED) . "', "; 
			$actioned = $this->action . "ed";
			$field_approved_by = $actioned . "_by";
			$field_approved_date = $actioned . "_date";
		}
		
		$registration_sql = "";
		if ($generate_registration_number) {
			$registration_year = date("Y");
			$registration_number = self::generateRegistrationNumber($this->organization_id, $registration_year);
			$registration_sql = "registration_year = '" . $conn->real_escape_string($registration_year) . "', ";
			$registration_sql .= "registration_number = '" . $conn->real_escape_string($registration_number) . "', ";
		}
				
		$sql="UPDATE {$table_prefix}organization SET $record_control_sql$rejection_sql$registration_sql$field_approved_by = '".$conn->real_escape_string($this->approved_by)."',";
		$sql .= "$field_approved_date = NOW() WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "'$payment_processed_sql";

		$result = $conn->query($sql);

        if ($result) {
			// successfully approved organization		
			$message = "NGO '$this->organization_name'" . MESSAGE_SUCCESS . $actioned . $level_str;
			$message_type = MESSAGE_SUCCESS_TYPE;
        
			// inform the next user (second approver/finance/requestor) to act on the request
			$page_id_approval = 51; // awaiting approval (level 2), inform second level approvers
			$url = "registration_approval_2";
			$subject_str = "NGO Awaiting Approval";
			$message_email = "Dear Approver,</p><p>A new NGO '$this->organization_name' has been submitted for registration awaiting your approval. ";
			$task = "approve";
			$ngo_registration_number = common::getFieldValue("organization", "registration_number", "organization_id", $this->organization_id);
			$blanks = "";
			$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
			$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
			$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
 			
			// ensure to get the correct requestor even for rejected organizations
			$requested_by = common::getFieldValue("organization", "captured_by", "organization_id", $this->organization_id, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks,
												  $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
			$requestor_firstname = common::getFieldValue("user", "firstname", "username", $requested_by, "organization_id", $this->organization_id);
			
			if ($this->action === "approve") {
				if ($new_record_control == $approved) {
					$page_id_approval = 58; // awaiting payment processing, inform Finance
					$url = "payment";
					$subject_str = "NGO Awaiting Payment Processing";
					$message_email = "Dear Finance,</p><p>A new NGO '$this->organization_name ($ngo_registration_number)' has been approved awaiting payment processing. ";
					$task = "process payment";
					$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
					$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
					$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				} elseif ($new_record_control == $payment_processed) {
					// approved, inform requestor
					$url = "registration";
					$subject_str = "NGO Approved";
					$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
					$message_email = "Dear $requestor_firstname,</p><p>Your application for the registration of '$this->organization_name' has been approved with ";
					$message_email .= "registration number $ngo_registration_number. ";
					$task = "track the status of your NGO";
				}
			} elseif ($this->action === "reject") {
				// rejected, inform requestor
				$url = "registration";
				$subject_str = "NGO Rejected";
				$rejected_comments = common::getFieldValue("organization", "rejected_comments", "organization_id", $this->organization_id, $blanks, $blanks, $blanks, $blanks,
														   $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
				$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
				$message_email = "Dear $requestor_firstname,</p><p>Your application for the registration of '$this->organization_name' has been rejected with the following ";
				//$message_email .= "reasons: <br /><b><i>" . str_replace("\r\n", "<br />", $rejected_comments) . "</i></b><br />.";
				$message_email .= "reasons: </p><p><b>" . str_replace("\r\n", "<br />", $rejected_comments) . "</b></p><p>";
				$task = "review your request";
			}
			
			$subject_str .= " - $this->organization_name";
			if (strlen($ngo_registration_number) > 0) $subject_str .= " ($ngo_registration_number)";
			
			$message_email .= "To $task, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myNGO</a>.</p>";		
			$to_email = array();
			if (!empty($approver_emails)) {	
				$to_email[] = $approver_emails;
				$subject[] = $subject_str;								
				$email_body[] = $message_email;
				$email_attachment[] = NULL;
			}
				
			// if this is a final approval then generate a registration certificate for the NGO
			if ($generate_certificate) {
				// add registration number and year to the confirmation message
				$message .= " (Reg No: $registration_number | Reg Year: $registration_year)";

				// firstly generate an invoice, starting with registration fees
				$registration_fees = array_unique(array_column(fee::all(INVOICE_TIME_REGISTRATION), "fee_category"));
				
				// then get the TEP processing certificate fees
				$teps = self::getOrganizationData($this->organization_id, "tep");
				$TEP_details = array_column($teps, "fullname");

				$number_of_TEP_requests = count($TEP_details);					
				for ($i = 0; $i < $number_of_TEP_requests; $i++) {
					$registration_fees = array_merge($registration_fees, array_unique(array_column(fee::all(INVOICE_TIME_TEP), "fee_category")));
				}

				$invoice = new invoice();
				$invoice->setOrganizationID(array($this->organization_id));
				$invoice->setFeeCategory($registration_fees);
				$invoice->setTEPDetails($TEP_details);
				$invoice->setInvoiceYear($registration_year);													
				$invoice->setCapturedBy($this->approved_by);					
				$invoice->generate();				
				
				$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
				$is_invoiced = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
				
				if (!$is_invoiced) {
					// registration fee invoice was not generated successfully
					$message .= ", but " . strtolower(implode(" and ", array_unique($registration_fees))) . " invoice could not be generated: " . ucfirst($processing_result);
					$message_type = MESSAGE_INFORMATION_TYPE;
				} else {
					// registration fee invoice was generated successfully...generate registration certificate
					
					// get the newly generated invoice number from above						
					if (isset($_SESSION["invoice_number"])) {
						$invoice_number = $_SESSION["invoice_number"];
						unset($_SESSION["invoice_number"]);
					} else {
						$invoice_number = "";
					}
					
					// email the invoice to the requestor
					$url = "registration";
					$subject_str = "Invoice for NGO Registration - $this->organization_name";
					if (strlen($ngo_registration_number) > 0) $subject_str .= " ($ngo_registration_number)";
					$message_email = "Dear $requestor_firstname,</p><p>Find attached an invoice for your application for the registration of '$this->organization_name'. ";					
					$message_email .= "To track the status of your application, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myNGO</a>.</p>";	
					$requestor_email = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
					$currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
					
					$report = new report();
					$report->setOrganizationID($this->organization_id);
					$report->setReportName("Invoice");
					$report->setInvoiceNumber($invoice_number);
					$report->setCurrency($currency);
					$report->setDestination(PDF_FILE_EXT);
					$report->setPrintedBy($this->approved_by);
					$report->setReturnReport(true);
		
					if (!empty($requestor_email)) {	
						$to_email[] = $requestor_email;
						$subject[] = $subject_str;								
						$email_body[] = $message_email;
						$email_attachment[] = array("file" => $report->generate(), "file_name" => "registration_invoice.pdf");
					}	
					
					$start_date = certificate::getPeriod(INVOICE_TIME_REGISTRATION, "start_date");		
					if (strlen($start_date) > 0) $start_date = $registration_year . "-" . $start_date;
	
					$end_date = certificate::getPeriod(INVOICE_TIME_REGISTRATION, "end_date");		
					if (strlen($end_date) > 0) $end_date = $registration_year . "-" . $end_date;
					
					$certificate_type = "New Certificate";
					$certificates = new certificate();		
					$certificates->setOrganizationID($this->organization_id);	
					$certificates->setCategory(CERTIFICATE_REGISTRATION);
					$certificates->setDetails2($certificate_type);
					$certificates->setInvoiceNumber($invoice_number);
					$certificates->setStartDate($start_date);								
					$certificates->setEndDate($end_date);								
					$certificates->setCapturedBy($this->approved_by);					
					$certificates->generate();
					
					$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
					$is_generated = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
					
					if (!$is_generated) {
						// registration certificate was not generated successfully
						$message .= ", but " . strtolower(CERTIFICATE_REGISTRATION) . " could not be generated: " . ucfirst($processing_result);
						$message_type = MESSAGE_INFORMATION_TYPE;
					} elseif ($number_of_TEP_requests > 0) {
						// registration certificate was generated successfully...generate TEP processing certificates
						$start_date = certificate::getPeriod(INVOICE_TIME_TEP, "start_date");		
						if (strlen($start_date) > 0) $start_date = $registration_year . "-" . $start_date;
		
						$end_date = certificate::getPeriod(INVOICE_TIME_TEP, "end_date");		
						if (strlen($end_date) > 0) $end_date = $registration_year . "-" . $end_date;						

						$certificate_type = "New TEP";				
						$certificates = new certificate();		
						$certificates->setOrganizationID($this->organization_id);	
						$certificates->setCategory(CERTIFICATE_TEP);
						$certificates->setStartDate($start_date);								
						$certificates->setEndDate($end_date);								
						$certificates->setDetails1($TEP_details);
						$certificates->setDetails2($certificate_type);
						$certificates->setInvoiceNumber($invoice_number);
						$certificates->setCapturedBy($this->approved_by);					
						$certificates->generate();
						
						$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
						$is_generated = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
						
						if (!$is_generated) {
							// TEP processing certificate was not generated successfully
							$message .= ", but " . strtolower(CERTIFICATE_TEP) . " could not be generated: " . ucfirst($processing_result);
							$message_type = MESSAGE_INFORMATION_TYPE;
						} else {
							// copy the TEP requests into the TEP table
							$tep_fullname = array_column($teps, "fullname");
							$tep_nationality = array_column($teps, "nationality");
							$tep_passport_number = array_column($teps, "passport_number");
							$tep_payment_proof = common::getFieldValue("organization_document", "filename", "document_category", DOCUMENT_CATEGORY_PAYMENT_PROOF_REGISTRATION,
																	   "organization_id",  $this->organization_id);	
							$tep = new tep();
							$tep->setOrganizationID($this->organization_id);
							$tep->setOrganizationName($this->organization_name);
							$tep->setInvoiceNumber($invoice_number);
							$tep->setFullname($tep_fullname);
							$tep->setNationality($tep_nationality);
							$tep->setPassportNumber($tep_passport_number);
							$tep->setPaymentProof($tep_payment_proof);		
							$tep->setUserAction("request");
							$tep->setRecordControl($approved);
							$tep->setCapturedBy($this->approved_by);	
							$tep->request();
						}
					}
				}
			}
			
			// send email							
			if (!empty($to_email)) {
				$send_email = new send_email();				
				$send_email->setToEmail($to_email);
				$send_email->setSubject($subject);
				$send_email->setMessage($email_body);				
				$send_email->setAttachment($email_attachment);				
				$send_email->send();
			}	
			
			$_SESSION["message"] = $message;
        	$_SESSION["message_type"] = $message_type;
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail(ucwords($this->action), $_SESSION["message"], $this->approved_by, "Organization", $this->organization_id);
	}
	
    /**
     * Delete organization
     *
     */
    public function delete()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        // check if this organization is in use
        $is_used = false;

        if ($is_used) {
            $_SESSION["message"] = "Organization '$this->organization_name'" . MESSAGE_IN_USE;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

        $sql = "UPDATE {$table_prefix}organization SET status = '". $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
		$sql .= $conn->real_escape_string($this->deleted_by) . "', " . "deleted_date = NOW() WHERE organization_id = '" . $conn->real_escape_string($this->organization_id) . "'";
 
        $result = $conn->query($sql);

        if ($result) {
			$log_data_activity = false;
			$action = "delete";
			$no_data = array();
			// 2. delete organizational objectives
			self::processOrganizationData($this->organization_id, "objective", $no_data, $action, $this->deleted_by, $log_data_activity);

			// 3. delete staff capacity
			self::processOrganizationData($this->organization_id, "staff capacity", $no_data, $action, $this->deleted_by, $log_data_activity);
										
			// 4. delete sectors
			self::processOrganizationData($this->organization_id, "sector", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 5. delete location activities
			self::processOrganizationData($this->organization_id, "location activity", $no_data, $action, $this->deleted_by, $log_data_activity);	
											
			// 6. delete target groups
			self::processOrganizationData($this->organization_id, "target group", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 7. delete directors/trustees
			self::processOrganizationData($this->organization_id, "trustee", $no_data, $action, $this->deleted_by, $log_data_activity);
								  
			// 8. delete source of funding
			self::processOrganizationData($this->organization_id, "source funding", $no_data, $action, $this->deleted_by, $log_data_activity);

			// 9. delete auditor's details 
			self::processOrganizationData($this->organization_id, "auditor", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 10. delete bank details
			self::processOrganizationData($this->organization_id, "bank", $no_data, $action, $this->deleted_by, $log_data_activity);

			// 11. delete temporary employment permit applications
			self::processOrganizationData($this->organization_id, "tep", $no_data, $action, $this->deleted_by, $log_data_activity);									  
			
			// 12. delete documents
			$documents = self::getOrganizationData($this->organization_id, "document", "filename"); 
			self::processOrganizationDocuments($this->organization_id, $no_data, $documents, $action, $this->deleted_by, $log_data_activity);
			
			// 13. if this is an NGO user, then de-assign the user from the deleted organization
			if (user::isNGOUser($this->deleted_by)) {
				$user = new user();
				$user->updateUser($this->deleted_by, "0", "organization_id");
			}
			
            $_SESSION["message"] = "Organization '$this->organization_name'" . MESSAGE_SUCCESS . "deleted";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "Organization", $this->organization_id);
    }
	
 	/**
	 * List all organizations
	 *
	 * @param string organization_id
	 * @param string order_by
	 * @param string district_id
	 * @param string zone_id
	 * @param string region_id
	 * @param string record_control
	 * @param string status
	 *
 	 * @return array of organizations
	 */
	public static function all($organization_id = "", $order_by = "", $district_id = "", $zone_id = "", $region_id = "", $record_control = "", $status = STATUS_ACTIVE) 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$organizations = array();
		$sql = "SELECT * FROM {$table_prefix}organization WHERE status IN ('$status') ";
		if (strlen($organization_id) > 0) $sql .= "AND organization_id IN ('$organization_id') ";		
		if (strlen($district_id) > 0) $sql .= "AND district_id IN ('$district_id') ";
		if (strlen($zone_id) > 0) $sql .= "AND district_id IN (SELECT district_id FROM {$table_prefix}district WHERE zone_id IN ('$zone_id')) ";
		if (strlen($region_id) > 0) $sql .= "AND district_id IN (SELECT district_id FROM {$table_prefix}district WHERE region_id IN ('$region_id')) ";
		if (strlen($record_control) > 0) $sql .= "AND record_control IN ('$record_control') ";
		if (strlen($order_by) > 0) $sql .= "ORDER BY $order_by";
		else $sql .= "ORDER BY organization_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$organizations[] = $row;
		}
		return $organizations;
	}
	
	/**
	 * List all registration types
	 *
 	 * @return array of registration types
	 */
	public static function getRegistrationTypes() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$registration_types = array();
		$sql = "SELECT * FROM {$table_prefix}registration_type WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY registration_type";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$registration_types[] = $row;
		}
		return $registration_types;
	}
	
	/**
	 * List all organization types
	 *
 	 * @return array of organization types
	 */
	public static function getOrganizationTypes() 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$organization_types = array();
		$sql = "SELECT * FROM {$table_prefix}organization_type WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ORDER BY organization_type";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$organization_types[] = $row;
		}
		return $organization_types;
	}
	
	/**
     * Process organization data
	 *
	 * @param string organization_id
	 * @param string data_category
	 * @param array data_1
	 * @param string action
	 * @param string captured_by
	 * @param boolean log_activity
	 * @param array data_2
	 * @param array data_3
	 * @param array data_4
	 * @param array data_5
	 * @param array data_6
	 * @param array data_7
	 * @param array data_8
	 * @param array data_9
	 * 
	 */
    public static function processOrganizationData($organization_id, $data_category, $data_1, $action, $captured_by, $log_activity = true, $data_2 = array(), $data_3 = array(), 
											 	   $data_4 = array(), $data_5 = array(), $data_6 = array(), $data_7 = array(), $data_8 = array(), $data_9 = array())
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

        if (empty($data_1) && $action === "register") {
            $_SESSION["message"] = "Please enter $data_category";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
		$fields = array();
		
		if (in_array($data_category, array("objective", "sector", "target group")))	$fields = array(str_replace(" ", "_", $data_category));
		elseif ($data_category === "staff capacity") $fields = array("staff_type", "staff_number");
		elseif ($data_category === "location activity") $fields = array("vdc", "adc", "district_id");		
		elseif ($data_category === "trustee") $fields = array("fullname", "telephone", "email", "occupation", "nationality", "national_id", "position", "timeframe");
		elseif ($data_category === "source funding") $fields = array("donor_id", "contact_details", "funding_currency", "funding_amount", "funding_amount_local");
		elseif ($data_category === "auditor") $fields = array("name", "address", "telephone", "email");
		elseif ($data_category === "bank") $fields = array("bank_id", "address", "telephone", "email");
		elseif ($data_category === "tep") $fields = array("fullname", "nationality", "passport_number");
		
		$table_part = str_replace(" ", "_", $data_category);
		$table_name = "organization_$table_part";
		$table_id = ($data_category === "bank") ? "organization_$table_part" . "_id" : $table_part . "_id";		

		$first_array_has_data = true;
		if ($action === "register") {
			$sql = "INSERT INTO {$table_prefix}$table_name (organization_id, " . implode(", ", $fields) . ", captured_by, ";
			$sql .= "captured_date, status) VALUES ";
			$first_array_has_data = false;
		} elseif ($action === "edit") {
			$sql = "";
		} elseif ($action === "delete") {
			// delete organization data
			$sql = "UPDATE {$table_prefix}$table_name SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
			$sql .= "organization_id = '" . $conn->real_escape_string($organization_id) . "'";
			// remove 'e' so that the past tense message to the user should make sense i.e. 'deleted' not 'deleteed'
			$action = "delet";
		}
			
		$count_1 = count($data_1);
		$i = 0;
		foreach ($data_1 as $d) :
			if ($action === "register") {
				// ensure theres data in the first array
				if (strlen(trim($d)) > 0) {
					$first_array_has_data = true;
					
					$sql .= "('" . $conn->real_escape_string($organization_id) . "', '" . $conn->real_escape_string($d) . "', '";
					
					if (!empty($data_2)) {
						$field_value = (array_key_exists($i, $data_2)) ? $data_2[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}
					
					if (!empty($data_3)) {
						$field_value = (array_key_exists($i, $data_3)) ? $data_3[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_4)) {
						$field_value = (array_key_exists($i, $data_4)) ? $data_4[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
						
						if ($data_category === "source funding") {
							// calculate funding in local currency
							$funding_currency = $data_3[$i];
							$exchange_rate = common::getFieldValue("currency", "exchange_rate", "currency", $funding_currency);
							$funding_amount = $data_4[$i];
							$funding_amount_local = $funding_amount * $exchange_rate;
		
							$sql .= $conn->real_escape_string($funding_amount_local) . "', '";
						}
					}			
					
					if (!empty($data_5)) {
						$field_value = (array_key_exists($i, $data_5)) ? $data_5[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_6)) {
						$field_value = (array_key_exists($i, $data_6)) ? $data_6[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_7)) {
						$field_value = (array_key_exists($i, $data_7)) ? $data_7[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_8)) {
						$field_value = (array_key_exists($i, $data_8)) ? $data_8[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
				
					$sql .= $conn->real_escape_string($captured_by) . "', NOW(), '";
					$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
					$i++;
					if ($i <= $count_1 - 1) $sql .= ", ";
				}
			} elseif ($action === "edit") {
				// edit organization data
				$sql .= "UPDATE {$table_prefix}$table_name SET $fields[0] = '" . $conn->real_escape_string($d) . "', ";				
				if (!empty($data_3)) $sql .= "$fields[1] = '" . $conn->real_escape_string($data_3[$i]) . "', ";
				if (!empty($data_4)) $sql .= "$fields[2] = '" . $conn->real_escape_string($data_4[$i]) . "', ";
				if (!empty($data_5)) {
					$sql .= "$fields[3] = '" . $conn->real_escape_string($data_5[$i]) . "', ";				
					if ($data_category === "source funding") {
						// calculate funding in local currency
						$funding_currency = $data_4[$i];
						$exchange_rate = common::getFieldValue("currency", "exchange_rate", "currency", $funding_currency);
						$funding_amount = $data_5[$i];
						$funding_amount_local = $funding_amount * $exchange_rate;	
						$sql .= "$fields[4] = '" . $conn->real_escape_string($funding_amount_local) . "', ";
					}
				}					
				if (!empty($data_6)) $sql .= "$fields[4] = '" . $conn->real_escape_string($data_6[$i]) . "', ";
				if (!empty($data_7)) $sql .= "$fields[5] = '" . $conn->real_escape_string($data_7[$i]) . "', ";
				if (!empty($data_8)) $sql .= "$fields[6] = '" . $conn->real_escape_string($data_8[$i]) . "', ";
				if (!empty($data_9)) $sql .= "$fields[7] = '" . $conn->real_escape_string($data_9[$i]) . "', ";
				$sql .= "last_edited_by = '" . $conn->real_escape_string($captured_by) . "', last_edited_date = NOW() WHERE organization_id = '";
				$sql .= $conn->real_escape_string($organization_id) . "' AND $table_id = '" . $conn->real_escape_string($data_2[$i]) . "';";
				
				$i++;

				if ($i == $count_1) {
					// delete organization data
					$sql .= "UPDATE {$table_prefix}$table_name SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
					$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
					$sql .= "organization_id = '" . $conn->real_escape_string($organization_id) . "' AND $table_id NOT IN ('" . implode("', '", $data_2) . "');";
				}
			}
		endforeach;

		$result = ($first_array_has_data) ? $conn->multi_query($sql) : true;

		if ($result) {
			$_SESSION["message"] = "Organizational $data_category" . MESSAGE_SUCCESS . "$action" . "ed";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		if ($log_activity) audit_trail::log_trail("Save Details", $_SESSION["message"], $captured_by, "Org " . ucwords($data_category), $organization_id);
		//audit_trail::log_trail($action, "$sql > " . var_dump($data_1) . " > " . var_dump($data_2) . " > " . var_dump($data_3), $captured_by, "Org " . ucwords($data_category), 
		//$organization_id);
	}
	
	/**
     * Process organization documents
	 *
	 * @param string organization_id
	 * @param array documents
	 * @param string action
	 * @param string captured_by
	 * @param boolean log_activity
	 * 
	 */
    public static function processOrganizationDocuments($organization_id, $documents, $action, $captured_by, $log_activity = true)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		global $DOC_FILE_EXT;

		// set the maximum execution time to 60 seconds
        set_time_limit(60);

		// set the default time zone to be that for Malawi
		date_default_timezone_set("Africa/Blantyre");
		
        if (empty($documents)) {
            $_SESSION["message"] = "No document was uploaded. Please upload document(s)";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

		if ($action === "register" || $action === "edit") {
			// loop through the documents to be uploaded
			foreach ($documents as $document_category => $document) :
				// if the document has been chosen, proceed
				if (isset($document["name"])) { 
					$document_size = $document["size"];
					$document_size_MB = $document_size / 1024 / 1024;
					$document_name = $document["name"];
					$document_type = $document["type"];
					$document_tmp = $document["tmp_name"];
					$document_ext = explode(".", $document_name); $document_ext = strtolower(end($document_ext));
	
					// if the document size is greater than zero, proceed
					if ($document_size > 0 && strlen(trim($document_name)) > 0) {
						// if the document size is less than the recommended size, proceed
						if ($document_size_MB <= MAX_FILE_IMPORT_SIZE) {
							// if the document extension is the correct one (docx, doc and pdf), proceed
							if (in_array($document_ext, $DOC_FILE_EXT)) {
								// define the path where the document should be saved
								$path = DOCUMENT_UPLOAD_PATH;
	
								// naming conversion of the new document: organization_id-document_category.extension e.g. FTC-1-constitution.pdf
								$new_document_name = strtolower(str_replace(" ", "-", "$organization_id-$document_category.$document_ext"));
	
								// get the old document name
								$old_document_name = common::getFieldValue("organization_document", "filename", "organization_id", $organization_id, "document_category",
																		   $document_category);
								// delete the old document if it exists
								if (strlen($old_document_name) > 0 && file_exists($path . $old_document_name))
									unlink($path . $old_document_name);
									
								if ($action === "register" || strlen($old_document_name) == 0) {
									// this is a 'register' action or there was no old document...insert the new information into the database
									$sql = "INSERT INTO {$table_prefix}organization_document (organization_id, document_category, filename, captured_by, captured_date, status) ";
									$sql .= "VALUES ('" . $conn->real_escape_string($organization_id) . "', '" . $conn->real_escape_string($document_category) . "', '";
									$sql .= $conn->real_escape_string($new_document_name) . "', '" . $conn->real_escape_string($captured_by) . "', NOW(), '";
									$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
								} elseif ($action === "edit") {
									// this is an 'edit' action...do nothing, the document information is already in the database...
									// just define s dumpy SQL statement which will be successful when executed i.e. result = true
									$sql = "SELECT 1";
								}		
								
								$result = $conn->query($sql);

								if ($result) {
									// upload document
									move_uploaded_file($document_tmp, $path . $new_document_name);
								
									$message = "Organizational document '$document_name'" . MESSAGE_SUCCESS . "uploaded";
									$message_type = MESSAGE_SUCCESS_TYPE;
								} else {
									$message = MESSAGE_ERROR;
									$message_type = MESSAGE_ERROR_TYPE;
								}
							} else {
								// wrong document type						
								$message = "Invalid document format. Please upload files of type " . implode(", ", $DOC_FILE_EXT);
								$message_type = MESSAGE_ERROR_TYPE;
							}
						} else {
							// document size exceeded
							$message = "Document size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
							$message_type = MESSAGE_ERROR_TYPE;
						}
				   } else {	
						// document size <= 0				
						$error_code = $document["error"];
		
						if ($error_code === UPLOAD_ERR_INI_SIZE || $error_code === UPLOAD_ERR_FORM_SIZE || $document_size_MB > MAX_FILE_IMPORT_SIZE)
							$error = "Document size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
						elseif ($error_code === UPLOAD_ERR_PARTIAL)						
							$error = "The uploaded document(s) were only partially uploaded";
						else
							$error = "No document was uploaded. Please upload document(s)";
									  
						$message = $error;
						$message_type = MESSAGE_ERROR_TYPE;
					}
				} else {
					// $document["name"]) not set 
					$message = "No document was uploaded. Please upload document(s)";					              
					$message_type = MESSAGE_ERROR_TYPE;
				}
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = $message_type;
			endforeach;
		} elseif ($action === "delete") {
			// delete organization documents
			$sql = "UPDATE {$table_prefix}organization_document SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
			$sql .= "organization_id = '" . $conn->real_escape_string($organization_id) . "'";
			
			$result = $conn->query($sql);
			
			if ($result) {
				// delete the files from the file directory
				foreach ($documents as $key => $document) :
					if (strlen($document->filename) > 0 && file_exists(DOCUMENT_UPLOAD_PATH . $document->filename))
						unlink(DOCUMENT_UPLOAD_PATH . $document->filename);
				endforeach;
								
				$message = "Organizational documents" . MESSAGE_SUCCESS . "deleted";
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
			} else {
				$message = MESSAGE_ERROR;
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			}			
		}
		
		// log the user activity
		if ($log_activity) audit_trail::log_trail("Save Details", $message, $captured_by, "Org Document", $organization_id);
	}
	
	/**
	 * List all organization data
	 *
	 * @param string organization_id
	 * @param string data_category
	 * @param string fields
	 * @param string status
	 *
 	 * @return array of organization data
	 */
	public static function getOrganizationData($organization_id, $data_category, $fields = "*", $status = STATUS_ACTIVE) 	
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$organization_data = array();
		$table_part = str_replace(" ", "_", $data_category);
		$table_id = $table_part . "_id";
		if ($data_category === "bank") $table_id = "organization_$table_id";
		
		$sql = "SELECT $fields FROM {$table_prefix}organization_$table_part WHERE status IN ('$status') AND organization_id IN ('";
		$sql .= $organization_id . "') ORDER BY $table_id";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$organization_data[] = $row;
		}
		return $organization_data;
	}
	
	/**
	 * generate unique registration number
	 *
	 * @param string organization_id
	 * @param string registration_year
	 *
	 * @return string registration_number
	 * 
	 */
	public function generateRegistrationNumber($organization_id, $registration_year)
	{
		$conn = config::connect();
        $table_prefix = TABLE_PREFIX;
		
		$registration_number = "";		

		// get the organization registration number prefix
		$registration_number_prefix = common::getFieldValue("system", "registration_number_prefix");

		// get the organization registration number format
		$registration_number_format = common::getFieldValue("system", "registration_number_format");
		
		if (strlen($registration_number_format) > 0) {
			$registration_number_format = substr($registration_number_format, 1); // remove the first | from the string
			$registration_number_format = substr_replace($registration_number_format, "", -1); // remove the last | from the string
		
			$formats = explode("|", $registration_number_format);
								
			for ($i = 0; $i < count($formats); $i++) {
				$this_format = $formats[$i];
				$this_format = substr($this_format, 1); // remove the first { from the string
				$this_format = substr_replace($this_format, "", -1);// remove the last } from the string
				$fields = explode("}{", $this_format);
				
				// elements have format: {field}{number of characters}{field separator}
				$field = $fields[0];
				$number_of_characters = $fields[1];
				$field_separator = $fields[2];
				
				if (strlen($field) > 0) {
					// only use the field if the field has a value
					
					if ($field !== REG_NUMBER_FORMAT_SERIAL_NUMBER) {
						// if the field is not a serial number, then it is available in the organization table, process it
	
						// get the field value for this organization
						$field_value = ($field === "registration_year") ? $registration_year : common::getFieldValue("organization", "$field","organization_id",$organization_id);
						
						if ($number_of_characters >= 0)
							$registration_number .= substr($field_value, 0, $number_of_characters);
						else					
							$registration_number .= substr($field_value, $number_of_characters);
						$registration_number .= $field_separator;
					} else {
						// the field is a serial number...
				
						// append the registration number prefix
						$registration_number = $registration_number_prefix . $registration_number;	
												
						// get the last recorded serial number and increment by 1
						$last_serial_number = common::getFieldValue("organization", "MAX(SUBSTRING(registration_number, -$number_of_characters))",
																	 "SUBSTRING(registration_number, 1, " . strlen($registration_number) . ")", $registration_number);
						
						if (strlen($last_serial_number) == 0) $last_serial_number = 0;
						$last_serial_number++;
						
						//add trailing zeros to the registration number
						$number_of_zeros = $number_of_characters - strlen($last_serial_number);		
						for ($j = 0; $j < $number_of_zeros; $j++) {
							$last_serial_number = "0" . $last_serial_number;
						}
						
						$registration_number .= $last_serial_number . $field_separator;
					}
				}
			}
		}
		
		return $registration_number;
	}
	
	/**
	 * Check if it is a reporting period
	 *
	 * @return true if it is a reporting period, false otherwise
	 */
	 public static function isReportingPeriod() {
		$conn = config::connect();
        $table_prefix = TABLE_PREFIX;
		$current_date = date("Y-m-d");		
		
		$sql = "SELECT system_id FROM {$table_prefix}system WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND ";
		$sql .= "'$current_date' BETWEEN reporting_period_start_date AND reporting_period_end_date";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Check if an organization is an NGO
	 *
 	 * @param string organization_id
	 *
	 * @return true if an organization is an NGO, false otherwise
	 */
	 public static function isNGO($organization_id) {
		$conn = config::connect();
        $table_prefix = TABLE_PREFIX;
		
		$sql = "SELECT organization_id FROM {$table_prefix}organization WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND organization_id = '";
		$sql .= $conn->real_escape_string($organization_id) . "'";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			return true;
		}
		return false;
	}
	
    /**
	 * Get a list of organizations due for auto-disabling
	 *
 	 * @param string organization_id
	 *
	 * @return an array of organizations due for auto-disablin
	 */
	 public static function getDueforAutoDisablingOrganizations($organization_id = "", $check_one_organization = false) {
		$conn = config::connect();
        $table_prefix = TABLE_PREFIX;
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[4];
		$inactive_organizations = array();
		$is_due_for_auto_disabling = false;
		
		// get the organization auto disabling duration
		$organization_disable_duration = common::getFieldValue("system", "organization_disable_duration");

		$sql = "SELECT * FROM (SELECT organization_id, (YEAR(NOW()) - MAX(reporting_year)) AS inactive_duration FROM {$table_prefix}licensing_organization WHERE status = '";
		$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "' AND record_control = '" . $conn->real_escape_string($approved) . "' GROUP BY organization_id) ";
		$sql .= "inactive_organizations WHERE inactive_duration > $organization_disable_duration ";
		if (strlen($organization_id) > 0) $sql .= "AND organization_id IN ('$organization_id') ";		

		$result = $conn->query($sql);		
		
		while ($row = $result->fetch_object()) {
			if ($check_one_organization) 
				$is_due_for_auto_disabling = true;
			else
				$inactive_organizations[] = $row;
		}
		
		if ($check_one_organization) 
			return $is_due_for_auto_disabling;
		else
			return $inactive_organizations;	
	}
}