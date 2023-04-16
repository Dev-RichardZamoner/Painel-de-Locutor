<?php
session_start();
include('../install/config.php');
function anti_injecao($palavra)
{
	// remove palavras que contenham sintaxe sql
	$palavra = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|\\\\)/"),"",$palavra);
	//$palavra = preg_replace(sql_regcase("from | select | insert | delete | where | drop table |show tables"),"",$palavra);
	//$palavra = preg_replace(sql_regcase("drop table|delete|insert"),"",$palavra);
	$palavra = trim($palavra);//limpa espaços vazio
	$palavra = strip_tags($palavra);//tira tags html e php
	$palavra = addslashes($palavra);//Adiciona barras invertidas a uma string
	return $palavra;
}
$usuario = anti_injecao($_POST['usuario']);
$senha = anti_injecao($_POST['senha']);
$ip = $_SERVER['REMOTE_ADDR'];
$data = time();
$data_tempo = $data + 300;
if(isset($usuario)) :
	$sql = db::Query("SELECT * FROM painel_usuarios WHERE usuario='$usuario' AND ativo='sim'");
	$ver = db::FetchArray($sql);
	$total = db::NumRows($sql);
	if($total == 1) :
		if($ver['senha'] != $senha) :
			$inserir_erro = db::Query("INSERT INTO painel_usuarios_logs(usuario, ip, data) VALUES ('$usuario','$ip','$data') ");
			$senha_fail = db::Query("SELECT * FROM painel_usuarios_logs WHERE data < $data_tempo AND ip='$ip'");
			$total_chances = db::NumRows($senha_fail);
			$chances = 5 - $total_chances;
			if($total_chances > 4) :
				$inserir_ban = db::Query("INSERT INTO painel_usuarios_ban(ip, data) VALUES ('$ip','$data') ");
				echo('baned');
			else:
				echo('A senha que você digitou esta <b>incorreta</b>. Tente novamente <i>(Você ainda tem '.$chances.' chances.)</i>');
			endif;
		else:
			echo('deu');
			$_SESSION['usuario_admin'] = $usuario;
			db::Query("UPDATE painel_usuarios SET ultima_data='$data', ultimo_ip='".$_SERVER['REMOTE_ADDR']."' WHERE usuario='$usuario'");
		endif;
	else:
		echo('Esse usuário não existe ou foi inativado!');
	endif;
else:
	echo('sai daki nub');
endif;