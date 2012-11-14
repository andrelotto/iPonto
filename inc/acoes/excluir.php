<?
  $modulo=$_GET['modulo'];
  include("comum.php");
  $registro = "campo2";
  $_REGISTROS = $_POST[$registro];
  excluir($_TITULOEXCLUIR, $_TABELAS, $_CAMPO, $_REGISTROS);
  include("../../inc/$_RODAPE");
  
?>
