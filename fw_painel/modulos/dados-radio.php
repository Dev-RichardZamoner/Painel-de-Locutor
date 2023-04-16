<div id="barra_title_pagina">
<div id="base_icone_local_pagina">
<div id="icone_local_pagina"></div>
</div>
<div id="base_text_topo_local_pagina" class="text_barra_title_pagina">Locução / Dados da rádio</div>
<div id="content_title_pagina" class="title_pagina_barra">Dados da rádio</div>
</div>

<div id="lado_dir_content">
<div id="box_pagina_conteudo">
<div id="content_list_inser_registro">
</div>
<?php
$sql = mysql_query("SELECT * FROM dados_radio");
$ver = mysql_fetch_array($sql);
?>
<h1>Coloque esses dados no seu Sam Broadcaster ou programa usado para locução.</h1>
<hr>
<b>Quality:</b> <em>High Quality</em><br>
<b>Format:</b> <em>AACPLUS: 48 kb/s, 44,1 kHz, Stereo</em><br>
<b>Ip:</b> <em><?php echo $ver['ip']; ?></em><br>
<b>Porta:</b> <em><?php echo $ver['porta']; ?></em><br>
<b>Senha da rádio: </b><em><?php echo $ver['senha_radio']; ?></em><br>
<b>Station name: </b><em><?php echo $_SESSION['usuario_admin']; ?></em><br>
<b>Genre:</b> <em>Seu Programa</em><br>
<b>Website URL: </b><a href="http://www.paneladourada.org/" target="_blank">http://www.paneladourada.org/</a>
</div>
</div>