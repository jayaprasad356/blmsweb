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

if (empty($_POST['bank_id'])) {
    $response['success'] = false;
    $response['message'] = "Bank is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
$bank_id = $db->escapeString($_POST['bank_id']);
$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT * FROM users WHERE id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $last_updated_on = $res[0]['last_updated_on'];
    if(isset($_POST['offset']) && isset($_POST['limit']) ){
        $offset = $db->escapeString($_POST['offset']);
        $limit = $db->escapeString($_POST['limit']);
    
        if($bank_id == 'all'){
            $sql = "SELECT COUNT(bank_cmp_cat.id) AS total FROM bank_cmp_cat,banks WHERE bank_cmp_cat.bank_name=banks.id AND banks.data_imported_on > '$last_updated_on' ";
            $db->sql($sql);
            $res = $db->getResult();
            $total = $res[0]['total'];
            $sql = "SELECT SQL_NO_CACHE bank_cmp_cat.id,bank_cmp_cat.company_name,bank_cmp_cat.cat,banks.bank_name,bank_cmp_cat.remarks,banks.id AS bank_id FROM bank_cmp_cat,banks WHERE bank_cmp_cat.bank_name=banks.id AND banks.data_imported_on > '$last_updated_on' ORDER BY bank_cmp_cat.id LIMIT $offset,$limit";
        
        }
        else{
            $sql = "SELECT COUNT(bank_cmp_cat.id) AS total FROM bank_cmp_cat,banks WHERE bank_cmp_cat.bank_name=banks.id AND banks.id = '$bank_id'";
            $db->sql($sql);
            $res = $db->getResult();
            $total = $res[0]['total'];
            $sql = "SELECT SQL_NO_CACHE bank_cmp_cat.id,bank_cmp_cat.company_name,bank_cmp_cat.cat,banks.bank_name,bank_cmp_cat.remarks,banks.id AS bank_id FROM bank_cmp_cat,banks WHERE bank_cmp_cat.bank_name=banks.id AND banks.id = '$bank_id' ORDER BY bank_cmp_cat.id LIMIT $offset,$limit";
    
        }
        $db->sql($sql);
        $res = $db->getResult();
        $num = $db->numRows($res);
        if ($num >= 1) {
            $response['success'] = true;
            $response['message'] = "Company listed Successfully";
            $response['total'] = $total;
            $response['data'] = $res;
            print_r(json_encode($response));
    
        }else{
            $response['success'] = false;
            $response['message'] = "No Company Found";
            print_r(json_encode($response));
    
        }
    
    }
    

}
else{
    $response['success'] = false;
    $response['message'] = "User Not Found";
    print_r(json_encode($response));


}



?>