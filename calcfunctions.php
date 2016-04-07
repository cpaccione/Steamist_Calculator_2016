<?php
ob_start(); 
session_start(); ?><?php

$spaceformvalid = 'true';

//Step 1

if ($_GET["button2"] <> "") {
	
	$rawlength = str_replace("\'","", $_GET["length"]);
	$rawheight = str_replace("\'","", $_GET["height"]);
	$rawwidth = str_replace("\'","", $_GET["width"]);
	
	if( is_numeric( htmlentities($rawlength) )) {
		$_SESSION['length'] = htmlentities($rawlength);
	}else{
		$_SESSION['length'] = 0;
		$spaceformvalid = 'false';
	}

	if( is_numeric( htmlentities($rawheight) )){
		$_SESSION['height']  = htmlentities($rawheight);
	}else{
		$_SESSION['height'] = 0;
		$spaceformvalid = 'false';
	}
	
	if( is_numeric( htmlentities($rawwidth) )){
		$_SESSION['width'] = htmlentities($rawwidth);
	}else{
		$_SESSION['width'] = 0;
		$spaceformvalid = 'false';
	}
	//echo $_SESSION['height'];
	if( ($_SESSION['width'] <= 0 ) || 
		($_SESSION['height'] <= 0 ) ||
		($_SESSION['length'] <= 0 ) ){
		$spaceformvalid = 'false';
	}


	$_SESSION['userquoteid'] = uniqid('', true);
	if ($_SESSION['height'] <= '6' ) {
		$_SESSION['height']  = 7;
	}
}

$varLength = $_SESSION['length'];
$varHeight = $_SESSION['height'];
$varWidth = $_SESSION['width'];



$_SESSION['varCubicTotal'] = $varLength * $varHeight * $varWidth ;

$varCubicTotal = $_SESSION['varCubicTotal'] ;


//Step 2 Adjusted Calc

if ($_GET["materials"] <> "") {

$_SESSION['materials']  = htmlentities($_GET["materials"]);
$_SESSION['numwalls']  = htmlentities($_GET["numwalls"]);
$_SESSION['ceiling']  = htmlentities($_GET["height"]);
$_SESSION['skylight']  = htmlentities($_GET["skylight"]);
$_SESSION['userquoteid'] = uniqid('', true);
}

$materials = $_SESSION['materials'];
$varWalls = $_SESSION['numwalls'];
$varCeiling = $_SESSION['ceiling'];
$varSkylight = $_SESSION['skylight'];

if ($materials == 'ceramic' ) {
	$adjustmaterialval = .35;
} 

if ($materials == 'porcelain' ) {
	$adjustmaterialval = 1;
} 

$materialstotal = $varCubicTotal + ($adjustmaterialval * $varCubicTotal);

//echo 'CF: ' . $varCubicTotal . '<br>';
//echo 'Material Adj.  x ' . $adjustmaterialval . '%<br>';
//echo '---------------------' . '<br>';
//echo '' . $materialstotal . '<br><br>';



if ($varWalls == '0' ) {
	$adjustwallval = 0;
} 
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
//echo 'Adj CF ' . $materialstotal . '<br>';
//echo 'Wall adj. x' . $adjustwallval . '%<br>';
//echo '---------------------' . '<br>';
//echo '' . $wallstotal . '<br><br>';




if ($varCeiling >= '7' and $varCeiling <= '8'  ) {
	$adjustceilningval = 0;
} 
if ($varCeiling >= '8.01' and $varCeiling <= '9' ) {
	$adjustceilningval = .15;
} 
if ($varCeiling >= '9.01'  and $varCeiling <= '10' ) {
	$adjustceilningval = .30;
} 
if ($varCeiling >= '10.01'  ) {
	$adjustceilningval = .30;
} 



$ceilingtotal = $wallstotal + ($adjustceilningval * $wallstotal);
//echo 'Adj CF ' . $wallstotal . '<br>';
//echo 'Ceiling adj.  x' . $adjustceilningval . '%<br>';
//echo '---------------------' . '<br>';
//echo '' . $ceilingtotal . '<br><br>';

// Step 3

/* Pjl adding ... 02/15/2015
SM-9: 221 to 360 adj cu.ft.
SM-10: 361 to 450 adj. cu.ft.
SM-11: 451 to 500 adj. cu.f t.

210-250 : 3 : 24
251-360 : 4 : 25

210-220 : 3 : 24
221-250 : 70 : 71
251-360 : 4 : 25

*/

$varGenModel = 0;

if($ceilingtotal == 0) {

	$varGenModels = 1;

}

elseif($ceilingtotal > 0  && $ceilingtotal <= 100) {

	if($varSkylight == "Y") {
		// $varGenModels = 22;
		$varGenModels = 2;
	} else {
		$varGenModels = 1;
	}
}

