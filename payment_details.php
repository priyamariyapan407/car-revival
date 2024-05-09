<?php

include 'database.php';

$subscription     = $_POST['subscription'];
$post_count      = $_POST['post_count'];
$mobile_number = $_POST['mobile_number'];

$res_qry = "select * from users where mobile_number='$mobile_number'";
$result = $conn->query($res_qry);
$row = $result->fetch_assoc();
$user_id = $row['user_id'];

$sql = "select * from payments where user_id='$user_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $qry = "update payments set subscription='$subscription',post_count='$post_count' where user_id='$user_id'";
} else {
    $qry = "insert into payments (user_id,subscription,post_count) values('$user_id','$subscription','$post_count') ";
}

$payment_info = $conn->query($qry);

if ($payment_info ) {
    $row      = $payment_info->fetch_assoc();
    $response = array(
        'status'  => '200',
        "message" => "payment details has been updated successfully",
        "data"    => $row);
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
}  else {
    $response = array(
        'status'  => '400',
        "message" => "Error: " . $conn->error,
        "data"    => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
}

$conn->close();
