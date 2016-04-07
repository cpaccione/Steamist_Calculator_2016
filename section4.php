<?php
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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

//require_once('../../../../Connections/conn.php');
require_once('calcfunctions.php');
require_once('accessfunctions.php');

mysql_select_db($database_conn, $conn);
$query_rsOptions = "SELECT * FROM sg_accessories ORDER BY name ASC";
$rsOptions = mysql_query($query_rsOptions, $conn) or die(mysql_error());
$row_rsOptions = mysql_fetch_assoc($rsOptions);
$totalRows_rsOptions = mysql_num_rows($rsOptions);

mysql_select_db($database_conn, $conn);
$query_rsControls = "SELECT * FROM sg_accessories ORDER BY name ASC";
$rsControls = mysql_query($query_rsControls, $conn) or die(mysql_error());
$row_rsControls = mysql_fetch_assoc($rsControls);
$totalRows_rsControls = mysql_num_rows($rsControls);

?>

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

<h2>Sizing and Selection Guide </h2>
<?php
$whereFrom = explode('/', $_SERVER[REQUEST_URI]);
if ($whereFrom[1] == "mysteamist2") {
?>
<p><a href="<?php bloginfo('url'); ?>/for-professionals/residential-sizing-guide/">< Back to generator selection</a></p>
<?php
}
else {
?>
<p><a href="<?php bloginfo('url'); ?>/for-professionals/residential-sizing-guide/">< Back to generator selection</a></p>
<?php
}
require_once('sumGenerators.php');
require_once('sumOptions.php');
require_once('sumControls.php');
//echo $cparray . '----------<br>';

$hasCPcontrol = strstr($cparray, 'CP');
$hasTSCcontrol = strstr($cparray, 'TSC');
$noTSX = strstr($cparray, 'CP');
// check item and show or hide based on logic

// pjl
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG == true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    } 
  }
}

function debugchecklogic(){

  global $cp_controlexists;
  global $hasCPcontrol;
  global $hasTSCcontrol;
  global $TSSPCL;
  global $TSSPIN;
  global $TSA; // total sense Aroma
  global $TSMU; // audio
  global $TSCH; // chromasense
  global $TSSH;// showersense (NEW!)
  global $spaoption; // number of rows of options
  global $aromaoption;
  global $voltage, $voltcheck, $voltcheck240;
  global $tcontolfinish;
  global $noTSX;
  global $goAwayTsx;

  $pos = substr($_GET['gen'], 0,2);
  $genquantity = $_GET["genqty"];
  //echo $pos;

  // debug
  _log('pos '.$pos);
  _log('genquantity ' . $genquantity );
  _log('cp_controlexists '.$cp_controlexists);
  _log('hasCPcontrol '.$hasCPcontrol);
  _log('hasTSCcontrol '.$hasTSCcontrol);
  _log('TSSPCL '.$TSSPCL);
  _log('TSSPIN '.$TSSPIN);
  _log('TSA '.$TSA); // total sense Aroma
  _log('TSMU '.$TSMU); // audio
  _log('TSCH '.$TSCH); // chromasense
  _log('TSSH '.$TSSH);// showersense (NEW!)
  _log('spaoption '.$spaoption); // number of rows of options
  _log('aromaoption '.$aromaoption);
  _log('voltage '.$voltage); 
  _log('voltcheck '.$voltcheck); 
  _log('voltcheck240 '.$voltcheck240);

  $tcontolfinish = false;
  $goAwayTsx = false;

  $hasTSCcontrol = trim( $hasTSCcontrol, ' ');
  $hasCPcontrol = trim( $hasCPcontrol,' ');
  $noTSX = trim( $noTSX,' ');


  if(( $noTSX === 'CP250' ) ||
    ( $noTSX === 'CP251')){ 
    $goAwayTsx = true; 
  }

  if( $hasTSCcontrol === 'TSC-450T' ){ 
    _log('traditional finish: TSC-450T');
    $tcontolfinish = true; 
  }

  if( ( $hasCPcontrol === 'CP450T' ) || 
      ( $hasCPcontrol === 'CP451T' ) ||
      ( $hasCPcontrol === 'TSC-450T' ) ||
      ( $hasCPcontrol === 'DCP450T')){ 
    _log('traditional finish:' . $hasCPcontrol);
    $tcontolfinish = true; 
  }

  //die();
  //
}

