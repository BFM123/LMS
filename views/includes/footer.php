<?php $asset_path = "../../"; ?>

<section>
    <footer class="main-footer" style="font-weight: normal;">

		<!-- display identification information -->
		myLMS
		
		<!-- print version -->
		Version 1.0

		<!-- display copyright information -->
		&copy; <?php echo date("Y") . " " .  $licensee; ?>.
		
		<!-- display author information -->		
		<a target = "new" title = "Idias - Software Development &amp; Hosting, Data Management, IT Consultancy" href = "http://www.idiasmw.com">
			Powered by Idias <span class="powered_by"></span>
		</a>	
	</footer>
</section>

<script src="<?php echo $asset_path ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $asset_path ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $asset_path ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->
<script src="<?php echo $asset_path ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo $asset_path ?>assets/bower_components/morris.js/morris.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo $asset_path ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<!-- jvectormap -->
<script src="<?php echo $asset_path ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $asset_path ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- jQuery Knob Chart -->
<script src="<?php echo $asset_path ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<!-- datepicker -->
<script src="<?php echo $asset_path ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>  
	  
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo $asset_path ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo $asset_path ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?php echo $asset_path ?>assets/bower_components/fastclick/lib/fastclick.js"></script>

<!-- DataTables -->
<script src="<?php echo $asset_path ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $asset_path ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- select2 -->
<!--<script src="<?php echo $asset_path ?>assets/select2/jquery.select2.js"></script>-->
<script src="<?php echo $asset_path ?>assets/select2/select2.min.js"></script>

<!-- input-mask -->
<script src="<?php echo $asset_path ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $asset_path ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- iCheck -->
<script src="<?php echo $asset_path ?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- Select country -->
<script src="<?php echo $asset_path ?>assets/country-picker-master/js/countrypicker.js"></script>

<!-- Charts -->
<script src="<?php echo $asset_path ?>assets/charts/Chart.bundle.js"></script>
<script src="<?php echo $asset_path ?>assets/charts/utils.js"></script>
rr v 
<!-- AdminLTE App -->
<script src="<?php echo $asset_path ?>assets/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo $asset_path ?>assets/dist/js/demo.js"></script>

