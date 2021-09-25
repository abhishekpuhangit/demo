<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

$rawdata = file_get_contents("php://input");
// Let's say we got JSON
$data = json_decode($rawdata);


        if($data->mobile!="" && $data->password!=""){
            
            $profile_image="";
            // $phone= $_POST['phone'];
            $pass= $data->password;
       //     $device_token=$data->device_token;
            $password= md5($pass);
            $response= array();

            $query="SELECT * FROM individual_reg where mobile='".$data->mobile."'";


            $result= mysqli_query($conn, $query);

            
            if(mysqli_num_rows($result)>0)
            {
                $row= mysqli_fetch_assoc($result);

                $name=$row['name'];
                $age=$row['age'];
                $school=$row['school'];
                $class=$row['class'];
                $mobile=$row['mobile'];
                $states=$row['states'];
                $district=$row['district'];
                $blocks=$row['blocks'];
                $state=$row['state'];
                $user_type=$row['user_type'];
                $patron_teacher=$row['patron_teacher'];
                $patron_teacher_mobile=$row['patron_teacher_mobile'];
            
	

		
		

                if($row['mobile'] == $data->mobile &&  $row['password'] == $password){


      //              $update_query="UPDATE registration set device_token='".$device_token."' where phone='".$phone."'";
               //       $update_query_execute=mysqli_query($conn,$update_query);
                     $response['status']=true;
                     $response['message']="You have successfully Logged in.";
                   	$response['data']=(["name"=>$name,"age"=>$age, "school"=>$school, "class"=>$class, "mobile"=>$mobile, "states"=>$states,  "district"=>$district,  "blocks"=>$blocks,  "state"=>$state, "password"=>$pass,  "patron_teacher"=>$patron_teacher,  "patron_teacher_mobile"=>$patron_teacher_mobile, "user_type"=>$user_type, "profile_image"=>$profile_image]);
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
  
            
        


?>