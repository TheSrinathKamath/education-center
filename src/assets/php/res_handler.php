<?php
    function send_response($status, $response){
        exit(json_encode(array("status"=>$status, "result"=>$response), JSON_UNESCAPED_UNICODE));
    }
?>