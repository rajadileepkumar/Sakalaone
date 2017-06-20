<?php
session_start();

class SendOTP
{
  private $baseUrl = "https://sendotp.msg91.com/api";

  public function callGenerateAPI($request)
  {
    $data = array("countryCode" => $request['countryCode'], "mobileNumber" => $request['mobileNumber'], "getGeneratedOTP" => true);
    $data_string = json_encode($data);
    $ch = curl_init($this->baseUrl . '/generateOTP');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string),
      'application-Key: 0OOnTRK0W9prqqS7n5_CUWXys-N_l07UwtlTvb_tKpZ6-IleyhL7ZVCIIGasO2_EfcDk-4YgwahdGaTQf9nRSAfbzCj-IxChClHfzNzOwi5-wMdNj_xMX1OycrGYfpVBWYH3h6U3drdzNDHLrS4gNg=='
    ));
    
    $result = curl_exec($ch);
    
    curl_close($ch);
    echo json_decode($result,true);
    return $result;
  }

  public function saveOTP($OTP)
  {
    //save OTP to your session
    $_SESSION["oneTimePassword"] = $OTP;
    // OR save the OTP to your database
    //connect db and save it to a table
    return true;
  }

  public function generateOTP($request)
  {
    //call generateOTP API
    $response = $this->callGenerateAPI($request);
    $response = json_decode($response, true);
    //echo $response["status"];
    if ($response["status"] == "error") {
    
    //customize this as per your framework
    $resp['message'] =  $response["response"]["code"];
    return json_encode($resp);
    }
    
    //save the OTP on your server
    if($this->saveOTP($response["response"]["oneTimePassword"])){
      $resp['message'] = "OTP SENT SUCCESSFULLY";
    return json_encode($resp);
  };
  }

  public function verifyOTP($request){
        //This is the sudo logic you have to customize it as needed.
        //your verify logic here
        if($request["oneTimePassword"] == $_SESSION["oneTimePassword"]){
            $resp['message'] = "NUMBER VERIFIED SUCCESSFULLY";
            
        }
        else{
            $resp['message'] =  "OTP INVALID";
            
        }
        return json_encode($resp);
        // OR get the OTP from your db and check against the OTP from client
    }
    
    public function verifyBySendOtp($request)
    {
        $data = array("countryCode" => $request['countryCode'], "mobileNumber" => $request['mobileNumber'], "oneTimePassword" => $request['oneTimePassword']);
        $data_string = json_encode($data);
        $ch = curl_init($this->baseUrl . '/verifyOTP');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Content-Length: ' . strlen($data_string),
          'application-Key: 0OOnTRK0W9prqqS7n5_CUWXys-N_l07UwtlTvb_tKpZ6-IleyhL7ZVCIIGasO2_EfcDk-4YgwahdGaTQf9nRSAfbzCj-IxChClHfzNzOwi5-wMdNj_xMX1OycrGYfpVBWYH3h6U3drdzNDHLrS4gNg=='
        ));
        $result = curl_exec($ch);
       curl_close($ch);
       $response = json_decode($result, true);
       if ($response["status"] == "error") {
         //customize this as per your framework
         $resp['message'] =  $response["response"]["code"];
         
       } else {
         $resp['message'] =  "NUMBER VERIFIED SUCCESSFULLY";
       }
       return json_encode($resp);
    }
}
  
  $sendOTPObject = new SendOTP();
  if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    echo $sendOTPObject->$_REQUEST['action']($_REQUEST);
  } else {
    echo "Error Wrong api";
  }
?>