elseif($ceilingtotal > 100  && $ceilingtotal <= 210) {
	
	if($varSkylight == "Y") {
		$varGenModels = 23;
	} else {
		$varGenModels = 2;
	}
}
elseif($ceilingtotal > 210  && $ceilingtotal <= 220) {
	if($varSkylight == "Y") {
		$varGenModels = 24;
	} else {
		$varGenModels = 3;
	}
}
elseif($ceilingtotal > 220  && $ceilingtotal <= 250) {
	if($varSkylight == "Y") {
		$varGenModels = 71;
	} else {
		$varGenModels = 70;
	}
}
elseif($ceilingtotal > 250  && $ceilingtotal <= 360) {
	if($varSkylight == "Y") {
		// $varGenModels = 25;
		$varGenModels = 5;
	} else {
		$varGenModels = 4;
	}
}

elseif($ceilingtotal > 360  && $ceilingtotal <= 450) {
	if($varSkylight == "Y") {
		// $varGenModels = 26;
		$varGenModels = 7;
	} else {
		$varGenModels = 5;
	}
}

elseif($ceilingtotal > 450  && $ceilingtotal <= 500) {
	if($varSkylight == "Y") {
		// $varGenModels = 27;
		$varGenModels = 7;
	} else {
		$varGenModels = 6;
	}
}

elseif($ceilingtotal > 500  && $ceilingtotal <= 550) {
	if($varSkylight == "Y") {
		$varGenModels = 28;
	} else {
		$varGenModels = 7;
	}
}

elseif($ceilingtotal > 550  && $ceilingtotal <= 675) {
	if($varSkylight == "Y") {
		$varGenModels = 29;
	} else {
		$varGenModels = 8;
	}
}
elseif($ceilingtotal > 675 && $ceilingtotal <= 900) {
	if($varSkylight == "Y") {
		$varGenModels = 10;
	} else {
		$varGenModels = 9;
	}
}
elseif($ceilingtotal > 900 && $ceilingtotal <= 1000) {
	if($varSkylight == "Y") {
		$varGenModels = 31;
	} else {
		$varGenModels = 10;
	}
}

elseif($ceilingtotal > 1000 && $ceilingtotal <= 1100) {
	if($varSkylight == "Y") {
		$varGenModels = 12;
	} else {
		$varGenModels = 11;
	}
}

elseif($ceilingtotal > 1100 && $ceilingtotal <= 1225) {
	if($varSkylight == "Y") {
		$varGenModels = 33;
	} else {
		$varGenModels = 12;
	}
}

elseif($ceilingtotal > 1225 && $ceilingtotal <= 1350) {
	if($varSkylight == "Y") {
		$varGenModels = 34;
	} else {
		$varGenModels = 13;
	}
}

// New code added here on 2/26/16 - added additional cubic feet that was removed in 2014

elseif($ceilingtotal > 1350 && $ceilingtotal <= 1650) {
	if($varSkylight == "Y") {
			$varGenModels = 15;
	} else {
			$varGenModels = 14;
	}
}

elseif($ceilingtotal > 1650 && $ceilingtotal <= 1900) {
	if($varSkylight == "Y") {
			$varGenModels = 37;
	} else {
			$varGenModels = 15;
	}
}

elseif($ceilingtotal > 1900 && $ceilingtotal <= 2025) {
	if($varSkylight == "Y") {
			$varGenModels = 38;
	} else {
			$varGenModels = 17;
	}
}

elseif($ceilingtotal > 2025 && $ceilingtotal <= 2575) {
	if($varSkylight == "Y") {
			$varGenModels = 41;
	} else {
			$varGenModels = 38;
	}
}

elseif($ceilingtotal > 2575 && $ceilingtotal <= 2700) {
	if($varSkylight == "Y") {
			$varGenModels = 99;
	} else {
			$varGenModels = 41;
	}
}

elseif($ceilingtotal > 2700 ) {
	$varGenModels = 99;
}


//echo $varGenModels;

if($varSkylight == "Y") {
	//$varGenModels = $varGenModels + 1;
}

if ($_GET["button3"] <> "") {

$_SESSION['genid']  = htmlentities($_GET["genid"]);
$varGenID = $_SESSION['genid'];

$_SESSION['gen']  = htmlentities($_GET["gen"]);
$varGen = $_SESSION['gen'];


$_SESSION['genref']  = htmlentities($_GET["genref"]);
$varGenRef = $_SESSION['genref'];

$_SESSION['genqty']  = htmlentities($_GET["genqty"]);
$varGenQty = $_SESSION['genqty'];
}

?>

<?php 
if ($_SESSION['userquoteid']  == '') {
	
	$_SESSION['userquoteid'] = uniqid('', true);

}
if ($_GET['costid'] <> '' ){
	$_SESSION['userquoteid'] = $_GET['costid'] ;
	} 
//echo $_SESSION['userquoteid'];

?>