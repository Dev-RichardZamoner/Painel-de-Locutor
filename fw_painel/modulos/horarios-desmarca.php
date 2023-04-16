<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Desmarca horários</div>
<div id="content_title_pagina" class="title_pagina_barra">Administração / Desmarca horários</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>




<?
/*
* PAINEL HABBOFM
* Desenvolvido por Michel Pinzetta Gayeski
* michel.chel@gmail.com
* Editado por: -Looper
*/
$sql = "SELECT * FROM painel_usuario_rel r, painel_cargos t \n".
			"WHERE t.tp_usr_id=r.tp_usr_id \n".
			"AND r.usr_id='".$_SESSION["usuario_id_admin"]."'\n".
			"LIMIT 1";
$res = mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($res) > 0){
	$admin = true;
}else{
	$admin = false;	
}

function traduz_dia($x){
		switch($x){
		case "7" : return "Domingo";
		break;
		case "1" : return "Segunda-Feira";
		break;
		case "2" : return "Ter&ccedil;a-Feira";
		break;
		case "3" : return "Quarta-Feira";
		break;
		case "4" : return "Quinta-Feira";
		break;
		case "5" : return "Sexta-Feira";
		break;
		case "6" : return "S&aacute;bado";
		break;
		}
}
$i=1;
$action = $_GET["action"];
$hora = $_GET["hora"];
$dia = $_GET["dia"];
$dia = ($dia)?$dia:"7";
$nome_dia = traduz_dia($dia);

if($action == "marcarhorario"){
	$sql = "SELECT * FROM painel_horarios h INNER JOIN painel_usuarios u ON id=h.usr_id WHERE hor_dia='$dia' AND hor_hora='$hora'";
	$res = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res)<=0){
		$sql2 = "UPDATE painel_horarios SET usr_id='".$_SESSION[usuario_id_admin]."' WHERE hor_dia='$dia' AND hor_hora='$hora'";
		$res2 = mysql_query($sql2) or die(mysql_error());
	}
}elseif($action=="desmarcarhorario"){
	$sql = "SELECT * FROM painel_horarios WHERE hor_dia='$dia' AND hor_hora='$hora' AND usr_id='".$_SESSION[usuario_id_admin]."'";
	$res = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($res)>0 || $admin){
		$sql2 = "UPDATE painel_horarios SET usr_id='0' WHERE hor_dia='$dia' AND hor_hora='$hora'";
		$res2 = mysql_query($sql2) or die(mysql_error());
	}
}

echo "<center>";
while($i<=7){
	if($i!=1){
		echo " | ";
	}
	if($dia==$i){
		echo "<a href='?cp=$cp&c=$c&dia=$i'><b>".traduz_dia($i)."</b></a>";
	}else{
		echo "<a href='?cp=$cp&c=$c&dia=$i'>".traduz_dia($i)."</a>";
	}
	$i++;
}
echo "</center>";

?>
<script>
	$("#titulo_canal span").append("&nbsp;- <?=$nome_dia?>");
</script>
	<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" /> 
<table width="100%" cellpadding="0" cellspacing="0" class="listing">
        <tr>
            <th class="first" style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"><center><b>Hor&aacute;rio</b></center></th>
            <th align="center" style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"><b>Locutor</b></th>
            <th class="last" style="padding:3px; background:#eeeeee; border:2px solid #fff; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px;"><b>Programa</b></th>
        </tr>
    <?
    $sql ="SELECT * FROM painel_horarios h WHERE h.hor_dia='$dia' ORDER BY h.hor_hora";
    $res = mysql_query($sql) or die(mysql_error());
    $i=1;
    $total = mysql_num_rows($res);
    while($row=mysql_fetch_array($res)){
		$hora = str_pad($row[hor_hora], 2, "0", STR_PAD_LEFT);
		if($row[usr_id]){
			$sql_u = "SELECT usuario FROM painel_usuarios WHERE id='$row[usr_id]'";
			$res_u=mysql_query($sql_u) or die(mysql_error());
			$row_u=mysql_fetch_array($res_u);
		}
		if(!$row_u){
			$locutor = "<a href='?cp=$cp&c=$c&action=marcarhorario&dia=$dia&hora=$row[hor_hora]'><u>Marcar Hor&aacute;rio<u></a>";
			$programa = $locutor;
		}elseif($_SESSION[usuario_id_admin]==$row[usr_id] || $admin){
			$locutor = "<a href='?cp=$cp&c=$c&action=desmarcarhorario&dia=$dia&hora=$row[hor_hora]'><u>$row_u[usuario]<u></a>";
			$programa = "<a href='?cp=$cp&c=$c&action=desmarcarhorario&dia=$dia&hora=$row[hor_hora]'><u>$row_u[programa]<u></a>";
		}else{
			$locutor = $row_u[usuario];
			$programa = $row_u[programa];
		}
	$bg = (($i+1)%2==0)?"bg":"";
    ?>
        <tr class="<?=$bg?>">
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><?=str_pad($row[hor_hora], 2, "0", STR_PAD_LEFT).":00 ~ ".(str_pad($row[hor_hora]+1, 2, "0", STR_PAD_LEFT)) .":00"?></td>
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><?=$locutor?></td>
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><?=$programa?></td>
        </tr>
    <?
		unset($row_u);
		unset($locutor);
		unset($programa);
        $i++;
    }
    ?>
    </table>
</div>