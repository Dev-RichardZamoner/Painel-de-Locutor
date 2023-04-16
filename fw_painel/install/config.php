<?php
class db {
	public static function Conect($servidor, $usuario, $senha, $db){
		mysql_connect($servidor, $usuario, $senha);
		mysql_select_db($db);
	}
	public static function Query($val){
		return @mysql_query($val);
	}
	public static function FetchArray($val){
		return @mysql_fetch_array($val);
	}
	public static function NumRows($val){
		return @mysql_num_rows($val);
	}
}
db::Conect('localhost','radiolit_db','l*kCX9KX0c@H','radiolit_db');