<?php
$cp = $_GET['cp'];	
$c = $_GET['c'];
if(isset($c)){

	$nav = $c;

}else{

	$nav = $cp;

}

if(!$nav){

	//$nav = $admin["paizao"];

}

if($nav){

			$sql = "SELECT * FROM painel_canais c \n".

					"WHERE c.aca_id LIKE '$nav' \n".

					"AND c.aca_status='Ativo'\n".

					"LIMIT 1";

			$sql = "SELECT * FROM painel_canais c, painel_permissao p , painel_usuario_rel r \n".

					"WHERE c.aca_id LIKE '$nav' \n".

					"AND r.usr_id='".$_SESSION["usuario_id_admin"]."'\n".

					"AND r.tp_usr_id=p.tp_usr_id\n".

					"AND c.aca_id=p.aca_id \n".

					"GROUP BY p.aca_id\n".

					"LIMIT 1";

			$res = mysql_query($sql);

			if(mysql_num_rows($res) > 0){

				$row = mysql_fetch_array($res);

				include(''.$row['aca_diretorio'].'');
				//include('fw_painel/modulos/pai.php');
				
			}else{
						include('fw_painel/modulos/erro.php');

			}
		}else{
			include('fw_painel/modulos/inicio.php');
		}
		$arquivo = ("../logs/painel.html");
		$fp = fopen("$arquivo", "a");
		if(isset($c)){
			fwrite($fp,'<br/ >Usuario: '.$_SESSION['usuario_admin'].' | Canal: index.php?cp='.$cp.'&c='.$c.' | Data: '.date('d/m/y',time()).' ás '.date('H:i:s',time()).' | IP: '.$_SERVER['REMOTE_ADDR'].'<br>');
			db::Query("INSERT INTO logs_painel(ip, data, usuario, canal) VALUES ('".$_SERVER['REMOTE_ADDR']."','".time()."','".$_SESSION['usuario_admin']."','index.php?cp=".$cp."&c=".$c."') ");
		}else{
			db::Query("INSERT INTO logs_painel(ip, data, usuario, canal) VALUES ('".$_SERVER['REMOTE_ADDR']."','".time()."','".$_SESSION['usuario_admin']."','index.php?cp=".$cp."') ");
			fwrite($fp,'<br/ >Usuario: '.$_SESSION['usuario_admin'].' | Canal: index.php?cp='.$cp.' | Data: '.date('d/m/y',time()).' ás '.date('H:i:s',time()).' | IP: '.$_SERVER['REMOTE_ADDR'].'<br>');
		}
		fclose($fp);	
?>       