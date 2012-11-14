<?php

// determine what browser the user is using (this is used only for formatting the reports for printing) //

if (strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko')) {
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {
    $browser = 'Netscape';
  } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
    $browser = 'Firefox';
  } else {
    $browser = 'Mozilla';
  }
}
else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
    $browser = 'Opera';
  } else {
    $browser = 'MSIE';
  }
} else {
  $browser = 'Other';
}

$row_count = 0;
$page_count = 0;

?>

<script language="javascript"><!--
  function RetornaHora(){
        var tmp = document.getElementById("hora").value.split(":");
        var s = tmp[2];    var m = tmp[1];    var h = tmp[0];
        s++;
        if (s > 59){ s = 0;    m++; }
        if (m > 59){ m = 0;    h++; }
        if (h > 23) h = 0;
        s = new String(s); if (s.length < 2) s = "0" + s;
        m = new String(m); if (m.length < 2) m = "0" + m;
        h = new String(h); if (h.length < 2) h = "0" + h;
        
        var temp = h + ":" + m + ":" + s;
        document.getElementById("hora").value = temp;
    }
    
</script>
<center>
<?

if (!$_POST['login']) {
?>
<input type="text" size="6" id="hora" readonly="true" value="<? echo date('H:i:s'); ?>" style="border:0; text-align:center; font-size:150px">
<BR><font size=6>
<?
$dia=date('l');
$mes=date('F');

switch($dia) {
	case "Sunday"	: $dia="Domingo";
			  break;
	case "Monday"	: $dia="Segunda-Feira";
			  break;
	case "Tuesday"	: $dia="Terça-Feira";
			  break;
	case "Wednesday": $dia="Quarta-Feira";
			  break;
	case "Thursday"	: $dia="Quinta-Feira";
			  break;
	case "Friday"	: $dia="Sexta-Feira";
			  break;
        case "Saturday" : $dia="Sábado";
                          break;

}

switch($mes) {
	case "January"	: $mes="Janeiro";
			  break;
	case "Febuary"	: $mes="Fevereiro";
			  break;
	case "March"	: $mes="Março";
			  break;
	case "April"	: $mes="Abril";
			  break;
	case "May"	: $mes="Maio";
			  break;
	case "June"	: $mes="Junho";
			  break;
	case "July"	: $mes="Julho";
			  break;
	case "August"	: $mes="Agosto";
			  break;
	case "September": $mes="Setembro";
			  break;
	case "October"  : $mes="Outubro";
			  break;
	case "November" : $mes="Novembro";
			  break;
	case "December" : $mes="Dezembro";
			  break;

}

echo "$dia, ". date('d') . " de " . $mes . " de " . date('Y');

?>
</font>
</center>
<script language="javascript">
    window.setInterval('RetornaHora()', 1000);
</script>
<?
quebra(16);
}else{
   echo "<BR><BR>";
   if (($_POST['login']==NULL) or ($_POST['senha']==NULL))  msgerro("<font size=4>Todos os campos ao lado devem ser preenchidos!<BR>Tente novamente.</font>");
   
   $login=$_POST['login'];
   $sql="SELECT * FROM funcionarios where login = '$login'"; 
   $result=pg_exec($CON,$sql);
   
   if (pg_num_rows($result)==0) msgerro("<font size=4>Login digitado incorreto ou não existe na base de dados!<BR>Tente novamente</font>");
   
   $linha = pg_fetch_array($result,0); 
   $senha_md5 = $linha[11];
   
   if (md5($_POST['senha'])!=$senha_md5) msgerro("<font size=4>Senha digitada não confere com o login informado!<BR>Tente novamente</font>");
?>
<BR><BR>
<table border=0 width=90%>
<tr><td align=right width=30%><font size=5><b>Funcionário:&nbsp;&nbsp;</b></td><td><font size=5><?=$linha[1]?></font></td></tr>
<tr><td align=right><font size=5><b>Cargo:&nbsp;&nbsp;</b></td><td><font size=5><?=$linha[7]?></font></td></tr>  
<tr><td align=right><font size=5><b>Hora Registrada:&nbsp;&nbsp;</b></td><td><font size=5><?=date('G:i:s')?></font></td></tr>  
</table>

<?

   $sql = "SELECT * FROM pontos where id_funcionario = $linha[0] order by data_hora desc limit 1";
   $result = pg_exec($CON,$sql);
   $tot = pg_num_rows($result);
   if ($tot==0) {
      $tipo = "ENTRADA";
      $msg  = "TRABALHO";
      $cor  = "BLUE";
      $tipo2 = 0;
   }else{
     $ultima=pg_fetch_array($result,0);
     $ultimo_tipo=$ultima[2];
     if ($ultimo_tipo == 1) {
       $tipo = "ENTRADA";
       $msg  = "TRABALHO";
       $cor  = "BLUE";
       $tipo2=0;
     }else{
      $tipo = "SAÍDA";
      $msg  = "DESCANSO";
      $cor  = "GREEN";
      $tipo2= 1;
     } 
   }
   $data = date('Y-m-d G:i:s');
   $ip_ponto = getenv("REMOTE_ADDR");
   $sql="INSERT INTO pontos (id_funcionario, tipo, data_hora, ip_ponto) values ('$linha[0]', '$tipo2', '$data', '$ip_ponto')";
   pg_exec($CON,$sql) or msgerro("<font size=4>Impossível registrar o ponto!!!</font>");
quebra(5);
?>
<FONT SIZE=6 color=<?=$cor?>><B>PONTO REGISTRADO COM SUCESSO!</B></FONT>
<? 
quebra(10);
}
?>