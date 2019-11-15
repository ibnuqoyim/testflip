<?php
include_once("model/Model.php");

class Controller {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Model();

    } 
	
	public function index()
	{
		//echo system('php disburse.php');
		echo "Ketik 0 untuk keluar, 1 untuk ke menu utama :";
		$handle = fopen ("php://stdin","r");
		$line = fgets($handle);
		if(trim($line) == '0'){
   			echo "Selamat Tinggal!\n";
    		exit;
		}
		require('disburse.php');
	}

	function save($param)
	{ 
		$this->model->saveData($param);

		$this->index(); //controller dikembalikan ke method index setelah selesai mengakses method ini.
	}

	function show_data($transaction_id)
	{
		
		$this->model->lihatDataDetail($transaction_id);
		$this->index();//controller dikembalikan ke method index setelah selesai mengakses method ini.
	}

	function show_list()
	{
		$rs = $this->model->lihatData();
		require_once('views/list.php');
		$this->index(); //controller dikembalikan ke method index setelah selesai mengakses method ini.
	}

}

?>