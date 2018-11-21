<?php


require_once "authentication/authentication.php";
require_once "serviceauthentication/serviceauthentication.php";

use Operation\Authentication;
use Operation\DepositService;
use Operation\Withdrawal;
use Operation\Transfer;
use Operation\BillPayment;

$logFile = "../errorlog.txt";

function output2JSON($outputIns){
    $response = array();
    if (isset($outputIns->errorMessage)){
      $response["isError"] = true;
      $response["message"] = $outputIns->errorMessage;
    }
    else{
      $response["isError"] = false;
      $response["data"] = array_filter((array)$outputIns,"strlen");
    }
    return $response;
}
try{
 
	if($_POST["cmd"] == "loginService"){
	$auth = new Authentication($_POST["acct_num"],$_POST["pin"]);
	echo json_encode($auth->login());
	}
	if($_POST["cmd"] == "passLogin"){
	
	 $result = ServiceAuthentication::accountAuthenticationProvider($_POST["acct_num"]);
	echo json_encode($result);
}



}catch(Error $e){
  date_default_timezone_set('Asia/Bangkok');
  $file = fopen($logFile,"a+");
  fwrite($file,"Log Time: ".date("d-m-Y H:i:sa") . "\n");
  fwrite($file,$e."\n\n");
  http_response_code(400);
  return;
}
