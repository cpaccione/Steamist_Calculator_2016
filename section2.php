<?php //require_once('../../../../Connections/conn.php'); ?>
<?php require_once('calcfunctions.php'); 
		require_once('optionfunctions.php'); 
		
		?>

<?php 
mysql_select_db($database_conn, $conn);
$query_rsOptions = "SELECT * FROM sg_options ORDER BY SortOrder ASC";
$rsOptions = mysql_query($query_rsOptions, $conn) or die(mysql_error());
$row_rsOptions = mysql_fetch_assoc($rsOptions);
$totalRows_rsOptions = mysql_num_rows($rsOptions);

?>

<h2>Sizing and Selection Guide </h2>
<?php $whereFrom = explode('/', $_SERVER[REQUEST_URI]);?>
<?php if($whereFrom[1] == "mysteamist2") : ?>
<p><a href="calc.php" >< Back to generator selection</a></p>
<?php else : ?>
<p><a href="<?php bloginfo('url'); ?>/for-professionals/residential-sizing-guide/">< Back to generator selection</a></p>
<?php endif; ?>

<?php require_once('sumGenerators.php'); ?>

<script type="text/javascript">
incdec = null;
jQuery(function($){
	function my_incdec(parentname) {
	    upname = parentname + ">#up";
	    downname = parentname + ">#down";
	    jQuery(upname).on('click', function () {
	        jQuery(parentname + ">input").val(parseInt(jQuery(parentname + ">input").val()) + 1);
	    });

	    jQuery(downname).on('click', function () {
	    	qval = parseInt(jQuery(parentname + ">input").val());
	    	if( qval > 0 ) qval--;
	        jQuery(parentname + ">input").val(qval);
	    });
	}
	incdec = my_incdec;
})
</script>

<table border="0" cellspacing="0" cellpadding="0">
		<tr>
				<!-- <td><h5>3. </h5></td> -->
				<td width="100%"><h5><strong>3. Choose Total Sense Spa Options:</strong></h5>
				<p>Total Sense Spa Options (available with TSG generators):</p>
				<p>Click on the listed items for a detailed description.</p>
				<form id="form1" name="form1" method="post" action="">
				<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
						<tr>
								<td><strong>Name</strong></td>
								<td><strong>Price</strong></td>
								<td>&nbsp;</td>
								<td><strong>Qty</strong></td>
						</tr>

						<?php do { ?>
						<tr>
							<td>

							<a class="options" href="#opt<?php echo $row_rsOptions['id']; ?>"> <?php echo $row_rsOptions['optionname']; ?>-<?php echo $row_rsOptions['model']; ?></a>

								<div style="display: none;">
										<div id="opt<?php echo $row_rsOptions['id']; ?>" style="width:400px;overflow:auto;"> 
										<?php if ($row_rsOptions['image'] <> '') {?>
										<img class="alignleft" name="img" src="<?php echo $row_rsOptions['image']; ?>"  alt="" />
											<?php } ?>
										<strong><?php echo $row_rsOptions['optionname']; ?></strong> <br />
												<?php echo $row_rsOptions['model']; ?> <br />
												<?php echo $row_rsOptions['modaltext']; ?> <br />
										</div>
								</div>
							</td>

							<td>$<?php echo $row_rsOptions['price']  ?></td>

								<td>

								<input name="optionsid[]" type="hidden" id="optionid<?php echo $row_rsOptions['id']; ?>" value="<?php echo $row_rsOptions['id']; ?>" />		

								<!--
								<input name="optionsqty[]" type="text" id="optionsqty<?php echo $row_rsOptions['id']; ?>" style="width:30px;" value="<?php  if (Option($row_rsOptions['id'], $_SESSION['userquoteid'],  'optionqty') <> '' ){ echo Option($row_rsOptions['id'], $_SESSION['userquoteid'],  'optionqty') ; } else { echo '0';} ?>" />
								-->
								</td>

								<td id="indec<?php echo $row_rsOptions['id']; ?>">
									<!--
									<input style="width: 30px;" type="text" value="0">
									-->
									<input name="optionsqty[]" type="text" id="optionsqty<?php echo $row_rsOptions['id']; ?>" style="width:30px;" value="<?php  if (Option($row_rsOptions['id'], $_SESSION['userquoteid'],  'optionqty') <> '' ){ echo Option($row_rsOptions['id'], $_SESSION['userquoteid'],  'optionqty') ; } else { echo '0';} ?>" />
								    <button id="up" >+</button>
								    <button id="down" >-</button>
								    <script>
								    jQuery(function($){incdec("#indec<?php echo $row_rsOptions['id']; ?>");})</script>
									</td>
								

								<td>
								$<?php echo $row_rsOptions['price'] * Option($row_rsOptions['id'], $_SESSION['userquoteid'],  'optionqty') ;?>
								</td>
						</tr>
						<?php } while ($row_rsOptions = mysql_fetch_assoc($rsOptions)); ?>
				</table>
<!-- 				<input name="optionscb" type="checkbox" id="optionscb" value="N" />
				<input name="useroptions" type="hidden" id="useroptions" value="<?php// echo uniqid('', true); ?>" />	
				Do not include any Total Sense Spa Options<br />
				<br /> -->
<div class="steps-update"><!--<input type="submit" name="optionsbtn" id="optionsbtn" value="Add/Update Options" />--></div>
<input name="optionsform" type="hidden" id="optionsform" value="Update" />
				</form>
				
				</td>
	
		
		</tr>
</table>
	<?php //if ($_POST['optionsbtn'] == 'Update') {?>
				<div class="steps">
				<a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=3&amp;genstack=<?php echo $_GET[genstack]; ?>"><button type="button" class="btn btn-primary">NEXT - Choose Control Package</button></a>
				</div>
				<!-- <p>4. Next, choose your control or control package ></p> This is the old copy from the next link -->
				<?php // } ?>
<?php
mysql_free_result($rsGenerators);

mysql_free_result($rsOptions);
?>

<script type="text/javascript">
jQuery('#optionsbtn').mousedown (function () {
	/*jQuery("#controlqty5").attr("disabled", jQuery("#controlqty5").val() == "0");*/
		
	if ( jQuery("#optionsqty1").val() == "0" 
	 && jQuery("#optionsqty2").val() == "0" 
	 && jQuery("#optionsqty3").val() == "0" 
	 && jQuery("#optionsqty4").val() == "0"
	 && jQuery("#optionsqty101").val() == "0" 
	 && jQuery("#optionsqty100").val() == "0" 
	) {
		if ( jQuery("#optionsqty5").val() > "0" 
		 || jQuery("#optionsqty6").val() > "0" 
		 || jQuery("#optionsqty7").val() > "0" 
		 || jQuery("#optionsqty8").val() > "0" 
		) {
			alert("This item cannot be selected on its own. Please select a spa option with this selection.");
		}
	} 
	jQuery('input[id^="optionsqty"]').each(function(){
		if (jQuery(this).val() == "") {
			alert("Please do not leave any values blank");
			e.preventDefault();
			return false;
		}
	});


});

</script>
