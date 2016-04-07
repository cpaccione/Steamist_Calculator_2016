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

$colname_rsGenerators = "-1";
if (isset($varGenRef)) {
  $colname_rsGenerators = $varGenRef;
}
mysql_select_db($database_conn, $conn);
$query_rsGenerators = sprintf("SELECT sg_generators.*, sg_genrelation.* FROM sg_generators INNER JOIN sg_genrelation ON sg_generators.id = sg_genrelation.genmodel WHERE sg_genrelation.refid = %s", GetSQLValueString($colname_rsGenerators, "text"));
$rsGenerators = mysql_query($query_rsGenerators, $conn) or die(mysql_error());
$row_rsGenerators = mysql_fetch_assoc($rsGenerators);
$totalRows_rsGenerators = mysql_num_rows($rsGenerators);


?>

<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
		<tr>
				<td><strong><a href="?genqty=<?php echo $_GET[genqty]; ?>&button3=<?php echo $_GET[button3]; ?>&genid=<?php echo $_GET[genid]; ?>&gen=<?php echo $_GET[gen]; ?>&genref=<?php echo $_GET[genref]; ?>">Generator</a></strong></td>
				<td align="right"><strong>Price</strong></td>
				<td align="right"><strong>Qty</strong></td>
				<td align="right"><strong>Total</strong></td>
		</tr>
		<?php do { ?>
				<tr>
						<td><a class="generators" href="#<?php echo $row_rsGenerators['id']; ?>"> <?php echo $row_rsGenerators['series']; ?>-<?php echo $row_rsGenerators['model']; ?></a>
								<div style="display: none;">
										<div id="<?php echo $row_rsGenerators['id']; ?>" style="width:400px;overflow:auto;"> 
										<?php if ($row_rsGenerators['image'] <> '') {?>
						<img class="alignleft" name="img" src="<?php echo $row_rsGenerators['image']; ?>"  alt="" />
						<?php } ?>
										<strong><?php echo $row_rsGenerators['series']; ?></strong> <br />
												<?php echo $row_rsGenerators['model']; ?> <br />
												<?php echo $row_rsGenerators['modaltext']; ?> <br />
										</div>
								</div></td>
						<td align="right" style="width:50px;">$<?php echo $row_rsGenerators['price'] ; ?></td>
						<td align="right" style="width:50px;"><?php echo $varGenQty; ?></td>
						<td align="right" style="width:50px;">$<?php 
								 $gentotal = $row_rsGenerators['price'] *  $varGenQty;
								echo $gentotal;
								$gengrandtotal +=  + $gentotal;
								//echo '<br>' . $controlgrandtotal ;
								?></td>
				</tr>
				<tr>
						<td colspan="3" align="right" class="boxBG"><strong>Generator Total:</strong></td>
						<td align="right" class="boxBG"><strong>$<?php echo $gengrandtotal; ?></strong></td>
				</tr>
				<?php } while ($row_rsGenerators = mysql_fetch_assoc($rsGenerators)); ?>
</table>
