<?
  $_NIVEL         = "../";

  $_TOTPAG	  = 100;
  $_CAMPO	  = "u.id_unidade";

  $_TABELAS       = "unidades u";
  $_COLUNAS       = array("$_CAMPO","u.nome_fantasia","u.bairro", "u.uf", "u.telefone", "u.gerente");
  $_WHERE         = "u.id_unidade >= 0";
  $_ORDERTIPO     = "";
  $_ORDER         = "1";

  $_LEGENDAS      = array("Cód:","Nome Fantasia:","Bairro:", "UF:", "Tel.:", "Gerente:");
  $_TAMANHOS      = array("5%","30%","10%", "2%", "10%", "10%");

 
  $_CAMPOSFORM    = array("$_CAMPO","u.nome_fantasia", "u.razao_social", "u.cnpj","u.endereco", "u.bairro", "u.cidade", "u.uf", "u.telefone", "u.gerente", "u.email", "u.obs");
  $_LEGENDASFORM  = array("Cód:","Nome Fantasia:","Razão Social:", "CNPJ:", "Endereço:", "Bairro:", "Cidade:", "UF:", "Telefone:", "Gerente:", "Email:", "OBS:");
  $_TAMANHOSFORM  = array("5%","45%", "45%", "15%", "45%", "20%", "20%", "2%", "10%", "25%", "25%", "75%");
  $_MASCARAS      = array("none", "none", "none", "none","none", "none", "none", "uf", "tel_res", "none", "none", "none");


  $_TITULOEDIT    = "Alteração dos dados da Unidade";
  $_TITULOEXCLUIR = "Exclusão dos dados da Unidade";
  $_TITULONOVO	  = "Cadastro de Unidades";
  $_TITULOPREVIEW = "Confirme os dados da Unidade";
 

  $_SUBTITULO     = "Gerenciar Unidades";

  $_IMGSUB        = "unidades.png";

  if (!isset($_GET['modulo']))  include($_NIVEL . "inc/acoes/index.php");
?>