<!-- Handling date in leave modal to display number of days excluding weekends and public holidays-->
<script>
	$(document).ready(function() {	
		$(document).on("change", ".end_date", function() {
			var id = $(this).attr("id").split("-")[0] + "-" + $(this).attr("id").split("-")[1];
			var start_date = $("#" + id + "-start_date").val();
			var end_date = $("#" + id + "-end_date").val();

			if (start_date.length > 0 && end_date.length > 0) {
				// Validate input
				if (end_date >= start_date) {
					$.ajax({
						url: "get_leave_duration.php",
						method: "POST",
						data: {
							"start_date": start_date,
							"end_date": end_date
						},
						dataType: "json", 
						cache: false,
						success: function(data) {	
							$("#" + id + "-num_of_days").val(data);
						}
					})
                    $("#" + id + "-alert").addClass("hide");
                    $("#" + id + "-approve_btn").attr("disabled", false);
				} else {
                    // display error when end date is lesser than start date
                    $("#" + id + "-alert").removeClass("hide");
                    //$("#" + id + "-approve_btn").attr("disabled", true);
                }
			}
		});
	});

	// initialize date picker
 	$('#datepicker').datepicker();

    $(function() {
        $('#table1').DataTable()
        $('#table2').DataTable({
			'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
		 $('#table-menu').DataTable({
			'ordering': false
        })
		$('#table-indicator-values-x').DataTable({
			'ordering': false
        })
    })

    $('#range').select()
	
	// globally override Bootstrap's behavior to force Bootstrap to accept select2
	$.fn.modal.Constructor.prototype.enforceFocus = function() {};
   
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

       //Money Euro
        $('[data-mask]').inputmask()

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    })

	//script to make radio button options uncheckable
	$(document).ready(function(){	
		$("input:radio:checked").data("chk",true);
		$("input:radio").click(function(){
			$("input[name='"+$(this).attr("name")+"']:radio").not(this).removeData("chk");
			$(this).data("chk",!$(this).data("chk"));
			$(this).prop("checked",$(this).data("chk"));
		});
	});
 	// script to make radio button options uncheckable
	
	// <!-- script to logout  -->
	$("#logout").click(function (event) {
		var path = $("#path").val();
		window.location.href = path + "/logout.php";
	});
	// <!-- ./ script to logout -->

	//<!-- script to show a preview of notices/news articles -->
    $(document).ready(function(){
        var maxLength = <?php echo MAX_NOTICE_PREVIEW_LENGTH; ?>;
        $(".show-read-more").each(function(){
            var myStr = $(this).text();
            if($.trim(myStr).length > maxLength){
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append('<a href="javascript:void(0);" class="read-more text-blue"><i> Read more...</i></a>');
                $(this).append('<span class="more-text">' + removedStr + '</span>');
            }
        });
        $(".read-more").click(function(){
            $(this).siblings(".more-text").contents().unwrap();
            $(this).remove();
        });
    });
	
	function addReadMore() {
        //Setting the limit for the text to be shown.
        var carLmt = <?php echo MAX_NOTICE_PREVIEW_LENGTH; ?>;;
        // Text to show when text is collapsed
        // var readMoreTxt = " Read more >> ";
        var readMoreTxt = " Read more <i class='fa fa-angle-double-right'></i>";
        // Text to show when text is expanded
        // var readLessTxt = " << Read less";
        var readLessTxt = " <i class='fa fa-angle-double-left'></i> Read less";
        
        //function to be called to show Read more
        $(".addReadMore").each(function() {
            //getting the first segment of the article
            if ($(this).find(".firstSec").length)
                return;
       		//The full string
            var allstr = $(this).text();
            //checking if full string is more than the maximum length and cut it
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = firstSet + '<span class="SecSec">' + secdHalf + '</span><span class="readMore text-blue" title="Read more">' + readMoreTxt;
				strtoadd += '</span><span class="readLess text-blue" title="Read less">' + readLessTxt + '</span>';
                $(this).html(strtoadd);
            }
        });
        //Read more and Read Less Click Event binding
        $(document).on("click", ".readMore,.readLess", function() {
            $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
        });
    }
    $(function() {
        //Calling function after Page Load
        addReadMore();
    });
	//<!-- ./ script to show a preview of notices/news articles -->

    //<!-- script to set save button to approve or reject when user selects an approval option from the approve dropdown list -->	
	$(document).on("change", ".approve", function() {
        var id = $(this).attr("id").split("-")[0] + "-" + $(this).attr("id").split("-")[1];
		var approval_choice = $(this).val();
		
		if (approval_choice == "Yes") {
            $("#" + id + "-approve_btn").html("Approve");
            $("#" + id + "-comments").prop("disabled", false);
            $("#" + id + "-comments").prop("required", false);
            $("#" + id + "-comments_label").removeClass("required");
            $("#" + id + "-option").val("approve");
		} else {
            $("#" + id + "-approve_btn").html("Reject");
            $("#" + id + "-comments").html("");
            $("#" + id + "-comments_label").addClass("required");
            $("#" + id + "-comments").prop("required", true);
            $("#" + id + "-comments").prop("disabled", false);
            $("#" + id + "-option").val("reject");
		}
	});
    //<!-- script to set save button to approve or reject when user selects an approval option from the approve dropdown list -->

    //<!-- script to allow document based on the selected leave type -->	
	$(document).on("change", ".leave_type", function() {
        var id = $(this).attr("id").split("-")[0] + "-" + $(this).attr("id").split("-")[1];
		var leave_type = $(this).val();

		
        $.ajax({
            url: "get_leave_type.php",
            method: "POST",
            data: {
                "leave_type": leave_type
            },
            cache: false,

            success: function(data) {

                if (data === "true") {
                    //$("#" + id + "-document").removeClass("hide");
                    $("#" + id + "-supporting_document").attr("required", true);
                    $("#" + id + "-document").addClass("required");
                } else {
                    $("#" + id + "-supporting_document").attr("required", false);
                    $("#" + id + "-document").removeClass("required");
                    //$("#" + id + "-document").addClass("hide");
                }
            }
        })
	});
    //<!-- script to allow document based on the selected leave type -->	
</script>
</body>
</html>