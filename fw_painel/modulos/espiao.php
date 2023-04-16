<?
$dados['ip'] = '198.50.168.208';
$dados['port'] = '9992';

#include("config.php");
#$sql_ = mysql_query("SELECT * FROM dados_radio LIMIT 1");//PESQUISA OS DADOS DA RADIO
#$dados = mysql_fetch_array($sql_);//TRAZ AS INFORMAÇÕES PESQUISADAS
#ATRIBUI VARIAVEIS AOS DADOS PESQUISADOS
$scip = "".$dados['ip']."";
$scport = "".$dados['port']."";
$scpass = "".$dados['password2']."";

$host = "198.50.168.208";

$port = "9992";

$listenlink = 'http://198.50.168.208:9992/listen.pls';  //make link to stream



$fp = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp) {

 $success=2;  //se-t if no connection

}

if($success!=2){ //if connection

 fputs($fp,"GET /index.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp)) {

  $pg .= fgets($fp, 1000);

 }

 fclose($fp); //close connection

 $paage = ereg_replace(".*<font class=default>Stream Title: </font></td><td><font class=default><b>", "", $pg); //extract data

 $paage = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $paage); //extract data

 $pge = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pge = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pge); //extract data

 $pe = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pe = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pe); //extract data

 $musica = ereg_replace(".*<font class=default>Current Song: </font></td><td><font class=default><b>", "", $pg); //extract data

 $musica = ereg_replace("</b></td></tr></table>.*", "", $musica); //extract data

 $numbers = explode(",",$paage); //extract data

 $servertitle=$numbers[0]; //set variable

 $connected=$numbers[1]; //set variable

}







$fp2 = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp2) {

 $success2=2;  //se-t if no connection

}

if($success2!=2){ //if connection

 fputs($fp2,"GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp2)) {

  $pg2 .= fgets($fp2, 1000);

 }

 fclose($fp2); //close connection

$pag = ereg_replace(".*<body>", "", $pg2); //extract data

 $pag = ereg_replace("</body>.*", ",", $pag); //extract data

 $numbers = explode(",",$pag); //extract data

 $currentlisteners=$numbers[4]; //set variable

 $paage = str_replace(" ", "", $paage);	

}
?>
<p>
  <?
$dados['ip'] = '198.50.168.208';
$dados['port'] = '9992';

#include("config.php");
#$sql_ = mysql_query("SELECT * FROM dados_radio LIMIT 1");//PESQUISA OS DADOS DA RADIO
#$dados = mysql_fetch_array($sql_);//TRAZ AS INFORMAÇÕES PESQUISADAS
#ATRIBUI VARIAVEIS AOS DADOS PESQUISADOS
$scip = "".$dados['ip']."";
$scport = "".$dados['port']."";
$scpass = "".$dados['password2']."";

$host = "198.50.168.208";

$port = "9992";

$listenlink = 'http://198.50.168.208:9992/listen.pls';  //make link to stream



$fp = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp) {

 $success=2;  //se-t if no connection

}

if($success!=2){ //if connection

 fputs($fp,"GET /index.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp)) {

  $pg .= fgets($fp, 1000);

 }

 fclose($fp); //close connection

 $paage = ereg_replace(".*<font class=default>Stream Title: </font></td><td><font class=default><b>", "", $pg); //extract data

 $paage = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $paage); //extract data

 $pge = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pge = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pge); //extract data

 $pe = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pe = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pe); //extract data

 $musica = ereg_replace(".*<font class=default>Current Song: </font></td><td><font class=default><b>", "", $pg); //extract data

 $musica = ereg_replace("</b></td></tr></table>.*", "", $musica); //extract data

 $numbers = explode(",",$paage); //extract data

 $servertitle=$numbers[0]; //set variable

 $connected=$numbers[1]; //set variable

}







$fp2 = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp2) {

 $success2=2;  //se-t if no connection

}

if($success2!=2){ //if connection

 fputs($fp2,"GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp2)) {

  $pg2 .= fgets($fp2, 1000);

 }

 fclose($fp2); //close connection

$pag = ereg_replace(".*<body>", "", $pg2); //extract data

 $pag = ereg_replace("</body>.*", ",", $pag); //extract data

 $numbers = explode(",",$pag); //extract data

 $currentlisteners=$numbers[4]; //set variable

 $paage = str_replace(" ", "", $paage);	

}
?>
  Espi&atilde;o de Audiencia:<br><br>
  
  Habbonados<br>
  Locutor: <b>
  <?=$paage?>
  </b><br>
  Programa: <b>
  <?=$pge?>
  </b><br>
  Ouvintes: <b>
  <?=$currentlisteners?>
  </b><br><br>
  
  <?
$dados['ip'] = '69.30.219.230';
$dados['port'] = '8822';

