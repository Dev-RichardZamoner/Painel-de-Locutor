<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administracao / Canais</div>
<div id="content_title_pagina" class="title_pagina_barra">Canais</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<script>

function muda_ordem(direcao, ordem, controle)
{
	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&action=muda_ordem&direcao='+direcao+'&ordem='+ordem+'&controle='+controle;
}
function troca_flag(flag, id_reg, campo_flag)
{
	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&action=muda_status&flag='+flag+'&id_reg='+id_reg;
}
function troca_todos(tf)
{
	if(tf.checked)
		ToggleAll(lista, true);
	else
		ToggleAll(lista, false);
}
function ToggleAll(formname, checked_flag)
{
	len = formname.elements.length;
    var i = 0;
    for(i = 0; i < len; i++)
	{
        formname.elements[i].checked = checked_flag;
    }
}
function confirma_delete()
{
	if(confirm('Tem certeza que voce deseja apagar este(s) registro(s)?'))
		return true;
	else
		return false;
}

</script>
<?
$action=$_GET["action"];
if($action == ""){
	$action=$_POST["action"];
}
?>
<a href="?cp=<?=$cp?>&c=<?=$c?>&action=inserir">Inserir Registro</a> | <a href="?cp=<?=$cp?>&c=<?=$c?>">Listar Registros</a>
<?
if($action=="muda_ordem"){
	$controle = $_GET["controle"];
	$ordem = $_GET["ordem"];
	$sql = "SELECT aca_ordem
					FROM painel_canais
				ORDER BY aca_ordem DESC
			LIMIT 1";
	$limite_qr = mysql_query($sql) or die(mysql_error());
	$limite_reg = mysql_fetch_array($limite_qr);
	$limite = $limite_reg[aca_ordem]+1;
	// ------->> Passo 1: pega o controle e coloca no limite <<-------|
	$sql = "UPDATE painel_canais
					SET aca_ordem = '".$limite."'
				WHERE aca_ordem = '".$controle."'";
		//echo $sql . "<br>";
	$db = mysql_query($sql) or die(mysql_error());
	
	// ------->> Passo 2: pega o item e coloca no lugar do controle <<-------|
	$sql = "UPDATE painel_canais
					SET aca_ordem = '".$controle."'
				WHERE aca_ordem = '".$ordem."'";
		//echo $sql . "<br>";
	$db = mysql_query($sql) or die(mysql_error());
	
	// ------->> Passo 3: pega o registro que está no limite e coloca no lugar do que foi mudado <<-------|
	$sql = "UPDATE painel_canais
					SET aca_ordem = '".$ordem."'
				WHERE aca_ordem = '".$limite."'";
	$db = mysql_query($sql) or die(mysql_error());
	$action = "";
}elseif($action=="muda_status"){
	$flag=$_GET["flag"];
	$id_reg = $_GET["id_reg"];
	$sql = "UPDATE painel_canais SET aca_status='".$flag."' WHERE aca_id='".$id_reg."'";
	$res = mysql_query($sql) or die(mysql_error());
	$action = "";
}elseif($action == 'deleta')
{

	// ------->> loop nos registros selecionados na lista <<-------|
	$del_item = $_POST["del_item"];
	$i=0;
	while($cada_um = each($del_item))
	{
		$sql = "DELETE FROM painel_canais WHERE aca_id = '".$cada_um[1]."'";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
			$i++;
		}
	}
	if($i>0){
		echo "<div id=\"aviso\" onmouseover=\"this.style.opacity=4;this.filters.alpha.opacity=40\"
onmouseout=\"this.style.opacity=0; this.filters.alpha.opacity=0; object.style.display=hidden\" >
  <table width=\"99%\" height=\"59\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"23%\" align=\"center\"><img src=\"img/alert.gif\" width=\"30\" height=\"29\" /></td>
      <td width=\"77%\">Registrado com sucesso.</td>
    </tr>
  </table>
</div>";
	}else{
		echo "<div id=\"aviso\" onmouseover=\"this.style.opacity=4;this.filters.alpha.opacity=40\"
onmouseout=\"this.style.opacity=0; this.filters.alpha.opacity=0; object.style.display=hidden\" >
  <table width=\"99%\" height=\"59\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"23%\" align=\"center\"><img src=\"img/alert.gif\" width=\"30\" height=\"29\" /></td>
      <td width=\"77%\">Ops Falhou.</td>
    </tr>
  </table>
</div>";
	}
	$action = "";
}elseif($action == "editar" || $action == "inserir"){
	$id = $_GET["id"];
	if($id){
		$sql_f = "SELECT * FROM painel_canais WHERE aca_id='".$id."' LIMIT 1";
		$res_f = mysql_query($sql_f) or die(mysql_error());
		$row_f = mysql_fetch_array($res_f);
		$action = "F_editar";
		$button = "Editar";
	}else{
		$action = "F_inserir";
		$button = "Inserir";
	}
?>
<br />
<table style="margin-top:10px;" width="0%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>	<form method="post" action="?cp=<?=$cp?>&c=<?=$c?>">
    <input type="hidden" name="action" value="<?=$action?>" />
    <input type="hidden" name="id" value="<?=$id?>" />
    	<table style="float:left">
        	<tr>
            	<td>Nome:</td>
                <td><input type="text" name="nome" value="<?=$row_f[aca_nome]?>" class="form2" onFocus="this.className='form';" onBlur="this.className='form2'"/></td>
            </tr>
            <tr>
            	<td>Diret&oacute;rio:</td>
                <td><input type="text" name="diretorio" value="<?=$row_f[aca_diretorio]?>" class="form2" onFocus="this.className='form';" onBlur="this.className='form2'"/></td>
            </tr>
            <tr>
            	<td>Status:</td>
                <td>
                	<select name="status" class="form2" style="width:100%">
                    	<option value="Ativo" <? if($row_f[aca_status]=='Ativo')echo 'selected="selected"';?>>Ativo</option>
                    	<option value="Inativo" <? if($row_f[aca_status]=='Inativo')echo 'selected="selected"';?>>Inativo</option>
               		</select>
                </td>
            </tr>
            <tr>
            	<?
				$id = ($id)?$id:0;
				$sql_pai = "SELECT * FROM painel_canais WHERE aca_id <> $id AND (aca_pai IS NULL OR aca_pai=0)";
				$res_pai = mysql_query($sql_pai) or die(mysql_error());
				?>
            	<td>Canal Pai:</td>
                <td>
                	<select name="pai" class="form2" style="width:100%">
                    	<option value="0"> --- </option>
                    <? while($row_pai=mysql_fetch_array($res_pai)){ ?>
                    	<option value="<?=$row_pai[aca_id]?>" <? if($row_f[aca_pai]==$row_pai[aca_id])echo 'selected="selected"';?>><?=$row_pai[aca_nome]?></option>
                	<? }?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td></td>
            	<td><input type="submit" name="btn_form" value="<?=$button?>" class="form2" /></td>
            </tr>
        </table>
    </form></td>
  </tr>
</table>

<?
}elseif($action == "F_editar"){
	$id = $_POST["id"];
	if($id){
		$nome = $_POST["nome"];
		$diretorio = $_POST["diretorio"];
		$status = $_POST["status"];
		$pai = $_POST["pai"];
		$sql = "UPDATE painel_canais SET aca_nome='$nome', aca_diretorio='$diretorio', aca_status='$status', aca_pai=$pai
				WHERE aca_id=$id";
		$res = mysql_query($sql) or die(mysql_error());
		if($res){
			echo "<div id=\"aviso\" onmouseover=\"this.style.opacity=4;this.filters.alpha.opacity=40\"
onmouseout=\"this.style.opacity=0; this.filters.alpha.opacity=0; object.style.display=hidden\" >
  <table width=\"99%\" height=\"59\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"23%\" align=\"center\"><img src=\"img/alert.gif\" width=\"30\" height=\"29\" /></td>
      <td width=\"77%\">Regitrado com sucesso.</td>
    </tr>
  </table>
</div>";
		}else{
			echo "<div id=\"aviso\" onmouseover=\"this.style.opacity=4;this.filters.alpha.opacity=40\"
onmouseout=\"this.style.opacity=0; this.filters.alpha.opacity=0; object.style.display=hidden\" >
  <table width=\"99%\" height=\"59\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"23%\" align=\"center\"><img src=\"img/alert.gif\" width=\"30\" height=\"29\" /></td>
      <td width=\"77%\">Ops Falhou.</td>
    </tr>
  </table>
</div>";
		}
	}
	$action = "";
}elseif($action == "F_inserir"){
	$nome = $_POST["nome"];
	$diretorio = $_POST["diretorio"];
	$status = $_POST["status"];
	$pai = $_POST["pai"];
	$sql_o="SELECT * FROM painel_canais ORDER BY aca_ordem DESC LIMIT 1";
	$row_o=mysql_fetch_array(mysql_query($sql_o));
	$ordem = $row_o[aca_ordem]+1;
	$sql = "INSERT INTO painel_canais (aca_nome, aca_diretorio, aca_status, aca_pai, aca_ordem) 
			VALUES('$nome','$diretorio','$status','$pai','$ordem')";
	$res = mysql_query($sql) or die(mysql_error());
	if($res){
		echo "<div id=\"aviso\" onmouseover=\"this.style.opacity=4;this.filters.alpha.opacity=40\"
onmouseout=\"this.style.opacity=0; this.filters.alpha.opacity=0; object.style.display=hidden\" >
  <table width=\"99%\" height=\"59\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"23%\" align=\"center\"><img src=\"img/alert.gif\" width=\"30\" height=\"29\" /></td>
      <td width=\"77%\">Regitrado com sucesso.</td>
    </tr>
  </table>
</div>";
	}else{
		echo "<div id=\"aviso\" onmouseover=\"this.style.opacity=4;this.filters.alpha.opacity=40\"
onmouseout=\"this.style.opacity=0; this.filters.alpha.opacity=0; object.style.display=hidden\" >
  <table width=\"99%\" height=\"59\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"23%\" align=\"center\"><img src=\"img/alert.gif\" width=\"30\" height=\"29\" /></td>
      <td width=\"77%\">Ops Falhou.</td>
    </tr>
  </table>
</div>";
	}
	$action = "";
}
if($action == ""){
?>

				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form name="lista" method="post" action="?cp=<?=$cp?>&c=<?=$c?>" onsubmit="return confirma_delete()">
    <input type="Hidden" value="deleta" name="action">
    <input type="hidden" value="<?=$cp?>" name="cp" />
    <input type="hidden" value="<?=$c?>" name="c" />
    <table width="100%" cellpadding="0" cellspacing="0" class="listing">
        <tr>
            <th width="4%" height="30" style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"><center><input style="width:10px; height:10px;" type="Checkbox" onClick="troca_todos(this);"  alt="Marca ou desmarca todos da lista"></center></th>
            <th width="7%"style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;" align="center"><input style="width:16px; height:16px;" type="image" src="imagens/edit.png" alt="Apagar registros selecionados" ></th>
            <th width="16%" style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"><b>Nome</b></th>
            <th width="18%" style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"><b>Diret&oacute;rio</b></th>
            <th width="19%"  style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"align="center"><b>Canal Pai</b></th>
            <th width="18%"style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;" align="center"><b>Status</b></th>
            <th width="18%"style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;" class="last"><b>Ordem</b></th>
        </tr>
    <?
    $sql ="SELECT * FROM painel_canais ORDER BY aca_ordem";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($row=mysql_fetch_array($res)){
        $bg = (($i+1)%2==0)?"bg":"";
        $sql_pai="SELECT * FROM painel_canais WHERE aca_id='".$row[aca_pai]."' LIMIT 1";
        $row_pai = mysql_fetch_array(mysql_query($sql_pai));
    ?>
        <tr class="<?=$bg?>">
            <td style="border-bottom:1px dashed #fff;"><input style="width:10px; height:10px;" type="Checkbox" name="del_item[]" value="<?=$row[aca_id]?>"></td>
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff;"><a href="?cp=<?=$cp?>&c=<?=$c?>&action=editar&id=<?=$row[aca_id]?>"><img style="width:16px; height:16px;" src="imagens/edit.png" alt="Clique para editar este registro" align="absmiddle" /></a></td>
            <td style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><div align="center"><b>
              <?=$row[aca_nome]?>
            </b></div></td>
            <td style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><div align="center">
                <?=$row[aca_diretorio]?></div></td>
            <td align="center" style="border-left:2px dashed #fff;  border-bottom:1px dashed #fff; padding:2px;" ><div align="center">
              <?=$row_pai[aca_nome]?>
            </div></td>
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff;  padding:2px;">
                <select name="status" class="form2" onchange="troca_flag(this.value, '<?=$row[aca_id]?>')">
                    <option value="Ativo" <? if($row[aca_status]=='Ativo')echo 'selected="selected"';?>>Ativo</option>
                    <option value="Inativo" <? if($row[aca_status]=='Inativo')echo 'selected="selected"';?>>Inativo</option>
                </select>            </td>
            <input type="Hidden" value="<?=$row[aca_ordem]?>" name="ordem_pos[<?=$i?>]">
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff;  padding:2px;">
                <? if($i!=1){ ?>
                <a href="javascript:muda_ordem('sobe','<?=$row[aca_ordem]?>', document.lista['ordem_pos[<?=$i-1?>]'].value);"  target='_self'><img border=0 src='images/bt_sobe.gif' alt='Clique para subir este item na lista'></a>
                <? }
                if($total!=$i){?>
                <a href="javascript:muda_ordem('desce','<?=$row[aca_ordem]?>', document.lista['ordem_pos[<?=$i+1?>]'].value);" target='_self'><img border=0 src='images/bt_desce.gif' alt='Clique para descer este item na lista'></a>
                <? }?></td>
        </tr>
    <?
        $i++;
    }
    ?>
    </table>
    </form></td>
  </tr>
</table>

  
<?
}
?>