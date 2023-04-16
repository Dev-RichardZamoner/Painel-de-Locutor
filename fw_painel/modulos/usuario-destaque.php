<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Dire&ccedil;&atilde;o de conteudo / Habbo Destaque</div>
<div id="content_title_pagina" class="title_pagina_barra">Habbo Destaque<</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$habbo = $_POST['habbo'];
$motivo = $_POST['motivo']; 
if($_POST){
	db::Query("UPDATE habbo_destaque SET habbo='$habbo', motivo='$motivo'");
	echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
}
    $sql = db::Query("SELECT * FROM habbo_destaque");
	$ver = db::FetchArray($sql);
?>
<form method="post">
    Habbo:<br>
    <input type="text" name="habbo" value="<?php echo $ver['habbo']; ?>"><br>
    Motivo:<Br>
    <input type="text" name="motivo" value="<?php echo $ver['motivo']; ?>"><br>
    <input type="submit" value="Criar">
</form>
</div>
</div>