#include("config.php");
#$sql_ = mysql_query("SELECT * FROM dados_radio LIMIT 1");//PESQUISA OS DADOS DA RADIO
#$dados = mysql_fetch_array($sql_);//TRAZ AS INFORMAÇÕES PESQUISADAS
#ATRIBUI VARIAVEIS AOS DADOS PESQUISADOS
$scip = "".$dados['ip']."";
$scport = "".$dados['port']."";
$scpass = "".$dados['password2']."";

$host = "173.193.202.68";

$port = "8015";

$listenlink = 'http://173.193.202.68:8015/listen.pls';  //make link to stream



$fp = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp) {

 $success=2;  //se-t if no connection

}

if($success!=2){ //if connection

 fputs($fp,"GET /index.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp)) {

  $pg .= fgets($fp, 1000);

 }

 fclose($fp); //close connection

 $paage = ereg_replace(".*<font class=default>Stream Title: </font></td><td><font class=default><b>", "", $pg); //extract data

 $paage = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $paage); //extract data

 $pge = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pge = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pge); //extract data

 $pe = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pe = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pe); //extract data

 $musica = ereg_replace(".*<font class=default>Current Song: </font></td><td><font class=default><b>", "", $pg); //extract data

 $musica = ereg_replace("</b></td></tr></table>.*", "", $musica); //extract data

 $numbers = explode(",",$paage); //extract data

 $servertitle=$numbers[0]; //set variable

 $connected=$numbers[1]; //set variable

}







$fp2 = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp2) {

 $success2=2;  //se-t if no connection

}

if($success2!=2){ //if connection

 fputs($fp2,"GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp2)) {

  $pg2 .= fgets($fp2, 1000);

 }

 fclose($fp2); //close connection

$pag = ereg_replace(".*<body>", "", $pg2); //extract data

 $pag = ereg_replace("</body>.*", ",", $pag); //extract data

 $numbers = explode(",",$pag); //extract data

 $currentlisteners=$numbers[4]; //set variable

 $paage = str_replace(" ", "", $paage);	

}
?>
  Habboz<br>
  Locutor: <b>
  <?=$paage?>
  </b><br>
  Programa: <b>
  <?=$pge?>
  </b><br>
  Ouvintes: <b>
  <?=$currentlisteners?>
  </b><br><br>
  
  <?
$dados['ip'] = '66.96.248.200';
$dados['port'] = '2201';

#include("config.php");
#$sql_ = mysql_query("SELECT * FROM dados_radio LIMIT 1");//PESQUISA OS DADOS DA RADIO
#$dados = mysql_fetch_array($sql_);//TRAZ AS INFORMAÇÕES PESQUISADAS
#ATRIBUI VARIAVEIS AOS DADOS PESQUISADOS
$scip = "".$dados['ip']."";
$scport = "".$dados['port']."";
$scpass = "".$dados['password2']."";

$host = "66.96.248.200";

$port = "2201";

$listenlink = 'http://66.96.248.200:2201/listen.pls';  //make link to stream



$fp = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp) {

 $success=2;  //se-t if no connection

}

if($success!=2){ //if connection

 fputs($fp,"GET /index.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp)) {

  $pg .= fgets($fp, 1000);

 }

 fclose($fp); //close connection

 $paage = ereg_replace(".*<font class=default>Stream Title: </font></td><td><font class=default><b>", "", $pg); //extract data

 $paage = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $paage); //extract data

 $pge = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pge = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pge); //extract data

 $pe = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pe = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pe); //extract data

 $musica = ereg_replace(".*<font class=default>Current Song: </font></td><td><font class=default><b>", "", $pg); //extract data

 $musica = ereg_replace("</b></td></tr></table>.*", "", $musica); //extract data

 $numbers = explode(",",$paage); //extract data

 $servertitle=$numbers[0]; //set variable

 $connected=$numbers[1]; //set variable

}







$fp2 = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp2) {

 $success2=2;  //se-t if no connection

}

if($success2!=2){ //if connection

 fputs($fp2,"GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp2)) {

  $pg2 .= fgets($fp2, 1000);

 }

 fclose($fp2); //close connection

$pag = ereg_replace(".*<body>", "", $pg2); //extract data

 $pag = ereg_replace("</body>.*", ",", $pag); //extract data

 $numbers = explode(",",$pag); //extract data

 $currentlisteners=$numbers[4]; //set variable

 $paage = str_replace(" ", "", $paage);	

}
?> HabboFest
  <br>
  Locutor: <b>
  <?=$paage?>
  </b><br>
  Programa: <b>
  <?=$pge?>
  </b><br>
  Ouvintes: <b>
  <?=$currentlisteners?>
  </b><br><br />
  <?
$dados['ip'] = '66.96.248.200';
$dados['port'] = '9704';

