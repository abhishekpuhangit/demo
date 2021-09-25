<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

if(isset($_POST['lead_teacher_phone'])){

   $lead_teacher_phone = $_POST['lead_teacher_phone'];
    
    $query= "SELECT * FROM  registration where lead_teacher_phone ='".$lead_teacher_phone."'"  ;
	
	$result=mysqli_query($conn, $query);
	$response= array();
    
    
   
    $phone=$_POST['lead_teacher_phone'];
    $certificate_img=str_replace(" ", "_", $_FILES['certificate_img']['name']);
        $certificate_imgsource=$_FILES['certificate_img']['tmp_name'];
        $certificate_imgtarget="certificate/".$certificate_img;
        move_uploaded_file($certificate_imgsource, $certificate_imgtarget);
        $certificate_img_url="https://daajyu.app/curiosityApi/".$certificate_imgtarget;




		
		$query="UPDATE registration set certificate_img ='".$certificate_img_url."' WHERE lead_teacher_phone ='".$lead_teacher_phone."'";
		
		$result=mysqli_query($conn, $query);
		
		$response['status']="true";
		$response['message']="Certificate uploaded successfully .";
		$response['data']=(["certificate_img"=>$certificate_img_url]);
		
		echo json_encode($response);
		

            
        }


?>