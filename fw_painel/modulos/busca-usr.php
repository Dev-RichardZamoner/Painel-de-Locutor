<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Moderação / Buscar Usuário</div>
<div id="content_title_pagina" class="title_pagina_barra">Buscar Usuário</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<div>
<FORM method="post"><INPUT style="width:80px;" type="submit" value="Buscar"> <INPUT type="text" name="palavra">
</FORM>
<?php
if(!empty($_POST["palavra"])){
        $palavra = str_replace(" ", "%", $_POST['palavra']);
        $qr = "SELECT * FROM usuarios WHERE usuario LIKE '".$palavra."' ORDER BY id DESC";
        // Executa a query no Banco de Dados
        $resutado = mysql_query($qr);
        // Conta o total ded resultados encontrados
        $total = mysql_num_rows($resutado);
        echo "Total de resultados $total.";
        // Gera o Loop com os resultados<br />
		$r= mysql_fetch_array($resutado);
       
}
?>
<br /><b><a href='index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&usuario=<?=$r["id"]?>' ><?=$r["usuario"]?></a></b>
<?php if(!empty($_GET['usuario'])){ ?>
<style>
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</style> 
<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.8.23/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="media/css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.8.24/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
<?php
$id = $_GET['usuario'];
$sql = db::Query("SELECT * FROM usuarios WHERE id='$id'");
$ver = db::FetchArray($sql);
$senha = $_POST['senha'];
$email = $_POST['email'];
$missao = $_POST['missao'];
$emailconfirmado = $_POST['emailconfirmado'];
$banido = $_POST['banido'];
$tempoban = $_POST['tempoban'];
$motivo_ban = $_POST['motivo_ban'];
if($_POST){
	mysql_query("UPDATE usuarios SET senha='$senha', email='$email', missao='$missao', confirmado='$emailconfirmado', banido='$banido', dia_ban='$tempoban', motivo_ban='$motivo_ban' WHERE id='$id'");
	echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'&usuario='.$id.'');
}
?>
<form method="post">
	Usuario:<br>
    <input type="text" name="usuario" value="<?php echo $ver['usuario'] ;?>"><br>
    Senha:<br>
    <input type="password" name="senha" value="<?php echo $ver['senha']; ?>"><br>
    Email:<br>
    <input type="text" name="email" value="<?php echo $ver['email'] ;?>"><br>
    Missão:<br>
    <input type="text" name="missao" value="<?php echo $ver['missao'] ;?>"><br>
    Email confirmado:<br>
    <select name="emailconfirmado">
    	<option value="sim"<?php if($ver['confirmado'] == 'sim'){echo(' selected');} ?>>Sim</option>
        <option value="nao"<?php if($ver['confirmado'] == 'nao'){echo(' selected');} ?>>Não</option>
    </select><br>
    Banido:<br>
    <select name="banido">
    	<option value="sim"<?php if($ver['banido'] == 'sim'){echo(' selected');} ?>>Sim</option>
        <option value="nao"<?php if($ver['banido'] == 'nao'){echo(' selected');} ?>>Não</option>
    </select><br>
    Banido até o dia:<br>
    <input type="text" name="tempoban" id="tempo" value="<?php echo $ver['dia_ban'] ;?>" /><br>
    Motivo ban:<br>
    <input type="text" name="motivo_ban" value="<?php echo $ver['motivo_ban']; ?>"><br>
    <script>
	$('#tempo').datetimepicker({
		addSliderAccess: true,
		sliderAccessArgs: { touchonly: false }
	});
    </script>
    <input type="submit" value="Editar">
</form>
<?php } ?>