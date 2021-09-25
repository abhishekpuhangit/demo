<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

$rawdata = file_get_contents("php://input");
// Let's say we got JSON
$data = json_decode($rawdata);


 $APIKey='ed4021cc-dfb3-11eb-8089-0200cd936042';
    // $OTPMessage="<p>We have sent an OTP to $mobile,<br>Please enter the same below</p>";
    
    #### Custom Logic
    $otpValue=(( isset($data->otp) AND $data->otp<>'' ) ? $data->otp : '' );
    
    
   
     if ( $otpValue <> '') ### OTP value entered by user
    {
        ### Check if OTP is matching or not
        $VerificationSessionId=$data->VerificationSessionId;
        $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/VERIFY/$VerificationSessionId/$otpValue"),false);
        $VerificationStatus= $API_Response_json->Details;

        // echo $VerificationStatus;
            
            ## Check if OTP is matching
            if ( $VerificationStatus =='OTP Matched')
            {

            	$response['status']="true";
            	$response['message']="Phone no. verified";

            	echo json_encode($response);

                
            
            // echo "Congratulations $mobile has been verified. Following are the details captured: <br>Name : $name <br> Email:  $email <br> Mobile : $mobile ";
            //     die();
                
            }
            else
            {

            	$response['status']="false";
            	$response['message']="Phone no. not verified.";
            	
            	echo json_encode($response);
                
                // echo "<script type='text/javascript'>alert('Sorry, OTP entered was incorrect. Please enter correct OTP');  window.history.back();  </script>";
                // die();
            }
        
    }
  

?>