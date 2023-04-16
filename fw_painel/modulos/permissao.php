<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administração / Permissões de cargo</div>
<div id="content_title_pagina" class="title_pagina_barra">Permissões de cargo</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
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
<?php
$tipo = $_GET['tipo'];
if($tipo == 'apagar'){
	$id = (int) $_GET['id'];
	db::Query("DELETE FROM painel_permissao WHERE per_id='$id'");
	echo('deu');
}else{
?>

<?php
/*
* PAINEL HABBOFM
* Desenvolvido por Michel Pinzetta Gayeski
* michel.chel@gmail.com
*/
?>
<script>

function seleciona_tp(tp_id)

{

	this.location = 'index.php?cp=<?php echo $cp; ?>&c=<?php echo $c; ?>&tp_id='+tp_id;

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

	if(confirm('Tem certeza que você deseja apagar este(s) registro(s)?'))

		return true;

	else

		return false;

}



</script>

<?php

$action=$_GET["action"];

if($action == ""){

	$action=$_POST["action"];

}

$tp_id = $_GET["tp_id"];

if($tp_id == ""){

	$tp_id=$_POST["tp_id"];

}

if($tp_id){

	$sql3 = "SELECT * FROM painel_cargos WHERE tp_usr_id='$tp_id'";

	$row3 = mysql_fetch_array(mysql_query($sql3));

?>

<a href="?cp=<?php echo $cp?>&c=<?php echo $c?>&tp_id=<?php echo $tp_id?>&action=inserir">Inserir Registro</a> | <a href="?cp=<?php echo $cp?>&c=<?php echo $c?>&tp_id=<?php echo $tp_id?>">Listar Registros</a> | <a href="?cp=<?php echo $cp?>&c=<?php echo $c?>">Tipo de Usu&aacute;rios</a>

<?php

}

if($action == 'deleta')

{



	// ------->> loop nos registros selecionados na lista <<-------|

	$del_item = $_POST["del_item"];

	$i=0;

	while($cada_um = each($del_item))

	{

		$sql = "DELETE FROM painel_permissao WHERE per_id = '".$cada_um[1]."'";

		$res = mysql_query($sql) or die(mysql_error());

		if($res){

			$i++;

		}

	}

	if($i>0){

		echo "<script>alert('Registro(s) excluido(s) com sucesso!')</script>";

	}else{

		echo "<script>alert('Um ou mais registros não puderam ser excluidos!')</script>";

	}

	$action = "";

}elseif($action == "editar" || $action == "inserir"){

	$id = $_GET["id"];

	if($id){

		$sql_f = "SELECT * FROM painel_permissao WHERE per_id='".$id."' LIMIT 1";

		$res_f = mysql_query($sql_f) or die(mysql_error());

		$row_f = mysql_fetch_array($res_f);

		$action = "F_editar";

	}else{

		$action = "F_inserir";

	}

?>

	<form method="post" action="?cp=<?php echo $cp?>&c=<?php echo $c?>">

    <input type="hidden" name="action" value="<?php echo $action?>" />

    <input type="hidden" name="id" value="<?php echo $id?>" />

    <input type="hidden" value="<?php echo $tp_id?>" name="tp_id">

    	<table style="float:left">

        	<tr>

            	<td>Tipo Usu&aacute;rio:</td>

                <?php
        $res_usr = mysql_query("SELECT * FROM painel_cargos");
				?>

                <td>

                	<select name="tp_usr_id" class="form2">

                    <?php while($row_usr = mysql_fetch_array($res_usr)){?>

                    	<option value="<?php echo $row_usr['tp_usr_id']?>" <?php if($row_usr['tp_usr_id']==$tp_id)echo 'selected="selected"';?>><?php echo $row_usr['tp_usr_nome']?></option>

                	<?php }?>

                	</select>

                </td>

            </tr>

            <tr>

            	<td>Canal:</td>

                <td>                	

                	<select name="aca_id" class="form2">

                    <?php
                    $res_can = mysql_query("SELECT * FROM painel_canais");
					while($row_can = mysql_fetch_array($res_can)){
					?>

                    	<option value="<?php echo $row_can['aca_id']?>"><?php echo $row_can['aca_nome']?></option>

                	<?php }?>

                	</select>

                </td>

            </tr>

            <tr>

            	<td></td>

            	<td><input type="submit" name="btn_form" value="Ok" class="form2" /></td>

            </tr>

        </table>

    </form>

<?php

}elseif($action == "F_editar"){

	$id = $_POST["id"];

	if($id){


		$tp_usr_id = $_POST["tp_usr_id"];

		$aca_id = $_POST["aca_id"];

		$sql = "UPDATE painel_permissao SET tp_usr_id='$tp_usr_id', aca_id='$aca_id' WHERE per_id=$id";

		$res = mysql_query($sql) or die(mysql_error());

		if($res){

			echo "<script>alert('Registro Editado com sucesso')</script>";

		}else{

			echo "<script>alert('Um erro inesperado aconteceu')</script>";

		}

	}

	$action = "";

}elseif($action == "F_inserir"){

	$tp_usr_id = $_POST["tp_usr_id"];

	$aca_id = $_POST["aca_id"];



	$sql = "INSERT INTO painel_permissao (tp_usr_id, aca_id) VALUES('$tp_usr_id','$aca_id')";

	$res = mysql_query($sql) or die(mysql_error());

	if($res){

		echo "<script>alert('Registro Inserido com sucesso')</script>";

	}else{

		echo "<script>alert('Um erro inesperado aconteceu')</script>";

	}

	$action = "";

}

if($tp_id && $action == ""){

?>
	<div class="table">
    <form name="lista" method="post" action="?cp=<?php echo $cp?>&c=<?php echo $c?>" onsubmit="return confirma_delete()">
    <input type="Hidden" value="deleta" name="action">
    <input type="hidden" value="<?php echo $cp?>" name="cp" />
    <input type="hidden" value="<?php echo $c?>" name="c" />
    <input type="hidden" value="<?php echo $tp_id?>" name="tp_id">
    <table width="100%" cellpadding="0" cellspacing="0" class="listing">
        <tr>
            <th><img src="imagens/x.png"></th>
            <th>Id:</th>
            <th>Cargo:</th>
            <th>Canal:</th>
            <th>Status:</th>
        </tr>

    <?php

	$i = 1;
    $sql = mysql_query("SELECT * FROM painel_permissao p, painel_canais c, painel_cargos u 

			WHERE p.tp_usr_id = '$tp_id' AND p.aca_id=c.aca_id AND p.tp_usr_id=u.tp_usr_id 

			ORDER BY c.aca_ordem");

    while($row=mysql_fetch_array($sql)){
		$css = $i%2==0 ? '' : ' style="background:none;"';
    ?>

        <tr>
            <th<?php echo $css; ?>><img src="imagens/x.png" onClick="apagar.sim('<?php echo $row['per_id']; ?>');" style="cursor:pointer;"></th>
            <th<?php echo $css; ?>><?php echo $row['per_id']; ?></th>
            <th<?php echo $css; ?>><?php echo $row['tp_usr_nome']?></th>
            <th<?php echo $css; ?>><?php echo $row['aca_nome']?></th>
            <th<?php echo $css; ?>><?php echo $row['aca_status']?></th>

        </tr>

   <?php

        $i++;

    }

    ?>

    </table>
    </form>
    </div>

<?php

}elseif($action == ""){

	$sql = "SELECT * FROM painel_cargos ORDER BY tp_usr_nome";

	$res = mysql_query($sql);

?>


	Selecione um tipo de usu&aacute;rio para dar permiss&atilde;o

	<form>

    	<select name="tp_id" onchange="seleciona_tp(this.value)" class="form2">

        <option value=""> -- </option>

<?php

while($row = mysql_fetch_array($res)){

?>

	<option value="<?php echo $row['tp_usr_id']?>"><?php echo $row['tp_usr_nome']?></option>

<?php

}

?>

        </select>

    </form>

<?php 

}

?>
<?php } ?>


</div>
</div>