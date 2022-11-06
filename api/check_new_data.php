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
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "user_id is Empty";
    print_r(json_encode($response));
    return false;
}

$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT * FROM users WHERE id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $last_updated_on = $res[0]['last_updated_on'];
    $bank_id = $res[0]['bank_id'];
    if($bank_id != 'all'){
        $sql = "SELECT *,DATE(data_imported_on) AS data_imported_on FROM banks WHERE id = $bank_id ";
        $db->sql($sql); 
        $res = $db->getResult();
        $data_imported_on = $res[0]['data_imported_on'];
        if($data_imported_on >= $last_updated_on){
            $response['success'] = true;
            $response['message'] = "New Data Available";
            print_r(json_encode($response));

        }else{
            $response['success'] = false;
            $response['message'] = "Not Available";
            print_r(json_encode($response));

        }


    }else{
        $sql = "SELECT *,DATE(data_imported_on) AS data_imported_on FROM banks WHERE data_imported_on IS NOT NULL ORDER BY data_imported_on ";
        $db->sql($sql); 
        $res = $db->getResult();
        $data_imported_on = $res[0]['data_imported_on'];
        if($data_imported_on >= $last_updated_on){
            $response['success'] = true;
            $response['message'] = "New Data Available";
            print_r(json_encode($response));

        }else{
            $response['success'] = false;
            $response['message'] = "Not Available";
            print_r(json_encode($response));

        }

    }

}
else{
    $response['success'] = false;
    $response['message'] = "User Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}

   
    
   


?>
