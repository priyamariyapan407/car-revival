<?php

include 'database.php';
$id  = $_POST['car_id'];
$sql = "select * from cars where car_id='$id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mobile number exists, fetch user info
    $row = $result->fetch_assoc();
    // $userInfo = "User Name: " . $row["user_name"];

    $response = array(
        'status' => '200',
        "data"   => $row);
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
} else {
    $response = array(
        'status' => '400',
        "data"   => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
}

// Close connection
$conn->close();