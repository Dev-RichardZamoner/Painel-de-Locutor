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

<!-- /TinyMCE -->

<div id="barra_title_pagina">

<div id="base_icone_local_pagina">

<div id="icone_local_pagina"></div>

</div>

<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Noticiario / Postar notícia</div>

<div id="content_title_pagina" class="title_pagina_barra">Postar notícia</div>

</div>



<div id="lado_dir_content">



<div id="box_pagina_conteudo">

<div id="content_list_inser_registro">

</div>

<?php

$tipo = $_GET['tipo'];

if($tipo == 'criar'){

	$titulo = $_POST['titulo'];

	$resumo = $_POST['resumo'];

	$categoria = $_POST['categoria'];

	$texto = $_POST['texto'];

	$data = time();

	$criador = $_SESSION['usuario_admin'];

	$url = Site::LimparUrl($titulo);

	$foto = $_FILES['imagem'];

	$tag1 = $_POST['tag1'];

	$tag2 = $_POST['tag2'];

	$tag3 = $_POST['tag3'];

	if($_POST){

		if(empty($texto) || empty($titulo) || empty($resumo) || empty($foto["name"])){

			echo Site::Alerta('Preencha todos os campos!',false);

		}else{

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

					db::Query("INSERT INTO noticias(titulo, resumo, texto, categoria, imagem, criador, data, status, url, tag1, tag2, tag3) VALUES ('$titulo','$resumo','$texto','$categoria','$nome_imagem','$criador','$data','inativo','$url','$tag1','$tag2','$tag3') ");

					//$ultima_postado = mysql_fetch_array(mysql_query("SELECT * FROM noticias ORDER BY id DESC LIMIT 1"));

					$ultima_id = $ultima_postado['id'];

					$logs_i = mysql_query("INSERT INTO noticias_tags(nome, id_noticia) VALUES ('$tags','$ultima_id')");

					echo Site::Alerta('Criado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');

				}else{

					foreach($error as $erro){

						echo $erro;

					}

				}

			}

		}

	}

?>

<form method="post" enctype="multipart/form-data">

	Titulo:<br>

    <input type="text" name="titulo"><br>

    Resumo:<br>

    <input type="text" name="resumo"><br>

    Tag 1:<br>

    <input type="text" name="tag1"><br>

    Tag 2: <span style="font-size:11px;">(Se não precisar desse campo deixe em branco.)</span><br>

    <input type="text" name="tag2"><br>

    Tag 3: <span style="font-size:11px;">(Se não precisar desse campo deixe em branco.)</span><br>

    <input type="text" name="tag3"><br>

    Categoria:<br>

    <select name="categoria">

    	<option value="1">Paneladourada</option>

        <option value="2">Rádio</option>

        <option value="17">Fixa</option>

        <option value="18">Fixa</option>

        <!--<option value="3">Eventos</option>-->

        <option value="4">Sulake</option>

        <option value="5">Externas</option>

        <option value="6">Habbo BR/PT</option>

        <option value="7">Habbo.com (INT)</option>

        <option value="8">Habbo suéco (SE)</option>

        <option value="9">Habbo espanhol (ES)</option>

        <option value="10">Habbo francês (FR)</option>

        <option value="11">Habbo alemão (DE)</option>

        <option value="12">Habbo dinamarquês (DK)</option>

        <option value="13">Habbo finlandês (FI)</option>

        <option value="14">Habbo Turco (TR)</option>

        <option value="15">Habbo Italiano (IT)</option>

        <option value="16">Habbo Holandês (NL)</option>

    </select><br>

    Imagem: <span style="font-size:11px;">(Noticia 218 x 201)</span><br>

    <input type="file" name="imagem"><br>

    Texto completo:<br>

    <textarea name="texto" class="ckeditor" style="width:100%;"></textarea>

    <input type="submit" value="Postar">

</form>

<?php }else{ ?>

<a href="index.php?cp=8&c=16&tipo=criar"><input type="button" name="btn_form" value="Criar notícia" /></a><br><br>



<table width="100%">

	<tr>

    	<th><img src="imagens/edit.png"></th>

        <th>Id</th>

        <th>Titulo</th>

        <th>Criador</th>

        <th>Data</th>

        <th>Status</th>

    </tr>

    <?php

	$i = 1;

    $sql = db::Query("SELECT * FROM noticias WHERE criador='".$_SESSION['usuario_admin']."' ORDER BY id DESC LIMIT 50");

	while($ver = db::FetchArray($sql)){

		$css = $i%2==0 ? '' : ' style="background:none;"';

	?>

    <tr>

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



