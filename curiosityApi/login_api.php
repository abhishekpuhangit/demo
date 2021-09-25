<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

$rawdata = file_get_contents("php://input");
// Let's say we got JSON
$data = json_decode($rawdata);

 //        if($_SERVER['REQUEST_METHOD']=='POST'){
 // }
         $user_type=$_POST['user_type'];
           



        if($data->user_type=="school"){
        if($data->lead_teacher_phone!="" && $data->password!=""){
            
            
            // $phone= $_POST['phone'];
            $pass= $data->password;
       //     $device_token=$data->device_token;
            $password= md5($pass);
            $response= array();

            $query="SELECT * FROM registration where lead_teacher_phone='".$data->lead_teacher_phone."'";


            $result= mysqli_query($conn, $query);

            
            if(mysqli_num_rows($result)>0)
            {
                $row= mysqli_fetch_assoc($result);

                $school_name=$row['school_name'];
                $school_level=$row['school_level'];
                $principal_name=$row['principal_name'];
                $principal_phone=$row['principal_phone'];
                $lead_teacher=$row['lead_teacher'];
                $lead_teacher_phone=$row['lead_teacher_phone'];
            $profile_image="";


                if($row['lead_teacher_phone'] == $data->lead_teacher_phone &&  $row['password'] == $password){



                     $response['status']=true;
                     $response['message']="You have successfully Logged in.";
                   	$response['data']=(["school_name"=>$school_name,"school_level"=>$school_level, "principal_name"=>$principal_name, "principal_phone"=>$principal_phone, "lead_teacher"=>$lead_teacher, "lead_teacher_phone"=>$lead_teacher_phone,"profile_image"=>$profile_image,"user_type"=>$user_type]);
                     echo json_encode($response);


                }

                else{

                     

                     $response['status']=false;
                     $response['message']="Invalid credentials.";
                     echo json_encode($response);
                }


                           
            }
            else{

                            $response['status']=false;
                     $response['message']="This phone no. is not registered with us.";
                     echo json_encode($response);


            }
            


         }

    

    
    else{
            
            
             $response['status']=false;
            $response['message']="Required fields are missing";
            echo json_encode($response); 
        }
     }
    
     else{
       
       $response['status']=false;
      $response['message'] = "Invalid Request";
      echo json_encode($response); 
        
     }
            
        


?>