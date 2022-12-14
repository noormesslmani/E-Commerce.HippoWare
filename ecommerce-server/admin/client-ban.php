<?php


header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST');
header('Content-Type:application/json');
include '../database/Database.php';
include '../vendor/autoload.php';

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

$obj = new Database();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    try {
        $allheaders = getallheaders();
        $jwt =$allheaders['Authorization'];
        $secret_key = "Hippo";
        $user_data = JWT::decode($jwt, new Key($secret_key, 'HS256'));
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        //checking if he is an admin
        if($user_data->data->user_type != 1){
            echo json_encode([
                'status' => 0,
                'message' => 'Access Denied',
            ]);
            die();
        } 

        $id = $data['id'];
        // getting current ban status
        $obj->select('users', '*', null, "id='{$id}'", null, null); 
        $datas = $obj->getResult();
        foreach ($datas as $data) {
            if($data['accepted'] == 1){
                $ban = 0;
            }else $ban = 1;
        }
         // switching ban status
        $obj->update('users', ['accepted' => $ban],"id='{$id}'" );
        $result = $obj->getResult();
        echo json_encode($result);

    } catch (Exception $e) {
        echo json_encode([
            'status' => 0,
            'message' => $e->getMessage(),
        ]);
    }
} else {
    echo json_encode([
        'status' => 0,
        'message' => 'Access Denied',
    ]);
}
?>