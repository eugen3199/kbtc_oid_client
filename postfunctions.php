<?php
	session_start();
	// echo "<script>console.log('made it here');</script>";
	include "includes/qrgen.php";

	// Employee Create
	if(isset($_POST["empCreate"])){
		$url = 'http://localhost/kbtc_oid_server/backend.php';
		$empID = htmlspecialchars($_POST['empID']);
		$empName = htmlspecialchars($_POST['empName']);
		$NRC1 = htmlspecialchars($_POST['NRC1']);
		$NRC2 = htmlspecialchars($_POST['NRC2']);
		$NRC3 = htmlspecialchars($_POST['NRC3']);
		$NRC4 = htmlspecialchars($_POST['NRC4']);
		$empNRC = $NRC1.$NRC2.$NRC3.$NRC4;
		$empPositionID = htmlspecialchars($_POST['empPositionID']);
		$empDeptID = htmlspecialchars($_POST['empDeptID']);
		$empJoinDate = htmlspecialchars($_POST['empJoinDate']);
		$empKey = htmlspecialchars($_POST['empKey']);

		
		//Generate QR
		qrgen($empID, 'employee');

		$filename = 'assets/qrcodes/employee/'.$empID.'.png';

		if (file_exists($filename)) {
		    echo "The file $filename exists";
		} else {
		    echo "The file $filename does not exist";
		    die();
		}

		$data = array(
			'url' => $url,
			'empCreate' => True, 
			'empID' => $empID, 
			'empName' => $empName,
			'empNRC' => $empNRC,
			'empPositionID' => $empPositionID,
			'empDeptID' => $empDeptID,
			'empJoinDate' => $empJoinDate,
		);

		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) {
			$_SESSION['Message'] = $json->Message;
		}
		$json = json_decode($result);
		// echo $json->Message;
		$_SESSION['Message'] = $json->Message;

		header("Location:".$_SERVER['HTTP_REFERER']);
	}

?>