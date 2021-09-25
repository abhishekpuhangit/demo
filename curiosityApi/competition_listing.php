<?php
	
	header('Content-Type: application/json');	

	define('DB_HOST', 'localhost');
	define('DB_USER', 'a1630ciy_curiosity');
	define('DB_PASS', 'curiosity@123');
	define('DB_NAME', 'a1630ciy_curiosity');
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if(mysqli_connect_errno()){
		
		die('Unable to connect to database' . mysqli_connect_error());
		
	}
		
	
	$stmt = $conn->prepare("SELECT competition_id, name, class, age FROM competition ");
	
	$stmt->execute();
	
	$stmt->bind_result($competition_id, $name, $class, $age);		
	
	$competition= array();
	
	while($stmt->fetch()){
		
		$temp=array();
		
		$temp['competition_id'] = $competition_id;
		$temp['name'] = $name;
		$temp['class'] = $class;
		$temp['age'] = $age;
	
		
		array_push($competition, $temp);
		
	}
	
	
	
	echo json_encode($competition);


?>