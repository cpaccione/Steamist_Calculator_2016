<?php if ($_SESSION['genselected'] != 'SM' )  {?>
<?php if ($_GET['sm'] != 'SM') {?>
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

$colname_rsSumOptions = "-1";
if (isset($_SESSION['userquoteid'])) {
  $colname_rsSumOptions = $_SESSION['userquoteid'];
}
mysql_select_db($database_conn, $conn);
$query_rsSumOptions = sprintf("SELECT sg_options.*, sg_options.id as optid, sg_useroptions.* FROM sg_options INNER JOIN sg_useroptions ON sg_options.id = sg_useroptions.optionid where  sg_useroptions.quotesession = %s AND optionqty <> 0", GetSQLValueString($colname_rsSumOptions, "text"));
$rsSumOptions = mysql_query($query_rsSumOptions, $conn) or die(mysql_error());
$row_rsSumOptions = mysql_fetch_assoc($rsSumOptions);
$totalRows_rsSumOptions = mysql_num_rows($rsSumOptions);

?>
<?php if ($totalRows_rsSumOptions > 0) { // Show if recordset not empty ?>
		<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
						<td><strong>Options</strong></td>
						<td align="right" style="width:50px;"><strong>Price</strong></td>
						<td align="right" style="width:50px;"><strong>Qty</strong></td>
						<td align="right" style="width:50px;"><strong>Total</strong></td>
				</tr>
				<?php do { ?>
						<?php 
						
						
							if ($row_rsSumOptions['model'] == 'TSA') {
								$aromaoption = 'yes';	
							}
							
							if ($row_rsSumOptions['model'] == 'TSMC') {
								$opTSMC = 'true';	
							}
							if ($row_rsSumOptions['model'] == 'TSCH') {
								$opTSMC = 'true';	
							}
							if ($row_rsSumOptions['model'] == 'TSMU') {
								$opTSMC = 'true';	
							}
							if ($row_rsSumOptions['model'] == 'TSA') {
								$opTSMC = 'true';	
							}
									
									
									
									?>
						<tr>
								<td><div class="options"> <?php echo $row_rsSumOptions['optionname']; ?>-<?php echo $row_rsSumOptions['model']; ?></div>
		<!--								<div style="display: none;">  -->
												<div id="opt<?php echo $row_rsSumOptions['optid']; ?>" style="width:400px;overflow:auto;"> 
												
												<?php if ($row_rsSumOptions['image'] <> '') {?>
						<img class="alignleft" name="img" src="http://www.steamist.com<?php echo $row_rsSumOptions['image']; ?>"  alt="" />
						<?php } ?>
						
		<!--							<strong><?php echo $row_rsSumOptions['optionname']; ?></strong> <br />  -->
		<!--										<?php echo $row_rsSumOptions['model']; ?> <br />  -->
												<?php echo $row_rsSumOptions['modaltext']; ?> <br />
												</div>
										</div></td>
								<td valign="top" align="right">$<?php echo $row_rsSumOptions['price'] ; ?></td>
								<td valign="top" align="right"><?php echo $row_rsSumOptions['optionqty']; ?></td>
								<td valign="top" align="right">$<?php 
								 $optionstotal = $row_rsSumOptions['price'] *  $row_rsSumOptions['optionqty'];
								echo $optionstotal;
								$optionsgrandtotal +=  + $optionstotal;
								//echo '<br>' . $controlgrandtotal ;
								?></td>
						</tr>
						<?php } while ($row_rsSumOptions = mysql_fetch_assoc($rsSumOptions)); ?>
				<tr>
						<td colspan="3" align="right" class="boxBG"><strong>Options Total:</strong></td>
						<td align="right" class="boxBG"><strong>$<?php echo $optionsgrandtotal; ?></strong></td>
				</tr>
		</table>
		<?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsSumOptions == 0) { // Show if recordset empty ?>
		<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
						<td><strong>Options</strong></td>
				</tr>
				<tr>
						<td>No Options Selected.</td>
				</tr>
		</table>
		<?php $spaoptions = 'empty' ;
		
		//echo $aromaoption ;
		//echo $spaoptions;?>
		<?php } // Show if recordset empty ?>
<?php mysql_free_result($rsSumOptions);?>
<?php } } ?>