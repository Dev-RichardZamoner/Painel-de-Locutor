<?php
include('../install/config.php');
session_start();
$sql = db::Query("SELECT * FROM painel_notificacao");

/* total de notificacao */
$total_notificacao = db::NumRows(db::Query("SELECT * FROM painel_notificacao"));
/* total eu ja vi */
$total_li = db::NumRows(db::Query("SELECT * FROM painel_notificacao_lida WHERE usuario='$criador'"));
/* total final */
$total_final = $total_notificacao - $total_li;



echo('deu');