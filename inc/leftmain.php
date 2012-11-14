<?php

$self = $_SERVER['PHP_SELF']."?origem=login";

echo "<table width=100% height=89% border=0 callpadding=0 cellspacing=1>\n";
echo "  <tr valign=top>\n";
echo "    <td class=leftMain width=170 align=left scope=col>\n";
echo "      <table width=100% border=0 cellpadding=1 cellspacing=0>\n";


echo "	      <TR><TD  height=5></TD></TR>\n";
echo "        <tr><td  align=center align=left valign=middle><B>Registrar Ponto</b></td></tr>\n";
echo "        <TR><TD  height=15><form name=\"ponto\" action=\"$self\" method=\"post\"></TD></TR>\n";

echo "	      <TR><TD>&nbsp;&nbsp;Login:</TD></TR>";
echo "        <TR><TD>&nbsp;&nbsp;<input type=\"text\" name=\"login\" id=\"login\" size=\"18\" maxlength=\"18\"></TD></TR>";
echo "        <TR><TD>&nbsp;&nbsp;Senha:</TD></TR>";
echo "        <TR><TD>&nbsp;&nbsp;<input type=\"password\" name=\"senha\" id=\"senha\" size=\"18\" maxlength=\"18\"></TD></TR>";
echo "        <TR><TD  height=15></TD></TR>\n";
echo "        <TR><TD  height=15></TD></TR>\n";
echo "        <TR><TD align=center><input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Registrar Ponto\">&nbsp;&nbsp;&nbsp;&nbsp;</TD></TR>";


echo "	      </table>";
?>
