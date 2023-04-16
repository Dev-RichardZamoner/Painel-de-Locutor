<?php
session_start();
//include('../functions/site.php');
include('../install/config.php');
$email = trim(htmlspecialchars(addslashes($_POST['email'])));
if(isset($email)) :
	$procurar_email = db::Query("SELECT * FROM painel_usuarios WHERE email='$email'");
	$ver = db::FetchArray($procurar_email);
	if($ver == 0) :
		echo('fail');
	else:
		/* enviar msg email */
		$corpo .= "Olá $ver[usuario] parece que você nós enviou um pedido de recuperação de senha.\n";
		$corpo .= "Sua senha atual: $ver[senha]\n\n";
		$corpo .= "Equipe Fwdesign";
		mail("$email","Esqueceu a senha ?","$corpo","From:webmaster@fwdesign.com.br");
		echo('deu');
	endif;
else:
	echo('sai daki nub');
endif;