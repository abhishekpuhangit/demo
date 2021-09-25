<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

$rawdata = file_get_contents("php://input");
// Let's say we got JSON
$data = json_decode($rawdata);
$response= array();

if(isset($data->lead_teacher_phone)){
    $user_type=$data->user_type;

     if($user_type=="school"){

    	$phone=$data->lead_teacher_phone;
    	$password=$data->password;

    	$pass=md5($password);

    	$sql="UPDATE registration set password='".$pass."' where lead_teacher_phone ='".$phone."'";
    	$sql_execute=mysqli_query($conn,$sql);

         if($sql_execute){

         	$response['status']="true";
         	$response['message']="Password changed successfully.";
         	echo json_encode($response);
         }
         else{
         	$response['status']="false";
         	$response['message']="Password not changed.";
         	echo json_encode($response);
         }

 }
}
 else{
         	$response['status']="false";
         	$response['message']="invalid request.";
         	echo json_encode($response);
         }
?>