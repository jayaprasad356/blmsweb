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

if (empty($_POST['company_name'])) {
    $response['success'] = false;
    $response['message'] = "Company Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['bank_id'])) {
    $response['success'] = false;
    $response['message'] = "Bank Id is Empty";
    print_r(json_encode($response));
    return false;
}
$company_name = $db->escapeString($_POST['company_name']);
$bank_id = $db->escapeString($_POST['bank_id']);
if($bank_id == 'all'){
    $sql=" SELECT id,company_name FROM bank_cmp_cat WHERE company_name like '".$company_name."%' GROUP BY company_name ORDER BY id LIMIT 20 ";
}
else{
    $sql=" SELECT id,company_name FROM bank_cmp_cat WHERE bank_name = $bank_id AND company_name like '".$company_name."%' GROUP BY company_name ORDER BY id LIMIT 20 ";


}
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $response['success'] = true;
    $response['message'] = "Company listed Successfully";
    $response['total'] = $num;
    $response['data'] = $res;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Company Found";
    print_r(json_encode($response));

}

?>