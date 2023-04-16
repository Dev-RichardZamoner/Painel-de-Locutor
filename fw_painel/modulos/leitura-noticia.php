<?php include('lado_left.php'); ?>
<div id="lado" class="right">
        	<div id="box">
            	<?php
				$id = $_GET['id'];
				$sql = db::Query("SELECT * FROM noticias WHERE id='$id'");
				$item = db::FetchArray($sql);
				if($item['status'] == 'inativo'){
				?>
                <div id="titulo" style="display:table;"><div style="float:left; padding-top:5px;">ARTIGO <em>DESCONHECIDO</em></div>
                <a href="javascript:;" onclick="history.go(-1);"><div id="button-voltar">VOLTAR</div></a>
                </div>
                <div id="corpo">
					Esse Artigo não existe. :-(
                </div>
                <?php }else{ ?>
        		<div id="titulo" style="display:table;"><div style="float:left; padding-top:5px;"><?php echo $item['titulo']; ?></div>
                <a href="javascript:;" onclick="history.go(-1);"><div id="button-voltar">VOLTAR</div></a>
                </div>
                <div id="corpo">
                <div style="width:664px; height:41px; background-color:#E1E1E1; margin-top:10px;">
                	<div style="width:42px; height:41px; background-color:#1D81C9; float:left;">
                    	<div style="width:42px; height:28px; background:url(https://www.habbo.com.br/habbo-imaging/avatarimage?img_format=gif&user=<?php echo $item['criador']; ?>&action=std&direction=3&head_direction=3&gesture=sml&size=s) 6px -9px no-repeat; float:left; margin-top:6px;"></div>
                    </div>
                    <div style="float:left; margin-left:8px; margin-top:12px;">
                    	Postado por: <b><?php echo $item['criador']; ?></b> em <b><?php echo date('d/m/Y', $item['data']); ?></b> ás <b><?php echo date('H:i', $item['data']); ?></b> na categoria Habbo Brasileiro/Portugu&ecirc;s.
                    </div>
                </div>
               	<?php echo $item['texto']; ?>
                </div>
                <?php } ?>
            </div>
            <!-- end #box -->
            <div id="box" class="fim" style="margin:10px 0px; margin-top:14px;"></div>
            <!-- end #box.fim -->
            <?php include('publicidades/menor.php'); ?>
        </div>
        <!-- end #lado.right -->