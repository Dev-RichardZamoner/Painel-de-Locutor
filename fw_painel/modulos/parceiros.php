<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Administra��o / Parceiros</div>
<div id="content_title_pagina" class="title_pagina_barra">Parceiros</div>
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

	this.location = 'index.php?cp=<?=$cp?>&c=<?=$c?>&action=muda_status&flag='+flag+'&id_reg='+id_reg+'&campo='+campo_flag;

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

	if(confirm('Tem certeza que voc� deseja apagar este(s) registro(s)?'))

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

<a href="?cp=<?=$cp?>&c=<?=$c?>&action=inserir">Inserir Parceiros</a> | <a href="?cp=<?=$cp?>&c=<?=$c?>">Ver Parceiros</a>

<?

if($action=="muda_status"){

	$flag=$_GET["flag"];

	$id_reg = $_GET["id_reg"];

	$campo = $_GET["campo"];

	$sql = "UPDATE parceiros SET $campo='".$flag."' WHERE par_id='".$id_reg."'";

	$res = mysql_query($sql) or die(mysql_error());

	$action = "";

}elseif($action == 'deleta')

{



	// ------->> loop nos registros selecionados na lista <<-------|

	$del_item = $_POST["del_item"];

	$i=0;

	while($cada_um = each($del_item))

	{

		$sql = "DELETE FROM parceiros WHERE par_id = '".$cada_um[1]."'";

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

		$sql_f = "SELECT * FROM parceiros WHERE par_id='".$id."' LIMIT 1";

		$res_f = mysql_query($sql_f) or die(mysql_error());

		$row_f = mysql_fetch_array($res_f);

		$action = "F_editar";

	}else{

		$action = "F_inserir";

	}

?>

	<form method="post" action="?cp=<?=$cp?>&c=<?=$c?>">

    <input type="hidden" name="action" value="<?=$action?>" />

    <input type="hidden" name="id" value="<?=$id?>" />

    	<table style="float:left">

      

            <tr>

            	<td width="108">Nome:</td>

                <td width="205">

                	<input type="text" style="width:150px;" name="codigo" value="<?=$row_f[par_nome]?>" class="form2" onFocus="this.className='form';" onBlur="this.className='form2'"/>              </td>
            </tr>
 <tr>

            	<td>Url do site:</td>

                <td>

                	<input type="text" style="width:150px;" name="link" value="<?=$row_f[par_link]?>" class="form2" onFocus="this.className='form';" onBlur="this.className='form2'"/>                </td>
          </tr>
            <tr>

            	<td>Url do Button:</td>

                <td>

                	<input type="text" style="width:150px;" name="img" value="<?=$row_f[par_img]?>" class="form2" onFocus="this.className='form';" onBlur="this.className='form2'"/>                </td>
            </tr>
			  <tr>

            	<td>Descri��o:</td>

                <td><input type="text" style="width:150px; height:40px;" name="desc" value="<?=$row_f[par_desc]?>" class="form2" onfocus="this.className='form';" onblur="this.className='form2'"/>                </td>
            </tr>

            <tr>

           	  <td colspan="2"><div align="center"><br />
       	        <input type="submit" name="btn_form" value="Ok" class="form2" />
       	      </div></td>
            </tr>
        </table>

    </form>

<?

}elseif($action == "F_editar"){

	$id = $_POST["id"];

	if($id){


		

		$codigo = $_POST["codigo"];

		$link = $_POST["img"];
		
		
		
		$plink = $_POST["link"];

		$desc = $_POST["desc"];

		$sql = "UPDATE parceiros SET par_nome='$codigo', par_link='$plink', par_img='$link', par_desc='$desc' WHERE par_id='$id'";

		$res = mysql_query($sql) or die(mysql_error());

		if($res){

			echo "<script>alert('Registro Editado com sucesso')</scrit>";

		}else{

			echo "<script>alert('Um erro inesperado aconteceu')</script>";

		}

	}

	$action = "";

}elseif($action == "F_inserir"){

		$codigo = $_POST["codigo"];

		$link = $_POST["img"];
		
		
		
		$plink = $_POST["link"];

		$desc = $_POST["desc"];

	

	$sql = "INSERT INTO parceiros (par_nome, par_link, par_img, par_desc) 

			VALUES('$codigo', '$plink', '$link', '$desc')";

	$res = mysql_query($sql) or die(mysql_error());

	if($res){

		echo "<script>alert('Registro Inserido com sucesso')</script>";

	}else{

		echo "<script>alert('Um erro inesperado aconteceu')</script>";

	}

	$action = "";

}

