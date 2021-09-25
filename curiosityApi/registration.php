<?php
header('Content-Type: application/json');
include_once ('db_helper.php');


$rawdata = file_get_contents("php://input");

$data = json_decode($rawdata); 

if(isset($data->lead_teacher_phone)){
		
	
		$school_name = $data->school_name;
		$school_level = $data->school_level;
		$principal_name = $data->principal_name;
		$principal_phone = $data->principal_phone;
		$lead_teacher = $data->lead_teacher;
		$lead_teacher_phone = $data->lead_teacher_phone;
		$user_type = $data->user_type;
		$password = $data->password;
		$profile_image="";
		$pass =  md5($password);
		
		date_default_timezone_set('Asia/Kolkata');
			$date = date('d/m/y h:i:s a', time());
		
		
		$query= "SELECT * FROM  registration where lead_teacher_phone ='".$lead_teacher_phone."'"  ;	
		$result=mysqli_query($conn, $query);
		$response= array();
	
	
		if(mysqli_num_rows($result)>0){
			
			
			$response['status']="false";
			$response['message']="User Already Exists.";
			echo json_encode($response);
			
		}
		
		else{
			$query = "INSERT INTO registration(school_name,school_level,principal_name,principal_phone,lead_teacher,lead_teacher_phone,password,user_type,timestamp) VALUES ('".$school_name."','".$school_level."','".$principal_name."','".$principal_phone."','".$lead_teacher."','".$lead_teacher_phone."','".$pass."','".$user_type."','".$date."')";
			$result = mysqli_query($conn,$query);

			if($result){
			
			$response['status']="true";
			$response['message']="Thank you! You are succesfully registered.";
			$response['data']=(["school_name"=>$school_name,"school_level"=>$school_level, "principal_name"=>$principal_name, "principal_phone"=>$principal_phone, "lead_teacher"=>$lead_teacher, "lead_teacher_phone"=>$lead_teacher_phone, "password"=>$pass, "user_type"=>$user_type,"profile_image"=>$profile_image, "timestamp"=>$date]);
		}
		else{
			$response['status']="false";
		$response['message'] = "Not registered";
		}
			
			echo json_encode($response);
			
		}
	}
	
	else{
		
		$response['status']="false";
		$response['message'] = "Invalid Request";
		echo json_encode($response); 
		
	}

	
	
?>