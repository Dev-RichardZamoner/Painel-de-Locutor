<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administração / Membros da equipe</div>
<div id="content_title_pagina" class="title_pagina_barra">Membros da equipe</div>
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
if($tipo == 'criar'){
	$senha = $_POST['senha'];
	$turno = $_POST['turno'];
	$email = $_POST['email'];
	$status = $_POST['status'];
	$nivel = $_POST['nivel'];
	if($_POST){
		if(empty($_POST['usuario'])){
			echo Site::Alerta('Preencha todos os campos!',false);
		}else{
			db::Query("INSERT painel_usuarios(usuario, senha, email, turno, ativo) VALUES ('".$_POST['usuario']."','$senha','$email','$turno','$status') ");
			while($cada = each($nivel)){
				$row_o = mysql_fetch_array(mysql_query("SELECT * FROM painel_usuarios ORDER BY id DESC LIMIT 1"));
				$usr_id = $row_o['id'];
				$sql2 =  mysql_query("INSERT INTO painel_usuario_rel(tp_usr_id, usr_id) VALUES('".$cada[1]."','".$usr_id."')");
			}
			echo Site::Alerta('Criado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
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
    Cargos:<br>
        <?php
		$eu_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$_SESSION['usuario_id_admin']."' AND tp_usr_id='1'"));
		$sql_r = mysql_query("SELECT * FROM painel_cargos t, painel_usuario_rel r WHERE t.tp_usr_id=r.tp_usr_id AND r.usr_id='".$id."'");
		$nivel = "";
		while($ver_r = mysql_fetch_array($sql_r)){
			$nivel .= $ver_r['tp_usr_nome'].",";
			//echo('kkkkkk '.$nivel);
		}
		$id = ($id)?$id:0;
		$sql_cargos = mysql_query("SELECT * FROM painel_cargos");
        while($ver_pai = mysql_fetch_array($sql_cargos)){
			if($eu_1 == 11){
		?>

                    	<label><input type="checkbox" name="nivel[]" value="<?php echo $ver_pai['tp_usr_id']?>">
                    <?php echo $ver_pai['tp_usr_nome']; ?></label>
                    	<br />
                    <?php }else{ ?>
                    <?php
						if($ver_pai['tp_usr_id'] == 11){
							echo('');
						}else{
					?>
                    <label><input type="checkbox" name="nivel[]" value="<?php echo $ver_pai['tp_usr_id']?>">
                    <?php echo $ver_pai['tp_usr_nome']; ?></label><br>
                    <?php } }?>
           	  <?php }?>  
    <input type="submit" value="Postar">
</form>
<?php }elseif($tipo == 'editar'){
		$id = $_GET['id'];
		$sql_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$id."' AND tp_usr_id='1'"));
		$eu_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$_SESSION['usuario_id_admin']."' AND tp_usr_id='1'"));
		if($sql_1 == 999999999999999999999999999999999999999999999999999999999999999999999999999999){
			echo('Você não pode editar esse usuario');
		}else{
		$sql = mysql_query("SELECT * FROM painel_usuarios WHERE id='$id'");
		$ver = mysql_fetch_array($sql);	
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$status = $_POST['status'];
		$advertencia = $_POST['advertencia'];
		$nivel = $_POST['nivel'];
		$turno2 = $_POST['turno'];
		$consulta = '';
		if($_POST){
			while($cada = @each($nivel)){
				$sql_ver = "SELECT * FROM painel_usuario_rel WHERE tp_usr_id='".$cada[1]."' AND usr_id = '".$id."'";
				$res_v = mysql_query($sql_ver);
					if(mysql_num_rows($res_v) <= 0){
						$sql2 = mysql_query("INSERT INTO painel_usuario_rel(tp_usr_id, usr_id) VALUES('".$cada[1]."','".$id."')");
					}
				$consulta .= " AND tp_usr_id<>'".$cada[1]."' ";
			}
			$sql_del = mysql_query("DELETE FROM painel_usuario_rel WHERE usr_id='".$id."' ".$consulta);
			/* editar */
			mysql_query("UPDATE painel_usuarios SET usuario='".$_POST['usuario']."', email='$email', senha='$senha', ativo='$status', advertencia='$advertencia', turno='$turno2' WHERE id='$id'");
		echo Site::Alerta('Editado com sucesso!','index.php?cp='.$cp.'&c='.$c.'');
		}
	?>
	<form method="post">
    	Usuario:<br>
        <input type="text" name="usuario" value="<?php echo $ver['usuario']; ?>"><br>
        Senha:<br>
        <input type="password" name="senha" value="<?php echo $ver['senha']; ?>"><br>
        Email:<br>
        <input type="text" name="email" value="<?php echo $ver['email']; ?>"><br>
        Status:<br>
        <select name="status">
    		<option value="sim"<?php if($ver['ativo'] == 'sim'){echo(' selected');} ?>>Ativo</option>
        	<option value="nao"<?php if($ver['ativo'] == 'nao'){echo(' selected');} ?>>Inativo</option>
        </select><br>
        Turno:<br>
    <select name="turno">
    	<?php $turno = $ver['turno']; ?>
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
        Advertencias: <span style="font-size:11px;">(<?php echo $ver['advertencia']; ?>)</span><br>
        <select name="advertencia">
        	<option value="0"<?php if($ver['advertencia'] == 0){echo(' selected="selected"');} ?>>0</option>
        	<option value="1"<?php if($ver['advertencia'] == 1){echo(' selected="selected"');} ?>>1</option>
            <option value="2"<?php if($ver['advertencia'] == 2){echo(' selected="selected"');} ?>>2</option>
            <option value="3"<?php if($ver['advertencia'] == 3){echo(' selected="selected"');} ?>>3</option>
        </select><br>
        Cargos:<br>
        <?php
		$sql_r = mysql_query("SELECT * FROM painel_cargos t, painel_usuario_rel r WHERE t.tp_usr_id=r.tp_usr_id AND r.usr_id='".$id."'");
		$nivel = "";
		while($ver_r = mysql_fetch_array($sql_r)){
			$nivel .= $ver_r['tp_usr_nome'].",";
			//echo('kkkkkk '.$nivel);
		}
		$id = ($id)?$id:0;
		$sql_cargos = mysql_query("SELECT * FROM painel_cargos");
        while($ver_pai = mysql_fetch_array($sql_cargos)){
			if($eu_1 == 1){
		?>

                    	<label><input type="checkbox" name="nivel[]" value="<?php echo $ver_pai['tp_usr_id']?>"<?php if(strstr($nivel, $ver_pai['tp_usr_nome'])) echo 'checked="checked"'; ?>>
                    <?php echo $ver_pai['tp_usr_nome']; ?></label>
                    	<br />
                    <?php }else{ ?>
                    <?php
						if($ver_pai['tp_usr_id'] == 1){
							echo('');
						}else{
					?>
                    <label><input type="checkbox" name="nivel[]" value="<?php echo $ver_pai['tp_usr_id']?>"<?php if(strstr($nivel, $ver_pai['tp_usr_nome'])) echo 'checked="checked"'; ?>>
                    <?php echo $ver_pai['tp_usr_nome']; ?></label><br>
                    <?php } }?>
           	  <?php }?>  
        <input type="submit" value="Editar">
    </form>
   <?php } ?>
