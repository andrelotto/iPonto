<?
  $_NIVEL         = "../";

  $_TOTPAG	  = 100;
  $_CAMPO	  = "p.id_ponto";

  $_TABELAS       = "pontos p, funcionarios f";
//  $_COLUNAS       = array("$_CAMPO","p.data_hora", "f.nome", "p.ip_ponto");
  $_COLUNAS       = array("$_CAMPO", "p.tipo","p.data_hora", "f.nome", "p.ip_ponto");
  $_WHERE         = "f.id_funcionario >= 0 AND p.id_funcionario = f.id_funcionario";
  $_ORDERTIPO     = "";
  $_ORDER         = "2";

  $_LEGENDAS      = array("Id","Tipo","Data:","Funcionário:", "IP:");
  $_TAMANHOS      = array("5%", "10%","30%","30%","15%");


  $_CAMPOSFORM    = array("$_CAMPO", "p.tipo", "f.id_funcionario", "p.data_hora", "p.ip_ponto");
  $_LEGENDASFORM  = array("Id Ponto:","Tipo:", "Funcionário:", "Data:", "IP:");
  $_TAMANHOSFORM  = array("10%", "10%", "10%", "30%", "15%");
  $_MASCARAS      = array("none", "none", "none", "none", "none");


  $_TITULOEDIT    = "Alteração dos dados do Ponto";
  $_TITULOEXCLUIR = "Exclusão dos dados do Ponto";
  $_TITULONOVO	  = "Cadastro de Pontos";
  $_TITULOPREVIEW = "Confirme os dados do Ponto";
 

  $_SUBTITULO     = "Gerenciar Pontos";

  $_IMGSUB        = "pontos.png";

  if (!isset($_GET['modulo']))  include($_NIVEL . "inc/acoes/index.php");
?>