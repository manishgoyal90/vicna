<?php
include"lib/header.php";
?>
<?php include("pagination.class.php");?>
<style type="text/css">
/*
Plugin Name: WP-Digg Style Paginator
Plugin URI: http://www.mis-algoritmos.com/2007/09/09/wp-digg-style-pagination-plugin-v-10/
Author: Victor De la Rocha
Author URI: http://www.mis-algoritmos.com
*/
.pagination {
	padding: 2px;
	margin: 2px;
	text-align:center;
}
.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	font-weight:normal;
	font-size:14px;
	border: 1px solid #EEE;
	text-decoration: none; /* no underline */
	color: #036CB4;
}
.pagination a:hover, .pagination a:active {
	border: 1px solid #999;
	font-size:14px;
	font-weight:normal;
	color: #666;
}
.pagination .current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	font-size:14px;
	border: 1px solid #036CB4;
	font-weight: normal;
	background-color: #036CB4;
	color: #FFF;
}
.pagination .disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #EEE;
	color: #DDD;
}
</style>
<div class="page-container row-fluid">
  <!-- BEGIN SIDEBAR -->
  <?php include"lib/leftbar.php"; ?>
  <!-- END SIDEBAR -->
  <!-- BEGIN PAGE -->
  <div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
      <!-- BEGIN PAGE HEADER-->
      <div class="row-fluid">
        <div class="span12">
          <!-- BEGIN STYLE CUSTOMIZER -->
          <?php include"lib/themecolor.php"; ?>
          <!-- END BEGIN STYLE CUSTOMIZER -->
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title"> Queries </h3>
          <ul class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <span class="icon-angle-right"></span> </li>
            <li><a href="#">Queries</a></li>
          </ul>
		  <button data-toggle="collapse" data-target="#demo2" style="width:200px; margin:3px;">Add Donot Send </button>
		  <div id="demo2" class="collapse">
		  <form action="ajax/doNotSend.php" method="post" id="do_not_send">
          <table class="table table-striped table-bordered table-hover" style="">  
		  	<tr>
				<th width="20%">Staff name:</th>
				<th width="25%">Staff Qualification:</th>
				<th width="20%">Client Registration No.</th>
				<th width="30%">For What</th>
				<th>&nbsp;</th>
			</tr>         
           <tr>
		   <td><input  type="text" name="stuffName" value="" placeholder="Enter Staff Name" style="background:#FFE6E1; width:90%;" required> </td>
		   <td><input type="text" name="qualification" value="" placeholder="Enter Qualification" style="background:#FFE6E1; width:90%;" > </td>
		   <td><input type="text" name="clientRegNo" value="" placeholder="Enter Client Reg. No." style="background:#FFE6E1; width:90%;" > </td>
		   <td rowspan="2"><textarea name="reason" rows="3" style="background:#FFE6E1; width:90%;" ></textarea></td>
           <td><input type="button" name="donotsend" id="donotsend" value="Do not send" class="btn btn-info" ></td></tr>
			</table>
             </form>
		  </div>
          <!-- END PAGE TITLE & BREADCRUMB-->
          <?php
if ($_REQUEST['mess'] == 'updatesuccessful') {
    ?>
          <div class="alert alert-success">
            <button data-dismiss="alert" class="close"></button>
            Item Menu Successfully Created... </div>
          <?php
}
if ($_REQUEST['mess'] == 'successfulupdate') {
    ?>
          <div class="alert alert-success">
            <button data-dismiss="alert" class="close"></button>
            Successfully Item Menu Updated... </div>
          <?php
}
if ($_REQUEST['mess'] == 'unsuccessful') {
    ?>
          <div class="alert alert-error">
            <button data-dismiss="alert" class="close"></button>
            E-Mail Address already exists.Please try another one! </div>
          <?php
}
?>
        </div>
      </div>
      <!-- END PAGE HEADER-->
      <!-- Statr Page body-->
      <!-- BEGIN PAGE CONTENT-->
      <div class="row-fluid">
        <div class="span12">
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet box grey">
            <div class="portlet-title">
              <div class="caption"><i class="icon-reorder"></i>
                <?=$pagetitle?>
              </div>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#portlet-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="portlet-body">
              <div class="table-toolbar">
                <div class="btn-group pull-right">
                  <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i> </button>
                  <ul class="dropdown-menu">
                    <li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
                  </ul>
                </div>
              </div>
              <div id="tablesec">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
                      <th class="hidden-480">Nos.</th>
                      <th class="hidden-480">Staff Name</th>
					  <th class="hidden-480">Qualification</th>
                      <th class="hidden-480">Client Name</th>
                      <th class="hidden-480">Reason</th>
                      <th class="hidden-480">Date Request</th>
                      <th class="hidden-480">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					
					$ctn = 1;
					
					
											
					$GetUserSql = "SELECT * FROM do_not_send ORDER BY sl DESC";
					$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
					while ($rowdest = mysql_fetch_array($GetQuery)) {
    ?>
                    <tr class="odd gradeX">
                      <td class="hidden-480"><input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $ctn; ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['stuffName'] ?>
                        </div></td>
						<td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['qualification'] ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
					  <?php	$fetClient = mysql_fetch_array(mysql_query("SELECT FirstName, LastName FROM hr_user_registration WHERE Uid = '".$rowdest['clientId']."'"));?>
                          <a target="_blank" href="userinfo.php?Uid=<?=$rowdest['clientId']?>"><?=strtoupper($fetClient['FirstName']." ".$fetClient['LastName']); ?></a>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= stripslashes($rowdest['reason']); ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= date('d/m/Y H:i:s', strtotime($rowdest['dt'])); ?>
                        </div></td>
                     
                      <td class="hidden-480"><a onclick="deleteone(<?=$rowdest['sl']?>);" class="btn mini red"><i class="icon-trash"></i> Delete</a></td>
                    </tr>
                    <?php $ctn++;
} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>
      <!-- END PAGE CONTENT-->
      <!-- End Page Body-->
    </div>
    <!-- END PAGE CONTAINER-->
  </div>
  <!-- END PAGE -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
  <?php include "lib/footer.php"; ?>
