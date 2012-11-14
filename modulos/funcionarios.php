<?
  $_NIVEL         = "../";

  $_TOTPAG	  = 100;
  $_CAMPO	  = "f.id_funcionario";

  $_TABELAS       = "funcionarios f,unidades u";
  $_COLUNAS       = array("$_CAMPO","f.nome","f.cargo", "f.data_admissao", "f.login", "u.nome_fantasia");
  $_WHERE         = "f.id_funcionario >= 0 AND f.id_unidade = u.id_unidade";
  $_ORDERTIPO     = "";
  $_ORDER         = "1";

  $_LEGENDAS      = array("Cód:","Nome:","Cargo:", "Data Admissão:", "Login:", "Unidade:");
  $_TAMANHOS      = array("5%","30%","25%","15%", "10%", "15%");


  $_CAMPOSFORM    = array("$_CAMPO","f.nome","f.endereco", "f.bairro", "f.cidade", "f.uf", "f.telefone", "f.cargo", "f.data_admissao", "f.horas_dia", "f.horas_mes", "f.login", "f.senha", "f.id_unidade", "f.hora_entrada_manha", "f.hora_saida_manha", "f.hora_entrada_tarde", "f.hora_saida_tarde");
  $_LEGENDASFORM  = array("Cód:","Nome:","Endereço:", "Bairro:", "Cidade:", "UF:", "Telefone:", "Cargo:", "Data Admissão:", "Horas/Dia:", "Horas/Mês:","Login:", "Senha:", "Unidade:", "Entrada Manhã:", "Saída Manhã:", "Entrada Tarde:", "Saída Tarde");
  $_TAMANHOSFORM  = array("5%","45%","45%", "20%", "20%", "3%", "15%", "35%","15%","10%", "10%", "25%", "25%", "14%", "15%", "15%", "15%", "15%");
  $_MASCARAS      = array("none", "none", "none", "none", "none", "uf", "tel_res", "none","data","hora", "none", "none", "senha", "none", "hora", "hora", "hora", "hora");


  $_TITULOEDIT    = "Alteração dos dados do Funcionários";
  $_TITULOEXCLUIR = "Exclusão dos dados do Funcionário";
  $_TITULONOVO	  = "Cadastro de Funcionários";
  $_TITULOPREVIEW = "Confirme os dados do Funcionário";
 

  $_SUBTITULO     = "Gerenciar Funcionários";

  $_IMGSUB        = "funcionarios.png";

  if (!isset($_GET['modulo']))  include($_NIVEL . "inc/acoes/index.php");
?>
