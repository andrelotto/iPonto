<?php
include("conf/common.php");
include("security.php");
include("inc/header.php");
include("inc/topmain.php");

echo "<table width=100% border=0 callpadding=0 cellspacing=1>\n";
echo "  <tr valign=top>\n";
echo "    <td colspan=2 class=leftMain width=170 align=left>\n<BR>";

echo "      <table width=100% border=0 cellpadding=7 cellspacing=1>\n";
echo "        <tr><td colspan=2 align=center valign=top><div id=topo_pag1>Administração do wPonto<BR><BR></div></td></tr>\n";
echo "        <tr><td colspan=2>\n";

echo "		<table width=45% border=0 cellpadding=0 cellspacing=1>";
echo "		  <TR><TD rowspan=2 align=right width=20%><a href=\"$_DIRINC/acoes/index.php?modulo=unidades\"><img src=\"$_DIRIMGS/unidades_g.png\" /> </a></td>";
echo "		      <td><a class=blue href=\"$_DIRINC/acoes/index.php?modulo=unidades\">&nbsp;&nbsp;Gerenciar Unidades</a></td>";
echo "		  </TR>";
echo "		  <TR><td valign=top width=50%><font size=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gerencie aqui todas unidades existentes na empresa.</font></td>";
echo "		  </TR>";
echo "		</table>";
quebra(1);
echo "          <table width=45% border=0 cellpadding=0 cellspacing=1>";
echo "            <TR><TD rowspan=2 align=right width=20%><a href=\"$_DIRINC/acoes/index.php?modulo=funcionarios\"><img src=\"$_DIRIMGS/funcionarios_g.png\" /> </a></td>";
echo "                <td><a class=blue href=\"$_DIRINC/acoes/index.php?modulo=funcionarios\">&nbsp;&nbsp;Gerenciar Funcionários</a></td>";
echo "            </TR>";
echo "            <TR><td valign=top width=50%><font size=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cadastre aqui todos os funcionários da empresa e <BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; defina uma senha para que possa registrar seu ponto!</font></td>";
echo "            </TR>";
echo "          </table>";
quebra(1);
echo "          <table width=45% border=0 cellpadding=0 cellspacing=1>";
echo "            <TR><TD rowspan=2 align=right width=20%><a href=\"$_DIRINC/acoes/index.php?modulo=pontos\"><img src=\"$_DIRIMGS/pontos_g.png\" /> </a></td>";
echo "                <td><a class=blue href=\"$_DIRINC/acoes/index.php?modulo=pontos\">&nbsp;&nbsp;Gerenciar Pontos</a></td>";
echo "            </TR>";
echo "            <TR><td valign=top width=50%><font size=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Altere dados dos pontos registrados <BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; e registre pontos que os funcionários esqueceram!</font></td>";
echo "            </TR>";
echo "          </table>";
quebra(1);
echo "          <table width=45% border=0 cellpadding=0 cellspacing=1>";
echo "            <TR><TD rowspan=2 align=right width=20%><a href=\"" . $_DIRINC . "relatorios/\"><img src=\"$_DIRIMGS/relatorios_g.png\" /> </a> </td>";
echo "                <td><a class=blue href=\"" . $_URL . "relatorios/\">&nbsp;&nbsp;Emitir Relatórios</a></td>";
echo "            </TR>";
echo "            <TR><td valign=top width=50%><font size=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprima relatórios de todos os funcionários, ou <BR> ";
echo "			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;especificando algum. Você também pode selecionar <BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;apenas uma unidade caso prefira.</font></td>";
echo "            </TR>";
echo "          </table>";
quebra(1);
echo "	      </td></tr>\n";
echo "	      </table>";
include 'inc/footer.php';
echo "	</td></tr></table>";
?>
