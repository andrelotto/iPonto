<?
// Caso _ERROS esteja setado para False, desabilita a 
// exibição de erros, caso contrario, habilita!
  if ($_ERROS == "False") 
   error_reporting(0);
  else
   error_reporting(E_ALL);



  if (isset($_GET['origem'])) {
     $tempo=3;
  }else{
     $tempo=9999999;
  }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="Keywords" content="<?=$_PALAVRAS?>" />
        <meta name="Description" content="<?=$_DESCRICAO?>" />
        <meta name="Autor" content="<?=$_AUTOR?>" />
        <meta name="License" content="<?=$_LICENCA?>" />
        <meta name="Date" content="<?=$_DATA?>" />
        <meta HTTP-EQUIV="Refresh" CONTENT="<?=$tempo?>; URL=<?=$_URL?>">

        <title><?=$_TITULO?></title>
        <link rel="Stylesheet" href="<?=$_DIRINC?>/styles.css" />
        <script type="text/javascript" language="JavaScript" src="<?=$_DIRINC?>/functions.js"></script>
</head>
<body onload="document.getElementById('login').focus();">
<?
// Estabelece a conexão com o banco de dados
  $CON = pg_connect("host=$_HOST dbname=$_DB user=$_USER password=$_PASS") or msgerro("Impossível acessar a base de dados!");
?>

