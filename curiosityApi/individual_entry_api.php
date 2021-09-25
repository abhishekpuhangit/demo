<?php
	
	header('Content-Type: application/json');	
include_once 'db_helper.php';


	// if($_SERVER['REQUEST_METHOD']=='POST'){

	// if(isset($_POST['mobile'])){


      $mobile = $_POST['mobile'];
	
	$stmt =$conn->prepare("SELECT  C.name, I.mobile FROM competition C JOIN individual_entry_list I  ON I.competition_id = C.competition_id WHERE I.mobile='".$mobile."'");
	
	$stmt->execute();
	
	$stmt->bind_result($name, $mobile);		
	
	$competition= array();
	

	while($stmt->fetch()){
		
		$temp=array();
		
		$temp['name'] = $name;
	//	$temp['mobile'] = $mobile;
	//	array_push($competition, $temp);
		
	
	if($stmt){

     $response['status']="true";
     $response['message']=" Competition Participation ";
     $response['data'][]=array("name"=>$name);
}
else{

     $response['status']="false";
     $response['message']="No Data";
}
	
}	
	
	echo json_encode($response);

	// }
	  // }
?>