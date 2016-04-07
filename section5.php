<?php
require_once('calcfunctions.php');
require_once('accessfunctions.php');
?>

<h2>Sizing and Selection Guide </h2>
<?php
$whereFrom = explode('/', $_SERVER[REQUEST_URI]);
if($whereFrom[1] == "mysteamist2") : 
?>
<p><a href="calc.php" >< Back to generator selection</a></p>
<?php
else :
?>
<p><a href="<?php bloginfo('url'); ?>/for-professionals/residential-sizing-guide/">< Back to generator selection</a></p>
<?php
endif;
?>
<p>Click on the listed items for a detailed description.</p>
<?php
require_once('sumGenerators.php');
require_once('sumOptions.php');
require_once('sumControls.php');
require_once('sumTotal.php');

if ($_GET['genstack'] == '2' || $_GET['genqty'] == '2' || $_GET['genstack'] == '3' || $_GET['genqty'] == '3') {
	require_once('section5-logic-a.php');
} else {
	require_once('section5-logic-b.php');
}
?>

<p>This form is for estimating only.<br />
You can print or e-mail this form by clicking below. </p>
<div class="printbtn"> <a href="/wp-content/selection-guide/print.php?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=5&amp;genstack=<?php echo $_GET[genstack]; ?>" target="_blank"><button type="button" class="btn btn-primary">PRINT</button></a></a> <a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo $_GET[button3]; ?>&amp;genid=<?php echo $_GET[genid]; ?>&amp;gen=<?php echo $_GET[gen]; ?>&amp;genref=<?php echo $_GET[genref]; ?>&amp;section=email&amp;genstack=<?php echo $_GET[genstack]; ?>"><button type="button" class="btn btn-primary">E-MAIL</button></a></a> </div>
<br />
<br />