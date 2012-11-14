<?php
include("../conf/common.php");
include("../inc/header.php");
include("../inc/topmain.php");

echo "<table width=100% border=0 callpadding=0 cellspacing=1>\n";
echo "  <tr valign=top>\n";
echo "    <td colspan=2 class=leftMain width=170 align=left>\n<BR>";

echo "      <table width=100% border=0 cellpadding=7 cellspacing=1>\n";
echo "        <tr><td colspan=2 align=center valign=top><div id=topo_pag1>Administração do wPonto<BR><BR></div></td></tr>\n";
echo "        <tr><td colspan=2>\n";

echo "		<table width=45% border=0 cellpadding=0 cellspacing=1>";
echo "		  <TR><TD rowspan=2 align=right width=20%><a href=\"index.php\"><img src=\"$_DIRIMGS/relatorios.png\" /> </a></td>";
echo "		      <td><a class=blue href=\"index.php\">&nbsp;&nbsp;Emitir Relatórios</a></td>";
echo "		  </TR>";
echo "		</table>";
echo "<CENTER><table width=60% border=0><form name=relatorio action=rel1.php method=post>";
echo "<tr><td align=right><B>Unidade:</B></td><td>";
     $sql = "SELECT id_unidade, nome_fantasia from unidades order by nome_fantasia";
     $result = pg_exec($CON,$sql);
     $tot = pg_num_rows($result);
     if ($tot == 0) {
        echo "Sem registros na base";
     }else{
        echo "<select name=\"id_unidade\">";
        for($i=0;$i<$tot;$i++) {
          $linha = pg_fetch_array($result,$i);
          echo "<option value=\"$linha[0]\">$linha[1] .";
        }
        echo "</select>";
     }
    
echo "</td></tr>";
echo "<tr><td align=right><b>Mês:</b></td><td>";

  $mes = array ("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
  $mes_atual = date('m');
  echo "<select name=\"mes\">";
  for ($i=0;$i<12;$i++) {
       $valor=$i+1;
       if ($valor == $mes_atual)
        echo "<option value=$valor selected>$mes[$i]";
       else
        echo "<option value=$valor>$mes[$i]";
   }
  echo "</select>";
    

echo "</td></tr>";
echo "<tr><td align=right><B>Ano:</B></td><td>";
 $ano = date('Y');

  $sql = "SELECT CAST(max(data_hora) as text) as fim, cast(min(data_hora) as text) as inicio from pontos";
  $result = pg_exec($CON,$sql);
  $linha = pg_fetch_object($result);
  $ano_inicio = explode("-",$linha->inicio);
  $ano_inicio = $ano_inicio[0];
  $ano_final = explode("-",$linha->fim);
  $ano_final = $ano_final[0];
  
  echo "<select name=\"ano\">";
  
 for($i=$ano_inicio;$i<=$ano_final;$i++) {
     if ($i == $ano)
        echo "<option value=$i selected>$i";
     else
        echo "<option value=$i>$i";
 }
  echo "</select>";
echo "</td></tr>";
echo "<TR><TD align=center colspan=2><input type=submit value=Gerar></form></td></tr>";
echo "</table></CENTER>";
quebra(10);
echo "	      </td></tr>\n";
echo "	      </table>";
include '../inc/footer.php';

echo "	</td></tr></table>";
?>=======
<?php
include("../conf/common.php");
include("../inc/header.php");
include("../inc/topmain.php");

echo "<table width=100% border=0 callpadding=0 cellspacing=1>\n";
echo "  <tr valign=top>\n";
echo "    <td colspan=2 class=leftMain width=170 align=left>\n<BR>";

echo "      <table width=100% border=0 cellpadding=7 cellspacing=1>\n";
echo "        <tr><td colspan=2 align=center valign=top><div id=topo_pag1>Administração do wPonto<BR><BR></div></td></tr>\n";
echo "        <tr><td colspan=2>\n";

echo "		<table width=45% border=0 cellpadding=0 cellspacing=1>";
echo "		  <TR><TD rowspan=2 align=right width=20%><a href=\"index.php\"><img src=\"$_DIRIMGS/relatorios.png\" /> </a></td>";
echo "		      <td><a class=blue href=\"index.php\">&nbsp;&nbsp;Emitir Relatórios</a></td>";
echo "		  </TR>";
echo "		</table>";
echo "<CENTER><table width=60% border=0><form name=relatorio action=rel1.php method=post>";
echo "<tr><td align=right><B>Unidade:</B></td><td>";
     $sql = "SELECT id_unidade, nome_fantasia from unidades order by nome_fantasia";
     $result = pg_exec($CON,$sql);
     $tot = pg_num_rows($result);
     if ($tot == 0) {
        echo "Sem registros na base";
     }else{
        echo "<select name=\"id_unidade\">";
        for($i=0;$i<$tot;$i++) {
          $linha = pg_fetch_array($result,$i);
          echo "<option value=\"$linha[0]\">$linha[1] .";
        }
        echo "</select>";
     }
    
echo "</td></tr>";
echo "<tr><td align=right><b>Mês:</b></td><td>";

  $mes = array ("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
  $mes_atual = date('m');
  echo "<select name=\"mes\">";
  for ($i=0;$i<12;$i++) {
       $valor=$i+1;
       if ($valor == $mes_atual)
        echo "<option value=$valor selected>$mes[$i]";
       else
        echo "<option value=$valor>$mes[$i]";
   }
  echo "</select>";
    

echo "</td></tr>";
echo "<tr><td align=right><B>Ano:</B></td><td>";
 $ano = date('Y');
 echo "<select name=\"ano\">";


  $sql = "SELECT CAST(max(data_hora) as text), cast(min(data_hora) as text) from pontos";
  $result = pg_exec($CON,$sql);
  $linha = pg_fetch_array($result,0);
  
  $ano_inicio = explode("-",$linha[0]);
  $ano_inicio = $ano_inicio[0];
  $ano_final = explode("-",$linha[0]);
  $ano_final = $ano_final[0];
 for($i=$ano_inicio;$i<=$ano_final;$i++) {
     if ($i == $ano)
        echo "<option value=$i selected>$i";
     else
        echo "<option value=$i>$i";
 }
  echo "</select>";
echo "</td></tr>";
echo "<TR><TD align=center colspan=2><input type=submit value=Gerar></form></td></tr>";
echo "</table></CENTER>";
quebra(10);
echo "	      </td></tr>\n";
echo "	      </table>";
include '../inc/footer.php';

echo "	</td></tr></table>";