#include("config.php");
#$sql_ = mysql_query("SELECT * FROM dados_radio LIMIT 1");//PESQUISA OS DADOS DA RADIO
#$dados = mysql_fetch_array($sql_);//TRAZ AS INFORMAÇÕES PESQUISADAS
#ATRIBUI VARIAVEIS AOS DADOS PESQUISADOS
$scip = "".$dados['ip']."";
$scport = "".$dados['port']."";
$scpass = "".$dados['password2']."";
$host = "66.96.248.200";

$port = "9704";

$listenlink = 'http://66.96.248.200:9704/listen.pls';  //make link to stream



$fp = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp) {

 $success=2;  //se-t if no connection

}

if($success!=2){ //if connection

 fputs($fp,"GET /index.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp)) {

  $pg .= fgets($fp, 1000);

 }

 fclose($fp); //close connection

 $paage = ereg_replace(".*<font class=default>Stream Title: </font></td><td><font class=default><b>", "", $pg); //extract data

 $paage = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $paage); //extract data

 $pge = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pge = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pge); //extract data

 $pe = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pe = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pe); //extract data

 $musica = ereg_replace(".*<font class=default>Current Song: </font></td><td><font class=default><b>", "", $pg); //extract data

 $musica = ereg_replace("</b></td></tr></table>.*", "", $musica); //extract data

 $numbers = explode(",",$paage); //extract data

 $servertitle=$numbers[0]; //set variable

 $connected=$numbers[1]; //set variable

}







$fp2 = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp2) {

 $success2=2;  //se-t if no connection

}

if($success2!=2){ //if connection

 fputs($fp2,"GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp2)) {

  $pg2 .= fgets($fp2, 1000);

 }

 fclose($fp2); //close connection

$pag = ereg_replace(".*<body>", "", $pg2); //extract data

 $pag = ereg_replace("</body>.*", ",", $pag); //extract data

 $numbers = explode(",",$pag); //extract data

 $currentlisteners=$numbers[4]; //set variable

 $paage = str_replace(" ", "", $paage);	

}
?>
  HabboNight<br>
  Locutor: <b>
  <?=$paage?>
  </b><br>
  Programa: <b>
  <?=$pge?>
  </b><br>
  Ouvintes: <b>
  <?=$currentlisteners?>
  </b><br><br />
  <?
$dados['ip'] = '198.24.138.226';
$dados['port'] = '9094';

#include("config.php");
#$sql_ = mysql_query("SELECT * FROM dados_radio LIMIT 1");//PESQUISA OS DADOS DA RADIO
#$dados = mysql_fetch_array($sql_);//TRAZ AS INFORMAÇÕES PESQUISADAS
#ATRIBUI VARIAVEIS AOS DADOS PESQUISADOS
$scip = "".$dados['ip']."";
$scport = "".$dados['port']."";
$scpass = "".$dados['password2']."";

$host = "198.24.138.226";

$port = "9094";

$listenlink = 'http://198.24.138.226:9094/listen.pls';  //make link to stream



$fp = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp) {

 $success=2;  //se-t if no connection

}

if($success!=2){ //if connection

 fputs($fp,"GET /index.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp)) {

  $pg .= fgets($fp, 1000);

 }

 fclose($fp); //close connection

 $paage = ereg_replace(".*<font class=default>Stream Title: </font></td><td><font class=default><b>", "", $pg); //extract data

 $paage = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $paage); //extract data

 $pge = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pge = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pge); //extract data

 $pe = ereg_replace(".*<font class=default>Stream Genre: </font></td><td><font class=default><b>", "", $pg); //extract data

 $pe = ereg_replace("</b></td></tr><tr><td width=100 nowrap>.*", "", $pe); //extract data

 $musica = ereg_replace(".*<font class=default>Current Song: </font></td><td><font class=default><b>", "", $pg); //extract data

 $musica = ereg_replace("</b></td></tr></table>.*", "", $musica); //extract data

 $numbers = explode(",",$paage); //extract data

 $servertitle=$numbers[0]; //set variable

 $connected=$numbers[1]; //set variable

}







$fp2 = fsockopen($host, $port, $errno, $errstr, 30); //open connection

if(!$fp2) {

 $success2=2;  //se-t if no connection

}

if($success2!=2){ //if connection

 fputs($fp2,"GET /7.html HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n"); //get 7.html

 while(!feof($fp2)) {

  $pg2 .= fgets($fp2, 1000);

 }

 fclose($fp2); //close connection

$pag = ereg_replace(".*<body>", "", $pg2); //extract data

 $pag = ereg_replace("</body>.*", ",", $pag); //extract data

 $numbers = explode(",",$pag); //extract data

 $currentlisteners=$numbers[4]; //set variable

 $paage = str_replace(" ", "", $paage);	

}
?>
  TropiHabbo<br>
  Locutor: <b>
  <?=$paage?>
  </b><br>
  Programa: <b>
  <?=$pge?>
  </b><br>
  Ouvintes: <b>
  <?=$currentlisteners?>
</b></p>
<p><br>
  <br />
</p>
