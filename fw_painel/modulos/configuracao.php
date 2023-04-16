<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Meus dados / Minhas configurações</div>
<div id="content_title_pagina" class="title_pagina_barra">Minhas configurações</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$usuario_eu = $_SESSION['usuario_admin'];
$sql = db::Query("SELECT * FROM painel_usuarios WHERE usuario='$usuario_eu'");
$item = db::FetchArray($sql);
$senha = $_POST['senha'];
$programa = $_POST['programa'];
$nome = $_POST['nome'];
$quarto = $_POST['quarto'];
if($_POST):
	db::Query("UPDATE painel_usuarios SET senha='$senha', programa='$programa', nome='$nome', quarto='$quarto' WHERE usuario='$usuario_eu'");
	echo Site::Alerta('Editado com sucesso !',false);
endif;
?>
    <form method="post">
    Usuario:<br>
    <input type="text" name="usuario" readonly value="<?php echo $_SESSION['usuario_admin']; ?>"><br>
    Nome:<br>
    <input type="text" name="nome" value="<?php echo $item['nome']; ?>"><br>
    Senha:<br>
    <input type="password" name="senha" value="<?php echo $item['senha']; ?>"><br>
    Programa:<br>
    <input type="text" name="programa" value="<?php echo $item['programa']; ?>"><br>
	Quarto:<br>
    <input type="text" name="quarto" value="<?php echo $item['quarto']; ?>"><br>
    <input type="submit" value="Editar">
    </form>
</div>
</div>