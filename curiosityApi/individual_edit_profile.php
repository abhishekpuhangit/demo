<?php

header('Content-Type: application/json');
include_once 'db_helper.php';

//$user_type=$_POST['user_type'];

//if($user_type=="merchant"){


		
		
    $name=$_POST['name'];
    $age=$_POST['age'];
    $school=$_POST['school'];
    $class=$_POST['class'];   
    $mobile=$_POST['mobile'];
    $states=$_POST['states'];
    $district=$_POST['district'];
    $blocks =$_POST['blocks'];
    $state =$_POST['state'];
    $patron_teacher =$_POST['patron_teacher'];
    $patron_teacher_mobile =$_POST['patron_teacher_mobile'];
   // $password=$_POST['password'];
 


   

   $fetch="SELECT * FROM individual_reg where mobile='".$mobile."'";
   
    $result=mysqli_query($conn,$fetch);
    $row=mysqli_fetch_assoc($result);

    $profile_image=$row['profile_image'];
    $user_type=$row['user_type'];

    // if($_FILES['image_two']['size']!=0 ){

        if($_FILES['profile_image']['size']==0){


    $profile_image=str_replace(" ", "_", $_FILES['profile_image']['name']);
    $profile_imagesource=$_FILES['profile_image']['tmp_name'];
    $profile_imagetarget="individual_profile/".$profile_image;
    move_uploaded_file($profile_imagesource, $profile_imagetarget);
    $profile_image_url="https://daajyu.app/curiosityApi/".$profile_imagetarget;




$sql="UPDATE individual_reg set name='".$name."', age='".$age."', school='".$school."',class='".$class."',mobile='".$mobile."',states='".$states."',district='".$district."',blocks='".$blocks."',state='".$state."',patron_teacher='".$patron_teacher."',patron_teacher_mobile='".$patron_teacher_mobile."', profile_image='".$profile_image_url."' WHERE mobile='".$mobile."' ";

$sql_execute=mysqli_query($conn,$sql);
if($sql_execute){

     $response['status']="true";
     $response['message']=" Profile updated successfully ";
     $response['data']=(["name"=>$name,"age"=>$age, "school"=>$school, "class"=>$class, "mobile"=>$mobile, "states"=>$states,  "district"=>$district,  "blocks"=>$blocks,  "state"=>$state, "password"=>$pass,  "patron_teacher"=>$patron_teacher,  "patron_teacher_mobile"=>$patron_teacher_mobile, "user_type"=>$user_type, "profile_image"=>$profile_image_url]);
}
else{

     $response['status']="false";
     $response['message']="Profile not updated";
}
}

 else{

    $profile_image=str_replace(" ", "_", $_FILES['profile_image']['name']);
    $profile_imagesource=$_FILES['profile_image']['tmp_name'];
    $profile_imagetarget="individual_profile/".$profile_image;
    move_uploaded_file($profile_imagesource, $profile_imagetarget);
    $profile_image_url="https://daajyu.app/curiosityApi/".$profile_imagetarget;




$sql="UPDATE individual_reg set name='".$name."', age='".$age."', school='".$school."',class='".$class."',mobile='".$mobile."',states='".$states."',district='".$district."',blocks='".$blocks."',state='".$state."',patron_teacher='".$patron_teacher."',patron_teacher_mobile='".$patron_teacher_mobile."',profile_image='".$profile_image_url."' WHERE mobile='".$mobile."' ";

$sql_execute=mysqli_query($conn,$sql);
if($sql_execute){

     $response['status']="true";
     $response['message']=" Profile updated successfully ";
     $response['data']=(["name"=>$name,"age"=>$age, "school"=>$school, "class"=>$class, "mobile"=>$mobile, "states"=>$states,  "district"=>$district,  "blocks"=>$blocks,  "state"=>$state, "patron_teacher"=>$patron_teacher,  "patron_teacher_mobile"=>$patron_teacher_mobile, "user_type"=>$user_type, "profile_image"=>$profile_image_url]);
}
else{

     $response['status']="false";
     $response['message']="Profile not updated";
}
}

echo json_encode($response);

//}


?>