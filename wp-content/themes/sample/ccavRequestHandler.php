<?php 
/*
Template Name:Transaction
*/
get_header();?>
<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php 
	
	include('Crypto.php');
	error_reporting(0);
	
	$merchant_data='';
	$working_key='190FD51BD6617AE348780C041CD692F6';//Shared by CCAV$ENUES
	$access_code='AVQL69EB22BB81LQBB';//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.
	
?>
<form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

