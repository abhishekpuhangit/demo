
<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

$rawdata = file_get_contents("php://input");
// Let's say we got JSON
$data = json_decode($rawdata);
$response= array();

if(isset($data->mobile)){
    $user_type=$data->user_type;

     if($user_type=="individual"){

    	$phone=$data->mobile;
    	$password=$data->password;

    	$pass=md5($password);

    	$sql="UPDATE individual_reg set password='".$pass."' where mobile ='".$phone."'";
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