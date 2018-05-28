<?php
require "db_defs.php";

date_default_timezone_set('Australia/Brisbane');
$date = date('m/d/Y h:i:s a', time());

function check_var( $var){
    //return( (isset($var) and !empty($var )) ? $var : (!empty($default) ? $default : false) );
    return( isset($var) and !empty($var) and trim($var) );
}

function check_user($email) {

    try {
        $db = get_db();

        $query ="select * from user where BINARY email=:email";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        else
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->rowCount();
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function get_info($idUser, $table) {
	$tableNo = str_replace("table", "", $table);
    try {
        $db = get_db();

        $query ="select * from ".$table." where idUser=:idUser order by idT" .$tableNo;

        $stmt = $db->prepare($query);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if($stmt->rowCount() == 1)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        else if($stmt->rowCount() > 1)
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->rowCount();
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_user($name, $email) {

    try {
		$db = get_db();

		$query ="insert into user(name, email, created) values(:name, :email, :date)";

		$stmt = $db->prepare($query);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":date", $date);
		$stmt->execute();

		return $email;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function add_info_q1($data) {
	if(check_userID($data[0], "table1")) {
		delete_info($data[0], "table1");
	}

	try {
		$db = get_db();

		$query ="insert into table1(idUser, t1Info1, t1Info2, t1Info3, t1Info4) values(:0, :1, :2, :3, :4)";

		$stmt = $db->prepare($query);
		$stmt->bindParam(":0", $data[0]);
		$stmt->bindParam(":1", $data[1]);
		$stmt->bindParam(":2", $data[2]);
		$stmt->bindParam(":3", $data[3]);
		$stmt->bindParam(":4", $data[4]);
		$stmt->execute();

		return $data[0];
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function add_info_q2($data) {
    if(check_userID($data[0], "table2")) {
        delete_info($data[0], "table2");
    }

    try {
        $db = get_db();

        $query ="insert into table2(idUser, t2Info1, t2Info2, t2Info3, t2Info4) values(:0, :1, :2, :3, :4)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->bindParam(":2", $data[2]);
        $stmt->bindParam(":3", $data[3]);
        $stmt->bindParam(":4", $data[4]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q3($data) {
    if(check_userID($data[0], "table3")) {
        delete_info($data[0], "table3");
    }

    try {
        $db = get_db();

        $query ="insert into table3(idUser, family, closeF, worker, closeW, supporter, closeS, other, closeO) values(:0, :1, :2, :3, :4, :5, :6, :7, :8)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->bindParam(":2", $data[2]);
        $stmt->bindParam(":3", $data[3]);
        $stmt->bindParam(":4", $data[4]);
        $stmt->bindParam(":5", $data[5]);
        $stmt->bindParam(":6", $data[6]);
        $stmt->bindParam(":7", $data[7]);
        $stmt->bindParam(":8", $data[8]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q4($data) {
    if(check_userID($data[0], "table4")) {
        delete_info($data[0], "table4");
    }

    try {
        $db = get_db();

        $query ="insert into table4(idUser, house, cohabitant, helper, activity, equipment) values(:0, :1, :2, :3, :4, :5)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->bindParam(":2", $data[2]);
        $stmt->bindParam(":3", $data[3]);
        $stmt->bindParam(":4", $data[4]);
        $stmt->bindParam(":5", $data[5]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q5($data) {
    if(check_userID($data[0], "table5")) {
        delete_info($data[0], "table5");
    }

    $dayOfWeek = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    $timeOfDay = array("Morning", "Afternoon", "Evening");
    $status = array("doNow", "workingWell", "notWorkingWell");

    try {
        $db = get_db();

        $query ="insert into table5(idUser, dayOfWeek, timeOfDay, status, activity) values(:0, :1, :2, :3, :4)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);

        for ($i=0; $i<63; $i++) {
            $stmt->bindParam(":1", $dayOfWeek[intdiv($i, 9)]);
            $stmt->bindParam(":2", $timeOfDay[intdiv($i%9, 3)]);
            $stmt->bindParam(":3", $status[$i%3]);
            $stmt->bindParam(":4", $data[$i+1]);
            $stmt->execute();
        }

        $query ="update user set hobby=:1, interest=:2 where idUser=:0";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[64]);
        $stmt->bindParam(":2", $data[65]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q6($data) {
    if(check_userID($data[0], "table6")) {
        delete_info($data[0], "table6");
    }

    $numOfRow = count($data);

    try {
        $db = get_db();

        $query ="insert into table6(idUser, dailyActivity, dailySupport) values(:0, :1, :2)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);

        for ($i = 1; $i < $numOfRow/2; $i++) {
            $stmt->bindParam(":1", $data[$i*2-1]);
            $stmt->bindParam(":2", $data[$i*2]);
            $stmt->execute();
        }

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q6_new($data) {

    try {
        $db = get_db();

        $query ="insert into table6(idUser, dailyActivity, dailySupport) values(:0, :1, :2)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->bindParam(":2", $data[2]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q7($data) {
    if(check_userID($data[0], "table7")) {
        delete_info($data[0], "table7");
    }

    try {
        $db = get_db();

        $query ="insert into table7(idUser, currentHealth, importantThing, goingWell, notWorkingWell) values(:0, :1, :2, :3, :4)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->bindParam(":2", $data[2]);
        $stmt->bindParam(":3", $data[3]);
        $stmt->bindParam(":4", $data[4]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q8($data) {
    if(check_userID($data[0], "table8")) {
        delete_info($data[0], "table8");
    }

    $numOfRow = count($data);

    try {
        $db = get_db();

        $query ="insert into table8(idUser, program, who, purpose, howOften, owned) values(:0, :1, :2, :3, :4, :5)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":5", $data[$numOfRow-1]);

        for ($i = 1; $i < $numOfRow/4; $i++) {
            $stmt->bindParam(":1", $data[$i*4-3]);
            $stmt->bindParam(":2", $data[$i*4-2]);
            $stmt->bindParam(":3", $data[$i*4-1]);
            $stmt->bindParam(":4", $data[$i*4]);
            $stmt->execute();
        }

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q9($data) {
    if(check_userID($data[0], "table9")) {
        delete_info($data[0], "table9");
    }

    $numOfRow = count($data);

    try {
        $db = get_db();

        $query ="insert into table9(idUser, what, forWhat, doWhen, howOften, owned) values(:0, :1, :2, :3, :4, :5)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":5", $data[$numOfRow-1]);

        for ($i = 1; $i < $numOfRow/4; $i++) {
            $stmt->bindParam(":1", $data[$i*4-3]);
            $stmt->bindParam(":2", $data[$i*4-2]);
            $stmt->bindParam(":3", $data[$i*4-1]);
            $stmt->bindParam(":4", $data[$i*4]);
            $stmt->execute();
        }

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q10($data) {
    if(check_userID($data[0], "table10")) {
        delete_info($data[0], "table10");
    }

    $dayOfWeek = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
    $timeOfDay = array("Morning", "Afternoon", "Evening");

    try {
        $db = get_db();

        $query ="insert into table10(idUser, dayOfWeek, timeOfDay, activity) values(:0, :1, :2, :3)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);

        for ($i=0; $i<21; $i++) {
            $stmt->bindParam(":1", $dayOfWeek[intdiv($i, 3)]);
            $stmt->bindParam(":2", $timeOfDay[$i%3]);
            $stmt->bindParam(":3", $data[$i+1]);
            $stmt->execute();
        }

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q11($data) {
    if(check_userID($data[0], "table11")) {
        //delete_info($data[0], "table11");
    } else {
        $db = get_db();

        $query ="insert into table11(idUser) values(:0)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->execute();
    }
                
    try {
        $db = get_db();
        $query ="update table11 set shortTerm=:1 where idUser=:0";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q12($data) {
    if(check_userID($data[0], "table11")) {
        //delete_info($data[0], "table11");
    } else {
        $db = get_db();

        $query ="insert into table11(idUser) values(:0)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->execute();
    }
                
    try {
        $db = get_db();
        $query ="update table11 set longTerm=:1 where idUser=:0";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function add_info_q13($data) {
    if(check_userID($data[0], "table11")) {
        //delete_info($data[0], "table11");
    } else {
        $db = get_db();

        $query ="insert into table11(idUser) values(:0)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->execute();
    }
                
    try {
        $db = get_db();
        $query ="update table11 set bucketList=:1 where idUser=:0";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":0", $data[0]);
        $stmt->bindParam(":1", $data[1]);
        $stmt->execute();

        return $data[0];
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function get_users() {
    try {
        $db = get_db();
        $query ="select idUser, name, email, created from user order by idUser";

        $stmt = $db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        else
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->rowCount();
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function get_user_info_q11($idUser) {

    try {
        $db = get_db();

        $query ="select * from table11 where idUser=:idUser";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        else
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->rowCount();
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function check_userID($userID, $table) {

    try {
        $db = get_db();

        $query ="select * from ".$table." where idUser=:userID";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":userID", $userID);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        else
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $stmt->rowCount();
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function delete_info($userID, $table) {

	try {
		$db = get_db();

		$query ="delete from ".$table." where idUser=:userID";

		$stmt = $db->prepare($query);
		$stmt->bindParam(":userID", $userID);
		$stmt->execute();

	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

?>