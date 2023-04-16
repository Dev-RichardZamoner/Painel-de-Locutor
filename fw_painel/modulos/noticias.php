<!-- TinyMCE -->

<script type="text/javascript" src="/painel/ckeditor/ckeditor.js"></script>

<script src="/painel/ckeditor/_samples/sample.js" type="text/javascript"></script>

<link href="/painel/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript">



	tinyMCE.init({



		// General options



		mode : "textareas",



		theme : "advanced",



		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",







		// Theme options



		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect",



		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview",



		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,forecolor,backcolor",



		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,undo,redo,|,cite,abbr,acronym,del,|,print,|,ltr,rtl,|,fullscreen,|,charmap,iespell,media,advhr",



		theme_advanced_toolbar_location : "top",



		theme_advanced_toolbar_align : "left",



		theme_advanced_statusbar_location : "bottom",



		theme_advanced_resizing : true,







		// Example content CSS (should be your site CSS)



		content_css : "css/content.css",







		// Drop lists for link/image/media/template dialogs



		template_external_list_url : "lists/template_list.js",



		external_link_list_url : "lists/link_list.js",



		external_image_list_url : "lists/image_list.js",



		media_external_list_url : "lists/media_list.js",







		// Replace values for the template plugin



		template_replace_values : {



			username : "Some User",



			staffid : "991234"



		}



	});



</script>

<style>

body {

	margin:0;

	padding:0;

	list-style:none;

}

</style>

<div id="barra_title_pagina">

<div id="base_icone_local_pagina">

<div id="icone_local_pagina"></div>

</div>

<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Direção de conteúdo / Todas notícias</div>

<div id="content_title_pagina" class="title_pagina_barra">Todas notícias</div>

</div>

<script>

var apagar = {

	sim:function(id){

		if(confirm('Tem certeza que deseja apagar ?')){

			$.ajax({

				type:'GET',

				url:'index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=apagar&id='+id,

				data:{'id':id},

				success:function(html){

					alert('Apagado com sucesso!');

					location.reload();

				}

			});

		}

	}

}

</script>

<div id="lado_dir_content">

<div id="box_pagina_conteudo">

<div id="content_list_inser_registro">

</div>

<?php

$tipo = $_GET['tipo'];

$id = (int) $_GET['id'];

if($tipo == 'editar'){

	$sql = db::Query("SELECT * FROM noticias WHERE id='$id'");

	$ver = db::FetchArray($sql);

	$titulo = $_POST['titulo'];

	$resumo = $_POST['resumo'];

	$status = $_POST['status'];

	$revisado = $_POST['revisado'];

	$texto = $_POST['texto'];

	$tag1 = $_POST['tag1'];

	$tag2 = $_POST['tag2'];

	$tag3 = $_POST['tag3'];

	$categoria = $_POST['categoria'];

	$foto = $_FILES['imagem'];
	
	$fixo = $_POST['fixo'];

	if($_POST){

		if(!empty($foto["name"])){

				// Verifica se o arquivo é uma imagem

				if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $foto["type"])){

					$error[1] = "Isso n&atilde;o &eacute; uma imagem.";

				}

				// Se não houver nenhum erro

				if(count($error) == 0) {

					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

					$caminho_imagem = "uplouds/".$nome_imagem;

					move_uploaded_file($foto["tmp_name"], $caminho_imagem);

					db::Query("UPDATE noticias SET titulo='$titulo', resumo='$resumo', status='$status', revisado='$revisado', texto='$texto', tag1='$tag1', tag2='$tag2', tag3='$tag3', categoria='$categoria', imagem='$nome_imagem', fixo='$fixo' WHERE id='$id'");

		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');

				}else{

					foreach($error as $erro){

						echo $erro;

					}

				}

		}else{

			db::Query("UPDATE noticias SET titulo='$titulo', resumo='$resumo', status='$status', revisado='$revisado', texto='$texto', tag1='$tag1', tag2='$tag2', tag3='$tag3', categoria='$categoria', fixo='$fixo' WHERE id='$id'");

			echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');

		}

	}

?>

