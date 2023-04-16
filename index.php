<?php
session_start();
include('fw_painel/install/config.php');
include('fw_painel/functions/site.php');
include('fw_painel/functions/usuario.php');
$_SESSION['usuario_id_admin'] = Usuario::Dados('id');
if(!isset($_SESSION['usuario_admin'])){
	header ("location: login.php");
}
if(isset($_GET['deslogar'])){
	unset($_SESSION['usuario_admin']);
	echo('<script>location.href="index.php";</script>');
}/*
    $cp = $_GET["cp"];	
	$c = $_GET['c'];
	$tp_id= $_POST["tp_id"];*/
	if(Usuario::Dados(ativo) == 'nao'){
		echo('<script>location.href="?deslogar=sim";</script>');
	}
?>
<!doctype html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Painel - Habbig</title>
		<link href="css/principal.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="css/menu_lado.css" />
		<link rel="stylesheet" type="text/css" href="tt/tooltip.css" />
		<link rel="stylesheet" href="shadowbox/shadowbox.css" />
		<script type="text/javascript" language="javascript" src="tt/tooltip.js"></script>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/menu_script.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
	</head>
<script type="text/javascript"> 
	Shadowbox.init({
		handleOversize: "drag",
		overlayColor:  "#000000 ",
		autoplayMovies: true,
		modal:  false,
		players:  ['img', 'iframe','swf','html'] 
	});
</script>
<script> 
$(document).ready(function(){
	$("#total_notificacoes").click(function(){
		//$("#content_notificacoes").fadeToggle(126);
		$.ajax({
			type:'POST',
			url:'ajax-ver/notificacao',
			success:function(html){
				$('#total_notificacoes').html(0);
				$('title').html('(0) GCpanel - Generator Content 2.1');
			}
		});
		$('#total_notificacoes').html(0);
	});
});
</script>
<body>
<div id="content_notificacoes">
<div id="dentro_content_notificacoes">
<div id="title_notificacoes">Notificações</div>
<div style="height:316px; overflow-x:hidden; overflow-y:auto; clear:both;">
<?php
$criador = $_SESSION['usuario_admin'];
$sql = db::Query("SELECT * FROM painel_notificacao ORDER BY id DESC LIMIT 30");
/* total de notificacao */
$total_notificacao = db::NumRows(db::Query("SELECT * FROM painel_notificacao"));
/* total eu ja vi */
$total_li = db::NumRows(db::Query("SELECT * FROM painel_notificacao_lida WHERE usuario='$criador'"));
/* total final */
$total_final = $total_notificacao - $total_li;
while($ver = db::FetchArray($sql)){
?>
<div id="lista_notificacoes">
<div id="imagem_notificacoes" style="background:#617685;">
<div id="dentro_imagem_notificacoes" style="background:url(imagens/icones_menu/moderacao.png) center no-repeat;"></div>
</div>
<div id="text_lista_notificacoes"><b>Encooder</b> <?php echo $ver['texto']; ?></div>
<div id="data_postado_notificacoes">ha <?php echo Site::tempoAtras($ver['data']); ?></div>
</div>
<?php } ?>
</div>
<a href="#"><div id="ver_todas_notificacoes">Ver todas</div></a>
</div>
</div>
<div id="barra_topo_logado">
<div id="content_topo_logado">
<div id="base_avatar_logado">
<div style="width:39px; height:46px; float:left; margin-left:7px; margin-top:1px; background:url(http://www.habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $_SESSION['usuario_admin']; ?>&action=std&direction=3000002&head_direction=2999995&gesture=sml&size=m) -13px -18px;"></div>
</div>
<div id="base_text_topo" class="text_barra_topo_logado">Logado como <b><?php echo $_SESSION['usuario_admin']; ?></b> | Seu cargo <b><?php $sql_c = mysql_query("SELECT * FROM painel_usuario_rel r, painel_cargos t WHERE r.tp_usr_id=t.tp_usr_id AND r.usr_id='".$_SESSION['usuario_id_admin']."' ORDER BY t.tp_usr_ordem");while($ver_c=mysql_fetch_array($sql_c)){echo $ver_c['tp_usr_nome'].",";}?></b></div>
<div id="base_notificacao_topo">
<div id="icone_aviso_notificacao"></div>
<a href="#"><div id="total_notificacoes">0</div></a>
</div>
<div id="base_barra_topo_esq">
<div id="icone_data_hora"></div>
<div id="base_text_topo" class="text_barra_topo_logado">
<script type="text/javascript">
data = new Date();
dia = data.getDate();
mes = data.getMonth();
ano = data.getFullYear();
meses = new Array(12);
meses[0] = "01";
meses[1] = "02";
meses[2] = "03";
meses[3] = "04";
meses[4] = "05";
meses[5] = "06";
meses[6] = "07";
meses[7] = "08";
meses[8] = "09";
meses[9] = "10";
meses[10] = "11";
meses[11] = "12";
document.write ("Hoje é dia "+ dia +"/" + meses[mes] + "/" + ano);
</script>, agora  <span id="pendule"></span> 
<script language="javascript" type="text/javascript"> 
function clock() {
var digital = new Date();
var hours = digital.getHours();
var minutes = digital.getMinutes();
var seconds = digital.getSeconds();
var amOrPm = "AM";
if (hours > 11) amOrPm = "PM";
if (hours > 24) hours = hours - 24;
if (hours == 0) hours = 24;
if (minutes <= 9) minutes = "0" + minutes;
if (seconds <= 9) seconds = "0" + seconds;
dispTime = ''+ hours + ":" + minutes + ":" + seconds + " " + amOrPm+'';
document.getElementById('pendule').innerHTML = dispTime;
setTimeout("clock()", 1000);}
window.onload=clock;
</script>
</div>
</div>
</div>
</div>
<div id="bg_nav_left">
<div id="logo"></div>
<a href="?deslogar=sim"><button id="button_deslogar">Deslogar</button></a>
<a href="index.php"><button id="button_chat">Pagina inicial</button></a>
<div id="content_ultimo_acesso">ultimo acesso: <?php echo date('d/m/Y', Usuario::Dados('ultima_data')); ?> ás <?php echo date('H:i:s', Usuario::Dados('ultima_data')); ?></div>
<ul class="container">
<li class="menu">


