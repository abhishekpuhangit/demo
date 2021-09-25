<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

if(isset($_POST['lead_teacher_phone'])){

   $lead_teacher_phone = $_POST['lead_teacher_phone'];
   $user_type = $_POST['user_type'];
   $competition_id = $_POST['competition_id'];
  

               	date_default_timezone_set('Asia/Kolkata');
			$date = date('d/m/y h:i:s a', time());

    $image_type=str_replace(" ", "_", $_FILES['image_type']['name']);
        $image_typesource=$_FILES['image_type']['tmp_name'];
        $image_typetarget="school_entry/".$image_type;
        move_uploaded_file($image_typesource, $image_typetarget);
        $image_type_url="https://daajyu.app/curiosityApi/".$image_typetarget;


		
		$query="INSERT into school_entry_list(user_type,lead_teacher_phone,competition_id,image_type,timestamp) VALUES ('".$user_type."','".$lead_teacher_phone."','".$competition_id."','".$image_type."','".$date."')";
		
		$result=mysqli_query($conn, $query);
		
		if($result)
		{
		$response['status']="true";
		$response['message']="Entry uploaded successfully .";
		$response['data']=(["image_type"=>$image_type_url]);
		}
		else{
			$response['status']="false";
			$response['message']="Entry Not Uploaded";		
		
		}
            echo json_encode($response);
        }

	else{
			
			
			$response['status']="false";
			$response['message']="Required fields are missing";
			echo json_encode($response); 
		}

?>