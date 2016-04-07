<?php require_once('calcfunctions.php'); ?>
<h2>Sizing and Selection Guide </h2>
    <p><a href="?genqty=<?php echo $_GET[genqty]; ?>&amp;button3=<?php echo htmlentities($_GET['button3']); ?>&amp;genid=<?php echo htmlentities($_GET['genid']); ?>&amp;gen=<?php echo htmlentities($_GET['gen']); ?>&amp;genref=<?php echo htmlentities($_GET['genref']); ?>&amp;section=5&amp;genstack=<?php echo $_GET['genstack']; ?>">&lt; Back to Summary</a></p>
   
   <?php error_reporting(E_ALL ^ E_NOTICE);
if ($_POST['button'] == 'Send') {
//change this to your email.

function curl($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            return curl_exec($ch);
            curl_close($ch);
        }

    $from = htmlentities($_POST['youremail']);
    $to = htmlentities($_POST['recipemail']);
    $subject = "Sizing and Selection Guide";
	
	if ($_SESSION['genselected'] == 'SM' ) {
		$genselect = 'SM';
		} else {
			$genselect = 'TS';
			}
	
	
	$thaPage = get_site_url().('/wp-content/selection-guide/print.php?genqty=' . htmlentities($_GET[genqty]) . '&button3=Select&msg=email&genid=' . htmlentities($_GET[genid])  . '&genref=' . htmlentities($_GET[genref]) . '&costid=' . $_SESSION['userquoteid'] . '&sm=' . $genselect . '&genstack=' . htmlentities($_GET[genstack]) . '&gen=' . $genselect );
	$theHTML = curl($thaPage);
    //echo $thaPage . "    ";
    //echo '&costid=' . $_SESSION['userquoteid'] . '##';
    //echo $theHTML;  // PJL REMOVE THIS 
	//begin of HTML message
	$theComments = htmlentities($_POST['comments']) ;
	$message =  '<p>' . nl2br($theComments) . '</p>' . $theHTML;

   //end of message
    $headers  = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n";

    //options to send to cc+bcc
    //$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
    //$headers .= "Bcc: [email]email@maaking.cXom[/email]";
    
    // now lets send the email.
    mail($to, $subject, $message, $headers);
    //echo get_site_url();
    echo 'Thank you. Your email has been sent.';// . $message . ":::" . $thaPage;

} else { ?>


 <p>Fill in the form to email.</p>
    <form id="form1" name="form1" method="post" action="">
    		<table border="0" cellspacing="0" cellpadding="5">
    				<tr>
    						<td valign="top"><strong>Your Email: </strong></td>
    						<td><input name="youremail" type="text" id="youremail" maxlength="100" /></td>
					</tr>
    				<tr>
    						<td valign="top"><strong>Recipient Email:</strong></td>
    						<td><input name="recipemail" type="text" id="recipemail" maxlength="100" /></td>
					</tr>
    				<tr>
    						<td valign="top"><strong>Comments:</strong></td>
    						<td><textarea name="comments" id="comments" cols="45" rows="5"></textarea></td>
					</tr>
    				<tr>
    						<td>&nbsp;</td>
    						<td><input type="submit" name="button" id="button" value="Send" /></td>
					</tr>
			</table>
</form>
<?php 
}

	//echo  ('http://steamist.nologyit.com/wp-content/selection-guide/print.php?genqty=' . htmlentities($_GET[genqty]) . '&button3=Select&msg=email&genid=' . htmlentities($_GET[genid])  . '&genref=' . htmlentities($_GET[genref]) . '&costid=' . $_SESSION['userquoteid'] . '&sm=' . $genselect . '&genstack=' . htmlentities($_GET[genstack]) . '&gen=' . htmlentities($_GET[gen]) );
?>