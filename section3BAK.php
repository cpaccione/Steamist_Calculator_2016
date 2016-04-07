<?php
ob_start(); 
session_start();
// define if SM gen is used and use this to hide spa options
$_SESSION['genselected']  = substr($_GET['gen'], 0,2); 
$genselected = $_SESSION['genselected'] 
 ?>
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
 
//require_once('../../../../Connections/conn.php'); ?>
<?php require_once('calcfunctions.php'); 
		require_once('controlfunctions.php');  ?>
<?php 

mysql_select_db($database_conn, $conn);
$query_rsOptions = "SELECT * FROM sg_controls ORDER BY name ASC";
$rsOptions = mysql_query($query_rsOptions, $conn) or die(mysql_error());
$row_rsOptions = mysql_fetch_assoc($rsOptions);
$totalRows_rsOptions = mysql_num_rows($rsOptions);

mysql_select_db($database_conn, $conn);
$query_rsControls = "SELECT * FROM sg_controls ORDER BY ordering asc, name ASC";
$rsControls = mysql_query($query_rsControls, $conn) or die(mysql_error());
$row_rsControls = mysql_fetch_assoc($rsControls);
$totalRows_rsControls = mysql_num_rows($rsControls);



?>
<?php 
$pos = substr($_GET['gen'], 0,2); 
				function checklogic ($item) { 
				global $spaoptions, $opTSMC;
				$pos = substr($_GET['gen'], 0,2); 
				
				//$style = 'show';
				$style = 'hidden';
				
				if ($pos == 'TS') {
					
					
					if ($item == 'CP350' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'show';
												
												} 
											}
											
											if ($item == 'CP351' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'show';
												
												} 
												
												
											}
											
											
											
											
				if ($item == 'CP450' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'show';
												
												} 
											}
											
											if ($item == 'CP451' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'show';
												
												} 
												
												
											}											
											
											
											
			if ($item == 'CP450T' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'show';
												
												} 
											}
											
											if ($item == 'CP451T' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'show';
												
												} 
												
												
											}												
											
					
					
					if ($opTSMC != 'true') {
							
							if ($item == 'TSC-350' ) {
								$style = 'show';
							}
							
							if ($item == 'TSC-450' ) {
								$style = 'show';
							}
							
								if ($item == 'TSC-450T' ) {
								$style = 'show';
							}
							
							
							if ($item == 'TSC-250' ) {
								
										if ($spaoptions == 'empty' ) {
											$style = 'show';
										
										}  else {
											$style = 'hidden';
										
										} 
							}
							
							
							if ($item == 'TSC-250T' ) {
									if ($spaoptions == 'empty' ) {
											$style = 'show';
										
										}  else {
											$style = 'hidden';
										
										} 
							}
							
							if ($item == 'TSX-220' ) {
									if ($spaoptions == 'empty' ) {
											$style = 'show'; 
										
										}  else {
											$style = 'hidden';
										
										} 
								
							}
							
							if ($item == 'TSX-220T' ) {
									if ($spaoptions == 'empty' ) {
											$style = 'show'; 
																					
										}  else {
											$style = 'hidden';
										
										} 
							}
							
							if ($item == 'TSR' ) {
								$style = 'show';
							}
							
											
											
											
											
											if ($item == 'CP250' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'hidden';
												
												} 
											}
											
											if ($item == 'CP251' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'hidden';
												
												} 
											}
											
											if ($item == 'CP250T' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'hidden';
												
												} 
											}
											
											if ($item == 'CP251T' ) {
													if ($spaoptions == 'empty' ) {
													$style = 'show';
												
												}  else {
													$style = 'hidden';
												
												} 
											}
											
					} else {
						
						if ($item == 'TSC-350' ) {
								$style = 'show';
							}
							
							if ($item == 'TSC-450' ) {
								$style = 'show';
							}
							
								if ($item == 'TSC-450T' ) {
								$style = 'show';
							}
							
							
						}
						
						
						
						
						if ($item == 'TSR' ) {
								$style = 'show';
							}
					
					
					if ($spaoptions == 'empty' ) {
						
					//	if ($item == 'TSC-350' ) {
//								$style = 'show';
//							}
											
										
										}  
					
						return $style;
					} 
					
					
					
					
					
					
					if ($pos == 'SM') {
					
							if ($item == 'SMC-150' ) {
								$style = 'show';
							}
							
							if ($item == 'SMC-120' ) {
								$style = 'show';
							}
							
							if ($item == 'CP-151' ) {
								$style = 'show';
							}
							
							if ($item == 'CP-150' ) {
								$style = 'show';
							}
							
	
						return $style;
					} 
						
				}?>

