<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

$rawdata = file_get_contents("php://input");
// Let's say we got JSON
$data = json_decode($rawdata);
if (isset($data->lead_teacher_phone)) {
	

$mobile=$data->lead_teacher_phone;

 #### 2Factor API Setting
    $APIKey='ed4021cc-dfb3-11eb-8089-0200cd936042';
    // $OTPMessage="<p>We have sent an OTP to $mobile,<br>Please enter the same below</p>";
    
    #### Custom Logic
   $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/$mobile/AUTOGEN"),false);
            $VerificationSessionId= $API_Response_json->Details;

$response['status']="true";
$response['message']="Verification Code Sent To Your Registered Phone Number";
$response['data']=(["VerificationSessionId"=>$VerificationSessionId]);
echo json_encode($response);
}
else{
	$response['status']="false";
$response['message']="Your Phone Number Is Not Valid";
echo json_encode($response);
}

?>