<?php require_once('calcfunctions.php'); ?>
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
if (isset($varGenModels)) {
  $colname_rsGenerators = $varGenModels;
}
mysql_select_db($database_conn, $conn);
$query_rsGenerators = sprintf("SELECT sg_generators.*, sg_generators.id as genid, sg_genrelation.*,  sg_genrelation.refid as genref FROM sg_generators INNER JOIN sg_genrelation ON sg_generators.id = sg_genrelation.genmodel WHERE cubicfeet = %s order by series desc", GetSQLValueString($colname_rsGenerators, "text"));
$rsGenerators = mysql_query($query_rsGenerators, $conn) or die(mysql_error());
$row_rsGenerators = mysql_fetch_assoc($rsGenerators);
$totalRows_rsGenerators = mysql_num_rows($rsGenerators);

?>

<h2>Sizing and Selection Guide</h2>
    <p>The Steam Bath Selection Guide will make it easy for you to select the right
      components for your home steam bath system: Steam Generator, Total Sense Spa
      Options, Controls, even Accessories. The first step is to select the right Steam
      Generator. </p>
	
   
      <table border="0" cellpadding="8" cellspacing="0"> <form id="form1" name="form1" method="get" action="">
        <tr>
          <td valign="top"><h5><strong><a name="steps" id="steps"></a>1.</h5></strong></td>
          <td valign="top"><h5><strong>Calculate your adjusted cubic feet </strong><span style="font-size:12px; font-weight:normal;"><a class="whatsthis" href="#whatsthis">What's this?</a></span>            </h5>
          	<table border="0" cellspacing="0" cellpadding="3">
          		<tr>
                <td nowrap="nowrap"><strong> Length</strong><br />
                		<input style="width:50px;" type="text" name="length" id="length" value="<?php echo $varLength; ?>" />
                		x&nbsp;</td>
                <td nowrap="nowrap"><strong>Width</strong><br />
                		<input style="width:50px;" type="text" name="width" id="width" value="<?php echo $varWidth; ?>" />
		                x&nbsp;</td>
                <td nowrap="nowrap"><strong>Height</strong><br />
                		<input style="width:50px;" type="text" name="height" id="height" value="<?php echo $varHeight; ?>" />                			         		
                		&nbsp;</td>
                <td nowrap="nowrap"><br /></td>
              </tr>
            </table>
          <input style="width:50px;" name="basecf" id="basecf" type="hidden" value="<?php echo $varCubicTotal; ?>" /></td>
        </tr>
        <tr>
          <td valign="top"><h5>&nbsp;</h5></td>
          <td valign="top">
            <div style="display: none;">
              <div id="whatsthis" style="width:400px;overflow:auto;">
                <p><strong>Heat Loss Adjustments</strong></p>
                <p>Adjustments are made to the cubic feet to account for heat loss in the room. </p>
                <p> *For exterior walls; 10% heat loss is added per exterior wall.</p>
                <p> *For ceiling heights over 8 feet 15% for each additional
                  foot is added (up to 10 feet). </p>
                <p> *Ceramic tile, glass tile or block construction adds 35%
                  heat loss to the room.</p>
                <p> Note: Skylights should be double-pane and sealed from
                  inside the steam room. </p>
              </div>
            </div>
            <?php if( $spaceformvalid === 'false' ) { ?>
            <p>
              <div style="background-color:#FFF; color:#D00; padding:5px; margin-top:10px;">&#x25b6 Please enter measurements.</div>
            </p>
            <?php }  ?>
            <p>Construction materials in room:</p>
            <p>

              <input name="materials" type="radio" id="radio" value="ceramic" checked="checked"  <?php if (!(strcmp($materials,"ceramic"))) {echo "checked=\"checked\"";} ?> />
              ceramic tile, porcelain tile, glass tile, or glass block<br />
              
              <input <?php if (!(strcmp($materials,"porcelain"))) {echo "checked=\"checked\"";} ?> type="radio" name="materials" id="radio" value="porcelain" />
              natural stone tile</p>

            <table border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td>Number of exterior walls:</td>
                <td><label for="numwalls"></label>
                  <select name="numwalls" id="numwalls">
				  <option value="0" <?php if (!(strcmp(0, $varWalls))) {echo "selected=\"selected\"";} ?>>0</option>
                    <option value="1" <?php if (!(strcmp(1, $varWalls))) {echo "selected=\"selected\"";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp(2, $varWalls))) {echo "selected=\"selected\"";} ?>>2</option>
                    <option value="3" <?php if (!(strcmp(3, $varWalls))) {echo "selected=\"selected\"";} ?>>3</option>
                    <option value="4" <?php if (!(strcmp(4, $varWalls))) {echo "selected=\"selected\"";} ?>>4</option>
                  </select></td>
              </tr>
              <tr>
              		<td>Is there a window or skylight?</td>
              		<td><input <?php if (!(strcmp($varSkylight,"Y"))) {echo "checked=\"checked\"";} ?> name="skylight" type="checkbox" id="skylight" value="Y" /></td>
              		</tr>
              <tr>
                <td>
                  <br />
                 <input type="submit" name="button2" id="button2" value="Calculate and Select Generator">
                 <strong><a href="<?php bloginfo('template_directory');?>/incs/reset.php?reset=1&src=<?php echo($_SERVER[REQUEST_URI]) ?>">Reset</a> </strong></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            Total adjusted cubic feet: <?php echo round($ceilingtotal);  ?><br />
            <?php if( $varGenModels == 99 ) { ?>
            <div style="background-color:#D00; color:#FFF; padding:5px; margin-top:10px;">Please consult Steamist for assistance with Generator Selection. Call (800) 577-6478 or e-mail sales@steamist.com </div>
            <?php } ?>
			
			<?php if( $varHeight > 10 ) { ?>
			<br /><div style="background-color:#D00; color:#FFF; padding:5px; margin-top:10px;">
			The maximum recommended ceiling height is 10'.  Please contact Steamist for a custom system pricing at info@steamist.com.</div>
			<?php }  ?>
            <br /></td>
        </tr>
        </form>
        <?php 
		 if ( $varCubicTotal <> "") { ?>
		  <?php if( $varGenModels != 99 and $varHeight <= 10) { ?>
        <tr>
          <td valign="top"><h5><strong>2.</strong></h5></td>
          <td valign="top"><h5><strong>Select a recommended generator.</strong></h5>
          		<p>Please select the Steam Generator properly sized for your installation to proceed to the next step. For InstaMist
          				and Steady Steam™ features a TSG generator must be selected. </p><p>Click on the listed items for a detailed description.</p>
            <?php if( $varGenModels != 99 ) { ?>
            <?php if ($totalRows_rsGenerators > 0) { // Show if recordset not empty ?>
              
              <table width="100%" border="0" cellpadding="5" cellspacing="0" class="tablegrid">
                <tr>
             
                  <td><strong>Generator</strong></td>
                  <td><strong>Price</strong></td>
                  <td><strong>Qty</strong></td>
                  <td>&nbsp;</td>
                </tr>
                <?php do { ?>
	
						 <form id="form1" name="form1" method="get" action="">
				
				
                  <tr>
           
                    <td><a class="generators" href="#<?php echo $row_rsGenerators['id']; ?>"> <?php echo $row_rsGenerators['series']; ?>-<?php echo $row_rsGenerators['model']; ?></a>
                      <div style="display: none;">
                        <div id="<?php echo $row_rsGenerators['id']; ?>" style="width:400px;overflow:auto;"> 
						<?php if ($row_rsGenerators['image'] <> '') {?>
						<img class="alignleft" name="img" src="<?php echo $row_rsGenerators['image']; ?>"  alt="" />
						<?php } ?>
						<strong><?php echo $row_rsGenerators['series']; ?></strong> <br />
                          <?php echo $row_rsGenerators['model']; ?> <br /><br />
                          <?php echo nl2br($row_rsGenerators['modaltext']); ?> <br />
                        </div>
                      </div></td>
                    <td>$<?php echo $row_rsGenerators['price']; ?></td>
                    <td>
					<?php 
					$txt_disable = "";
					
					if ($row_rsGenerators['genid'] == "11" || $row_rsGenerators['genid'] == "12" || $row_rsGenerators['genid'] == "13" || $row_rsGenerators['genid'] == "14" || $row_rsGenerators['genid'] == "15" || $row_rsGenerators['genid'] == "16") {
						//$txt_disable = "disabled"; ?>
						<input name="genqty"  type="hidden" id="genqty" value="<?php echo $row_rsGenerators['qty']; ?>" /><?php echo $row_rsGenerators['qty']; ?>
						<?php 
						} else {
					
					?>
					<input style="width:30px;" name="genqty"  type="text" id="genqty" value="<?php echo $row_rsGenerators['qty']; ?>" />
					<?php 
						} 
					
					?>
					
					
					
					
					</td>
                    <td><strong>
                      <input type="submit" name="button3" id="button3" value="Select" /><input name="genid" type="hidden" value="<?php echo $row_rsGenerators['genid']; ?>">
                        <input type="hidden" name="gen" id="gen" value="<?php echo $row_rsGenerators['model']; ?>" />
						 <input type="hidden" name="genref" id="genref" value="<?php echo $row_rsGenerators['genref']; ?>" />
						 <input type="hidden" name="genstack" id="genstack" value="<?php echo $row_rsGenerators['genstacked']; ?>" />
						 <?php 
				 
	
				
			$pos = 	substr($row_rsGenerators['model'], 0,2); 

				 
				if ($pos == 'SM') { ?>
						 <input type="hidden" name="section" id="section" value="3" />
						 <?php } else {?>
						 <input type="hidden" name="section" id="section" value="2" />
						 <?php } ?>
						 
                    </strong></td>
                  </tr>
				  </form>
                  <?php } while ($row_rsGenerators = mysql_fetch_assoc($rsGenerators)); ?>
              </table>
			       
             <div style="margin:8px; padding:8px;" class="boxBG">
                <p><strong>TSG Total Sense&trade; Steam Generators</strong></p>
                <ul>
                		<li>Can be installed with one or more Spa Options: AromaSense&trade;, ChromaSense&trade;, AudioSense&trade; and ShowerSense&trade;.</li>
                		<li>Steady Steam&trade; modulates steam output to meet the user's precise requirements without temperature spikes.</li>
                		<li>InstaMist&trade; feature provides quick-response steam in about a minute.</li>
                		<li>Can be installed without Spa Options for InstaMist and Steady Steam features.</li>
                </ul>
                  <?php if( $ceilingtotal > 675 ) { ?>
                  <div style="background-color:#D00; color:#FFF; padding:5px; margin-top:10px;">IMPORTANT: Using multiple generators can place an unexpected load on the electrical service. Please consult your electrician before ordering.</div>
                  <?php } ?>
              </div>

              
              <?php  // Show if recordset not empty ?></td>
        </tr><?php } }}}
		 if ( $_GET['gen'] <> "") { 
		 if( $_GET['gen'] != 21 ) { ?>
	
		 <?php }} ?>
      </table>

    <?php 
	//echo "Testing Variables: <br>";
//	echo "Cost Level/Skylight: " . $varGenModels . "<br>";
//	echo "Materials: " . $materialstotal . "<br>";
//	echo "Adj. w/Walls: " . $wallstotal . "<br>";
//	echo "Adj. w/Ceiling: " . $ceilingtotal . "<br>";

	?>
	<?php 
mysql_free_result($rsGenerators);
//echo $varGenModels;
?>