function checklogic ($item) {

  global $cp_controlexists;
  global $hasCPcontrol;
  global $hasTSCcontrol;
  global $TSSPCL; // spa package classic speakers
  global $TSSPIN; // spa package invisible speakers
  global $TSA; // total sense Aroma
  global $TSMU; // audio
  global $TSCH; // chromasense
  global $TSSH;// showersense (NEW!)
  global $spaoption; // number of rows of options
  global $aromaoption;
  global $voltage, $voltcheck, $voltcheck240;
  $pos = substr($_GET['gen'], 0,2);
  $genquantity = $_GET["genqty"];
  //echo $pos;
  global $tcontolfinish;
  global $goAwayTsx;

  $style = 'show';

  _log( 'Asset item id: ' . $item );


  if(( $pos == 'SM' ) && ( $cp_controlexists != 'true' )){ //SM with SMC-150 only

    _log('steamist assest select: 1');
    if( $item == 'SBS-101' ){ $style = 'show'; }
    if( $item == 'ADA' ){ $style = 'show'; }
    if( $item == 'ASB-10' ){ $style = 'show'; }
    if( $item == 'TSG-AD' ){ $style = 'hidden'; }
    if( $item == 'SM-900' ){ $style = 'show'; }
    if( $item == 'SM-DP' ){ $style = 'show'; }
    if( $item == 'ASC-120' ){ $style = 'hidden'; }
    if(( $item == 'TSX-220' ) || ($item == 'TSX-220T' )){ $style = 'hidden'; }
    if( $item == 'TSS-CL' ){ $style = 'hidden'; }
    if( $item == 'TSS-IN' ){ $style = 'hidden'; }
    if( $item == 'TSTR' ){ $style = 'hidden'; }
    if( $item == 'SMC-120' ){ $style = 'show'; }
    if( $item == 'SMC-900' ){ $style = 'show'; }

  }elseif(( $pos == 'SM' ) && ( $cp_controlexists == 'true' )){ //SM with any Control Package

    _log('steamist assest select: 2');
    if( $item == 'SBS-101' ){ $style = 'show'; }
    if( $item == 'ADA' ){ $style = 'show'; }
    if( $item == 'ASB-10' ){ $style = 'show'; }
    if( $item == 'TSG-AD' ){ $style = 'hidden'; }
    if( $item == 'SM-900' ){ $style = 'hidden'; }
    if( $item == 'SM-DP' ){ $style = 'hidden'; }
    if( $item == 'ASC-120' ){ $style = 'hidden'; }
    if(( $item == 'TSX-220' ) || ($item == 'TSX-220T' )){ $style = 'hidden'; }
    if( $item == 'TSS-CL' ){ $style = 'hidden'; }
    if( $item == 'TSS-IN' ){ $style = 'hidden'; }
    if( $item == 'TSTR' ){ $style = 'hidden'; }
    if( $item == 'SMC-120' ){ $style = 'hidden'; }
    if( $item == 'SMC-900' ){ $style = 'show'; }

  }
  if($pos == 'TS' ){
    if(( $TSA == 'yes' ) ||
       ( $TSCH == 'yes' ) ||
       ( $TSMU == 'yes' ) ||
       ( $TSSH == 'yes' ) &&
       ( $spaoption >= 1 ) &&
       (( $TSSPCL != 'yes' ) && ( $TSSPIN != 'yes') )) {//Total Sense with spa alacarte but no spa package

      _log('steamist assest select: 4');

      if( $item == 'SBS-101' ){ $style = 'show'; }
      if( $item == 'ADA' ){ $style = 'show'; }
      if( $item == 'ASC-120' ){ $style = 'hidden'; }
      if( $item == 'SMC-120' ){ $style = 'hidden'; }
      if( $item == 'TSS-CL' ){ $style = 'hidden'; }
      if( $item == 'TSS-IN' ){ $style = 'hidden'; }
      if( $item == 'SM-900' ){ $style = 'hidden'; }
      if( $item == 'ASB-10' ){ $style = 'show'; }
      if( $item == 'TSTR' ){ $style = 'hidden'; }

      if( $cp_controlexists === 'true' ){
        if( $item == 'TSG-AD' ){ $style = 'hidden'; }
        if( $item == 'SM-DP' ){ $style = 'hidden'; }
      }else{
        if( $item == 'TSG-AD' ){ $style = 'show'; }
        if( $item == 'SM-DP' ){ $style = 'show'; }
      }

      if( $TSCH =='yes'){
        if( $item == 'TSTR' ){ $style = 'show'; }
      }

      if( $TSMU == 'yes' ){
        if( $item == 'TSS-CL' ){ $style = 'show'; }
        if( $item == 'TSS-IN' ){ $style = 'show'; }
      }

      if( $TSA == 'yes' ){
        if( $item == 'ASB-10' ){ $style = 'hidden'; }
        if( $item == 'ASC-120' ){ $style = 'show'; }
      }

      if( $item == 'TSX-220' ){ 
        if( $tcontolfinish == true ){
          $style = 'hidden'; 
        }else{
          $style = 'show';
        }
      }

      if( $item == 'TSX-220T' ){ 
        if( $tcontolfinish == true ){
          $style = 'show';
        }else{
          $style = 'hidden'; 
        }
      }

  }elseif( $spaoption < 1 ){//Total Sense with no Spa Options, 450 only

    _log('steamist assest select: 8');
    if( $item == 'SBS-101' ){ $style = 'show'; }
    if( $item == 'ADA' ){ $style = 'show'; }
    if( $item == 'ASB-10' ){ $style = 'show'; }
    if( $item == 'SM-900' ){ $style = 'hidden'; }
    if( $item == 'ASC-120' ){ $style = 'hidden'; }

    if( $cp_controlexists === 'true' ){
      // if( $item == 'TSG-AD' ){ $style = 'hidden'; } // cp removed because product has been replaced by AD-900
      if( $item == 'SM-DP' ){ $style = 'hidden'; }
      if( $item == 'AD-900' ){ $style = 'hidden'; }
      if( $item == 'AD-111' ){ $style = 'hidden'; }

    } else {
      // if( $item == 'TSG-AD' ){ $style = 'hidden'; } // cp removed because product has been replaced by AD-900
      if( $item == 'SM-DP' ){ $style = 'show'; }
      if( $item == 'AD-900' ){ $style = 'show'; }
      if( $item == 'AD-111' ){ $style = 'hidden'; }
    }

    if( $item == 'TSX-220' ){ 
      if ( $tcontolfinish == true ){
        $style = 'hidden'; 
      } else {
        $style = 'show';
      }
    }

    if( $item == 'TSX-220T' ){ 
      if( $tcontolfinish == true ){
        $style = 'show';
      } else{
        $style = 'hidden'; 
      }
    }

    // Added if statement to remove TSX-220 from 250 and 251 controllers. 

    if( $item == 'TSX-220' ){ 
      if( $goAwayTsx == true ){
        $style = 'hidden'; 
      } 
    }


    if( $item == 'TSS-CL' ){ $style = 'hidden'; }
    if( $item == 'TSS-IN' ){ $style = 'hidden'; }
    if( $item == 'TSTR' ){ $style = 'hidden'; }
    if( $item == 'SMC-120' ){ $style = 'hidden'; }

  } elseif(( $spaoption >= 1 ) && 
         (( $TSSPCL === 'yes' ) || ( $TSSPIN === 'yes'))) {//Total Sense with Deluxe Spa 

    _log('steamist assest select: 9#ß');
    if( $item == 'SBS-101' ){ $style = 'show'; }
    if( $item == 'ADA' ){ $style = 'show'; }
    if( $item == 'ASB-10' ){ $style = 'hidden'; }
    if( $item == 'TSG-AD' ){ $style = 'hidden'; }
    if( $item == 'SM-900' ){ $style = 'hidden'; }
    if( $item == 'SM-DP' ){ $style = 'hidden'; }
    if( $item == 'ASC-120' ){ $style = 'show'; }
    if( $item == 'TSTR' ){ $style = 'show'; }

    if( $cp_controlexists === 'true' ){
      if( $item == 'TSG-AD' ){ $style = 'hidden'; }
      if( $item == 'SM-DP' ){ $style = 'hidden'; }
    }else{
      if( $item == 'TSG-AD' ){ $style = 'show'; }
      if( $item == 'SM-DP' ){ $style = 'show'; }
    }

    if( $item == 'TSX-220' ){ 
      if( $tcontolfinish == true ){
        $style = 'hidden'; 
      }else{
        $style = 'show'; 
      }
    }

    if( $item == 'TSX-220T' ){ 
      if( $tcontolfinish == true ){
        $style = 'show'; 
      }else{
        $style = 'hidden'; 
      }
    }

    if( $item == 'TSS-CL' ){ $style = 'hidden'; }
    if( $item == 'TSS-IN' ){ $style = 'hidden'; }
    if( $item == 'SMC-120' ){ $style = 'hidden'; }

  }
}

  // handle multiple generators
  if(( $pos == 'TS' ) && 
    ( $genquantity > 1 ) &&
    ( $hasCPcontrol == false ) ){//Total Sense, with or without Spa Option(s), 450 only, multiple generators

    _log('steamist assest select: 13');

  }elseif(( $pos == 'TS' ) && 
    //( $spaoption < 1 ) &&
    ( $genquantity > 1 ) &&
    ( $hasCPcontrol != false ) ){//Total Sense, with or without Spa Option(s), any control package, multiple generators

    _log('steamist assest select: 14');
  }

  return $style;

}
// pjl end