<h2>Sizing and Selection Guide </h2>
<?php $whereFrom = explode('/', $_SERVER[REQUEST_URI]);?>
<?php if($whereFrom[1] == "mysteamist2") : ?>
<p><a href="calc.php" >< Back to generator selection</a></p>
<?php else : ?>
<p><a href="/index.php/for-professionals/residential-steambath-selection-guide/" >< Back to generator selection</a></p>
<?php endif; ?>

<?php require_once('sumGenerators.php'); ?>
<?php require_once('sumOptions.php'); ?>
<?php 
if ($pos == 'TS') {
if ($errormsg == 'err') {?>
<!--<div class="errmsg">
At least one Digital Control-TSC-350 must be selected.
</div>-->
<?php }}?>
<table border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td><h5>4. </h5></td>
				<td width="100%"><h5>Select controls or control package: </h5>
						You must choose a control option before continuing to next step.<br />
						<br />
						<form id="form1" name="form1" method="post" action="">
								<table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">

										<tr>
											<td><strong>Name</strong></td>
											<td><strong>Finish</strong></td>
											<td><strong>Price</strong></td>
											<td>&nbsp;</td>
											<td><strong>Qty</strong></td>
										</tr>
	
										<?php do { ?>
												<tr class="<?php echo checklogic($row_rsControls['model']);?>">
														<td><a class="controls" href="#controls<?php echo $row_rsControls['id']; ?>"> <?php echo $row_rsControls['name']; ?>-<?php echo $row_rsControls['model']; ?></a>
																<div style="display: none;">
																		<div id="controls<?php echo $row_rsControls['id']; ?>" style="width:400px;overflow:auto;">
																				<?php if ($row_rsControls['image'] <> '') {?>
																				<img class="alignleft" name="img" src="<?php echo $row_rsControls['image']; ?>"  alt="" />
																				<?php } ?>
																				<strong><?php echo $row_rsControls['name']; ?></strong> <br />
																				<?php echo $row_rsControls['model']; ?> <br />
																				<?php echo $row_rsControls['modaltext']; ?> <br />
																		</div>
																</div></td>
														<td><select name="controlfinish[]" id="controlfinish<?php echo $row_rsControls['id']; ?>">
																		<option value="0">Select Finish</option>
																		<?php 
										
										$colname_rsControlOptions = "-1";
										if (isset($row_rsControls['id'])) {
										  $colname_rsControlOptions = $row_rsControls['id'];
										}
										mysql_select_db($database_conn, $conn);
										$query_rsControlOptions = sprintf("SELECT sg_controls.*, sg_controloptions.* FROM sg_controloptions INNER JOIN sg_controls ON sg_controls.id = sg_controloptions.controlid WHERE sg_controls.id  = %s", GetSQLValueString($colname_rsControlOptions, "int"));
										$rsControlOptions = mysql_query($query_rsControlOptions, $conn) or die(mysql_error());
										$row_rsControlOptions = mysql_fetch_assoc($rsControlOptions);
										$totalRows_rsControlOptions = mysql_num_rows($rsControlOptions);
					do {  

?>
																		<option value="<?php echo $row_rsControlOptions['controloptionlabel']?>" <?php if (!(strcmp($row_rsControlOptions['controloptionlabel'], Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'finishlabel')))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsControlOptions['controloptionlabel']?></option>
																		<?php
											} while ($row_rsControlOptions = mysql_fetch_assoc($rsControlOptions));
											  $rows = mysql_num_rows($rsControlOptions);
											  if($rows > 0) {
												  mysql_data_seek($rsControlOptions, 0);
												  $row_rsControlOptions = mysql_fetch_assoc($rsControlOptions);
											  }
?>
																</select></td>
														<td>$<?php echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue'); ?>
																<?php if (Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue') <> '' ){ echo Controls($row_rsControls['userquoteid'], $_SESSION['controloptionvalue'],  'optionqty') ; } else { echo '0';} ?></td>
														<td><input name="conrolid[]" type="hidden" id="conrolid<?php echo $row_rsControls['id']; ?>" value="<?php echo $row_rsControls['id']; ?>" />
																<input name="controlqty[]" type="text" id="controlqty<?php echo $row_rsControls['id']; ?>" style="width:30px;" value="<?php if (Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') <> '' ){ echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') ; } else { echo '0';} ?>" /></td>
														<td nowrap="nowrap">$
																<?php 
														$controlprice = Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue') ;
														$controlquantity  = Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') ;
														$adjustedprice = 100;
														$controlsexist  = Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty')  ; 
														$controlsexist  += $controlsexist  * 1 ;
														 if  ($controlsexist > 0)  {
															 $nextstep = "true";}
															 if ( $row_rsControls['model'] == 'TSR') {
																 if ($controlquantity > 1 ) {
																	 echo ($adjustedprice * $controlquantity) + 290;
																	 } else {
																			echo $controlprice ;
																		}
																		} else {
																			echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue') * Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') ; 
															}
														?></td>
												</tr>
												<?php } while ($row_rsControls = mysql_fetch_assoc($rsControls)); ?>
								</table>
								<div class="steps-update">
										<input type="submit" name="controlsbtn" id="controlsbtn" value="Add/Update Controls" />
								</div>
								<input name="controlsform" type="hidden" id="controlsform" value="Update" />
						</form></td>
		</tr>
