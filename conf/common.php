<?
// VARIAVEIS GLOBAIS - GERAIS
  $_TITULO     = "Sistema de Ponto Eletrônico";
  $_PALAVRAS   = "gpl, software livre, ponto eletrônico, web, postgres, php";
  $_DESCRICAO  = "Sistema simples para controle de ponto dos funcionários";
  $_AUTOR      = "Ivan Brasil Fuzzer";
  $_LICENCA    = "GPL - veja LICENCA.txt";
  $_DATA       = "Qui Set 22 05:27:01 FNT 2005";
  $_VERSAO     = "0.1";

  $_ADM        = "Suporte";
  $_EMAIL      = "ti@progonos.com.br";

  $_URL	       = "http://sisponto.progonos.com/";

  $_DIRIMGS    = $_URL . "imgs";
  $_DIRINC     = $_URL . "inc";

  $_LOGO       = $_DIRIMGS . "/default.jpg";


// Use _ERROS para ativar a depuração das funções, caso esteja False, as funções do PHP não retornarão erros, caso
// caso esteja True, mostrarão os erros!

  $_ERROS      = "False";

// Use _DATAINV para inverter o formato da data, caso no banco esteja em padrao americao (mm/dd/aaaa para dd/mm/aaaa)

  $_DATAINV    = "True";

// VARIAVEIS GLOBAIS - BANCO

  $_HOST       = "10.0.1.25";
  $_DB	       = "wponto";
  $_USER       = "wponto";
  $_PASS       = "wponto";

  $_LOGIN_ADM  = "admin";
  $_PASS_ADM   = "admin";

  $_CABECALHO  = "header.php";
  $_RODAPE     = "footer.php";

  $_TAMTAB     = "75%";


  $_COR_NONE   = "#BEDFFF"; 
  $_COR_SEL    = "#89c0ff";

  $_HINT_NOVO  = "Inserir novo registro";
  $_HINT_EDIT  = "Editar o registro selecionado (Apenas UM)";
  $_HINT_DEL   = "Excluir o(s) registro(s) selecionado(s)";
  $_HINT_BUSCA = "Filtrar registro(s)";
  $_HINT_PRINT = "Preparar para Impressão";

  $_HINT_ALL   = "Seleciona todos os registros";
  $_HINT_NONE  = "Remove a seleção de todos os registros";
  $_HINT_INV   = "Inverte a seleção dos registros";

  $_HINT_BP    = "Vai até a primeira página";
  $_HINT_BA    = "Vai para a página anterior";
  $_HINT_BN    = "Vai para a próxima página";
  $_HINT_BU    = "Vai até a última página";



include("functions.php");

?>
