<?php

include 'database.php';

$buyer_latitude  = $_POST['buyer_latitude'];  // Get buyer's latitude from query parameter
$buyer_longitude = $_POST['buyer_longitude']; // Get buyer's longitude from query parameter

$radius = 10;
$sql    = "SELECT * FROM cars
        WHERE
        (6371 * ACOS(SIN(RADIANS(latitude)) * SIN(RADIANS($buyer_latitude)) + COS(RADIANS(latitude)) * COS(RADIANS($buyer_latitude)) * COS(RADIANS($buyer_longitude - longitude)))) <= $radius";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mobile number exists, fetch user info
    $row = $result->fetch_assoc();
    // $userInfo = "User Name: " . $row["user_name"];
    $row['distance'] = calculateDistance($buyer_latitude, $buyer_longitude, $row['latitude'], $row['longitude']) . " km";
    $response        = array(
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

function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    $distance = 6371 * acos(cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon2) - deg2rad($lon1)) + sin(deg2rad($lat1)) * sin(deg2rad($lat2)));
    return round($distance, 2); // Round to 2 decimal places
}

// Close connection
$conn->close();
