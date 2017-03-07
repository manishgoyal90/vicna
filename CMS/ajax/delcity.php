<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."city_regency WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	$delsingle = "DELETE FROM ".TABLE_PREFIX."city_regency WHERE id = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
										<th class="hidden-480">Provinces</th> 
										<th class="hidden-480">City/Regency</th> 
										<th class="hidden-480">Code</th>
										<th class="hidden-480">Status</th>
                                        <th class="hidden-480">Edit</th>
                                       <!-- <th class="hidden-480">Delete</th>-->
									</tr>
								</thead>
								<tbody>
									
								<?php
									$i=1;
									$GetUserSql = "SELECT cr.*, pr.* FROM ".TABLE_PREFIX."city_regency as cr
													 INNER JOIN ".TABLE_PREFIX."proviance as pr ON pr.pid = cr.pid
													 ORDER BY cr.pid ASC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
											<div class="videoWrapper">
												<?=stripslashes($rowdest['proviance_name'])?>(<?=stripslashes($rowdest['proviance_code'])?>)
											</div>
										</td>
										<td class="hidden-480">
											<div class="videoWrapper">
												<?=stripslashes($rowdest['city_regency_name'])?>
											</div>
										</td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['city_regency_code'])?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span6 chosen" tabindex="1" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="true" <?=$rowdest['cstatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['cstatus'] == 'No' ? 'selected' : ''?>>InActive</option>
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
													<h3>Edit City/Regency</h3>
												</div>	
													 <form class="fm_bottom" name="provience" id="provience" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" onsubmit="return check();">	
													 <input type="hidden" name="proid" value="<?=$rowdest['id']?>" />
														<div class="modal-body">								
															<div class="scroller7" style="height:250px" data-always-visible="1" data-rail-visible1="1">
															<div class="row-fluid">
																   <div class="span12">																	
																	<div class="control-group">
																	  <label class="control-label">Provinces <span style="color:#ff0000;">*</span></label>
																	   <div class="controls">
																		  <select name="provinces2" id="provinces2<?=$i?>" class="chosen">
																				<option value="">Choose Provinces</option>
																				<?php
																					//Fetch Music Cat
																					$FetchCatSql2 = "SELECT * FROM ".TABLE_PREFIX."proviance WHERE pstatus = 'Yes'";
																					$FetchCatQuery2 = mysql_query($FetchCatSql2);
																					while($FetchCatRows2 = mysql_fetch_array($FetchCatQuery2)){
																				?>
																				<option value="<?=$FetchCatRows2['pid']?>" <?php if($FetchCatRows2['pid']==$rowdest['pid']){echo"selected";}?>><?=$FetchCatRows2['proviance_name']?></option>
																				<?php } ?>
																			 </select>	
																		</div>
																	   </div>
																	  </div>
																	  
																		<div class="span12">																	
																	<div class="control-group">
																	  <label class="control-label">&nbsp;</label>
																	   
																	   </div>
																	  </div>																	
															  </div>
																<div class="row-fluid">
																   <div class="span6">																	
																	<div class="control-group">
																	  <label class="control-label">City/Regency <span style="color:#ff0000;">*</span></label>
																	   <div class="controls">
																		  <input type="text" class="span m-wrap" placeholder="City/Regency" name="city_regency_name2" id="city_regency_name2" value="<?=stripslashes($rowdest['city_regency_name'])?>" />
																		</div>
																	   </div>
																	  </div>
																	  <div class="span6">	
																	   <div class="control-group">
																	  <label class="control-label">City/Regency Code <span style="color:#ff0000;">*</span></label>
																	   <div class="controls">
																		  <input type="text" class="span m-wrap" placeholder="City/Regency Code" name="city_regency_code2" id="city_regency_code2" value="<?=stripslashes($rowdest['city_regency_code'])?>" />
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
                                            <a onclick="deleteone(<?=$rowdest['id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>-->
                                       </tr>
                                       <?php $i++; } ?>
								</tbody>
							</table>