<?php 

if ($_POST['optionsform'] == "Update") {
	
		$_SESSION['optionsqty']  = ($_POST["optionsqty"]);
		$varOptionsQty = implode(',', array_values($_SESSION['optionsqty']));
		
		
		$_SESSION['optionsid']  = ($_POST["optionsid"]);
		$varOptionsArray = implode(',', array_values($_SESSION['optionsid']));
		

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

$deleteSQL = sprintf("DELETE FROM sg_useroptions WHERE quotesession=%s",
                       GetSQLValueString($_SESSION['userquoteid'] , "text"));

					  mysql_select_db($database_conn, $conn);
					  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
					  
					  
$a1 = explode(',', $varOptionsArray);
$a2 = explode(',', $varOptionsQty);

// reset array pointers    
reset($a1); reset($a2);
while (TRUE)
{
  // get current item
  $item1=current($a1);
  $item2=current($a2);
  // break if we have reached the end of both arrays
  if ($item1===FALSE and $item2===FALSE) break;  
 if ($item2== "")  {
	 $item2 == 0;
	 }

  $insertSQL = sprintf("INSERT INTO sg_useroptions (optionid, optionqty, quotesession) VALUES (%s, %s, %s)",
                       GetSQLValueString($item1, "int"),
                       GetSQLValueString($item2, "int"),
                       GetSQLValueString($_SESSION['userquoteid'] , "text"));
	
					  mysql_select_db($database_conn, $conn);
					  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());


  //print $item1.' '. $item2.PHP_EOL;
  // move to the next items
  next($a1); next($a2);
}

if ($_POST['optionscb'] == "N") {

$deleteSQL = sprintf("DELETE FROM sg_useroptions WHERE quotesession=%s",
                       GetSQLValueString($_SESSION['userquoteid'] , "text"));

					  mysql_select_db($database_conn, $conn);
					  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}
}?>

<?php
// Get Content Blocks by ID using echo Block('548'); 

function Option ($OptionID, $UserSessionID, $field='') {
	
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

$query_rsTest = sprintf("SELECT * FROM sg_useroptions WHERE optionid =  %s AND quotesession = %s", 

GetSQLValueString($col1, "int"),
GetSQLValueString($col3, "text")

);
$rsTest = mysql_query($query_rsTest, mysql_pconnect($hostname_conn,$username_conn,$password_conn)) or die(mysql_error());
$row_rsTest = mysql_fetch_assoc($rsTest);
$totalRows_rsTest = mysql_num_rows($rsTest);



    if(isset($field, $row_rsTest[$field])) {
                return $row_rsTest[$field];
        } else {
                return $row_rsTest;
        }

mysql_free_result($rsTest);

//echo 'this: ' . Option('2', $_SESSION['userquoteid'],  'optionqty'   ) ;
}


?>		