?>
<table border="0" cellspacing="0" cellpadding="0">
        <tr>
                <!-- <td><h5>5. </h5></td> -->
                <td width="100%"><h5><strong>5. Choose Optional Accessories:</strong></h5>
                <form id="form1" name="form1" method="post" action="">
                        <table class="tablegrid" width="100%" border="0" cellpadding="5" cellspacing="0">
                                <tr>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Finish/Option</strong></td>
                                        <td><strong>Price</strong></td>
                                        <td>&nbsp;</td>
                                        <td><strong>Qty</strong></td>
                                </tr>
<?php
debugchecklogic();
do {
?>
   <tr class="<?php echo checklogic($row_rsControls['model']);?>">
                                        <td>
<?php
  if ($row_rsControls['model'] == 'ASB') {
    echo $row_rsControls['name']; ?> - <?php echo $row_rsControls['model'];
  }
  else {
?>
                                                <a class="accessories" href="#accessories<?php echo $row_rsControls['id']; ?>">
<?php
    echo $row_rsControls['name'];
?>
 - 
<?php
    echo $row_rsControls['model'];
?>
                                                </a>
<?php
  }
?>
                                                <div style="display: none;">
                                                        <div id="accessories<?php echo $row_rsControls['id']; ?>" style="width:400px;overflow:auto;">

<?php
  if ($row_rsControls['image'] <> '') {
?>
                                                                <img class="alignleft" name="img" src="<?php echo $row_rsControls['image']; ?>"  alt="" />
<?php
  }
?>

                                                                <strong><?php echo $row_rsControls['name']; ?></strong>
                                                                <br />
<?php
  echo $row_rsControls['model'];
?>
                                                                <br />
<?php
  echo $row_rsControls['modaltext'];
?>								<br />
                                                        </div>
                                                </div>
                                        </td>
                                        <td>

<?php
  $colname_rsAccessoriesOptions = "-1";
  if (isset($row_rsControls['id'])) {
    $colname_rsAccessoriesOptions = $row_rsControls['id'];
  }
  mysql_select_db($database_conn, $conn);
  $query_rsAccessoriesOptions = sprintf("SELECT sg_accessories.*, sg_accessoriesoptions.* FROM sg_accessoriesoptions INNER JOIN sg_accessories ON sg_accessories.id = sg_accessoriesoptions.controlid WHERE sg_accessories.id  = %s", GetSQLValueString($colname_rsAccessoriesOptions, "int"));
  $rsAccessoriesOptions = mysql_query($query_rsAccessoriesOptions, $conn) or die(mysql_error());
  $row_rsAccessoriesOptions = mysql_fetch_assoc($rsAccessoriesOptions);
  $totalRows_rsAccessoriesOptions = mysql_num_rows($rsAccessoriesOptions);
  if( $totalRows_rsAccessoriesOptions > 1 ){
?>
                                                <select name="controlfinish[]" id="controlfinish">
                                                        <option value="0">Select Finish/Option</option>
<?php
  do {
?>
                                                        <option value="<?php echo $row_rsAccessoriesOptions['controloptionlabel']?>"
<?php
    if (!(strcmp($row_rsAccessoriesOptions['controloptionlabel'], Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'finishlabel')))) {
      echo "selected=\"selected\"";
    }
?>
>
<?php
    echo $row_rsAccessoriesOptions['controloptionlabel']
?>
                                                        </option>
<?php
  } while ($row_rsAccessoriesOptions = mysql_fetch_assoc($rsAccessoriesOptions));
  $rows = mysql_num_rows($rsAccessoriesOptions);
  if($rows > 0) {
    mysql_data_seek($rsAccessoriesOptions, 0);
    $row_rsAccessoriesOptions = mysql_fetch_assoc($rsAccessoriesOptions);
  }
?>
                                                </select>
                                                <?php }elseif( $totalRows_rsAccessoriesOptions == 1 ){ // select only option 
                                                  echo $row_rsAccessoriesOptions['controloptionlabel'];?>
                                                  <input style="width:50px;" name="controlfinish[]" id="controlfinish" type="hidden" value="<?php echo $row_rsAccessoriesOptions['controloptionlabel']; ?>" />
                                                <?php }?>
                                        </td>
                                        <td>$<?php echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue'); ?><?php if (Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue') <> '' ){ echo Controls($row_rsControls['userquoteid'], $_SESSION['controloptionvalue'],  'optionqty') ; } else { echo '0';} ?></td>
                                        <td>
                                                <input name="conrolid[]" type="hidden" id="conrolid" value="<?php echo $row_rsControls['id']; ?>" />
                                                <!--
                                                <input name="controlqty[]" type="text" id="controlqty" style="width:30px;" value="<?php if (Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') <> '' ){ echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') ; } else { echo '0';} ?>" />
                                                -->
                                        </td>
                                        <td id="indec<?php echo $row_rsControls['id']; ?>">
                                            <input name="controlqty[]" type="text" id="controlqty" style="width:30px;" value="<?php if (Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') <> '' ){ echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') ; } else { echo '0';} ?>" />
                                            <button id="up" >+</button>
                                            <button id="down" >-</button>
                                            <script>
                                            jQuery(function($){incdec("#indec<?php echo $row_rsControls['id']; ?>");})</script>
                                        </td>
                                        <td>$<?php echo Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'controloptionvalue') * Controls($row_rsControls['id'], $_SESSION['userquoteid'],  'optionqty') ; ?></td>
                                </tr>
