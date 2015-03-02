<?php
define("HOST","");
define("USER","");
define("PASSWORD","");
define("_DB_MAIN","");

// Code to deal with sharing of theme @ fccthemes lab
if (isset($_GET['task'])) {
	if ($_GET['task'] == 'SAVE' && isset($_GET['t'])) {
		// save this theme and return the key
		$con = mysql_connect(HOST, USER, PASSWORD);
		mysql_select_db(_DB_MAIN);
		// Generate a random and unique key
		$key = '';
		while(true) {
			$k = substr(md5(uniqid()), 0, 7);
			$q = mysql_query("SELECT `id` FROM `themes` WHERE `key` = '$k'");
			if (!mysql_num_rows($q)) {
				$key = $k;
				break;
			}			
		}

		$json = htmlspecialchars($_GET['t']);
		mysql_query("INSERT INTO `themes`(`key`, `json`) VALUES ('$key', '$json')");
		echo json_encode(array('error' => false, 'key' => $k));
		exit;
	} else {
		echo json_encode(array('error' => true, 'message' => 'insufficient credentials'));
		exit;
	}
} else if (isset($_GET['k'])) {
	$con = mysql_connect(HOST, USER, PASSWORD);
	mysql_select_db(_DB_MAIN);
	$k = mysql_real_escape_string($_GET['k']);
	$q = mysql_query("SELECT `json` FROM `themes` WHERE `key` = '$k'");
	if (!mysql_num_rows($q)) {
		// Show default image
		echo json_encode(array('error' => true, 'message' => "invalid key"));
		exit;
		// #todo - show default image
	} else {
		$row = mysql_fetch_array($q);
		$j = htmlspecialchars_decode($row['json']);
		$j = json_decode($j, true);
		var_dump($j);exit;
	}

} else {
	echo json_encode(array('error' => true, 'message' => 'insufficient credentials'));
	exit;
}

?>