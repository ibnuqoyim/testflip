<?php 
include_once("controller/Controller.php");
	
	//buat objek dari class controller
$controller = new Controller();


echo "Selamat datang di Program Pencairan Dana \n";
echo "Silahkan Pilih Menu yang anda butuhkan dengan memilih angka 1-3 \n";

echo "1. Ajukan Pencairan \n";
echo "2. Cek Status Pencairan \n";
echo "3. Lihat History Pengajuan \n";

$handle = fopen ("php://stdin","r");
$line = fgets($handle);

switch (trim($line)) {
	case '1':
		echo "Anda Memilih Pengajuan, silahkan isi form berikut \n";
		echo "Bank Tujuan Pencairan :";
		
		$handle = fopen ("php://stdin","r");
		$bank_code	= fgets($handle);
		echo "No Rekening :";
		$handle = fopen ("php://stdin","r");
		$account_number	= fgets($handle);
		echo "Jumlah uang :";
		$handle = fopen ("php://stdin","r");
		$amount	= fgets($handle);
		echo "Remark :";
		$handle = fopen ("php://stdin","r");
		$remark	= fgets($handle);
		$param = [
			"account_number" =>$account_number,
			"bank_code" => $bank_code,
			"amount" =>$amount,
			"remark" =>$remark,
		];
		$controller->save($param);
		break;
	case '2':
		echo "Masukan ID Pencairan :";
		$handle = fopen ("php://stdin","r");
		$id_pen = trim(fgets($handle));
		$transaction_id	= intval($id_pen);
		$controller->show_data($transaction_id);
		break;
	case '3':
		$controller->show_list();
		break;	
	default:
		# code...
		break;
}

?>