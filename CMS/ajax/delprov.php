<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."proviance WHERE pid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	$delsingle = "DELETE FROM ".TABLE_PREFIX."proviance WHERE pid = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
										<th class="hidden-480">Provinces</th> 
										<th class="hidden-480">Provinces Code</th> 
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Status</th>
										<!--<th class="hidden-480">View</th>-->
                                        <th class="hidden-480">Edit</th>
                                        <!--<th class="hidden-480">Delete</th>-->
									</tr>
								</thead>
								<tbody>
									
								<?php
									$i=1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."proviance ORDER BY pid ASC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['pid']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
											<div class="videoWrapper">
												<?=stripslashes($rowdest['proviance_name'])?>
											</div>
										</td>
										<td class="hidden-480">
											<div class="videoWrapper">
												<?=stripslashes($rowdest['proviance_code'])?>
											</div>
										</td>
										<td class="hidden-480"><div class="videoWrapper"><?=date("jS F Y",strtotime($rowdest['p_date']))?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span6 chosen" tabindex="1" id="stat<?=$rowdest['pid']?>" onChange="changestatus(this.value,'<?=$rowdest['pid']?>')">
												<option value="true" <?=$rowdest['pstatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['pstatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<!--<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="coursecatview.php?cid=<?=$rowdest['cid']?>">View <i class="icon-edit"></i></a>                                           
										</td>-->
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="#proedit<?=$i?>">Edit <i class="icon-edit"></i></a> 
											<div id="proedit<?=$i?>" class="modal hide fade dip" tabindex="-1" data-width="650">	
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h3>Edit <?=stripslashes($rowdest['proviance_name'])?> Provinces</h3>
											</div>	
												 <form class="fm_bottom" name="provienceedit" id="provienceedit" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" onsubmit="return check2();">	
												 <input type="hidden" name="proid" id="proid" value="<?=$rowdest['pid']?>" /> 
													<div class="modal-body">								
														<div class="scroller" style="height:170px" data-always-visible="1" data-rail-visible1="1"> 
															<div class="row-fluid">
															   <div class="span6">																	
																<div class="control-group">
																  <label class="control-label">Provinces <span style="color:#ff0000;">*</span></label>
																   <div class="controls">
																	  <input type="text" class="span m-wrap" placeholder="Provinces" name="proviance_name2" id="proviance_name2" value="<?=stripslashes($rowdest['proviance_name'])?>" />
																	</div>
																   </div>	
																   </div>
																   <div class="span6">	
																   <div class="control-group">
																  <label class="control-label">Provinces Code <span style="color:#ff0000;">*</span></label>
																   <div class="controls">
																	  <input type="text" class="span m-wrap" placeholder="Provinces Code" name="proviance_code2" id="proviance_code2" value="<?=stripslashes($rowdest['proviance_code'])?>" />
																	</div>
																   </div>
																</div>
																																		
														  </div>
														</div>
														</div>
														<div class="modal-footer">
															<button type="button" data-dismiss="modal" class="btn">Close</button>
															<input type="submit" class="btn blue" name="submit" value="Update" />
														</div>							
											</form>
									</div>
                            			</td>
                                        <!--<td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['pid']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>-->
                                       </tr>
                                       <?php $i++; } ?>
								</tbody>
							</table>