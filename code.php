<?php
session_start();

include('dbconn.php');
include('StudentController.php');

$db = new DatabaseConnection;

if(isset($_POST['save_student']))
{
    $inputData = [
        'fullname' => mysqli_real_escape_string($db->conn,$_POST['fullname']),
        'email' => mysqli_real_escape_string($db->conn,$_POST['email']),

        'phone' => mysqli_real_escape_string($db->conn,$_POST['phone']),
        'course' => mysqli_real_escape_string($db->conn,$_POST['course']),
    ];

    $student = new StudentController;
    $result = $student->create($inputData);
    
    if($result)
    {
        $_SESSION['message'] = "";
        header("Location: student-add.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header("Location: student-add.php");
        exit(0);
    }
}
?>