<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include_once('../includes/crud.php');

$db = new Database();
$db->connect();

if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['dob'])) {
    $response['success'] = false;
    $response['message'] = "Date of Birth is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['gender'])) {
    $response['success'] = false;
    $response['message'] = "Gender is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['bank_id'])) {
    $response['success'] = false;
    $response['message'] = "Bank Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['address'])) {
    $response['success'] = false;
    $response['message'] = "Address is Empty";
    print_r(json_encode($response));
    return false;
}

$name = $db->escapeString($_POST['name']);
$dob = $db->escapeString($_POST['dob']);
$mobile = $db->escapeString($_POST['mobile']);
$email = $db->escapeString($_POST['email']);
$gender = $db->escapeString($_POST['gender']);
$bank_id = $db->escapeString($_POST['bank_id']);
$address = $db->escapeString($_POST['address']);


$mobile = $db->escapeString($_POST['mobile']);
$sql = "SELECT * FROM users WHERE mobile ='$mobile'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $response['success'] = false;
    $response['message'] ="User Already Exists";
    print_r(json_encode($response));
    return false;
}
else{
    $sql = "INSERT INTO users (`name`,`dob`,`email`,`mobile`,`gender`,`bank_id`,`address`)VALUES('$name','$dob','$email','$mobile','$gender','$bank_id','$address')";
    $db->sql($sql);
    $sql = "SELECT * FROM users WHERE mobile = '$mobile'";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Registered Successfully";
    $response['data'] = $res;

    print_r(json_encode($response));

}

?>