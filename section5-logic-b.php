<?php
$tsggen = substr($_GET['gen'], 0,2);
if ($tsggen == 'TS') {
	if ($_GET['genstack'] > '1' || $_GET['genqty'] > '1') {
		$checkchrome = strpos($strcontrolfinishes , 'polished chrome');
		if ($checkchrome === false) {
			$steamheadfinish = '';
			//echo "Nope";
		}
		else {
			$steamheadfinish = 'Polished Chrome';
			// echo "Yup";
		}
		$steamhead = '0';
		$extrasqty = '0';
		if ($_GET['genstack'] == '' )   {
			$extrasqty = $_GET['genqty'] - 1;
		}
		else {
			$extrasqty = $_GET['genstack'] -1 ;
		}
		$cabletotal = 50 * $extrasqty;
		$autodraintotal = 400 * $extrasqty;

?>
<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td ><strong>Additional Items</strong></td>
		<td align="right" ><strong>Qty</strong></td>
		<td align="right" ><strong>Price</strong></td>
	</tr>
	<tr>
		<td >3199 steamhead - <?php echo ucwords(substr($strcontrolfinishes, 0, -2)); ?></td>
		<td align="right" style="width:60px;"><?php echo $extrasqty; ?></td>
		<td align="right" style="width:60px;">
<?php
		if ($steamheadfinish == 'Polished Chrome') {
			$steamhead = '200';
			$steamheadtotal = $steamhead * $extrasqty ;
			echo '$' . $steamheadtotal ;
		}
		else {
			$steamhead = '250';
			$steamheadtotal = $steamhead * $extrasqty ;
			echo '$' . $steamheadtotal ;
		}
?>
		</td>
	</tr>
	<tr>
		<td >5158 cable</td>
		<td align="right" style="width:60px;"><?php echo $extrasqty; ?></td>
		<td align="right" style="width:60px;">$<?php echo $cabletotal;?></td>
	</tr>
<?php
		//echo $cparray;
		$hasCPcontrol = strstr($cparray, 'CP');
		//echo $hasCPcontrol;
		if ($hasCPcontrol <> '') {
?>
	<tr>
		<td>Auto Drain for Total Sense TSG Generator - TSG-AD</td>
		<td align="right" style="width:60px;"><?php echo $extrasqty; ?></td>
		<td align="right" style="width:60px;">$<?php echo $autodraintotal; ?></td>
	</tr>
<?php
		}
		else {
			$autodraintotal = '0';
		}
?>
	<tr>
		<td colspan="2" align="right" class="boxBG" ><strong>Additional Items Total:</strong></td>
		<td align="right" style="width:60px;" class="boxBG"><strong>
<?php
$steamcab = $steamheadtotal + $cabletotal + $autodraintotal;
echo '$' . $steamcab;
?>
		</strong></td>
	</tr>
</table>
<?php } }?>
<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" class="boxBG"><strong>Estimate order total:</strong></td>
		<td align="right" style="width:60px;" class="boxBG"><strong>
<?php
//$nosteamtotal = $gengrandtotal + $optionsgrandtotal + $controlgrandtotal + $accessgrandtotal;
//echo $nosteamtotal. '<br>';
$grandtotal = $gengrandtotal + $optionsgrandtotal + $controlgrandtotal + $accessgrandtotal + $steamheadtotal + $autodraintotal + $cabletotal;
echo '$' . $grandtotal;

?>
		</strong></td>
	</tr>
	<tr>
		<td colspan="2" align="right">Sales tax not included.</td>
	</tr>
</table>
