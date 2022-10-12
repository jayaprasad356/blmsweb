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
if (empty($_POST['bank'])) {
    $response['success'] = false;
    $response['message'] = "Bank is Empty";
    print_r(json_encode($response));
    return false;
}
$bank = $db->escapeString($_POST['bank']);
$company_name = $db->escapeString($_POST['company_name']);
$sql = "SELECT bank_cmp_cat.id,bank_cmp_cat.cat,bank_cmp_cat.remarks,banks.bank_name FROM bank_cmp_cat,banks WHERE bank_cmp_cat.bank_name=banks.id AND bank_cmp_cat.company_name = '$company_name' AND banks.bank_name = '$bank' LIMIT 25";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $response['success'] = true;
    $response['message'] = "Banks listed Successfully";
    $response['total'] = $num;
    $response['data'] = $res;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Banks Found";
    print_r(json_encode($response));

}

?>