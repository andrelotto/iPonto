<?php
function bad_auth(){

Header('WWW-authenticate: Basic realm="Administração wPonto"');
Header('HTTP/1.0 401 Unauthorized');
echo "<HTML>\n";
echo " <HEAD>\n";
echo " <TITLE>Autorização Requerida</TITLE>\n";
echo " </HEAD>\n";
echo " <BODY BGCOLOR=#FFFFFF TEXT=#000000>\n";
echo "  Senha ou usuário inválido.<P><br /><br />\n";
echo " </BODY>\n";
echo "</HTML>\n";
exit;
}

$passed = 0;

if ((isset($_SERVER['PHP_AUTH_PW'])) && (isset($_SERVER['PHP_AUTH_USER']))) {
        if (($_SERVER['PHP_AUTH_USER'] == $_LOGIN_ADM) && ( $_SERVER['PHP_AUTH_PW'] == $_PASS_ADM)) {
          $passed = 1;
	}
}


if (!$passed) bad_auth();

?>
