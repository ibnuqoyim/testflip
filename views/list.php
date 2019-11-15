<?php 
	
function table($data) {
 
// Find longest string in each column
$columns = [];
foreach ($data as $row_key => $row) {
foreach ($row as $cell_key => $cell) {
$length = strlen($cell);
if (empty($columns[$cell_key]) || $columns[$cell_key] < $length) {
$columns[$cell_key] = $length;
}
}
}
 
// Output table, padding columns
$table = '';
foreach ($data as $row_key => $row) {
foreach ($row as $cell_key => $cell)
$table .= str_pad($cell, $columns[$cell_key]) . '   ';
$table .= PHP_EOL;
}
return $table;
 
}

$fd = [
['ID PENCAIRAN', 'STATUS', 'TIME SERVED', 'TANGGAL PENGAJUAN']
];


foreach ($rs as $disburs => $list)
	{
		
		$ss = [$list['id_disburs'],$list['status_disburs'],$list['time_served'],$list['created_at']];
		array_push($fd, $ss);
	
	}
echo table($fd);

?>
