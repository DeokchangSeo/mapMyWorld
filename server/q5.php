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
    array_push($data, $_POST['q5_mon11']);
    array_push($data, $_POST['q5_mon21']);
    array_push($data, $_POST['q5_mon31']);
    array_push($data, $_POST['q5_mon12']);
    array_push($data, $_POST['q5_mon22']);
    array_push($data, $_POST['q5_mon32']);
    array_push($data, $_POST['q5_mon13']);
    array_push($data, $_POST['q5_mon23']);
    array_push($data, $_POST['q5_mon33']);

    array_push($data, $_POST['q5_tue11']);
    array_push($data, $_POST['q5_tue21']);
    array_push($data, $_POST['q5_tue31']);
    array_push($data, $_POST['q5_tue12']);
    array_push($data, $_POST['q5_tue22']);
    array_push($data, $_POST['q5_tue32']);
    array_push($data, $_POST['q5_tue13']);
    array_push($data, $_POST['q5_tue23']);
    array_push($data, $_POST['q5_tue33']);

    array_push($data, $_POST['q5_wed11']);
    array_push($data, $_POST['q5_wed21']);
    array_push($data, $_POST['q5_wed31']);
    array_push($data, $_POST['q5_wed12']);
    array_push($data, $_POST['q5_wed22']);
    array_push($data, $_POST['q5_wed32']);
    array_push($data, $_POST['q5_wed13']);
    array_push($data, $_POST['q5_wed23']);
    array_push($data, $_POST['q5_wed33']);

    array_push($data, $_POST['q5_thu11']);
    array_push($data, $_POST['q5_thu21']);
    array_push($data, $_POST['q5_thu31']);
    array_push($data, $_POST['q5_thu12']);
    array_push($data, $_POST['q5_thu22']);
    array_push($data, $_POST['q5_thu32']);
    array_push($data, $_POST['q5_thu13']);
    array_push($data, $_POST['q5_thu23']);
    array_push($data, $_POST['q5_thu33']);

    array_push($data, $_POST['q5_fri11']);
    array_push($data, $_POST['q5_fri21']);
    array_push($data, $_POST['q5_fri31']);
    array_push($data, $_POST['q5_fri12']);
    array_push($data, $_POST['q5_fri22']);
    array_push($data, $_POST['q5_fri32']);
    array_push($data, $_POST['q5_fri13']);
    array_push($data, $_POST['q5_fri23']);
    array_push($data, $_POST['q5_fri33']);

    array_push($data, $_POST['q5_sat11']);
    array_push($data, $_POST['q5_sat21']);
    array_push($data, $_POST['q5_sat31']);
    array_push($data, $_POST['q5_sat12']);
    array_push($data, $_POST['q5_sat22']);
    array_push($data, $_POST['q5_sat32']);
    array_push($data, $_POST['q5_sat13']);
    array_push($data, $_POST['q5_sat23']);
    array_push($data, $_POST['q5_sat33']);

    array_push($data, $_POST['q5_sun11']);
    array_push($data, $_POST['q5_sun21']);
    array_push($data, $_POST['q5_sun31']);
    array_push($data, $_POST['q5_sun12']);
    array_push($data, $_POST['q5_sun22']);
    array_push($data, $_POST['q5_sun32']);
    array_push($data, $_POST['q5_sun13']);
    array_push($data, $_POST['q5_sun23']);
    array_push($data, $_POST['q5_sun33']);

    array_push($data, $_POST['q5_hobby']);
    array_push($data, $_POST['q5_interest']);

    $temp = 0; //a counter which indicates whether each value in $data exists or not
    for ($i = 0; $i<66; $i++)
    {
        if(check_var($data[$i])){  //$data[$i] exists
            $temp++;
        }
    }
    $return = null;
    if($temp == 66){ //all the value in $data exist
        $return = add_info_q5($data);
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

