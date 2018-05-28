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
    array_push($data, $_POST['q9_info11']);
    array_push($data, $_POST['q9_info12']);
    array_push($data, $_POST['q9_info13']);
    array_push($data, $_POST['q9_info14']);
    array_push($data, $_POST['q9_info21']);
    array_push($data, $_POST['q9_info22']);
    array_push($data, $_POST['q9_info23']);
    array_push($data, $_POST['q9_info24']);
    array_push($data, $_POST['q9_info31']);
    array_push($data, $_POST['q9_info32']);
    array_push($data, $_POST['q9_info33']);
    array_push($data, $_POST['q9_info34']);
    array_push($data, $_POST['q9_info41']);
    array_push($data, $_POST['q9_info42']);
    array_push($data, $_POST['q9_info43']);
    array_push($data, $_POST['q9_info44']);
    array_push($data, $_POST['q9_info51']);
    array_push($data, $_POST['q9_info52']);
    array_push($data, $_POST['q9_info53']);
    array_push($data, $_POST['q9_info54']);
    array_push($data, $_POST['q9_info61']);
    array_push($data, $_POST['q9_info62']);
    array_push($data, $_POST['q9_info63']);
    array_push($data, $_POST['q9_info64']);
    array_push($data, $_POST['q9_additional']);

    // add more rows - function check

    $temp = 0; //a counter which indicates whether each value in $data exists or not
    for ($i = 0; $i<18; $i++)
    {
        if(check_var($data[$i])){  //$data[$i] exists
            $temp++;
        }
    }
    $return = null;
    if($temp == 18){ //all the value in $data exist
        $return = add_info_q9($data);
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

