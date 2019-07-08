<?php

//insert.php

$connect = new PDO("mysql:host=localhost;dbname=db_inventory", "root", "");

$query = "
INSERT INTO tb_permintaan_pembeliandet 
(id,id_pp,id_brg, qty) 
VALUES (:id_pp :id_brg, :qty)
";

for($count = 0; $count<count($_POST['hidden_ID_BRG']); $count++)
{
	$data = array(
		':id'	=>	$_POST['hidden_row_id'][$count],
		':id_pp'	=>	$_POST['ID_PERM_PEMBELIAN'][$count],
		':id_brg'	=>	$_POST['hidden_ID_BRG'][$count],
		':qty'	=>	$_POST['hidden_Qty'][$count]
	);
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

?>