<?php //require_once('../../../../Connections/conn.php'); ?>
<?php 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsSumControls = "-1";
if (isset($_SESSION['userquoteid'])) {
  $colname_rsSumControls = $_SESSION['userquoteid'];
}
mysql_select_db($database_conn, $conn);
$query_rsSumControls = sprintf("SELECT sg_controls.*, sg_controls.id AS optid, sg_usercontrols.*, sg_controloptions.* FROM sg_controls INNER JOIN sg_usercontrols ON sg_controls.id = sg_usercontrols.optionid INNER JOIN sg_controloptions ON sg_usercontrols.optionid = sg_controloptions.controlid where  sg_usercontrols.quotesession = %s AND sg_usercontrols.optionqty <> 0 AND sg_controloptions.controloptionlabel = sg_usercontrols.finishlabel order by name", GetSQLValueString($colname_rsSumControls, "text"));
$rsSumControls = mysql_query($query_rsSumControls, $conn) or die(mysql_error());
$row_rsSumControls = mysql_fetch_assoc($rsSumControls);
$totalRows_rsSumControls = mysql_num_rows($rsSumControls);

?>
<?php if ($totalRows_rsSumControls > 0) { // Show if recordset not empty ?>
		<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
						<td><strong>Controls</strong></td>
						<td align="right" style="width:50px;"><strong>Price</strong></td>
						<td align="right" style="width:50px;"><strong>Qty</strong></td>
						<td align="right" style="width:50px;"><strong>Total</strong></td>
				</tr>
				<?php do { ?>
						<tr>
								<td><?php echo $row_rsSumControls['name'].'-'.$row_rsSumControls['model']; ?> <?php 
								
				global $controlfinishes, $strcontrolfinishes,  $voltage, $strvolt;
											$controlfinishes = $row_rsSumControls['finishlabel'];
											
											$strcontrolfinishes .= $controlfinishes . ', ' ;
									
									
											$strvolt = $row_rsSumControls['volt'];
											$voltage .= $strvolt . ', ' ;
								
								echo ' - <span style="text-transform:capitalize;">' . $row_rsSumControls['finishlabel'] . '</span>'; ?>
					<!--					<div style="display: none;">  -->
												<div id="controls<?php echo $row_rsSumControls['optid']; ?>" style="width:400px;overflow:auto;"> 
												
												<?php if ($row_rsSumControls['image'] <> '') {?>
						<img class="alignleft" name="img" src="http://www.steamist.com<?php echo $row_rsSumControls['image']; ?>"  alt="" />
						<?php } ?>
												
					<!--							<strong><?php echo $row_rsSumControls['name']; ?></strong> <br />  -->
					<!--									<?php echo $row_rsSumControls['model']; ?> <br />  -->
														<?php echo $row_rsSumControls['modaltext']; ?> <br />
					<!--							</div>  -->
										</div></td>
								<td valign="top" align="right">$<?php echo $row_rsSumControls['controloptionvalue'] ; ?></td>
								<td valign="top" align="right"><?php echo $row_rsSumControls['optionqty']; ?></td>
								<td valign="top" align="right">$<?php 
														$controlprice = $row_rsSumControls['controloptionvalue'] ;
														$controlquantity  = $row_rsSumControls['optionqty'] ;
														$adjustedprice = 100;
														
														if ( $row_rsSumControls['model'] == 'TSR') {
														
																		if ($controlquantity > 1 ) {
																			
																			$controlcost = ($adjustedprice * $controlquantity) + 290  ;
																			echo $controlcost ;
					
																		} else {
																			$controlcost = $controlprice;
																			echo $controlcost ;
																		}
														//$controlgrandtotal +=  + $controltotal;
														
														} else {
															$controlcost = $controlprice * $controlquantity;
															
															echo $controlcost  ; 
															}
														?><?php  $controlgrandtotal +=  + $controlcost;
												//echo '<br>' . $controlgrandtotal ;
												
													$cparray1 = $row_rsSumControls['model'] . ' ';
													$cparray .= $cparray1 ;
												//										
												 ?>
								
								
								</td>
						</tr>
						<?php } while ($row_rsSumControls = mysql_fetch_assoc($rsSumControls)); ?>
						<tr>
						<td colspan="3" align="right" class="boxBG"><strong>Controls Total:</strong></td>
						<td align="right" class="boxBG"><strong>$<?php echo $controlgrandtotal; ?></strong></td>
				</tr>
		</table>
		<?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsSumControls == 0) { // Show if recordset empty ?>
		<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
						<td><strong>Controls</strong></td>
				</tr>
				<tr>
						<td>No Options Selected.</td>
				</tr>
		</table>
		<?php } // Show if recordset empty ?>
<?php mysql_free_result($rsSumControls);?>
