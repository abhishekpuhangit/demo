<?php
header('Content-Type: application/json');
include_once ('db_helper.php');


$rawdata = file_get_contents("php://input");

$data = json_decode($rawdata); 
	

if(isset($data->mobile)){
		
	
		$name = $data->name;
		$age = $data->age;
		$school = $data->school;
		$class = $data->class;
		$mobile = $data->mobile;
		$states = $data->states;
		$district = $data->district;
		$blocks = $data->blocks;
		$state = $data->state;
		$password = $data->password;
		$patron_teacher = $data->patron_teacher;
		$patron_teacher_mobile = $data->patron_teacher_mobile;
		$user_type = $data->user_type;
		$profile_image="";
	//	$profile_image="";
		 
		$pass =  md5($password);
		
		date_default_timezone_set('Asia/Kolkata');
			$date = date('d/m/y h:i:s a', time());
		
		
		$query= "SELECT * FROM  individual_reg where mobile ='".$mobile."'"  ;	
		$result=mysqli_query($conn, $query);
		$response= array();
	
	
		if(mysqli_num_rows($result)>0){
			
			
			$response['status']="false";
			$response['message']="User Already Exists.";
			echo json_encode($response);
			
		}
		
		else{
			$query = "INSERT INTO individual_reg(name,age,school,class,mobile,states,district,blocks,state,password,patron_teacher,patron_teacher_mobile,user_type,timestamp) VALUES ('".$name."','".$age."','".$school."','".$class."','".$mobile."','".$states."','".$district."','".$blocks."','".$state."','".$pass."','".$patron_teacher."','".$patron_teacher_mobile."','".$user_type."','".$date."')";
			$result = mysqli_query($conn,$query);

			if($result){
			
			$response['status']="true";
			$response['message']="Thank you! You are succesfully registered.";
			$response['data']=(["name"=>$name,"age"=>$age, "school"=>$school, "class"=>$class, "mobile"=>$mobile, "states"=>$states,  "district"=>$district,  "blocks"=>$blocks,  "state"=>$state, "password"=>$pass,  "patron_teacher"=>$patron_teacher,  "patron_teacher_mobile"=>$patron_teacher_mobile, "user_type"=>$user_type, "profile_image"=>$profile_image, "timestamp"=>$date]);
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