<?php
/*
 * Retrieve information from the table.
 */
require "includes/retrieval.php";
require "includes/defs.php";

$json; $result; $return;
$email = $_COOKIE['email'];
$table = $_POST['table'];
$user = check_user($email);

if ($table == "index") {   //index page
	$result = "currentUser";
	$return = $user['name'];
} else {
	$tableNo = str_replace("table", "", $table);
	$sqlTable = $table;

	if ($tableNo > 10) {
		if ($tableNo > 13) {
			exit();
		} else {
			$sqlTable = "table11";
		}
	}

	if ($user != 0) {
		$data = get_info($user['idUser'], $sqlTable);

		if ($data > 0) {
			$sortedData = sort_data($data, $table);

			if ($tableNo == 5) {
				$key = "q".$tableNo."_hobby";
		        $temp = array($key => $user['hobby']);
		        $sortedData = array_merge($sortedData, $temp);

		        $key = "q".$tableNo."_interest";
		        $temp = array($key => $user['interest']);
		        $sortedData = array_merge($sortedData, $temp);
			}

			$result = "success";
			$return = $sortedData;
		} else {
		    $result = "noData";
		}
	}
}

$json = array ("result" => $result, "return" => $return);
echo json_encode($json);

exit();
?>