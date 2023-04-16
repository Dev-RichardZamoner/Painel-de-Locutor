<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Locução / Adicionar locutor</div>
<div id="content_title_pagina" class="title_pagina_barra">Adicionar locutor</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$turno = $_POST['turno'];
	$email = $_POST['email'];
	$status = $_POST['status'];
	if($_POST){
		if(empty($usuario)){
			echo Site::Alerta('Preencha todos os campos!',false);
		}else{
			db::Query("INSERT painel_usuarios(usuario, senha, email, turno, ativo) VALUES ('$usuario','$senha','$email','$turno','$status') ");
			$row_o = mysql_fetch_array(mysql_query("SELECT * FROM painel_usuarios ORDER BY id DESC LIMIT 1"));
			$usr_id = $row_o['id'];
			$sql2 =  mysql_query("INSERT INTO painel_usuario_rel(tp_usr_id, usr_id) VALUES('7','".$usr_id."')");
			echo Site::Alerta('Criado com sucesso!',false);
		}
	}
?>
<form method="post">
	Usuario:<br>
    <input type="text" name="usuario"><br>
    Senha:<br>
    <input type="text" name="senha"><br>
    Email:<br>
    <input type="text" name="email"><br>
    Status:<br>
    <select name="status">
    	<option value="sim">Ativo</option>
        <option value="nao">Inativo</option>
    </select>
    <br>
    Turno:<br>
    <select name="turno">
    	<option <?php if($turno == 'Livre'){ echo'selected="selected"'; } ?> value='Livre'>Livre</option>
        <option <?php if($turno == 'Manhã'){ echo'selected="selected"'; } ?> value='Manhã'>Manhã</option>
        <option <?php if($turno == 'Tarde'){ echo'selected="selected"'; } ?> value='Tarde'>Tarde</option>
        <option <?php if($turno == 'Noite'){ echo'selected="selected"'; } ?> value='Noite'>Noite</option>
        <option <?php if($turno == 'Madrugada'){ echo'selected="selected"'; } ?> value='Madrugada'>Madrugada</option>
        <option <?php if($turno == 'Manhã / Tarde'){ echo'selected="selected"'; } ?> value='Manhã / Tarde'>Manhã / Tarde</option>
        <option <?php if($turno == 'Manhã / Noite'){ echo'selected="selected"'; } ?> value='Manhã / Noite'>Manhã / Noite</option>
        <option <?php if($turno == 'Manhã / Madrugada'){ echo'selected="selected"'; } ?> value='Manhã / Madrugada'>Manhã / Madrugada</option>
        <option <?php if($turno == 'Tarde / Noite'){ echo'selected="selected"'; } ?> value='Tarde / Noite'>Tarde / Noite</option>
        <option <?php if($turno == 'Tarde / Madrugada'){ echo'selected="selected"'; } ?> value='Tarde / Madrugada'>Tarde / Madrugada</option>
        <option <?php if($turno == 'Noite / Madrugada'){ echo'selected="selected"'; } ?> value='Noite / Madrugada'>Noite / Madrugada</option>
    </select><br>
    <input type="submit" value="Criar locutor">
</form>
</div>
</div>