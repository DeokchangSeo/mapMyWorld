<?php
/*
 * Add answers entered by the user into DB.
 */
require "includes/defs.php";


$json;
$email = $_COOKIE['email'];
$data = array();
$data_new = array(); #for adding new tabs

$result = check_user($email);

if ($result['idUser']) {

    if(isset($_POST['q6'])){
        array_push($data,$result['idUser']);
        $info = $_POST['q6'];
        $num_info = count($info);

        foreach ($info as $value){
            $value = html_entity_decode($value);
            array_push($data,$value);
        }

        $temp = 0; //a counter which indicates whether each value in $data exists or not
        for ($i = 0; $i<$num_info; $i++)
        {
            if(check_var($data[$i])){  //$data[$i] exists
                $temp++;
            }
        }

        $return = null;
        if($temp == $num_info){ //all the value in $data exist
            $return = add_info_q6($data);
            $json = array ("result" => "success", "return" => $return);
        } else {
            $json = array ("result" => "missing value", "return" => $return);
        }
    }


    if(isset($_POST['q6_new'])){
        array_push($data_new,$result['idUser']);
        $info_new = $_POST['q6_new'];
        foreach ($info_new as $value){
            array_push($data_new,$value);
        }
        $t = 0; //a counter
        for ($i = 0; $i<3; $i++)
        {
            if(check_var($data_new[$i])){  //$data[$i] exists
                $t++;
            }
        }
        $return = null;
        if($t == 3){
            $return = add_info_q6_new($data_new);
            $json = array ("result" => "success", "return" => $return);
        } else {
            $json = array ("result" => "missing value", "return" => $return);
        }
    }
}else{
    $return = null;
    $json = array ("result" => "noUser", "return" => $return);
}

echo json_encode($json);
exit();
?>
