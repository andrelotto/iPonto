<?
   include("comum.php");
   $tam=strlen($_POST['editarid']);
   $id = substr($_POST['editarid'],6,$tam-7);

   formulario_edit($id, $_TITULOEDIT, $_TABELAS, $_CAMPOSFORM, $_LEGENDASFORM, $_TAMANHOSFORM, $_MASCARAS);

   include("../../inc/$_RODAPE");
?>