</div>
<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>
<script src="assets/scripts/ui-modals.js"></script>
<script src="assets/scripts/form-components.js"></script>
<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script src="assets/scripts/table-managed.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$('#donotsend').click(function(){
		
		$('#do_not_send').ajaxForm({
			target:'#tablesec',
			beforeSubmit:function(e){
				//$('.uploading').show();
			},
			success:function(e){
				//$('.uploading').hide();
			},
			error:function(e){
			}
		}).submit();
	});
	
	
	
});
</script>
<script>

    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        UIModals.init();
        TableManaged.init();
    });

    /********************Delete****************/
    function deleteone(id)
    {
        var cnf = confirm("Are you sure to delete?");

        if (cnf)
        {
            $('.portlet .tools a.reload').click();
            $.post('ajax/delDoNot.php', {feedid: id, mode: 'single'},
            function(data)
            {//deletecinematic
                $('#tablesec').html(data);
                /************************************ Table JS ************************************/
                $('#sample_2').dataTable({
                    "aLengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"]
                    ],
                    // set the initial value
                    "iDisplayLength": 5,
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ records per page",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aoColumnDefs": [{
                            'bSortable': false,
                            'aTargets': [0]
                        }]
                });

                jQuery('#sample_2 .group-checkable').change(function() {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function() {
                        if (checked) {
                            $(this).attr("checked", true);
                        } else {
                            $(this).attr("checked", false);
                        }
                    });
                    jQuery.uniform.update(set);
                });

                var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
                if (test) {
                    test.uniform();
                }

                $(".chosen").chosen();

                /************************************ Table JS ************************************/
            }
            );
        }
    }
    function delselected()
    {
        var feed = document.getElementsByName('feed[]');

        var ln = feed.length;

        var flag = 0;
        var str = "";

        for (i = 0; i < ln; i++)
        {
            if (feed[i].checked)
            {
                str = str + feed[i].value + ',';
            }
        }

        if (str != "")
        {
            var cnf = confirm("Are you sure to delete?");

            if (cnf)
            {
                $('.portlet .tools a.reload').click();
                $.post('ajax/delitem.php', {feedids: str, mode: 'selected'},
                function(data)
                {
                    $('#tablesec').html(data);

                    /************************************ Table JS ************************************/

                    $('#sample_2').dataTable({
                        "aLengthMenu": [
                            [5, 15, 20, -1],
                            [5, 15, 20, "All"]
                        ],
                        // set the initial value
                        "iDisplayLength": 5,
                        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                        "sPaginationType": "bootstrap",
                        "oLanguage": {
                            "sLengthMenu": "_MENU_ records per page",
                            "oPaginate": {
                                "sPrevious": "Prev",
                                "sNext": "Next"
                            }
                        },
                        "aoColumnDefs": [{
                                'bSortable': false,
                                'aTargets': [0]
                            }]
                    });

                    jQuery('#sample_2 .group-checkable').change(function() {
                        var set = jQuery(this).attr("data-set");
                        var checked = jQuery(this).is(":checked");
                        jQuery(set).each(function() {
                            if (checked) {
                                $(this).attr("checked", true);
                            } else {
                                $(this).attr("checked", false);
                            }
                        });
                        jQuery.uniform.update(set);
                    });

                    var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
                    if (test) {
                        test.uniform();
                    }

                    $(".chosen").chosen();

                    /************************************ Table JS ************************************/
                }
                );
            }
        }
        else
        {
            alert('You must select atleast one item');
        }
    }
    /********************Status****************/
    function changestatus(stat, id)
    {
        $.post('ajax/statusphoto.php', {stat: stat, id: id});
    }
</script>
<!-- END JAVASCRIPTS -->
</body><!-- END BODY -->
</html>