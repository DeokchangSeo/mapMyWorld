<?php
/*
 * Add answers entered by the user into DB.
 */
require "includes/defs.php";

//session_start();

$json;
$email = $_COOKIE['email'];
$data = array();

$result = check_user($email);

if ($result['idUser']) {
    array_push($data, $result['idUser']);
    array_push($data, $_POST['q3_info11']);
    array_push($data, $_POST['q3_info12']);
    array_push($data, $_POST['q3_info21']);
    array_push($data, $_POST['q3_info22']);
    array_push($data, $_POST['q3_info31']);
    array_push($data, $_POST['q3_info32']);
    array_push($data, $_POST['q3_info41']);
    array_push($data, $_POST['q3_info42']);

    $temp = 0; //a counter which indicates whether each value in $data exists or not
    for ($i = 0; $i<9; $i++)
    {
        if(check_var($data[$i])){  //$data[$i] exists
            $temp++;
        }
    }
    $return = null;
    if($temp == 9){ //all the value in $data exist
        $return = add_info_q3($data);
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