</table>
<br />
<br />
<?php if ($nextstep == 'true') { // Show if recordset not empty ?>
<div class="steps"><a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=4&amp;genstack=<?php echo $_GET[genstack]; ?>"><button type="button" class="btn btn-primary">NEXT - Choose Optional Accessories</button></a></div>
<?php  } else { ?>
<div class="steps"><a href="javascript:;"><button type="button" class="btn btn-primary">NEXT - Choose Optional Accessories</button></a></div>
<?php  }  ?>
<?php
mysql_free_result($rsGenerators);

mysql_free_result($rsOptions);

mysql_free_result($rsControls);

mysql_free_result($rsControlOptions);
?>
<?php 
// TSC-450 = 20
//TSC-450T = 21
// TSC-350 = 1
// TSC-250 = 2
// TSC-251 = 3
// CP-350 =  9
// CP-351 = 12
//CP-450 = 18
//CP-450T = 19
//CP-451 = 16
//CP-451T = 17

// TSR = 6

// CP-250 = 10
// CP-251 = 13

//TSX-220 = 4
//TSX-220T = 5
?>
<script type="text/javascript">
jQuery('#controlsbtn').mousedown (function () {
	/*jQuery("#controlqty5").attr("disabled", jQuery("#controlqty5").val() == "0");*/
	
	
	if ( jQuery("#controlqty4").val() != "0" || jQuery("#controlqty5").val() != "0") {
		
		
		if ( jQuery("#controlqty1").val() == "0" 
				&& jQuery("#controlqty2").val() == "0" 
				&& jQuery("#controlqty3").val() == "0" 
				&& jQuery("#controlqty9").val() == "0" 
				&& jQuery("#controlqty12").val() == "0" 
				&& jQuery("#controlqty16").val() == "0" 
				&& jQuery("#controlqty17").val() == "0" 
				&& jQuery("#controlqty18").val() == "0" 
				&& jQuery("#controlqty19").val() == "0" 
				&& jQuery("#controlqty20").val() == "0" 
				&& jQuery("#controlqty21").val() == "0" 
				)  {
					
					alert("A TSC-450, TSC-450T, CP-450, CP-450T, CP-451, CP-451T, TSC-350, CP-350, CP-351, TSC-250, TSC-250T, CP-250, CP-250T, CP-251 or CP-251T must be selected to add a TSX-220 or TSX-220T.");
		}
		
		
	} else {

	}
	
	
	
	
	
	
	/* jQuery("#controlqty2").val("1");
	 jQuery("#controlfinish2").val("polished chrome");*/
});

jQuery('#controlsbtn').mousedown (function () {
	if ( jQuery("#controlqty6").val() != "0") {
		
		
		if ( jQuery("#controlqty1").val() == "0" 
				&& jQuery("#controlqty2").val() == "0" 
				&& jQuery("#controlqty3").val() == "0" 
				&& jQuery("#controlqty10").val() == "0" 
				&& jQuery("#controlqty13").val() == "0" 
				&& jQuery("#controlqty16").val() == "0" 
				&& jQuery("#controlqty17").val() == "0" 
				&& jQuery("#controlqty18").val() == "0" 
				&& jQuery("#controlqty19").val() == "0" 
				&& jQuery("#controlqty20").val() == "0" 
				&& jQuery("#controlqty21").val() == "0" 
				)  {
					
					alert("A TSC-450, TSC-450T, CP-450, CP-450T, CP-451, CP-451T, TSC-350, CP-350, CP-351, TSC-250, TSC-250T, CP-250, CP-250T, CP-251 or CP-251T must be selected to add a TSR.");
		}
		
		
	} else {

	}
	});
</script>