<?php

// echo $_POST['data']['name'];
   require_once(__DIR__.'/../includes/db.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mysqli_real_escape_string($connection,$_POST['data']['name']);
    $about= mysqli_real_escape_string($connection,$_POST['data']['about']); 
    $location = mysqli_real_escape_string($connection,$_POST['data']['location']);
    $contact = mysqli_real_escape_string($connection,$_POST['data']['contact']);
    $dob = mysqli_real_escape_string($connection,$_POST['data']['dob']);
    $languages = mysqli_real_escape_string($connection,$_POST['data']['languages']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    // $username = mysqli_real_escape_string($connection,$_POST['data']['name']);
    

    $sql = "INSERT INTO student_profile (about,location,contact,dob,languages) values ($about,$location,$contact,$dob,$languages)";

    if(mysqli_query($connection, $sql)) {
        $response["updated"] = true;
        
        // convert the result array to json format
        echo json_encode($response);
        exit;
        // header("location: index.php");
    }
    else {
        $response["updated"] = false;
        
        // convert the result array to json format
        echo json_encode($result);
        exit;
    }
    

}

   
?>