<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
if(isset($_SESSION['usuario_admin'])){
	header("Location:index.php");
	exit(0);
}
$ip = $_SERVER['REMOTE_ADDR'];
$data = time();
include('fw_painel/install/config.php');
?>
<!doctype html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

		<title>Painel - Habbig </title>
		<link href="css/login.css" type="text/css" rel="stylesheet" />
		<script src="js/jquery.js"></script>
		<script src="js/jquery-nav.js"></script>
<script> 
var deslogado = {
	verifica: true,
	login:function(){
		var usuario = $.trim($('#input_usr').val());
		var senha = $.trim($('#input_senha').val());
		if(usuario == '' || senha == ''){
			deslogado.alerta('vermelho','Preencha todos os campos.');
		}else{
			$.ajax({
				type:'POST',
				url:'ajax-ver/login',
				data:{'usuario':usuario, 'senha':senha},
				beforeSend:function(){
					$('#login-iniciar').animate({opacity:0.5});
				},success:function(html){
					$('#login-iniciar').animate({opacity:1});
					if(html == 'deu'){
						deslogado.alerta('verde','Habbig Painel - Bem Vindo');
						setTimeout("location.href='login.php'",1000);
					}else if(html == 'baned'){
						location.href='login.php';
					}else{
						deslogado.alerta('vermelho',html);
					}
				}
			});
		}
	},close:function(){
		$('.remove-alerta').submit(function(){
			$(this).html('kkkkkkk');
		});
	},alerta:function(cor, texto){
		html = '';
		if(cor == 'vermelho'){
			html += '<div id="alert_info" class="remove-alerta">';
		}else{
			html += '<div id="alert_info3" class="remove-alerta">';
		}
		html += texto;
		html += '</div>';
		$('#recebe-alerta').html(html);
	},esqueci:function(){
		if(deslogado.verifica){
			$('#alert_info2').show().animate({opacity:1});
		}else{
			$('#alert_info2').fadeOut(500).animate({opacity:0});
		}
		deslogado.verifica = !deslogado.verifica;
	},esqueceu:function(){
		var email = $('#input_esqueci_senha').val();
		$.ajax({
			type:'POST',
			url:'ajax-ver/esqueceu-senha',
			data:{'email':email},
			beforeSend:function(){
				$('#esqueceu-senha').animate({opacity:0.5});
			},success:function(html){
				$('#esqueceu-senha').animate({opacity:1});
				if(html == 'deu'){
					deslogado.alerta('verde','Você acabou de receber um email');
				}else{
					deslogado.alerta('vermelho',html);
				}
			}
		});
	}
}
$(function(){
	$('#login-iniciar').submit(function(){
		deslogado.login();
	});
	$('#esqueceu-senha').submit(function(){
		deslogado.esqueceu();
	});
});
</script>
</head>
<body>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
$data = time();
$procurar_ban = db::Query("SELECT * FROM painel_usuarios_ban WHERE ip='$ip'");
$ver_ban = db::NumRows($procurar_ban);
$ver_query = db::FetchArray($procurar_ban);
$acaba_ban = $ver_query['data'] + 300;
if($ver_ban == 0) :
?>
<div id="alerts">
	<div id="alert_info2" style="opacity:0.0;"><b>Digite seu e-mail:</b><br/><font style="font-size:12px;">(É o e-mail utilizado em seus dados do painel)</font><br/>
    <form action="javascript:;" id="esqueceu-senha"><input name="esquecisenha" id="input_esqueci_senha" /><input id="button_redefenir_senha" type="submit" name="esquecisenhaenviar" value="Enviar para este e-mail"/></form></div>
    <div id="recebe-alerta"></div>
</div>
<div id="corpo_login">
	<div id="logo"></div>
	<div id="bg_login_content">
		<div id="part1_dentr_login">
			<div id="usr_text_img"></div>
				<form action="javascript:;" id="login-iniciar">
					<input name="usuario" id="input_usr" /> 
					<div id="senha_text_img"></div>
					<input name="senha" type="password" id="input_senha" /> 
					<div id="box_mantenha_conectado"><input type="checkbox" id="lembrar" name="lembrar-me" /> <font style="float:left;margin-bottom:3px;"><label for="lembrar">Mantenha-me conectado</label></font></div>
					<div id="button_esqueci_senha" class="text_buttons_opc" onClick="deslogado.esqueci();" style="height:21px; padding:6px 0px;">Esqueci minha senha</div>
					<input name="submit"  type="submit" id="button_entrar" value="" />
<?php
else:
	if($data > $acaba_ban){
		db::Query("DELETE FROM painel_usuarios_ban WHERE id='$ver_query[id]' ");
		$logs_sql = db::Query("SELECT * FROM painel_usuarios_logs WHERE ip='$ip' ");
		while($ver_logs = db::FetchArray($logs_sql)){
			db::Query("DELETE FROM painel_usuarios_logs WHERE id='$ver_logs[id]' ");
		}
		echo('<script>location.href="index.php";</script>');
	}
?>
<div id="alerts">
	<div id="alert_info" class="remove-alerta">
    	<b>Painel inativo.</b><br>
        <?php
		$ip = $_SERVER['REMOTE_ADDR'];
		$agora = time();
        $procurar_sql = db::Query("SELECT * FROM painel_usuarios_ban WHERE ip='$ip' ");
		$ver_procura = db::FetchArray($procurar_sql);
		$total_falta = $ver_procura['data'] + 300;
		echo('O painel será libera ás <i>('.date("H:i:s", $total_falta).' Hrs.)</i>');
		?>
    </div>
</div>
<div id="corpo_login">
	<div id="logo"></div>
	<div id="bg_login_content">
		<div id="part1_dentr_login">
			<div id="usr_text_img"></div>
				<form action="javascript:;" id="login-iniciar">
					<input name="usuario" id="input_usr" /> 
					<div id="senha_text_img"></div>
					<input name="senha" type="password" id="input_senha" /> 
					<div id="box_mantenha_conectado"><input type="checkbox" id="lembrar" name="lembrar-me" /> <font style="float:left;margin-bottom:3px;"><label for="lembrar">Mantenha-me conectado</label></font></div>
					<div id="button_esqueci_senha" class="text_buttons_opc" style="height:21px; padding:6px 0px; opacity:0.5;">Esqueci minha senha</div>
					<div id="button_entrar" style="opacity:0.5;"></div>
<?php
endif;
?>
				</form>
		</div>
	</div>
	<div id="rodape">Copyright  2011 - <?php echo date('Y', time()); ?>. <b>DTH</b>.</div>
</div>
</body>
</html>