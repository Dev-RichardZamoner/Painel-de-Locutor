<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Teste / teste</div>
<div id="content_title_pagina" class="title_pagina_barra">Testee</div>
</div>
<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>

    <?php
		if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar'){
			
			$texto   = (!get_magic_quotes_gpc()) ? addslashes($_POST['texto']) : $_POST['texto'];
			$criador   = (!get_magic_quotes_gpc()) ? addslashes($_POST['criador']) : $_POST['criador'];
			
			
			$sql = "INSERT INTO 	painel_vinhetas (texto, criador )
										VALUES
										('$link', '$autor')";
			$qr = mysql_query($sql) or die (mysql_error());
			
					if($qr):
                    echo '<script>alert("Vinheta Adicionar com sucesso !")</script>';
                else:
                    echo '<script>alert("N&atilde;o foi possivel postar a vinheta ! !")</script>';
                endif;
		}
?>
    <form method="post" action="">
      <table width="85%" border="0" cellspacing="0" cellpadding="0" style="margin-left:2px;">
        <tr>
          <td width="23%" height="31" valign="top">Texto </td>
          <td width="77%" valign="top"><input type="text" name="link" size="35" style="outline:none; border:none; border:1px #999 solid; border-radius:2px; height:22px;" /></td>
        </tr>
        <tr>
          <td valign="top">Autor :</td>
          <td valign="top"><input type="text" name="autor" size="35" style="outline:none; border:none; border:1px #999 solid; border-radius:2px; height:22px;" /></td>
        </tr>
      </table>
      <br />
      <input type="hidden" name="acao"  value="cadastrar"/>
      <input type="submit" class="btn" value="Adicionar Vinheta"/>
    </form>
  </div>
</div>
