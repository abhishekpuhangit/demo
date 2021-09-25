<?php
header('Content-Type: application/json');
include_once ('db_helper.php');


$rawdata = file_get_contents("php://input");

$data = json_decode($rawdata); 
	

if(isset($data->name)){
		
	
		$name = $data->name;
		$class = $data->class;
		$age = $data->age;
		
		date_default_timezone_set('Asia/Kolkata');
			$date = date('d/m/y h:i:s a', time());
		
		
		$query= "SELECT * FROM  competition where name ='".$name."'";	
		$result=mysqli_query($conn, $query);
		$response= array();
	
	
		if(mysqli_num_rows($result)>0){
			
			
			$response['status']="false";
			$response['message']="Competition Already Exist.";
			echo json_encode($response);
			
		}
		
		else{
			$query = "INSERT INTO competition(name,class_a,class_b,age_a,age_b,timestamp) VALUES ('".$name."','".$class."','".$age."','".$date."')";
			$result = mysqli_query($conn,$query);

			if($result){
			
			$response['status']="true";
			$response['message']="Competition added succesfully.";
			$response['data']=(["name"=>$name,"class"=>$class, "age"=>$age, "timestamp"=>$date]);
		}
		else{
			$response['status']="false";
		$response['message'] = "Not added";
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