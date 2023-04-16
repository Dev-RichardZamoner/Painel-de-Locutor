<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Pagina inicial</div>
<div id="content_title_pagina" class="title_pagina_barra">Seja bem-vindo</div>
</div>

<div id="lado_dir_content">

<?php
$sql = db::Query("SELECT * FROM painel_avisos WHERE status='ativo' ORDER BY id DESC");
$total = db::NumRows($sql);
if($total == 0){
?>
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
Nenhum aviso postado.
</div>
<?php
}
	$pagina = $_GET['pagina'];
	if($pagina == 0){
		$pagina = 1;
	}else{
		$pagina = $pagina;
	}
	$quantidade = 20;
	$inicio = ($quantidade * $pagina) - $quantidade;
	$sql_total = "SELECT id FROM painel_avisos";
	$pagf_total = mysql_query($sql_total) or die(mysql_error());
	$num_tot = mysql_num_rows($pagf_total);
	$totalpag = ceil($num_tot/$quantidade);
?>
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<center>
<a <?php if($pagina>1){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina - 1; ?>"<? }else{;} ?>><?php if($pagina>1){;}else{ ?><? } ?>Anterior </a>
   <a style="text-decoration:underline;"> <?php echo $pagina; ?> </a>
   <a <?php if($pagina<$totalpag){  ?>href="index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&pagina=<?php echo $pagina + 1; ?>"<? }else{;};?>><?php if($pagina<$totalpag){;}else{?><? }?> Proximo</a></center>
</div>
<?php
$sql2 = db::Query("SELECT * FROM painel_avisos WHERE status='ativo' ORDER BY id DESC LIMIT $inicio, $quantidade");
while($ver = db::FetchArray($sql2)){

?>
<div id="aviso-<?php echo $ver['id']; ?>">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<script>
var aviso = {
	ler:function(id){
		if(confirm('Tem certeza que deseja marca esse aviso como lido ?')){
			$.ajax({
				type:'POST',
				url:'ajax-ver/marca-aviso',
				data:{'id':id, 'usuario':'<?php echo $_SESSION['usuario_admin']; ?>'},
				success:function(html){
					if(html == 'deu'){
						alert('Marcado com sucesso!');
					}else{
						alert('Erro, tente novamente!');
					}
					location.reload();
				}
			});
		}
	}
}
</script>
<?php
$usuario_eu = $_SESSION['usuario_admin'];
$sql_ler = db::NumRows(db::Query("SELECT * FROM painel_avisos_lido WHERE id_Aviso='$ver[id]' AND usuario='$usuario_eu'"));
if($sql_ler == 0){
	echo('<input type="button" onClick="aviso.ler(\''.$ver['id'].'\');" value="Marcar como lido">');
}else{
	echo('<input type="button" value="Aviso lido">');
}

?>
<br><br>
	<div style="word-wrap:break-word;"><?php echo $ver['texto']; ?></div>
<br>
Aviso postado por: <b><?php echo $ver['criador']; ?></b> no dia: <b><?php echo date('d/m/Y', $ver['data']); ?></b> &aacute;s <b><?php echo date('H:i:s', $ver['data']); ?></b>.<br><br>

<div style="width:100%; display:table;">

	<?php
		$sql_visto = db::Query("SELECT * FROM painel_avisos_lido WHERE id_Aviso='".$ver['id']."' ");
		while($visto = db::FetchArray($sql_visto)){
	?>
		<button id="list_inser_registro_a" style="margin-right:5px;"><?php echo $visto['usuario']; ?></button>
    <?php } ?>
</div>

</div>
</div>
<?php } ?>



</div>

