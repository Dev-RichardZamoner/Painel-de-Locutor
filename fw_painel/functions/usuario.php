<?php
class Usuario {
	public static function Dados($tipo){
		$sql = db::Query("SELECT * FROM painel_usuarios WHERE usuario='$_SESSION[usuario_admin]'");
		$ver = db::FetchArray($sql);
		return $ver[''.$tipo.''];
	}
}
?>