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

$colname_rsSumAccessories = "-1";
if (isset($_SESSION['userquoteid'])) {
  $colname_rsSumAccessories = $_SESSION['userquoteid'];
}
mysql_select_db($database_conn, $conn);
$query_rsSumAccessories = sprintf("SELECT sg_accessories.*, sg_accessories.id AS optid, sg_useraccessories.*, sg_accessoriesoptions.* FROM sg_accessories INNER JOIN sg_useraccessories ON sg_accessories.id = sg_useraccessories.optionid INNER JOIN sg_accessoriesoptions ON sg_useraccessories.optionid = sg_accessoriesoptions.controlid where  sg_useraccessories.quotesession = %s AND sg_useraccessories.optionqty <> 0 AND sg_accessoriesoptions.controloptionlabel = sg_useraccessories.finishlabel order by name ", GetSQLValueString($colname_rsSumAccessories, "text"));
$rsSumAccessories = mysql_query($query_rsSumAccessories, $conn) or die(mysql_error());
$row_rsSumAccessories = mysql_fetch_assoc($rsSumAccessories);
$totalRows_rsSumAccessories = mysql_num_rows($rsSumAccessories);

?>
<?php if ($totalRows_rsSumAccessories > 0) { // Show if recordset not empty ?>
		<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
						<td><strong><a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=4">Accessories</a></strong></td>
						<td align="right" style="width:50px;"><strong>Price</strong></td>
						<td align="right" style="width:50px;"><strong>Qty</strong></td>
						<td align="right" style="width:50px;"><strong>Total</strong></td>
				</tr>
				<?php do { ?>
						<tr>
								<td><a class="accessories" href="#accessories<?php echo $row_rsSumAccessories['optid']; ?>"> <?php echo $row_rsSumAccessories['name']; ?>-<?php echo $row_rsSumAccessories['model']; ?> </a><?php echo ' - <span style="text-transform:capitalize;">' . $row_rsSumAccessories['finishlabel'] . '</span>'; ?> 
										<div style="display: none;">
												<div id="accessories<?php echo $row_rsSumAccessories['optid']; ?>" style="width:400px;overflow:auto;">
												<?php if ($row_rsSumAccessories['image'] <> '') {?>
						<img class="alignleft" name="img" src="<?php echo $row_rsSumAccessories['image']; ?>"  alt="" />
						<?php } ?>
												 <strong><?php echo $row_rsSumAccessories['name']; ?></strong> <br />
														<?php echo $row_rsSumAccessories['model']; ?> <br />
														<?php echo $row_rsSumAccessories['modaltext']; ?> <br />
												</div>
										</div></td>
								<td align="right">$<?php echo $row_rsSumAccessories['controloptionvalue'] ; ?></td>
								<td align="right"><?php echo $row_rsSumAccessories['optionqty']; ?></td>
								<td align="right">$<?php 
								 $accesstotal = $row_rsSumAccessories['controloptionvalue'] *  $row_rsSumAccessories['optionqty'];
								echo $accesstotal;
								$accessgrandtotal +=  + $accesstotal;
								//echo '<br>' . $controlgrandtotal ;
								?></td>
						</tr>
						<?php } while ($row_rsSumAccessories = mysql_fetch_assoc($rsSumAccessories)); ?>
				<tr>
						<td colspan="3" align="right" class="boxBG"><strong>Accessories Total:</strong></td>
						<td align="right" class="boxBG"><strong>$<?php echo $accessgrandtotal; ?></strong></td>
				</tr>
		</table>
		<?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsSumAccessories == 0) { // Show if recordset empty ?>
		<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
						<td><strong><a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=4">Accessories</a></strong></td>
				</tr>
				<tr>
						<td>No Accessories Selected.</td>
				</tr>
		</table>
		<?php } // Show if recordset empty ?>
<?php mysql_free_result($rsSumAccessories);?>
