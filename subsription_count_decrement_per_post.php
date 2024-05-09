<?php

include 'database.php';

$mobile_number = $_POST['mobile_number'];

$res_qry = "select * from users where mobile_number='$mobile_number'";
$result = $conn->query($res_qry);
$row = $result->fetch_assoc();
$user_id = $row['user_id'];

$sql = "select * from payments where user_id='$user_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $qry = "update payments set post_count=post_count - 1 where user_id='$user_id'";
} 



 $conn->query($qry);

$payment_qry = "select * from payments where user_id='$user_id'";

$payment_result = $conn->query($payment_qry);
$payment_info = $payment_result->fetch_assoc();
//echo '<pre>'; print_r($payment_info['post_count']);
// foreach($payment_info as $info){
//     echo '<pre>'; print_r($info);
    $post_count = $payment_info['post_count'];
    $subscription = $payment_info['subscription'];
// }
//exit;

 if ($post_count <=0 || $subscription == false) {
    $response = array(
        'status'  => '400',
        "message" => "Please subscribe",
        "data"    => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
   
 }  else {
    $row      = $payment_info;
    $response = array(
        'status'  => '200',
        "message" => "payment count details has been updated successfully",
        "data"    => $row);
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
 } 

$conn->close();
