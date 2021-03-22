<?php
session_start();

// initializing variables
$name = "";
$email    = "";
$errors = array();
// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$doctor = new Doctor($db);

//Ce script doit avoir le moyen de récupérer ce identifiant

$doctor->id = isset($_POST['id']) ? $_POST['id'] : die(); //http://monsite/doctor/single.php?
$doctor->password = isset($_POST['password']) ? $_POST['password'] : die();
$doctor->password = base64_encode($_POST['password']);
$stmt = $doctor->login();
if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $doctor->name = $row['name'];

    $_SESSION['name'] = $doctor->name;
    $_SESSION['success'] = "You are now logged in";
    $doctor_arr = array(
        "status" => true,
        "message" => "Doctor, Successfully Authenticated!"
    );
} else {
    $doctor_arr = array(
        "status" => false,
        "message" => "Doctor, Cannot be autehnticated"
    );
}

echo json_encode($doctor_arr);
