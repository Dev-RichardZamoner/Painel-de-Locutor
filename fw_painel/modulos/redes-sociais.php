<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Meus dados / Minhas redes sociais</div>
<div id="content_title_pagina" class="title_pagina_barra">Minhas redes sociais</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$usuario_eu = $_SESSION['usuario_admin'];
$sql = db::Query("SELECT * FROM painel_usuarios WHERE usuario='$usuario_eu'");
$item = db::FetchArray($sql);
$twitter = $_POST['twitter'];
$facebook = $_POST['facebook'];
$skype = $_POST['skype'];
$instagram = $_POST['instagram'];
$whatsapp = $_POST['whatsapp'];
if($_POST):
	db::Query("UPDATE painel_usuarios SET twitter='$twitter', facebook='$facebook', skype='$skype', instagram='$instagram', whatsapp='$whatsapp' WHERE usuario='$usuario_eu'");
	echo Site::Alerta('Editado com sucesso !',false);
endif;
?>
    <form method="post">
    Twitter:<br>
    <input type="text" name="twitter" value="<?php echo $item['twitter']; ?>"><br>
    Facebook:<br>
    <input type="text" name="facebook" value="<?php echo $item['facebook']; ?>"><br>
    Skype:<br>
    <input type="text" name="skype" value="<?php echo $item['skype']; ?>"><br>
    Instagram:<br>
    <input type="text" name="instagram" value="<?php echo $item['instagram']; ?>"><br>
    Whatsapp: <span style="font-size:11px;">( (ddd) numero )</span><br>
    <input type="text" name="whatsapp" value="<?php echo $item['whatsapp']; ?>"><br>
    <input type="submit" value="Editar">
    </form>
</div>
</div>