<?php
// echo "<pre>";
// print_r($_FILES['image']); die();
require_once '../inc/db.php';


if (isset($_POST['submit'])){
    $title = $_POST['title'];
    $body = $_POST['body'];

$errors = [];
if(empty($body)){
    $errors[] =  "the body should be exist";
 };
 if(empty($title)){
    $errors[] =  "the title should be exist";
 };
  
 $img = $_FILES['image'];
$img_name = $img['name'];
$image_tmp_name = $img['tmp_name'];
$ext = pathinfo($img_name,PATHINFO_EXTENSION);
$img_error = $img['error'];
$img_size = $img['size'] /(1024 * 1024);
$now = date("Y/m/d h:i:s");
$dir_img = "../assets/images/postimage/";


if($img_error > 0){
    $errors[]= "the image is borken";
}

 elseif ($img_size > 1){
 $errors[]= "the image is greter than 1Mb";
}

elseif(!in_array($ext,['png,jpg'])){
    $errors[]= "the imge must be jpg";
}

if(empty($errors)){
    $query ="INSERT INTO posts (`title`,`image`,`body`,`created_at`,`user_id`)
    VALUES ('$title','$body','$img_name','$now',1) ";
    // echo $query; die();
    $result = mysqli_query($connection,$query);
     
if($result){
    $_SESSION['success']="the post is done";
    move_uploaded_file($image_tmp_name,$dir_img.$img_name);
    header('location:../index.php');
    exit();
} else {
    $errors[] = "the post is not";
}
}

$_SESSION['error']= $errors;
header("location:../addpost.php");


};
