<?
  $_NIVEL = "../../";

  $modulo = $_GET['modulo'];


  include($_NIVEL . "conf/common.php");
  include($_NIVEL . "inc/header.php");
  include($_NIVEL . "inc/topmain.php");
  

  echo "<table width=100% height=89% border=0 callpadding=0 cellspacing=1>\n";
  echo "  <tr valign=top>\n";
  echo "    <td class=leftMain width=170 align=left scope=col><BR>\n";
  


  include("../../modulos/".$_GET['modulo']. ".php");
  

?>
 <CENTER>
 <div id="topo_pag1">
 Administração do wPonto
 </div>
 <div id="topo_pag">
  <img src="<?=$_DIRIMGS . "/" . $_IMGSUB?>" /> <a class=blue href="index.php?modulo=<?=$_GET['modulo']?>"><?=$_SUBTITULO?></a>
 </div>
 </center><BR>

<?
?>
