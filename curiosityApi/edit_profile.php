<?php
header('Content-Type: application/json');
include_once 'db_helper.php';

//$user_type=$_POST['user_type'];

//if($user_type=="merchant"){


		
		
    $school_name=$_POST['school_name'];
    $school_level=$_POST['school_level'];
    $principal_name=$_POST['principal_name'];
    $principal_phone=$_POST['principal_phone'];   
    $lead_teacher=$_POST['lead_teacher'];
    $lead_teacher_phone=$_POST['lead_teacher_phone'];
   // $password=$_POST['password'];
 


   

   $fetch="SELECT * FROM registration where lead_teacher_phone='".$lead_teacher_phone."'";
   
    $result=mysqli_query($conn,$fetch);
    $row=mysqli_fetch_assoc($result);

    $profileimage=$row['profile_image'];
    $user_type=$row['user_type'];

    // if($_FILES['image_two']['size']!=0 ){

        if($_FILES['profile_image']['size']==0){


    $profile_image=str_replace(" ", "_", $_FILES['profile_image']['name']);
    $profile_imagesource=$_FILES['profile_image']['tmp_name'];
    $profile_imagetarget="profile/".$profile_image;
    move_uploaded_file($profile_imagesource, $profile_imagetarget);
    $profile_image_url="https://daajyu.app/curiosityApi/".$profile_imagetarget;




$sql="UPDATE registration set school_name='".$school_name."', school_level='".$school_level."', principal_name='".$principal_name."',principal_phone='".$principal_phone."',lead_teacher='".$lead_teacher."',lead_teacher_phone='".$lead_teacher_phone."', profile_image='".$profile_image_url."' WHERE lead_teacher_phone='".$lead_teacher_phone."' ";

$sql_execute=mysqli_query($conn,$sql);
if($sql_execute){

     $response['status']="true";
     $response['message']=" Profile updated successfully ";
     $response['data']=(["school_name"=>$school_name,"school_level"=>$school_level, "school_level"=>$school_level,  "principal_name"=>$principal_name, "principal_phone"=>$principal_phone,"lead_teacher"=>$lead_teacher, "lead_teacher_phone"=>$lead_teacher_phone,  "profile_image"=>$profile_image_url]);
}
else{

     $response['status']="false";
     $response['message']="Profile not updated";
}
}

 else{

    $profile_image=str_replace(" ", "_", $_FILES['profile_image']['name']);
    $profile_imagesource=$_FILES['profile_image']['tmp_name'];
    $profile_imagetarget="school/".$profile_image;
    move_uploaded_file($profile_imagesource, $profile_imagetarget);
    $profile_image_url="https://daajyu.app/curiosityApi/".$profile_imagetarget;




$sql="UPDATE registration set school_name='".$school_name."', school_level='".$school_level."', principal_name='".$principal_name."',principal_phone='".$principal_phone."',lead_teacher='".$lead_teacher."',lead_teacher_phone='".$lead_teacher_phone."' WHERE lead_teacher_phone='".$lead_teacher_phone."' ";

$sql_execute=mysqli_query($conn,$sql);
if($sql_execute){

     $response['status']="true";
     $response['message']=" Profile updated successfully ";
     $response['data']=(["school_name"=>$school_name,"school_level"=>$school_level, "school_level"=>$school_level,  "principal_name"=>$principal_name, "principal_phone"=>$principal_phone,"lead_teacher"=>$lead_teacher, "lead_teacher_phone"=>$lead_teacher_phone,  "profile_image"=>$profile_image_url]);
}
else{

     $response['status']="false";
     $response['message']="Profile not updated";
}
}

echo json_encode($response);

//}


?>