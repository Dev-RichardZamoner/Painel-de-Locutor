<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Meus dados / Meu perfil (Rádio)</div>
<div id="content_title_pagina" class="title_pagina_barra">Meu perfil (Rádio)</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$usuario_eu = $_SESSION['usuario_admin'];
$sql = db::Query("SELECT * FROM painel_usuarios WHERE usuario='$usuario_eu'");
$item = db::FetchArray($sql);
$sobre = $_POST['sobre'];
$colante = $_POST['colante'];
$emblema = $_POST['emblema'];
if($_POST):
	db::Query("UPDATE painel_usuarios SET sobre_programa='$sobre', colante='$colante', emblema='$emblema' WHERE usuario='$usuario_eu'");
	echo Site::Alerta('Editado com sucesso!');
endif;
?>
    <form method="post">
    Sobre programa:<br>
    <textarea name="sobre" class="ckeditor"><?php echo $item['sobre_programa']; ?></textarea><br>
    Colante: <span style="font-size:11px;">Clique <a href="index.php?cp=29&c=30" target="_blank">aqui</a> para fazer uploud.</span><br>
    <input type="text" name="colante" value="<?php echo $item['colante']; ?>"><br>
    <img src="<?php echo $item['colante']; ?>" style="max-width:200px; max-height:200px;"><br>
    Emblema: <span style="font-size:11px;">Clique <a href="index.php?cp=29&c=30" target="_blank">aqui</a> para fazer uploud.</span><br>
    <input type="text" name="emblema" value="<?php echo $item['emblema']; ?>"><br>
    <img src="<?php echo $item['emblema']; ?>" style="max-width:200px; max-height:200px;"><br>
    <input type="submit" value="Editar">
    </form>
</div>
</div>