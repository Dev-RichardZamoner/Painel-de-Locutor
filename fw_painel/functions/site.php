<?php
class Site {
	public static function tempoAtras($time){
		$diff = time() - $time;
		$seconds = $diff;
		$minutes = round($diff / 60);
		$hours = round($diff / 3600);
		$days = round($diff / 86400);
		$weeks = round($diff / 604800);
		$months = round($diff / 2419200);
		$years = round($diff / 29030400);
		if($seconds < 10) return "Agora mesmo";
		if($seconds < 60) return "$seconds segundos";
		else if($minutes < 60) return $minutes==1 ?'1 minuto':$minutes.' minutos';
		else if($hours < 24) return $hours==1 ?'1 hora':$hours.' horas';
		else if($days < 7) return $days==1 ?'1 dia':$days.' dias';
		else if($weeks < 4) return $weeks==1 ?'1 semana':$weeks.' semanas';
		else if($months < 12) return $months == 1 ?'1 mes':$months.' meses';
		else return $years == 1 ? '1 ano':$years.' anos';
	}
	public static function encurta($texto, $tamanho){
		 $palavra = strlen($texto);
		 $nova_palavra = substr($texto, 0, $tamanho); 
		 if($palavra > $tamanho){
			 return ''.$nova_palavra.'...';
		 }else{
		return $texto;
		} 
	}
	public static function LimparUrl($texto){
		$texto = html_entity_decode($texto);
		$texto = eregi_replace('[aÃƒÂ¡ÃƒÂ ÃƒÂ£ÃƒÂ¢ÃƒÂ¤]','a',$texto);
		$texto = eregi_replace('[eÃƒÂ©ÃƒÂ¨ÃƒÂªÃƒÂ«]','e',$texto);
		$texto = eregi_replace('[iÃƒÂ­ÃƒÂ¬ÃƒÂ®ÃƒÂ¯]','i',$texto);
		$texto = eregi_replace('[oÃƒÂ³ÃƒÂ²ÃƒÂµÃƒÂ´ÃƒÂ¶]','o',$texto);
		$texto = eregi_replace('[uÃƒÂºÃƒÂ¹ÃƒÂ»ÃƒÂ¼]','u',$texto);
		$texto = eregi_replace('[ÃƒÂ§]','c',$texto);
		$texto = eregi_replace('[ÃƒÂ±]','n',$texto);
		$texto = eregi_replace('( )','-',$texto);
		$texto = eregi_replace('[^a-z0-9\-]','',$texto);
		$texto = eregi_replace('--','-',$texto);
		return strtolower($texto);
	}
	public static function Post($val, $htmlspecialchars = true, $addslashes = true){
		if(isset($_POST[$val])){
			$value = $_POST[$var];
			if($htmlspecialchars){
				$value = htmlspecialchars($value, ENT_QUOTES);
			}else{
				$value = ($addslashes ? addslashes($value) : $value);
			}
			$value = trim($value);
			return $value;
		}
	}
	public static function Alerta($texto, $location){
		if($location == false){
			$montar = '<script>alert(" '.$texto.' ");location.reload();</script>';
		}else{
			$montar = '<script>alert(" '.$texto.' ");location.href="'.$location.'";</script>';
		}
		return $montar;
	}
}