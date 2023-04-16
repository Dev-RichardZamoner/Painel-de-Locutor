<?php
$sql = "SELECT aca_nome \n". "FROM painel_canais c\n". "WHERE c.aca_status = 'Ativo' \n". "AND c.aca_id = '$cp'";
$res = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($res);

echo '<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Selecione um canal</div>
<div id="content_title_pagina" class="title_pagina_barra">'.$row['aca_nome'].'</div>
</div>';
		
	$sql = "SELECT * \n".
			"FROM painel_canais c, painel_permissao p, painel_usuario_rel r \n".
			"WHERE c.aca_status = 'Ativo' \n".
			"AND r.usr_id='".$_SESSION["usuario_id_admin"]."'\n".
			"AND r.tp_usr_id=p.tp_usr_id\n".
			"AND c.aca_id=p.aca_id \n".
			"AND c.aca_pai = '$cp' \n".
			"GROUP BY p.aca_id\n".
			"ORDER BY c.aca_ordem";
			
	$res = mysql_query($sql) or die(mysql_error());
?>



<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
	<?php
	while($row = mysql_fetch_array($res)){
?>
			<a href="?cp=<?php echo $cp?>&c=<?php echo $row['aca_id']?>">» <?php echo $row['aca_nome']?></a><br />
<?php
	}
?>

</div>
</div>