<?php
	$sql = "SELECT * \n".
			"FROM painel_canais c, painel_permissao p, painel_usuario_rel r \n".
			"WHERE c.aca_status = 'Ativo' \n".
			"AND r.usr_id='".$_SESSION["usuario_id_admin"]."'\n".
			"AND r.tp_usr_id=p.tp_usr_id\n".
			"AND c.aca_id=p.aca_id \n".
			"AND (c.aca_pai IS NULL OR c.aca_pai = 0) \n".
			"GROUP BY p.aca_id\n".
			"ORDER BY c.aca_ordem";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
?>
<!-- Inicia menu -->
<li class="button">
<a class="blue"><div id="icone_menu_lado" style="background:url(imagens/icones_menu/<?php echo $row['aca_imagem']?>) center no-repeat;"></div><?php echo $row['aca_nome']?></a></li>
<li class="dropdown">
<div id="flecha_submenu_nav"></div>
<ul>
<?php
			$vlogs = "SELECT * \n".
			"FROM painel_canais c, painel_permissao p, painel_usuario_rel r \n".
			"WHERE c.aca_status = 'Ativo' \n".
			"AND r.usr_id='".$_SESSION["usuario_id_admin"]."'\n".
			"AND r.tp_usr_id=p.tp_usr_id\n".
			"AND c.aca_id=p.aca_id \n".
			"AND c.aca_pai = '$row[aca_id]' \n".
			"GROUP BY p.aca_id\n".
			"ORDER BY c.aca_ordem";
			$ress = mysql_query($vlogs);
			$total_acho = mysql_num_rows($ress);
			if($total_acho == 0){
				echo('<div style="padding-bottom:4px;"><font color="#FFF"><center>Sem acesso.</center></font></div>');
			}else{
				while($af = mysql_fetch_array($ress)){
?>
	<li><a href="index.php?cp=<?php echo $row['aca_id']; ?>&c=<?php echo $af['aca_id']; ?>"><?php echo $af['aca_nome']; ?></a></li>
<?php } } ?>
</ul>
<!-- Encerra menu -->
<?php
	}
?>
</ul>
<div id="rodape_nav">
<div id="content_rodape_nav" class="text_rodape_nav">Copyright DTH </div>
</div>
</div>
<?php
	include('fw_painel/modulos/conteudo.php');
?>
</body>
</html>