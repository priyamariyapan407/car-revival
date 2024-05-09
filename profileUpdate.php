<?php

include 'database.php';

$first_name     = $_POST['first_name'];
$last_name      = $_POST['last_name'];
$email_id       = $_POST['email_id'];
$mobile_number  = $_POST['mobile_number'];
$profile_status = 'success';
if ($_FILES) {
    $actual_image     = $_FILES['image']['name'];
    $extension        = explode('.', $actual_image);
    $image_extension  = end($extension);
    $unique_image     = time() . '-' . uniqid() . '.' . $image_extension;
    $upload_directory = 'images/profile_images/' . $unique_image;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_directory)) {
        $profile_status = 'success';
    } else {
        $profile_status = 'failed';
    }

    $image = ",user_image='$unique_image'";
} else {
    $image = "";
}

$sql = "update users set first_name='$first_name',last_name='$last_name',email_id='$email_id' $image where mobile_number='$mobile_number'";

$conn->query($sql);

$res_qry = "select * from users where mobile_number='$mobile_number'";

$result = $conn->query($res_qry);

if ($result->num_rows > 0 && $profile_status == 'success') {
    $row      = $result->fetch_assoc();
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
        "message" => "user does not exists",
        "data"    => null,
    );
    echo json_encode($response, JSON_UNESCAPED_SLASHES);
}

// Close connection
$conn->close();
