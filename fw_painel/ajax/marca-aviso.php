<?php
include('../install/config.php');
$sql = db::Query("SELECT * FROM painel_avisos_lido WHERE id_aviso='".$_POST['id']."' AND usuario='".$_POST['usuario']."'");
$total = db::NumRows($sql);
if($total == 0){
	db::Query("INSERT INTO painel_avisos_lido (id_aviso, usuario, data) VALUES ('".$_POST['id']."','".$_POST['usuario']."','".time()."') ");
	echo('deu');
}else{
	echo('erro');
}