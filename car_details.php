<?php

include 'database.php';

$brand     = $_POST['brand'];
$kms_driven      = $_POST['kms_driven'];
$latitude       = $_POST['latitude'];
$longitude  = $_POST['longitude'];
$model  = $_POST['model'];
$variant  = $_POST['variant'];
$body_type  = $_POST['body_type'];
$rto  = $_POST['rto'];
$colour  = $_POST['colour'];
$seating_capacity  = $_POST['seating_capacity'];
$budget  = $_POST['budget'];
$fuel  = $_POST['fuel'];
$prize  = $_POST['prize'];
$transmission  = $_POST['transmission'];
$year_of_manufacturing  = $_POST['year_of_manufacturing'];
$num_of_owners  = $_POST['num_of_owners'];
$verification_status  = $_POST['verification_status'];
$profile_status = 'success';
$car_photos = '';
$mobile_number = $_POST['mobile_number'];
if ($_FILES) {
    
    $car_photos     = $_FILES['car_photos']['name'];
    $extension        = explode('.', $car_photos);
    $image_extension  = end($extension);
    $unique_image     = time() . '-' . uniqid() . '.' . $image_extension;
    $upload_directory = 'images/car_images/' . $unique_image;

    if (move_uploaded_file($_FILES['car_photos']['tmp_name'], $upload_directory)) {
        $profile_status = 'success';
    } else {
        $profile_status = 'failed';
    }

} 

$res_qry = "select * from users where mobile_number='$mobile_number'";

$result = $conn->query($res_qry);

$row      = $result->fetch_assoc();

$user_id = $row['user_id'];

$qry = "insert into cars (user_id,brand,kms_driven,latitude,longitude,model,variant,body_type,rto,colour,seating_capacity,budget,fuel,car_photos,prize,transmission,year_of_manufacturing,num_of_owners,verification_status) values('$user_id','$brand','$kms_driven','$latitude','$longitude','$model','$variant','$body_type','$rto','$colour','$seating_capacity','$budget','$fuel','$car_photos','$prize','$transmission','$year_of_manufacturing','$num_of_owners','$verification_status') ";

$car_info = $conn->query($qry);


if ($car_info && $profile_status == 'success') {
    $row      = $car_info;
    $response = array(
        'status'  => '200',
        "message" => "Profile has been updated successfully",
        "data"    => $row);
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
} elseif ($profile_status == 'failed') {
    $response = array(
        'status'  => '400',
        "message" => "There is an error in uploading a profile. Please try again..",
        "data"    => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
} else {
    $response = array(
        'status'  => '400',
        "message" => "Error: " . $conn->error,
        "data"    => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
}

// Close connection
$conn->close();
