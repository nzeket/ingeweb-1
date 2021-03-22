
<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$doctor = new Doctor($db);

//Ce script doit avoir le moyen de récupérer ce identifiant

$doctor->id = isset($_GET['id']) ? $_GET['id'] : die(); //http://monsite/doctor/single.php?

$stmt = $doctor->read_single();
if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $doctor_arr = array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "password" => $row['password'],
        "phone" => $row['phone'],
        "gender" => $row['gender'],
        "specialist" => $row['specialist'],
        "created" => $row['created']

    );
}

echo json_encode($doctor_arr);
