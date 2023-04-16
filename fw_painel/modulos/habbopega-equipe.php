<?php include('lado_left.php'); ?>
<div id="lado" class="right">
        	<div id="box">
        		<div id="titulo">EQUIPE <em>HABBOPEGA</em>
                <a href="javascript:;" onclick="history.go(-1);"><div id="button-voltar">VOLTAR</div></a>
                <form action="javascript:;" id="buscar-membro">
                	<input id="nome-membro" type="text" required placeholder="Busque um membro da equipe" style="background:url(media/imgs/extras/input-buscar.png) no-repeat; border:none; outline:none; width:190px; height:28px; padding-bottom:2px; padding-left:6px; padding-right:34px; font-family:Segoe UI; font-size:12px; color:rgba(0,0,0,0.6); float:right; margin-top:-20px;">
                </form>
              </div>
                <div id="corpo" class="pagina">
                	<style>
						#corpo.pagina #titulo-cargo {
							margin:8px auto;
							font-family:Segoe UI;
							font-size:12px;
							color:rgba(0,0,0,0.6);
							font-weight:bold;
						}
						#corpo.pagina #cargos {
							padding-left:5px;
							background-color:rgba(225,225,225,0.6);
							width:660px;
							height:auto;
							margin:8px auto;
							display:table;
							border:1px solid #D6D6D6;
							font-family:Segoe UI;
							font-size:13px;
							color:rgba(0,0,0,0.4);
							font-weight:normal;
							text-shadow:0px 0px 0px;
						}
						#corpo.pagina #cargos ul {
							margin:0;
							padding:0;
							list-style:none;
						}
						#corpo.pagina #cargos ul li {
							float:left;
							padding:7px 5px;
							cursor:pointer;
						}
						#corpo.pagina #cargos ul li:hover {
							padding-top:7px;
							padding-bottom:4px;
							border-bottom:3px solid #197FC8;
						}
						#corpo.pagina #listra {
							background-color:#999999;
							width:1px;
							height:12px;
							float:left;
							margin:10px 2px;
							margin-bottom:0px;
						}
						#corpo.pagina #total {
							background-color:#197FC8;
							width:665px;
							height:40px;
							border-radius:5px;
							-webkit-border-radius:5px;
							-moz-border-radius:5px;
							-o-border-radius:5px;
							font-family:Segoe UI;
							font-size:13px;
							color:#FFF;
							font-weight:normal;
							text-shadow:0px 0px;
						}
						#corpo.pagina #palco {
							background-color:#E1E1E1;
							width:276px;
							height:100px;
							float:left;
							margin-top:12px;
							margin-right:18px;
						}
						#corpo.pagina #palco img {
							width:100px;
							height:100px;
							float:left;
							border:none;
						}
						#corpo.pagina #palco #avatar {
							width:40px;
							height:51px;
							position:absolute;
							margin-left:11px;
							margin-top:49px;
						}
						#corpo.pagina #rede-socias img {
							width:31px;
							height:31px;
							margin-right:6px;
						}
					</style>
<script>
var equipe = {
	total:function(id){
		$.ajax({
			type:'POST',
			url:'ajax-ver/equipe',
			data:{'id':id, 'modo':'total'},
			beforeSend:function(){
				$('#recebe-total-cargo').html('[...]');
			},success:function(html){
				if(html == 0){
					$('#recebe-total-cargo').html('Nenhum membro neste cargo.');
				}else if(html == 1){
					$('#recebe-total-cargo').html('Foram encontrado <b>1</b> membro neste cargo.');
				}else{
					$('#recebe-total-cargo').html('Foram encontrados <b>'+html+'</b> membros neste cargo.');
				}
			}
		});
	},ver:function(id){
		$.ajax({
			type:'POST',
			url:'ajax-ver/equipe',
			data:{'id':id, 'modo':'ver'},
			beforeSend:function(){
				$('#recebe-cargos').hide('blind');
				$('#loading-cargo').show('blind');
				//equipe.total(id);
			},success:function(html){
				$('#recebe-cargos').html(html).show('blind');
				$('#loading-cargo').hide('blind');
			}
		});
	},procurar:function(){
		$('#buscar-membro').submit(function(){
			var nome = $('#nome-membro').val();
			$.ajax({
				type:'POST',
				url:'ajax-ver/equipe',
				data:{'nome':nome, 'modo':'buscar'},
				beforeSend:function(){
					alert('Buscando: '+nome);
					$('#recebe-cargos').hide('blind');
					$('#loading-cargo').show('blind');
				},success:function(html){
					$('#recebe-cargos').html(html).show('blind');
					$('#loading-cargo').hide('blind');
				}
			});
		});
	}
}
$(function(){
	equipe.procurar();
});
</script>
                    <div id="titulo-cargo"><img src="media/imgs/icones/administracao.png"> Administração do site</div>
                    <div id="cargos">
                    	<ul>
                        	<li onClick="equipe.ver('1');">CEO</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('3');">WebMaster</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('2');">Administração de Rádio</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('4');">Administração de Conte&uacute;do</li>
                        </ul>
                    </div>
                    
                    <div id="titulo-cargo"><img src="media/imgs/icones/coordenacao.png"> Coordenação e segurança do site</div>
                    <div id="cargos">
                    	<ul>
                        	<li onClick="equipe.ver('12');">Supervisor de rádio</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('6');">Supervisor de conteúdo</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('16');">Coordenador de Jornalismo</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('17');">Coordenador de Moderação</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('18');">Coordenador de Eventos</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('19');">Coordenador de Artes</li>
                        </ul>
                    </div>
                    
                    <div id="titulo-cargo"><img src="media/imgs/icones/cargos.png"> Outros Cargos</div>
                    <div id="cargos">
                    	<ul>
                        	<li onClick="equipe.ver('7');">Locutor</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('10');">Sonoplasta</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('8');">Jornalista</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('');">Pixel Moderador</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('11');">Valorista</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('9');">Moderador</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('15');">Promotor de Eventos</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('');">Cartunista</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('');">Markenting</li>
                            <div id="listra"></div>
                            <li onClick="equipe.ver('14');">Estágiario</li>
                        </ul>
                    </div>
                    <div id="loading-cargo" style="display:none; width:665px;"><center><img src="media/imgs/icones/ajax-loader.gif" ></center></div>
                    <div id="recebe-cargos" style="width:665px;">
                    	
                    </div>
                </div>
            </div>
            <!-- end #box -->
            <div id="box" class="fim" style="margin:10px 0px; margin-top:14px;"></div>
            <!-- end #box.fim -->
            <?php include('publicidades/menor.php'); ?>
        </div>
        <!-- end #lado.right -->