<?php
} while ($row_rsControls = mysql_fetch_assoc($rsControls));
?>
                                </table>
                                <div class="steps-update">
                                        <!--<input type="submit" name="controlsbtn" id="controlsbtn" value="Add/Update Accessories" />-->
                                </div>
                                <input type="hidden" name="accessform" id="accessform" value="Update" />
                        </form>
                </td>
        </tr>
</table>
<?php // if ($_POST['controlsbtn'] == 'Update') {?>
<div class="steps">
        <a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=5&amp;genstack=<?php echo $_GET[genstack]; ?>"><button type="button" class="btn btn-primary"> Next - Print or E-mail Summary!</button></a></td>
</div>
<?php
      echo 'noTSX' . '&nbsp;' . $noTSX;

      if ($goAwayTsx == false) {
echo 'false';
      }
      if ($goAwayTsx == true) {
echo 'true';
      }
?>
<?php
// }
mysql_free_result($rsGenerators);
mysql_free_result($rsOptions);
mysql_free_result($rsControls);
mysql_free_result($rsAccessoriesOptions);
?>

<script type="text/javascript">
jQuery('#form1').submit (function (e) {
  /*jQuery("#controlqty5").attr("disabled", jQuery("#controlqty5").val() == "0");*/
  if ( jQuery("#controlqty8").val() != "0")  {
    if (  jQuery("#controlqty7").val() == "0" && jQuery("#controlqty35").val() == "0" && jQuery("#controlqty36").val() == "0")  {
      //pjl alert("A SMC-150, CP-150 or CP-151 must be selected to add an SMC-120.");
      //pjl e.preventDefault();
                }
        } else {
        }
        if ( jQuery("#controlqty4").val() != "0" || jQuery("#controlqty5").val() != "0") {
          if (  jQuery("#controlqty2").val() == "0"
            && jQuery("#controlqty3").val() == "0"
            && jQuery("#controlqty16").val() == "0"
            && jQuery("#controlqty17").val() == "0"
            && jQuery("#controlqty18").val() == "0"
            && jQuery("#controlqty19").val() == "0"
            && jQuery("#controlqty20").val() == "0"
            && jQuery("#controlqty21").val() == "0"
          )  {
            //pjl alert("A TSC-450, TSC-450T, CP-450, CP-450T, CP-451, CP-451T, TSC-250, TSC-250T, CP-250, CP-250T, CP-251 or CP-251T must be selected to add a TSX-220 or TSX-220T.");
            //pjl e.preventDefault();
                }
        } else {
        }
        /* jQuery("#controlqty2").val("1");
        jQuery("#controlfinish2").val("polished chrome");*/

        if ( jQuery("#controlqty6").val() != "0") {
          if (  jQuery("#controlqty2").val() == "0"
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
            //pjl alert("A TSC-450, TSC-450T, CP-450, CP-450T, CP-451, CP-451T, TSC-250, TSC-250T, CP-250, CP-250T, CP-251 or CP-251T must be selected to add a TSR.");
            //pjl e.preventDefault();
                }
        } else {
        }
        jQuery('input[id^="controlqty"]').each(function(){
          if (jQuery(this).val() == "") {
            alert("Please do not leave any values blank");
            e.preventDefault();
            return false;
                }
        });
});
</script>
