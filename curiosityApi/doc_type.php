<?php
	header('Content-Type: application/json');
	include_once('db_helper.php');
        
    if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_POST['lead_teacher_phone'])){


      $lead_teacher_phone = $_POST['lead_teacher_phone'];
	   $user_type = $_POST['user_type'];
	   $competition_id = $_POST['competition_id'];

	               	date_default_timezone_set('Asia/Kolkata');
			$date = date('d/m/y h:i:s a', time());
	

		
		$doc=$_FILES['doc_type']['name'];
		$docsource=$_FILES['doc_type']['tmp_name'];
		$filesize=$_FILES['doc_type']['size'];
		// $namemodify=rename($image, $savevideoname);
		$doctarget="school_entry/".$doc;
		$path="https://daajyu.app/curiosityApi/".$doc;
		move_uploaded_file($docsource, $doctarget);
		
		
		
		$response= array();
		  
		  
		
		if($filesize < 20971520){
			
			$query="INSERT into school_entry_list(user_type,lead_teacher_phone,competition_id,doc_type,timestamp) VALUES ('".$user_type."','".$lead_teacher_phone."','".$competition_id."','".$doc."','".$date."')";
		
			$result=mysqli_query($conn, $query);
			
			if($result)
			{
			$response['status']="true";
			$response['message']="Entry uploaded successfully .";
			$response['data']=(["doc_type"=>$path]);
			}
			else{
				$response['status']="false";
				$response['message']="Entry Not Uploaded";		
			
			}
				echo json_encode($response);
			}
				else{
			
		
			echo json_encode(array('response'=>'File limit exceeds 20Mb.'));
			
			
		}
			
			// $checkcompetitionquery="SELECT * FROM  registration where lead_teacher_phone ='".$lead_teacher_phone."'"  ;
		
			// $checkcompetitionresult=mysqli_query($conn, $checkcompetitionquery);
			
			
			// if(mysqli_num_rows($checkcompetitionresult)>0){
			
			// echo json_encode(array('response'=>'You already participated in this contest.'));
			
		// }
		
		// else{
			// $query="UPDATE registration set video_type ='".$path."' WHERE lead_teacher_phone ='".$lead_teacher_phone."'";
			
							// if(mysqli_query($conn, $query)){
					
					
								// file_put_contents($upload_path,base64_decode($image));
								// echo json_encode(array('response'=>'Video Uploaded Successfully.'));
					
					// }
					// else{
						
						// echo json_encode(array('response'=>'Video upload failed.'));
						
						
					// }
		// }
			
		}

	
		
		
		
	
       
       
            
        }
	else{
			
			
			echo json_encode(array('response'=>'Required fields are missing.'));
		}

	
	
?>

