<?php
	
	header('Content-Type: application/json');	
include_once 'db_helper.php';


	// if($_SERVER['REQUEST_METHOD']=='POST'){

	// if(isset($_POST['mobile'])){


    $lead_teacher_phone = $_POST['lead_teacher_phone'];
	
	$stmt =$conn->prepare("SELECT  C.name, S.lead_teacher_phone FROM competition C JOIN school_entry_list S ON S.competition_id = C.competition_id WHERE S.lead_teacher_phone='".$lead_teacher_phone."'");
	
	
	$stmt->execute();
	
	$stmt->bind_result($name, $lead_teacher_phone);		
	
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