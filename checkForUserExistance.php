<?php

include 'database.php';

$mobile_num    = $_POST['mobile_number'];
$country_code  = $_POST['country_code'];
$mobile_number = substr($mobile_num, strlen($country_code));

$sql = "select * from users where mobile_number='$mobile_number'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mobile number exists, fetch user info
    $row      = $result->fetch_assoc();
    $response = array(
        'status'  => '200',
        "message" => "user exists",
        "data"    => $row);
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
} else {
    $response = array(
        'status'  => '400',
        "message" => "user does not exists",
        "data"    => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
}

// Close connection
$conn->close();
