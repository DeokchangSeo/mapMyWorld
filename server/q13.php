<?php
require "includes/defs.php";
$json;
$email = $_COOKIE['email'];
$data = array();

$result = check_user($email);


if ($result['idUser']) {
    array_push($data, $result['idUser']);
    array_push($data, $_POST['q13_info1']);
    $temp = 0; //a counter which indicates whether each value in $data exists or not
    for ($i = 0; $i<2; $i++)
    {
        if(check_var($data[$i])){  //$data[$i] exists
            $temp++;
        }
    }
    $return = null;
    if($temp == 2){ //all the value in $data exist
        $return = add_info_q13($data);
        $json = array ("result" => "success", "return" => $return);
    } else {
        $json = array ("result" => "missing value", "return" => $return);
    }
}
else{
    $json = array ("result" => "noUser", "return" => $return);
}

echo json_encode($json);
exit();
?>