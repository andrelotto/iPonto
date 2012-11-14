<?php

echo "<table class=hide width=100% border=0 cellpadding=0 cellspacing=0>\n";
echo "  <tr>";

if ($_LOGO == "none") {
  echo "<td height=35 align=left  bgcolor=#16337></td>\n";
}else{
  echo "<td align=left  bgcolor=#163375><a href=\"$_URL\"><img border=0 src='$_LOGO'></a></td>";
  echo "<td width=80% valign=center align=center bgcolor=#163375><font face=\"Tahoma, arial\" size=6 color=white><b>" . strtoupper($_TITULO) . "</b></font></td>\n";
}
echo "</tr>\n";
echo "</table>\n";


echo "<table width=100% border=0 cellpadding=0 cellspacing=1>\n";
echo "  <tr class=rowColor>\n";   
echo "    <td height=10 align=right valign=middle>\n";
echo "      <a class=offwhitebold href=\"$_URL\">Principal</a>\n";
echo "      <a class=offwhitebold>|</a><a class=offwhitebold href=\"".$_URL."admin.php\"> Administração&nbsp; </a></td></tr>\n";
echo "</table>\n";
?>
