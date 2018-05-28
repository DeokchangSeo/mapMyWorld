<?php
/*
 * Add new user.
 */
require "includes/defs.php";

//session_start();

$json;
$name = $_POST['user'];
$email = $_POST['email'];
//$_COOKIE['currentUser'];

$result = check_user($email);

if ($result['email'] == $email) {
    $_COOKIE['currentUser'] = $email;

    $data = $email." is already existing.";
    $json = array ("result" => "existingUser", "return" => $email);
} else {
    $_COOKIE['currentUser'] = $result['email'];

    $data = add_user($name, $email);
    $json = array ("result" => "success", "return" => $data);
}

echo json_encode($json);

exit();
?>