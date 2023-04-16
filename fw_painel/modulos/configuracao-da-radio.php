<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administração / Configuração da rádio</div>
<div id="content_title_pagina" class="title_pagina_barra">Configuração da rádio</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$sql = db::Query("SELECT * FROM dados_radio");
$item = db::FetchArray($sql);
$ip = $_POST['ip'];
$porta = $_POST['porta'];
$senha_radio = $_POST['senha_radio'];
$senha_kick = $_POST['senha_kick'];
if($_POST):
	db::Query("UPDATE dados_radio SET ip='$ip', porta='$porta', senha_radio='$senha_radio', senha_kick='$senha_kick' WHERE id='1'");
	echo Site::Alerta('Editado com sucesso!',false);
endif;
?>
<form method="post">
	Ip:<br>
	<input type="text" name="ip" value="<?php echo $item['ip']; ?>"><br>
    Porta:<br>
    <input type="text" name="porta" value="<?php echo $item['porta']; ?>"><br>
    Senha da rádio:<br>
    <input type="password" name="senha_radio" value="<?php echo $item['senha_radio']; ?>"><br>
    Senha do kick:<br>
    <input type="password" name="senha_kick" value="<?php echo $item['senha_kick']; ?>"><br>
    <input type="submit" value="Editar">
</form>
</div>
</div>