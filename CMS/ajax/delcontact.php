<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."user_contact WHERE ContactId = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM ".TABLE_PREFIX."user_contact WHERE ContactId = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480">Sl No.</th> 
										<th class="hidden-480">Name</th>
										<th class="hidden-480">Subject</th>
										<th class="hidden-480">Phone</th>
										<th class="hidden-480">Email</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."user_contact ORDER BY ContactId DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 			
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<?=$ctn?>
                                        </td>
										<td class="hidden-480">
											<div class="videoWrapper"><?=$rowdest['ContactName']?></div>					
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['Subject']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['Phone']?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <?=$rowdest['Email']?>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="contactview.php?ContactId=<?=$rowdest['ContactId']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="#responssend<?=$ctn?>">Reply <i class="icon-edit"></i></a> 
                                             <!------------------------Edit in lightbox Start--------------->
											 <div id="responssend<?php echo $ctn; ?>" class="modal hide fade dip" tabindex="-1" data-width="650">		 	
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h3>Reply To <?=$rowdest['ContactName']?></h3>
												</div>
												<form name="frmpageedt" id="frmpageedt" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data">	
													<input type="hidden" name="ContactId" value="<?=$rowdest['ContactId']?>">			
													<div class="modal-body">
														
														<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
															<div class="row-fluid">
																<div class="span10">
																	   <div class="control-group">
																		  <label class="control-label">To</label>
																		  <div class="controls">
																			 <input type="text" class="span m-wrap" name="email" id="email" value="<?=$rowdest['Email']?>"/>
																		  </div>
																	   </div>
                                                                       
                                                                       <div class="control-group">
																		  <label class="control-label">Subject</label>
																		  <div class="controls">
																			 <input type="text" class="span m-wrap" name="subject" id="subject" value="" />
																		  </div>
																	   </div>
                                                                       
                                                                       <div class="control-group">
																		  <label class="control-label">Message</label>
																		  <div class="controls">
																			 <textarea name="message" class="span m-wrap" rows="7" cols="10"></textarea>
																		  </div>
																	   </div>
																 </div>																
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" data-dismiss="modal" class="btn">Close</button>
														<input type="submit" class="btn blue" name="submit" value="Send" />
													</div>
												</form>
											</div>
										<!------------------------Edit in lightbox End--------------->
										<a onclick="deleteone(<?=$rowdest['ContactId']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>	
                            			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>