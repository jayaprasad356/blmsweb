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


if(isset($_POST['offset']) && isset($_POST['limit']) ){
    $offset = $db->escapeString($_POST['offset']);
    $limit = $db->escapeString($_POST['limit']);
    $sql = "SELECT SQL_NO_CACHE bank_cmp_cat.id,bank_cmp_cat.company_name,bank_cmp_cat.cat,banks.bank_name FROM bank_cmp_cat,banks WHERE bank_cmp_cat.bank_name=banks.id LIMIT $offset,$limit";
    //$sql = "SELECT SQL_NO_CACHE id,company_name,cat,bank_name FROM bank_cmp_cat ORDER BY id DESC LIMIT $offset,$limit";
    
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

}


?>