<?php
$tsggen = substr($_GET['gen'], 0,2);

if ($tsggen == 'TS') {
	//echo $cparray;
	$hasCPcontrol = strstr($cparray, 'DCP');
	//echo $hasCPcontrol;
	if ($hasCPcontrol == false || $_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
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
			$extrasqty = $_GET['genqty'];
		}
		else {
			$extrasqty = $_GET['genstack'];
		}
		$cabletotal = 50 * ($extrasqty -1);
		$autodraintotal = 400 * $extrasqty;
		$drainpantotal = 95 * $extrasqty;
		if ($_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
			if ($hasCPcontrol == true) {
				$cabletotal = 50 * (1) ;
                $autodraintotal = 400 * 1;
                $drainpantotal = 95 * 1;
                $extrasqty = 1;
			}
		}
?>
<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td ><strong>Additional Items</strong></td>
        <td align="right" ><strong>Qty</strong></td>
        <td align="right" ><strong>Price</strong></td>
    </tr>
    <tr>
        <td >3199 steamhead <?php echo ' - ' . ucwords(substr($strcontrolfinishes, 0, -2)); ?></td>
        <td align="right" style="width:60px;">
<?php
		if ($_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
			if ($hasCPcontrol == true) {
				echo $extrasqty;
			}
			else {
				echo $extrasqty - 1;
			}
		}
		else {
			echo $extrasqty - 1;
		}
?>
		</td>
        <td align="right" style="width:60px;">
<?php
		if ($steamheadfinish == 'Polished Chrome') {
			$steamhead = '200';
			if ($_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
				if ($hasCPcontrol == true) {
					$steamheadtotal = $steamhead * ($extrasqty);
				}
				else {
					$steamheadtotal = $steamhead * ($extrasqty - 1);
				}
			}
			else {
				$steamheadtotal = $steamhead * ($extrasqty - 1);
			}
			echo '$' . $steamheadtotal;
		}
		else {
			$steamhead = '250';
			if ($_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
				if ($hasCPcontrol == true) {
					$steamheadtotal = $steamhead * ($extrasqty);
				}
				else {
					$steamheadtotal = $steamhead * ($extrasqty - 1);
				}
			}
			else {
				$steamheadtotal = $steamhead * ($extrasqty - 1);
			}
			echo '$' . $steamheadtotal;
		}
?>
		</td>
    </tr>
    <tr>
	    <td >5158 cable</td>
	    <td align="right" style="width:60px;">
<?php
		if ($_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
			if ($hasCPcontrol == true) {
				echo $extrasqty;
			}
			else {
				echo $extrasqty - 1;
			}
		}
		else {
			echo $extrasqty - 1;
		}
?>
        </td>
        <td align="right" style="width:60px;">$<?php echo $cabletotal; ?></td>
    </tr>
    <tr>
        <td>Auto Drain for Total Sense TSG Generator - TSG-AD</td>
        <td align="right" style="width:60px;"><?php echo $extrasqty; ?></td>
        <td align="right" style="width:60px;">$<?php echo $autodraintotal; ?></td>
    </tr>
    <tr>
        <td>Drain Pan</td>
        <td align="right" style="width:60px;"><?php echo $extrasqty; ?></td>
        <td align="right" style="width:60px;">$<?php echo $drainpantotal; ?></td>
    </tr>
    <tr>
        <td colspan="2" align="right" class="boxBG" ><strong>Additional Items Total:</strong></td>
        <td align="right" style="width:60px;" class="boxBG"><strong>
<?php
		$steamcab = $steamheadtotal + $cabletotal + $autodraintotal + $drainpantotal;
		echo '$' . $steamcab;
?>
		</strong></td>
	</tr>
</table>
<?php
	}
?>
<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" class="boxBG"><strong>Estimate order total:</strong></td>
		<td align="right" style="width:60px;" class="boxBG"><strong>
<?php
		//$nosteamtotal = $gengrandtotal + $optionsgrandtotal + $controlgrandtotal + $accessgrandtotal;
		//echo $nosteamtotal. '<br>';
	$grandtotal = $gengrandtotal + $optionsgrandtotal + $controlgrandtotal + $accessgrandtotal + $steamheadtotal + $autodraintotal + $drainpantotal + $cabletotal;
	echo '$' . $grandtotal;
?>
		</strong></td>
	</tr>
	<tr>
		<td colspan="2" align="right">Sales tax not included.</td>
	</tr>
</table>
<?php
}
else {
	$autodraintotal = '0';
}
?>
