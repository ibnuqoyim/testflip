<?php
	include_once 'config/config.php';
	include_once 'config/Database.php';
	class Model {
	function __construct()
	{
		$this->dbh = Database::getInstance();
	}


	function saveData($param)
	{

		$header = array(
			"Content-Type: application/x-www-form-urlencoded",
		);

		$url = 'https://nextar.flip.id/disburse';

		$result = self::http_post($param,$url,$header);
		$result = json_decode($result); 
		// insert to database
		$id_disburs 	= ''; 
		$status_disburs = '';
		$receipt 		= '';
		$time_served 	= ''; 

		if (isset($result->status) === true) {
			$id_disburs 	= $result->id;
			$status_disburs = $result->status;
			$receipt 		= $result->receipt;
			$time_served 	= $result->time_served;
		}

		$request = json_encode($param);
		$response = json_encode($result);	
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('Y-m-d H:i:s'); 
		$rs = $this->dbh->query("INSERT INTO disburs (api,id_disburs,time_served,status_disburs,receipt,request,response,created_at,updated_at) VALUES ('".$url."','".$id_disburs."','".$time_served."','".$status_disburs."','".$receipt."','".$request."','".$response."','".$datetime."','".$datetime."')");
		echo "Pengajuan Anda sudah dalam proses \n";
		echo 'ID Pengajuan Anda : '.$id_disburs;
		echo "\n Harap simpan untuk melakukan pengecekan status\n";
	}

	function lihatData()
	{

		$rs = $this->dbh->query("SELECT * FROM disburs");
		return $rs;
	}

	function lihatDataDetail($transaction_id)
	{
		$header = array(
			"Content-Type: application/x-www-form-urlencoded",
		);

		$url = URL.$transaction_id;

		$result = self::http_get($url,$header);
		$result = json_decode($result); 
			// update to database
			$status_disburs = '';
			$receipt 		= '';
			$time_served 	= ''; 
	
			if (isset($result->status) === true) {
				$status_disburs = $result->status;
				$receipt 		= $result->receipt;
				$time_served 	= $result->time_served;
			}
			$response = json_encode($result);
			date_default_timezone_set('Asia/Jakarta');
			$updated_at = date('Y-m-d H:i:s'); 
			$this->dbh->query("UPDATE disburs  SET status_disburs ='$status_disburs', receipt = '$receipt', time_served = '$time_served', response = '$response', updated_at = '$updated_at' WHERE id_disburs=".$transaction_id);

		echo 'Pengajuan dengan ID : '.$transaction_id.' statusnya '.$status_disburs;
		echo "\n";
	}

	public static function http_get($url,$header)
	{

		$ch = curl_init();
		
		$secret_key = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
	
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_USERPWD, $secret_key.":");

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;

	}

	public static function http_post($param,$url,$header) {
		$ch = curl_init();

		$secret_key = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		curl_setopt($ch, CURLOPT_USERPWD, $secret_key.":");

		$response = curl_exec($ch);
		curl_close($ch);
        return $response;
    }
	
	
}


?>
