<?php

function sort_data($data, $table) {
	$tableNo = str_replace("table", "", $table);
	$singleD = array(1, 2, 3, 4, 7, 11, 12, 13);
    
	if (in_array($tableNo, $singleD)) {
		$result = singleD_information($data, $tableNo);
        
	} else {
		$result = doubleD_information($data, $tableNo);
        
	}
	return $result;
}

function singleD_information($data, $table) {
	$result = array();
	$data = array_slice($data, 2, -1);

	if ($table == 3) {
		$data = array_values($data);
		$numData = count($data);

		for ($i = 0; $i < $numData; $i++) {
			$key = "q".$table."_info".(intdiv($i, 2)+1 . $i%2+1);
			$temp = array($key => $data[$i]);
			$result = array_merge($result, $temp);
		}
	} elseif ($table > 10) {
		$data = array_values($data);

		$key = "q".$table."_info1";
		$result = array($key => $data[$table-11]);
	} else {
		$data = array_values($data);
		$numData = count($data);

		for ($i = 0; $i < $numData; $i++) {
			$key = "q".$table."_info".($i+1);
			$temp = array($key => $data[$i]);
			$result = array_merge($result, $temp);
		}
	}
	return $result;
}

function doubleD_information($data, $table) {
	$result = array();
	$numData = count($data);

	if ($table == 5) {
		for ($i = 0; $i < $numData; $i++) {
			$first;
			if ($data[$i]['status'] == "doNow") {
				$first = 1;
			} elseif ($data[$i]['status'] == "workingWell") {
				$first = 2;
			} else {
				$first = 3;
			}

			$second;
			if ($data[$i]['timeOfDay'] == "Morning") {
				$second = 1;
			} elseif ($data[$i]['timeOfDay'] == "Afternoon") {
				$second = 2;
			} else {
				$second = 3;
			}

			$key = "q".$table."_".strtolower($data[$i]['dayOfWeek']).$first.$second;
			$temp = array($key => $data[$i]['activity']);
			$result = array_merge($result, $temp);
		}
	} elseif ($table == 6) {
		for ($i = 0; $i < $numData; $i++) {
			$key = "q".$table."_info".($i+1)."1";
			$temp = array($key => $data[$i]['dailyActivity']);
			$result = array_merge($result, $temp);
		
			$key = "q".$table."_info".($i+1)."2";
			$temp = array($key => $data[$i]['dailySupport']);
			$result = array_merge($result, $temp);
		}
	} elseif ($table == 8) {
		for ($i = 0; $i < $numData; $i++) {
			$key = "q".$table."_info".($i+1)."1";
			$temp = array($key => $data[$i]['program']);
			$result = array_merge($result, $temp);
		
			$key = "q".$table."_info".($i+1)."2";
			$temp = array($key => $data[$i]['who']);
			$result = array_merge($result, $temp);

			$key = "q".$table."_info".($i+1)."3";
			$temp = array($key => $data[$i]['purpose']);
			$result = array_merge($result, $temp);

			$key = "q".$table."_info".($i+1)."4";
			$temp = array($key => $data[$i]['howOften']);
			$result = array_merge($result, $temp);

			if ($i == $numData-1) {
				$key = "q".$table."_additional";
				$temp = array($key => $data[$i]['owned']);
				$result = array_merge($result, $temp);                
			}
		}
	} elseif ($table == 9) {
		for ($i = 0; $i < $numData; $i++) {
			$key = "q".$table."_info".($i+1)."1";
			$temp = array($key => $data[$i]['what']);
			$result = array_merge($result, $temp);
		
			$key = "q".$table."_info".($i+1)."2";
			$temp = array($key => $data[$i]['forWhat']);
			$result = array_merge($result, $temp);

			$key = "q".$table."_info".($i+1)."3";
			$temp = array($key => $data[$i]['doWhen']);
			$result = array_merge($result, $temp);

			$key = "q".$table."_info".($i+1)."4";
			$temp = array($key => $data[$i]['howOften']);
			$result = array_merge($result, $temp);

			if ($i == $numData-1) {
				$key = "q".$table."_additional";
				$temp = array($key => $data[$i]['owned']);
				$result = array_merge($result, $temp);                
			}
		}
	} else {
		for ($i = 0; $i < $numData; $i++) {
			$first;

			if ($data[$i]['timeOfDay'] == "Morning") {
				$first = 1;
			} elseif ($data[$i]['timeOfDay'] == "Afternoon") {
				$first = 2;
			} else {
				$first = 3;
			}

			$key = "q".$table."_".strtolower($data[$i]['dayOfWeek']).$first;
			$temp = array($key => $data[$i]['activity']);
			$result = array_merge($result, $temp);
		}
	}
	return $result;
}
?>