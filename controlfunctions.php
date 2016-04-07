<?php 

if ($_POST['controlsform'] == "Update") {
	
		$_SESSION['controlqty']  = ($_POST["controlqty"]);
		$varControlsQty = implode(',', array_values($_SESSION['controlqty']));
		
		//echo $varControlsQty . '<br>';
		
		$_SESSION['conrolid']  = ($_POST["conrolid"]);
		$varControlsArray = implode(',', array_values($_SESSION['conrolid']));
		
	//	echo $varControlsArray;
	
		$_SESSION['controlfinish']  = ($_POST["controlfinish"]);
		$varControlsFinish = implode(',', array_values($_SESSION['controlfinish']));
	

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$deleteSQL = sprintf("DELETE FROM sg_usercontrols WHERE quotesession=%s",
                       GetSQLValueString($_SESSION['userquoteid'] , "text"));

					  mysql_select_db($database_conn, $conn);
					  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
					  
					  
$a1 = explode(',', $varControlsArray);
$a2 = explode(',', $varControlsQty);
$a3 = explode(',', $varControlsFinish);

// reset array pointers    
reset($a1); reset($a2); reset($a3);
while (TRUE)
{
  // get current item
  $item1=current($a1);
  $item2=current($a2);
  $item3=current($a3);
  // break if we have reached the end of both arrays
  if ($item1===FALSE and $item2===FALSE and $item3===FALSE) break;  
 
 if ($item1 == '1') {
	 
	 if ($item2 == '0') {
		 $errormsg =  'err';
		 }
	 
	 }

if (!is_numeric($item2)) {$item2 = 0;}


  $insertSQL = sprintf("INSERT INTO sg_usercontrols (optionid, optionqty, finishlabel, quotesession ) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($item1, "int"),
                       GetSQLValueString($item2, "int"),
					   GetSQLValueString($item3, "text"),
                       GetSQLValueString($_SESSION['userquoteid'] , "text"));
	
					  mysql_select_db($database_conn, $conn);
					  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());


  //print $item1.' '. $item2.PHP_EOL;
  // move to the next items
  next($a1); next($a2); next($a3);
}

}?>

<?php
// Get Content Blocks by ID using echo Block('548'); 

function Controls ($OptionID, $UserSessionID, $field='') {
	
global $hostname_conn, $database_conn , $username_conn, $password_conn ;

$col1 = "-1";
if (isset($OptionID)) {
  $col1 = $OptionID;
}
$col3 = "-1";
if (isset($UserSessionID)) {
  $col3 = $UserSessionID;
}

mysql_select_db($database_conn, mysql_pconnect($hostname_conn,$username_conn,$password_conn));

$query_rsGetControl = sprintf("SELECT sg_controls.*, sg_controloptions.*, sg_usercontrols.* FROM sg_controloptions INNER JOIN sg_controls ON sg_controls.id = sg_controloptions.controlid INNER JOIN sg_usercontrols ON sg_controloptions.controlid = sg_usercontrols.optionid WHERE sg_usercontrols.optionid =  %s AND sg_usercontrols.quotesession = %s AND sg_controloptions.controloptionlabel = sg_usercontrols.finishlabel", 
GetSQLValueString($col1, "int"),
GetSQLValueString($col3, "text")

);
$rsGetControl = mysql_query($query_rsGetControl, mysql_pconnect($hostname_conn,$username_conn,$password_conn)) or die(mysql_error());
$row_rsGetControl = mysql_fetch_assoc($rsGetControl);
$totalRows_rsGetControl = mysql_num_rows($rsGetControl);



    if(isset($field, $row_rsGetControl[$field])) {
                return $row_rsGetControl[$field];
        } else {
                return $row_rsGetControl;
        }



mysql_free_result($rsGetControl);

//echo 'this: ' . Option('2', $_SESSION['userquoteid'],  'optionqty'   ) ;
}


?>


