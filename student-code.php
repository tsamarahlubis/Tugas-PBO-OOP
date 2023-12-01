<?php
session_start();

include('dbconn.php');
include('StudentController.php');

$db = new DatabaseConnection();

if (isset($_POST['save_student'])) {
    $inputData = [
        'fullname' => mysqli_real_escape_string($db->conn, $_POST['fullname']),
        'email'    => mysqli_real_escape_string($db->conn, $_POST['email']),
        'phone'    => mysqli_real_escape_string($db->conn, $_POST['phone']),
        'course'   => mysqli_real_escape_string($db->conn, $_POST['course']),
    ];

    $student = new StudentController($db->conn); // Pass the database connection to the controller
    $result  = $student->create($inputData);

    if ($result) {
        $_SESSION['message'] = "";
        header("Location: index.php");
    } else {
        $_SESSION['message'] = "Not Inserted";
    }

    header("Location: student-add.php");
    exit(0);
}

if(isset($_POST['update_student']))
{
    $id = mysqli_real_escape_string($db->conn,$_POST['student_id']);
    $inputData = [
        'fullname' => mysqli_real_escape_string($db->conn,$_POST['fullname']),
        'email' => mysqli_real_escape_string($db->conn,$_POST['email']),
        'phone' => mysqli_real_escape_string($db->conn,$_POST['phone']),
        'course' => mysqli_real_escape_string($db->conn,$_POST['course']),
    ];
    $student = new StudentController($db->conn);
    $result = $student->update($inputData, $id);

    if($result)
    {
        $_SESSION['message'] = "";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Added";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['deleteStudent']))
{
    $id = mysqli_real_escape_string($db->conn, $_POST['deleteStudent']);
    $student = new StudentController($db->conn);
    $result = $student->delete($id);
    if($result)
    {
        $_SESSION['message'] = "";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Added";
        header("Location: index.php");
        exit(0);
    }
}
?>