if($action == ""){

	$num_por_pagina = 30; 



	$pagina = $_GET["pagina"];

	if (!$pagina) {

	   $pagina = 1;

	}
	$primeiro_registro = ($pagina*$num_por_pagina) - $num_por_pagina;

?>

<style>

	a:hover{

		text-decoration:underline;

	}

</style>

<div id="paginacao_topo"></div>
	<div class="table">
    <form name="lista" method="post" action="?c=<?=$cp?>&c=<?=$c?>" onSubmit="return confirma_delete()">

    <input type="Hidden" value="deleta" name="action">

    <input type="hidden" value="<?=$c?>" name="p" />
    <input type="hidden" value="<?=$cp?>" name="cp" />

    <table width="100%" cellpadding="0" cellspacing="0" class="listing">
        <tr>

            <th><center><input style="width:16px;" type="Checkbox" onClick="troca_todos(this);"  alt="Marca ou desmarca todos da lista"></center></th>

            <th><input style="width:16px;" type="Image" src="imagens/x.png" alt="Apagar registros selecionados" align="absmiddle"></th>

            <th><b>Button</b></th>
            
            <th>&nbsp;</th>

          <th><b>Nome</b></th>
            <th><b>Descri��o</b></th>
        </tr>

    <?

    $sql ="SELECT * FROM parceiros ORDER BY par_id DESC 

			LIMIT $primeiro_registro, $num_por_pagina";

    $res = mysql_query($sql) or die(mysql_error());

    $i=1;

    $total = mysql_num_rows($res);

    while($row=mysql_fetch_array($res)){

	$bg = (($i+1)%2==0)?"bg":"";
    ?>

        <tr class="<?=$bg?>">

         
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;" ><input style="width:16px;" type="Checkbox" name="del_item[]" value="<?=$row[par_id]?>"></td>

            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;" ><a href="?cp=<?=$cp?>&c=<?=$c?>&action=editar&id=<?=$row[par_id]?>"><img src="imagens/edit.png" alt="Clique para editar este registro" align="absmiddle" /></a></td>

            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><img src="<?=$row[par_img]?>" /></td>
            
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;">&nbsp;</td>

   

            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><a href="<?=$row[par_link]?>" target="_blank">
              <?=$row[par_nome]?>
            </a></td>
            <td align="center" style="border-left:2px dashed #fff; border-bottom:1px dashed #fff; padding:2px;"><?=$row[par_desc]?></td>
        </tr>

    <?

        $i++;

    }

    ?>
    </table>
    </form>
    </div>

<?

    $sql1 ="SELECT * FROM parceiros ORDER BY par_id DESC";

	$res1= mysql_query($sql1) or die(mysql_error());

	

	$total = mysql_num_rows($res1);

	$total_paginas = $total/$num_por_pagina;



	$prev = $pagina - 1;

	$next = $pagina + 1;



	if ($pagina > 1) {

		$prev_link = "<a href=\"".$PHP_SELF."?cp=$cp&c=$c&pagina=$prev\">Anterior</a>";

	} else { 

		$prev_link = "Anterior";

	}



	// se número total de páginas for maior que a página corrente, então temos link para a próxima página

	if ($total_paginas > $pagina) {

		$next_link = "<a href=\"".$PHP_SELF."?cp=$cp&c=$c&pagina=$next\">Pr&oacute;xima";

	} else { // senão não há link para a próxima página

		$next_link = "Pr&oacute;xima";

	}	

	// vamos arredondar para o alto o número de páginas que serão necessárias para exibir todos os registros. Por exemplo, se temos 20 registros e mostramos 6 por página, nossa variável $total_paginas será igual a 20/6, que resultará em 3.33. Para exibir os 2 registros restantes dos 18 mostrados nas primeiras 3 páginas (0.33), será necessária a quarta página. Logo, sempre devemos arredondar uma fração de número real para um inteiro de cima e isto é feito com a função ceil().

	$total_paginas = ceil($total_paginas);

	$painel = "";

	

	$f = $pagina + 2;

	$f = ($f > $total_paginas)?$total_paginas:$f;

	$n = $pagina - 2;

	$n = ($n<1)?1:$n;

	

	if($n == 1 && $total_paginas >5){

		$f=5;

	}else{

		$f=$pagina+2;

		$f=($f<=$total_paginas)?$f:$total_paginas;

	}



	for ($x=$n; $x<=$f; $x++) {

		if ($x==$pagina) { // se estivermos na página corrente, não exibir o link para visualização desta página

			$painel .= " <b>[$x]</b> ";

		} else {

			$painel .= " <a href=\"".$PHP_SELF."?cp=$cp&c=$c&pagina=$x\">[$x]</a>";

		}

	}

		$paginacao = "<center class='menu2'>$prev_link | $painel | $next_link </center>";

		echo "<BR>".$paginacao;

}

?>

<script>

	$("#paginacao_topo").append("<?=addslashes($paginacao)?>");

</script>