<form method="post">

	Titulo:<br>

    <input type="text" name="titulo" value="<?php echo $ver['titulo'] ;?>"><br>

    Resumo:<br>

    <input type="text" name="resumo" value="<?php echo $ver['resumo'] ;?>"><br>

    Tag 1:<br>

    <input type="text" name="tag1" value="<?php echo $ver['tag1'] ;?>"><br>

    Tag 2: <span style="font-size:11px;">(Se não precisar desse campo deixe em branco.)</span><br>

    <input type="text" name="tag2" value="<?php echo $ver['tag2'] ;?>"><br>

    Tag 3: <span style="font-size:11px;">(Se não precisar desse campo deixe em branco.)</span><br>

    <input type="text" name="tag3" value="<?php echo $ver['tag3'] ;?>"><br>

    Categoria:<br>

    <select name="categoria">

    	<option value="1" <?php if($ver['categoria'] == 1){ ?> selected <?php } ?>>Paneladourada</option>

        <option value="2" <?php if($ver['categoria'] == 2){ ?> selected <?php } ?>>Rádio</option>

		<option value="17" <?php if($ver['categoria'] == 17){ ?> selected <?php } ?>>Fixa</option>

		<option value="18" <?php if($ver['categoria'] == 18){ ?> selected <?php } ?>>Colunas</option>

        <!--<option value="3">Eventos</option>-->

        <option value="4" <?php if($ver['categoria'] == 4){ ?> selected <?php } ?>>Sulake</option>

        <option value="5" <?php if($ver['categoria'] == 5){ ?> selected <?php } ?>>Mundo</option>

        <option value="6" <?php if($ver['categoria'] == 6){ ?> selected <?php } ?>>Habbo BR/PT</option>

        <option value="7" <?php if($ver['categoria'] == 7){ ?> selected <?php } ?>>Habbo.com (INT)</option>

        <option value="8" <?php if($ver['categoria'] == 8){ ?> selected <?php } ?>>Habbo suéco (SE)</option>

        <option value="9" <?php if($ver['categoria'] == 9){ ?> selected <?php } ?>>Habbo espanhol (ES)</option>

        <option value="10" <?php if($ver['categoria'] == 10){ ?> selected <?php } ?>>Habbo francês (FR)</option>

        <option value="11" <?php if($ver['categoria'] == 11){ ?> selected <?php } ?>>Habbo alemão (DE)</option>

        <option value="12" <?php if($ver['categoria'] == 12){ ?> selected <?php } ?>>Habbo dinamarquês (DK)</option>

        <option value="13" <?php if($ver['categoria'] == 13){ ?> selected <?php } ?>>Habbo finlandês (FI)</option>

        <option value="14" <?php if($ver['categoria'] == 14){ ?> selected <?php } ?>>Habbo Turco (TR)</option>

        <option value="15" <?php if($ver['categoria'] == 15){ ?> selected <?php } ?>>Habbo Italiano (IT)</option>

        <option value="16" <?php if($ver['categoria'] == 16){ ?> selected <?php } ?>>Habbo Holandês (NL)</option>

    </select><br>

    Fixa:<br>

    <select name="fixo">

    	<option value="sim"<?php if($ver['fixo'] == 'sim'){echo(' selected');} ?>>Sim</option>

        <option value="nao"<?php if($ver['fixo'] == 'nao'){echo(' selected');} ?>>Nao</option>

    </select><br>
    
        Status:<br>

    <select name="status">

    	<option value="ativo"<?php if($ver['status'] == 'ativo'){echo(' selected');} ?>>Ativo</option>

        <option value="inativo"<?php if($ver['status'] == 'inativo'){echo(' selected');} ?>>Inativo</option>

    </select><br>

    Revisado por:<br>

    <input type="text" name="revisado" placeholder value="<?php echo $_SESSION['usuario_admin']; ?>"><br>

    Imagem: <span style="font-size:11px;">(Noticia 218 x 201)</span><br>

    <a href="uplouds/<?php echo $ver['imagem']; ?>" rel="shadowbox" onMouseOver="tooltip.show('Ampliar');" onMouseOut="tooltip.hide();"><img src="uplouds/<?php echo $ver['imagem']; ?>" width="210" height="114"></a><br>

    <input type="file" name="imagem"><br>

    Texto completo:<br>

    <textarea name="texto" class="ckeditor" style="width:100%;"><?php echo $ver['texto']; ?></textarea>

    <input type="submit" value="Postar">

</form>

<?php

}elseif($tipo == 'apagar'){

	$id = (int) $_GET['id'];

	db::Query("DELETE FROM noticias WHERE id='$id'");

	echo('deu');

}else{

	$pagina = $_GET['pagina'];

	if($pagina == 0){

		$pagina = 1;

	}else{

		$pagina = $pagina;

	}

	$quantidade = 20;

	$inicio = ($quantidade * $pagina) - $quantidade;

	$sql_total = "SELECT id FROM noticias";

	$pagf_total = mysql_query($sql_total) or die(mysql_error());

	$num_tot = mysql_num_rows($pagf_total);

	$totalpag = ceil($num_tot/$quantidade);

?>

<center>

<a <?php if($pagina>1){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina - 1; ?>"<? }else{;} ?>><?php if($pagina>1){;}else{ ?><? } ?>Anterior </a>

   <a style="text-decoration:underline;"> <?php echo $pagina; ?> </a>

   <a <?php if($pagina<$totalpag){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina + 1; ?>"<? }else{;};?>><?php if($pagina<$totalpag){;}else{?><? }?> Proximo</a></center>

<table width="100%">

	<tr>

    	<th><img src="imagens/x.png"></th>

        <th><img src="imagens/edit.png"></th>

        <th>Id</th>

        <th>Titulo</th>

        <th>Criador</th>

        <th>Data</th>

        <th>Status</th>

    </tr>

    <?php

	$i = 1;

    $sql = db::Query("SELECT * FROM noticias ORDER BY id DESC LIMIT $inicio, $quantidade");

	while($ver = db::FetchArray($sql)){

		$css = $i%2==0 ? '' : ' style="background:none;"';

	?>

    <tr>

        <th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $ver['id']; ?>');" style="cursor:pointer;"></th>

        <th<?php echo $css; ?>><a href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>

        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>

        <th<?php echo $css; ?>><?php echo $ver['titulo']; ?></th>

        <th<?php echo $css; ?>><?php echo $ver['criador']; ?></th>

        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['data']); ?> ás <?php echo date('H:i:s', $ver['data']); ?></th>

        <th<?php echo $css; ?>><?php echo $ver['status']; ?></th>

    </tr>

    <?php $i++;} ?>

</table>

<?php } ?>

</div>

</div>