<?php }elseif($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM painel_usuarios WHERE id='$id'");
	echo('deu');
}else{ ?>
<a href="index.php?cp=2&c=13&tipo=criar"><input type="button" name="btn_form" value="Adicionar membro" /></a><br><br>
<table width="100%">
	<tr>
    	<th><img src="imagens/x.png"></th>
        <th><img src="imagens/edit.png"></th>
        <th>Id</th>
        <th>Usuario</th>
        <th>Cargos</th>
        <th>Último login</th>
        <th>Advertencias</th>
        <th>Status</th>
    </tr>
    <?php
	$i = 1;
    $sql = db::Query("SELECT * FROM painel_usuarios");
	while($ver = db::FetchArray($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
	?>
    <tr<?php if($ver['ativo'] == 'nao'){echo(' style="opacity:0.5;"');}?>>
    	<th<?php echo $css; ?>>
        	<?php
				$eu_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$_SESSION['usuario_id_admin']."' AND tp_usr_id='1'"));
				
            	$sql_1 = mysql_num_rows(mysql_query("SELECT * FROM painel_usuario_rel WHERE usr_id='".$ver['id']."' AND tp_usr_id='1'"));
				if($sql_1 !== 0){
					$apagar = '<img src="imagens/x.png" style="opacity:0.5; cursor:defaut;">';
				}else{
					$apagar = '<img src="imagens/x.png" onClick="apagar.sim(\''.$ver['id'].'\');" style="cursor:pointer;">';
				}
				if($eu_1 == 1){
					echo '<img src="imagens/x.png" onClick="apagar.sim(\''.$ver['id'].'\');" style="cursor:pointer;">';
				}else{
					echo $apagar;	
				}
        	?></th>
    	<th<?php echo $css; ?>><a href="index.php?cp=2&c=13&tipo=editar&id=<?php echo $ver['id']; ?>"><img src="imagens/edit.png"></a></th>
        <th<?php echo $css; ?>><?php echo $ver['id']; ?></th>
        <th<?php echo $css; ?>><?php echo $ver['usuario']; ?></th>
        <th<?php echo $css; ?>>
        	<?php
            $sql_c = mysql_query("SELECT * FROM painel_usuario_rel r, painel_cargos t WHERE r.tp_usr_id=t.tp_usr_id AND r.usr_id='".$ver['id']."' ORDER BY t.tp_usr_ordem");
			while($ver_c=mysql_fetch_array($sql_c)){
				echo $ver_c['tp_usr_nome']."<br>";
			}			
        	?>
        </th>
        <th<?php echo $css; ?>><?php echo date('d/m/Y', $ver['ultima_data']); ?> &aacute;s <?php echo date('H:i:s', $ver['ultima_data']); ?></th>
        <th<?php echo $css; ?>><?php echo $ver['advertencia']; ?></th>
        <th<?php echo $css; ?>><?php if($ver['ativo'] == 'sim'){echo('Ativo');}else{echo('Inativo');} ?></th>
    </tr>
    <?php $i++;} ?>
</table>
<?php } ?>
</div>
</div>