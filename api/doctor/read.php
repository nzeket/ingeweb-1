<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare doctor object
$doctor = new Doctor($db);
 
// query doctor
$stmt = $doctor->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // doctors array
    $doctors_arr=array();//fonction : tableau vide: []
    $doctors_arr["doctors"]=array(); // ["doctors"=> [ ["id"=>1,"name"=>"doc", ],["id"=>2, ], ]]
    //PDO::QQCHOSE=>QQCHOSE est un attribut statique de la classe PDO
    //FETCH::ASSOC => [clé=>valeur, clé=>valeur]
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row); //$id=$row['id']; $name=$row['name'];$phone=$row['phone']
        $doctor_item=array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "gender" => $gender,
            "specialist" => $specialist,
            "created" => $created
        );
        array_push($doctors_arr["doctors"], $doctor_item);//[ [id=>1,name="pierre",], [id=>2, na], [] ]
    }
    
    echo json_encode($doctors_arr["doctors"]);//JSON: JavaScript Object Notation  
    //JS: {clé1: valeur1,clé2:valeur2,}
    //JSON: {"clé":"valeur"}, exemple  { {"id":'1',"name":"pierre",}, {"id":2, name:"Marie"},{}}
}
else{
    echo json_encode(array());
}
?>