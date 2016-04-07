<?php 
//// 

//Step 1
$varLength = htmlentities($_POST["length"]);
$varHeight = htmlentities($_POST["height"]);
$varWidth = htmlentities($_POST["width"]);
$varCubicTotal = $varLength * $varHeight * $varWidth ;

//Step 2 Adjusted Calc

$materials = htmlentities($_POST["materials"]);
$varWalls = htmlentities($_POST["numwalls"]);
$varCeiling = htmlentities($_POST["ceiling"]);
$varSkylight = htmlentities($_POST["skylight"]);

if ($materials == 'ceramic' ) {
	$adjustmaterialval = .35;
} 

if ($materials == 'porcelain' ) {
	$adjustmaterialval = .01;
} 

$materialstotal = $varCubicTotal + ($adjustmaterialval * $varCubicTotal);

if ($varWalls == '1' ) {
	$adjustwallval = 0.1;
} 
if ($varWalls == '2' ) {
	$adjustwallval = 0.2;
} 
if ($varWalls == '3' ) {
	$adjustwallval = 0.3;
} 
if ($varWalls == '4' ) {
	$adjustwallval = 0.4;
} 

$wallstotal = $materialstotal + ($adjustwallval * $materialstotal);


if ($varCeiling == '7' ) {
	$adjustceilningval = .10;
} 
if ($varCeiling == '8' ) {
	$adjustceilningval = .15;
} 
if ($varCeiling == '9' ) {
	$adjustceilningval = .35;
} 

$ceilingtotal = $wallstotal + ($adjustceilningval * $wallstotal);

// Step 3
$varGenModel = 0;

if($ceilingtotal == 0) {
	$varGenModel = 1;
}

elseif($ceilingtotal > 0  && $ceilingtotal <= 100) {
	$varGenModels = 1;
}

elseif($ceilingtotal > 100  && $ceilingtotal <= 210) {
	$varGenModels = 2;
}
elseif($ceilingtotal > 210  && $ceilingtotal <= 250) {
	$varGenModels = 3;
}

elseif($ceilingtotal > 250  && $ceilingtotal <= 360) {
	$varGenModels = 4;
}

elseif($ceilingtotal > 360  && $ceilingtotal <= 450) {
	$varGenModels = 5;
}

elseif($ceilingtotal > 450  && $ceilingtotal <= 500) {
	$varGenModels = 6;
}

elseif($ceilingtotal > 500  && $ceilingtotal <= 550) {
	$varGenModels = 6;
}

elseif($ceilingtotal > 550  && $ceilingtotal <= 675) {
	$varGenModels = 7;
}
elseif($ceilingtotal > 675 && $ceilingtotal <= 900) {
	$varGenModels = 8;
}
elseif($ceilingtotal > 900 && $ceilingtotal <= 1000) {
	$varGenModels = 9;
}

elseif($ceilingtotal > 1000 && $ceilingtotal <= 1100) {
	$varGenModels = 10;
}

elseif($ceilingtotal > 1100 && $ceilingtotal <= 1225) {
	$varGenModels = 11;
}

elseif($ceilingtotal > 1225 && $ceilingtotal <= 1350) {
	$varGenModels = 12;
}

elseif($ceilingtotal > 1350 && $ceilingtotal <= 1650) {
	$varGenModels = 13;
}

elseif($ceilingtotal > 1650 && $ceilingtotal <= 1775) {
	$varGenModels = 14;
}
elseif($ceilingtotal > 1775 && $ceilingtotal <= 1900) {
	$varGenModels = 15;
}

elseif($ceilingtotal > 1900 && $ceilingtotal <= 2025) {
	$varGenModels = 16;
}
elseif($ceilingtotal > 2025 && $ceilingtotal <= 2200) {
	$varGenModels = 17;
}

elseif($ceilingtotal > 2200 && $ceilingtotal <= 2475) {
	$varGenModels = 18;
}

elseif($ceilingtotal > 2475 && $ceilingtotal <= 2575) {
	$varGenModels = 19;
}

elseif($ceilingtotal > 2575 && $ceilingtotal <= 2700) {
	$varGenModels = 20;
}

elseif($ceilingtotal > 2700.01 && $ceilingtotal <= 270000) {
	$varGenModels = 21;
}
elseif($ceilingtotal > 270000.01 && $ceilingtotal <= 2700000) {
	$varGenModels = 21;
}

if($varSkylight == "Y") {
	$varGenModels = $varGenModels + 1;
}

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

$colname_rsGenerators = "-1";
if (isset($varGenModels)) {
  $colname_rsGenerators = $varGenModels;
}
mysql_select_db($database_conn, $conn);
$query_rsGenerators = sprintf("SELECT sg_generators.*, sg_generators.id as genid, sg_genrelation.* FROM sg_generators INNER JOIN sg_genrelation ON sg_generators.id = sg_genrelation.genmodel WHERE cubicfeet = %s", GetSQLValueString($colname_rsGenerators, "text"));
$rsGenerators = mysql_query($query_rsGenerators, $conn) or die(mysql_error());
$row_rsGenerators = mysql_fetch_assoc($rsGenerators);
$totalRows_rsGenerators = mysql_num_rows($rsGenerators);

?>

<h2>Sizing and Selection Guide </h2>
    <p>The Steam Bath Selection Guide will make it easy for you to select the right
      components for your home steam bath system: Steam Generator, Total Sense Spa
      Options, Controls, even Accessories. The first step is to select the right Steam
      Generator. </p>
    <form id="form1" name="form1" method="post" action="#steps">
      <table border="0" cellspacing="0" cellpadding="8">
        <tr>
          <td valign="top"><a name="steps" id="steps"></a>1.</td>
          <td valign="top"><p><strong>Determine rooms cubic feet. Enter your room dimensions or the cubic feet if you've already calculated. </strong></p>
            <table border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td nowrap="nowrap"><strong> Length</strong><br />
                  <input style="width:50px;" type="text" name="length" id="length" value="<?php echo $varLength; ?>" />
                  x&nbsp;</td>
                <td nowrap="nowrap"><strong>Height</strong><br />
                  <input style="width:50px;" type="text" name="height" id="height" value="<?php echo $varHeight; ?>" />
                  x&nbsp;</td>
                <td nowrap="nowrap"><strong>Width</strong><br />
                  <input style="width:50px;" type="text" name="width" id="width" value="<?php echo $varWidth; ?>" />
                  &nbsp;</td>
                <td nowrap="nowrap"><br />
                  <strong>
                  <input type="submit" name="button" id="button" value="Calculate" />
                  </strong></td>
              </tr>
            </table>
            Total cubic feet: <?php echo $varCubicTotal; ?>
            <input style="width:50px;" name="basecf" id="basecf" type="hidden" value="<?php echo $varCubicTotal; ?>" /></td>
        </tr><?php 
		 if ( $_POST['gen'] <> "") { 
		 if( $_POST['gen'] != 21 ) { ?><?php }} ?>
      </table>
</form>
    <?php 
	//echo "Testing Variables: <br>";
//	echo "Cost Level/Skylight: " . $varGenModels . "<br>";
//	echo "Materials: " . $materialstotal . "<br>";
//	echo "Adj. w/Walls: " . $wallstotal . "<br>";
//	echo "Adj. w/Ceiling: " . $ceilingtotal . "<br>";

	?>
	<?php 
mysql_free_result($rsGenerators);
?>
