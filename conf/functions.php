<?
/************************************************************************************************************************/
/*  FUNÇÃO......: quebra()                                                                                              */
/*  DESCRIÇÃO...: Para que no código em php fique varios <BR><BR><BR>, use quebra() :) Uma simples função que mostra    */
/*                quantos <BR> você quiser e ainda vem de brinde o \n para o código <HTML> também ficar "organizado"    */
/*  ARGUMENTOS..: $num                                                                                                  */
/*                ----                                                                                                  */
/*                $num      = Numero de vezes que se deseja da o <BR />\n                                               */
/*  RETORNO.....: NULL									                                */
/*                                                                                                                      */
/************************************************************************************************************************/

function quebra($num) {
  for ($i=0;$i<$num;$i++) 
    echo "<BR />\n";
}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : quebra()   ***********************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: converte_data()                                                                                       */
/*  DESCRIÇÃO...: Converte uma data do formato americado (mm/dd/aaaa) para o formato brasileiro (dd/mm/aaaa) usando     */
/*                um separador (/ , - , etc..) informado.                                                               */
/*  ARGUMENTOS..: $data_conv, $sep                                                                                      */
/*                ----------------                                                                                      */
/*                $data_conv = Data para ser convertida, estando no padrão americano.                                   */
/*                $sep       = Separador usado para sepadar os digitos.                                                 */
/*  RETORNO.....: A data convertida para o padrão brasileiro (Dia/Mes/Ano) usando o separador informado.                */
/*                                                                                                                      */
/************************************************************************************************************************/

function converte_data($data_conv, $sep) {
   $dia = substr($data_conv,8,2);
   $mes = substr($data_conv,5,2);
   $ano = substr($data_conv,0,4);

   return "$dia$sep$mes$sep$ano";
}

/************************************************************************************************************************/
/************************************   FIM    DA   FUNÃO  : converte_data()   *****************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: converte_data_ingles()                                                                                */
/*  DESCRIÇÃO...: Converte uma data do formato brasileiro(dd/mm/aaaa) para o formato americado para ser inserido no     */
/*                banco usando um separador (/, - , etc..) informado.                                                   */
/*  ARGUMENTOS..: $data_conv, $sep                                                                                      */
/*                ----------------                                                                                      */
/*                $data_conv = Data para ser convertida, estando no padrão brasileiro                                   */
/*                $sep       = Separador usado para sepadar os digitos.                                                 */
/*  RETORNO.....: A data convertida para o padrão americano pronto para ser inserida no banco ingles                    */
/*                                                                                                                      */
/************************************************************************************************************************/

function converte_data_ingles($data_conv, $sep) {
   $dia = substr($data_conv,0,2);
   $mes = substr($data_conv,3,2);
   $ano = substr($data_conv,6,4);

   return "$ano$sep$mes$sep$dia";
}

/************************************************************************************************************************/
/************************************   FIM    DA   FUNÇÃO  : converte_data()   *****************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: get_dia()                                                                                             */
/*  DESCRIÇÃO...: Obtem o dia da semana abreviado apartir de uma data informada.                                        */
/*  ARGUMENTOS..: $data		                                                                                        */
/*                -----                                                                                                 */
/*                $data      = Data para ser convertida, estando no padrão brasileiro                                   */
/*  RETORNO.....: O Dia da semana em portugues de forma abreviada.				                        */
/*                                                                                                                      */
/************************************************************************************************************************/

function get_dia($dia, $mes, $ano) {
   $dias = array("Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb");

   return $dias[date('w', mktime(0,0,0, $mes, $dia, $ano))];
}

/************************************************************************************************************************/
/************************************   FIM    DA   FUNÇÃO  : get_dia()         *****************************************/
/************************************************************************************************************************/



/************************************************************************************************************************/
/*  FUNÇÃO......: converte_real()                                                                                       */
/*  DESCRIÇÃO...: Converte um numero real do padrao americano (1,898,989.87) para o padrao brasileiro (1.898.989,87)    */
/*                Usando uma qtd de casas informadas.                                                                   */
/*  ARGUMENTOS..: $num_conv, $casas                                                                                     */
/*                -----------------                                                                                     */
/*                $num_conv = Numero no formato americano para ser convertido.                                          */
/*                $casas    = Quantidade de casas decimais.                                                             */
/*  RETORNO.....: O Numero convertido.                                                                                  */
/*                                                                                                                      */
/************************************************************************************************************************/

function converte_real($num_conv, $casas) {
   return strtr(strtr(number_format($num_conv,$casas),".,","-."),"-",",");
}

/************************************************************************************************************************/
/************************************   FIM    DA   FUNÇÃO  : converte_real()   *****************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: linhas()                                                                                              */
/*  DESCRIÇÃO...: Conta e a quantidade de linhas que uma query retornou. Uma conexão ($CON) já deve ter sido criada!    */
/*  ARGUMENTOS..: $sql                                                                                                  */
/*                ----                                                                                                  */
/*                $sql      = SQL contendo a query a ser executada no banco de dados.                                   */
/*  RETORNO.....: O Numero de linhas do resultado.                                                                      */
/*                                                                                                                      */
/************************************************************************************************************************/

function linhas($sql) {
  global $CON;

  $result_tmp = pg_exec($CON,$sql);
  $linhas_tmp = pg_num_rows($result_tmp);
  return $linhas_tmp;
}

/************************************************************************************************************************/
/***************************************   FIM    DA   FUNÇÃO  : linhas()   *********************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: ativa_mascara()                                                                                       */
/*  DESCRIÇÃO...: Função Simples que Retorna uma string para ser colocada no input, para que o mesmo chame uma função   */
/*                javascript apropriada para a validação da mascara informada!						*/
/*  ARGUMENTOS..: $mascara                                                                                              */
/*                --------                                                                                              */
/*                $mascara  = Uma simples string contendo qual mascara deve ser aplicada.                               */
/* 			      Atualmente estão implementadas: uf, cep, cpf, tel_res, tel_cel e data.		        */
/*  RETORNO.....: Uma string para ser posta no input.                                                                   */
/*                                                                                                                      */
/************************************************************************************************************************/

function ativa_mascara($mascara) {
    switch($mascara) {
        case "data"     : $key_up = "onKeyUp=\"validaData()\" MAXLENGTH=10";
                          break;
        case "cpf"      : $key_up = "onKeyUp=\"validaCPF()\" MAXLENGTH=14";
                          break;
        case "cep"      : $key_up = "onKeyUp=\"validaCEP()\" MAXLENGTH=9";
                          break;
        case "tel_res"  : $key_up = "onKeyUp=\"validaTEL_RES()\" MAXLENGTH=12";
                          break;
        case "tel_cel"  : $key_up = "onKeyUp=\"validaTEL_CEL()\" MAXLENGTH=12";
                          break;
        case "uf"       : $key_up = "onKeyUp=\"validaUF()\" MAXLENGTH=2";
                          break;
	case "senha"	: $key_up = "senha";
			  break;
	case "hora"	: $key_up = "onKeyUp=\"validaHora(this)\" MAXLENGTH=8";
			  break;
        case "none"     : $key_up = "";
                          break;
	case "relacao"	: $key_up = "";	
			  break;
    }
    return $key_up;
}

/************************************************************************************************************************/
/**********************************   FIM    DA   FUNÇÃO  : ativa_mascara()   *******************************************/
/************************************************************************************************************************/



/************************************************************************************************************************/
/*  FUNÇÃO......: formulario()                                                                                          */
/*  DESCRIÇÃO...: Monta um formulário para cadastro no banco, colocando os campos um baixo dos outros.                  */
/*  ARGUMENTOS..: $titulo, $campos, $legendas, $tamanhos                                                                */
/*                --------------------------------------                                                                */
/*                $titulo   = String contendo o texto a ser exibido no inicio do formulário.                            */
/*                $campos   = VETOR contendo os campos a serem exibidos no formulário.                                  */
/*                $legendas = VETOR contendo as legendas para serem exibidas antes de cada campo.                       */
/*                $tamanhos = VETOR contendo os Tamanhos em porcentagem que cada campo irá ocupar no formulário.        */
/*                $mascaras = VETOR contendo qual mascara (Javascrip) vai ser usado no campo.                           */
/*                            Consulte a funcao ativa_mascara() para saber quais as máscara possiveis.                 */
/*  RETORNO.....: NULL	                                                                                                */
/*                                                                                                                      */
/*  OBS.........: Os campos do tipo VETOR devem ser passados com o mesmo numero de elemntos!!                           */
/*                                                                                                                      */
/************************************************************************************************************************/

function formulario($titulo, $tabelas, $campos, $legendas, $tamanhos, $mascaras) {
  global $_TABTAM, $CON;

  echo "<CENTER>";
  echo "<div id=\"titulo_form\">$titulo</div>";
  echo "<form name=novo action=preview.php?modulo=$_GET[modulo] method=post>";
  quebra(1);
  echo "<table border=0 width=$_TABTAM>";

  $tabs = explode(",",$tabelas);
  $tot_tabelas = sizeof($tabs);
  
  for ($i=0;$i<$tot_tabelas;$i++) {
    $tab = explode(" ",$tabs[$i]);
    $alias = $tab[1];
    $nome = $tab[0];
    $aliases[$alias]=$nome;
  } 

   /* Obtem as chaves estrangeiras da primeira tabela no banco! */

    $primeira = explode(" ", $tabs[0]);
    $tabela = $primeira[0];
    $chaves = "SELECT pt.tgargs FROM pg_class pc,
                pg_proc pg_proc, pg_proc pg_proc_1, pg_trigger pg_trigger,
                pg_trigger pg_trigger_1, pg_proc pp, pg_trigger pt
                WHERE  pt.tgrelid = pc.oid AND pp.oid = pt.tgfoid
                AND pg_trigger.tgconstrrelid = pc.oid
                AND pg_proc.oid = pg_trigger.tgfoid
                AND pg_trigger_1.tgfoid = pg_proc_1.oid
                AND pg_trigger_1.tgconstrrelid = pc.oid
                AND ((pc.relname =  '$tabela')
                AND (pp.proname LIKE '%%ins')
                AND (pg_proc.proname LIKE '%%upd')
                AND (pg_proc_1.proname LIKE '%%del')
                AND (pg_trigger.tgrelid=pt.tgconstrrelid)
                AND (pg_trigger_1.tgrelid = pt.tgconstrrelid))";

    $result_chaves=pg_exec($CON,$chaves);
    $tot_chaves = pg_num_rows($result_chaves);
    /* Fim da Rotina */

  $campos_sql="";
  $tot=sizeof($campos);
  for ($i=0;$i<$tot;$i++) {
    if ($i!=($tot-1)) {
      $campos_sql.=$campos[$i] . ",";
    }else{
      $campos_sql.=$campos[$i];
    }
  }

  $tot=sizeof($campos);  
  for ($i=1;$i<$tot;$i++) {
    $explode = explode(".", $campos[$i]);
    $alias_atual = $explode[0];
    $campo_atual = $explode[1];

    $dados= pg_meta_data($CON,$aliases[$alias_atual]);
    $tipo_atual = $dados[$campo_atual]['type'];
    $requerido = $dados[$campo_atual]['not null'];

    $negrito="";
    $negritof="";
    if ($requerido) {
      $negrito = "<b>";
      $regritof="</b>";
    }


    $achou=0;
    for ($j=0;$j<$tot_chaves;$j++) {

      $reg_chave = pg_fetch_array($result_chaves,$j);
      $fk = explode("\\000", $reg_chave[0]);
      if ($campo_atual == $fk[4]) { 
        $sql_fk = "SELECT * FROM $fk[2]";
        $result_fk = pg_exec($CON,$sql_fk);
        $linhas_fk = pg_num_rows($result_fk); 
        $achou = 1;
        break;
      }
    }

    $select="";
    if ($achou==1) {
       $select  = "<select name=\"$campo_atual\">\n";
       $select .= "<option value=\"\"> ----> Escolha <---- </option>\n";
       for ($k=0;$k<$linhas_fk;$k++) {
         $estrangeiro = pg_fetch_array($result_fk,$k);
         $id_estr     = $estrangeiro[0];
         $show_estr   = $estrangeiro[1];
         $select     .= "<option value=\"$id_estr\">$show_estr</option>\n";
          
       }  
       $select  .= "</select>\n"; 
    }

    $mask_atual=$mascaras[$i];
    echo "<TR><TD align=right valign=top>$negrito $legendas[$i] $negritof</td>";

    $key_up=ativa_mascara($mask_atual);
    switch($tipo_atual){
  	case "varchar"	: if ($key_up=="senha") {
			    echo "<td><input id=$mask_atual $key_up type=\"password\" name=\"$campo_atual\" size=\"$tamanhos[$i]\"></td></tr>";
			  }else{
                            echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\"></td></tr>";
			  }
			  break;
	case "time"	: echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\"></td></tr>";
			  break;
 	case "text"	: echo "<td><textarea id=$mask_atual $key_up name=\"$campo_atual\" cols=\"$tamanhos[$i]\"></textarea></td></tr>";
			  break;
	case "date"	: echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\"></td></tr>";
			  break;
        case "int4"	: if ($mask_atual=="none") {
                            echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\"></td></tr>";
			  }else{
			    if ($achou==1) echo "<td>$select</td></tr>";
                          }
                          break;
        default     : if ($mask_atual=="none") {
                            echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\"></td></tr>";
                          }else{
                            if ($achou==1) echo "<td>$select</td></tr>";
                          }
                          break;

    }

  }
  echo "<TR><TD colspan=2>";
  quebra(1);
  echo "<input type=button value=\"Cancelar\" onclick=\"javascript: self.history.back();\"><input type=submit value=\"Avançar\"></TD></TR>";
  echo "</table>";
  echo "</form>";
}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : formulario()   *******************************************/
/************************************************************************************************************************/



/************************************************************************************************************************/
/*  FUNÇÃO......: preview()                                                                                             */
/*  DESCRIÇÃO...: Monta um formulário para cadastro no banco, colocando os campos um baixo dos outros.                  */
/*  ARGUMENTOS..: $titulo, $tabelas, $campos, $legendas, $tamanhos                                                      */
/*                ------------------------------------------------                                                      */
/*                $titulo   = String contendo o texto a ser exibido no inicio do formulário.                            */
/*                $tabelas  = Tabelas de onde os campos estao armazenados.					        */
/*                $campos   = VETOR contendo os campos a serem exibidos no formulário.                                  */
/*                $legendas = VETOR contendo as legendas para serem exibidas antes de cada campo.                       */
/*                $tamanhos = VETOR contendo os tamanhos dos campos a serem exibidos.                                   */
/*  RETORNO.....: NULL                                                                                                  */
/*                                                                                                                      */
/*  OBS.........: Os campos do tipo VETOR devem ser passados com o mesmo numero de elemntos!!                           */
/*                                                                                                                      */
/************************************************************************************************************************/

function preview($titulo, $tabelas, $campos, $legendas, $tamanhos) {
  global $CON, $_TABTAM;

  $tabs = explode(",",$tabelas);
  $tot_tabelas = sizeof($tabs);
  
  for ($i=0;$i<$tot_tabelas;$i++) {
    $tab = explode(" ",$tabs[$i]);
    $alias = $tab[1];
    $nome = $tab[0];
    $aliases[$alias]=$nome;
  } 

 
  $tot=sizeof($campos);
  for ($i=1;$i<$tot;$i++) {
    $explode = explode(".", $campos[$i]);
    $alias_atual = $explode[0];
    $campo_atual = $explode[1];

    $dados = pg_meta_data($CON,$aliases[$alias_atual]);
    $tipo_atual = $dados[$campo_atual]['type'];
    $requerido = $dados[$campo_atual]['not null'];

    echo "<CENTER>";
    if (($requerido==1) and ($_POST[$campo_atual]==NULL)) 
     msgerro("Alguns campos são obrigatórios!<BR /> Click <a href=\"#\" onclick=\"javascript: self.history.back();\">aqui</a> para voltar!");

  }
  

  echo "<div id=\"titulo_form\">$titulo</div>";
  echo "<form name=preview action=insert.php?modulo=$_GET[modulo] method=post>";
  quebra(1);
  echo "<table border=0 width=$_TABTAM>";
   
  for ($i=1;$i<$tot;$i++) {
    $explode = explode(".", $campos[$i]);
    $alias_atual = $explode[0];
    $campo_atual = $explode[1];

	  
    echo "<TR><TD align=right valign=top width=20%><b>$legendas[$i]</b></td>";
    echo "<td width=\"$tamanhos[$i]\"><input type=\"hidden\" name=\"$campo_atual\" value=\"$_POST[$campo_atual]\">";
    if ($campo_atual=="senha")  $_POST[$campo_atual]=ereg_replace(".","*",$_POST[$campo_atual]);
    echo "$_POST[$campo_atual]</td></tr>";

  }
  echo "<TR><TD colspan=1 align=right>";
  quebra(1);
  echo "<input type=button value=\"Corrigir\" onclick=\"javascript: self.history.back();\"><input type=submit value=\"Concluir\"></TD><td></td></TR>";
  echo "</table>";
  echo "</form>";

}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : preview()      *******************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: insert()                                                                                              */
/*  DESCRIÇÃO...: Da um insert em uma tabela no banco com base nos dados recebidos do preview via _POST                 */
/*  ARGUMENTOS..: $tabelas                                                                                              */
/*                --------                                                                                              */
/*                $tabelas  = Tabelas de onde os campos serão armazenados.                                              */
/*  RETORNO.....: NULL                                                                                                  */
/*                                                                                                                      */
/************************************************************************************************************************/

function insert($tabelas) {
  global $CON, $_DATAINV, $_DIRINC, $_URL;

  echo "<CENTER>"; 
  $tab_insert = explode(" ",$tabelas);
  $tab_insert = $tab_insert[0];

  $tot = sizeof($_POST);
  $campos="";
  $valores="";

  $keys = array_keys($_POST);

  for ($i=0;$i<$tot;$i++) {
    if ($i==($tot-1)) 
      $fim = "";
    else
      $fim = ", ";
   
    $campos.=$keys[$i] . $fim;
    $v=$keys[$i];
    $campo=$_POST[$v];

    $meta=pg_meta_data($CON,$tab_insert);
    $tipo=$meta[$v]['type'];
   
    switch($tipo) {
      case "date": if (($_DATAINV == "True") && ($campo!=NULL)) $campo = converte_data_ingles($campo,"/");
  	 	   if ($campo==NULL) $campo='1900/01/01';
                   break;
    } 

    if ($keys[$i]=="senha") $campo=md5($campo);
    $valores.="'$campo'" . $fim;
  }
  
  $sql="INSERT INTO $tab_insert ($campos) VALUES ($valores)";
//  echo "Query: ".$sql."<br><br>";
  pg_exec($CON,$sql) or msgerro("Impossível inserir dados na base de dados!");

  echo "<div id=\"msg_insert\">Dados Inseridos com sucesso!";
  quebra(1);
  echo "Click <a href=\"$_DIRINC/acoes/index.php?modulo=$_GET[modulo]\">aqui</a> para voltar.</div>";
  quebra(4);


}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : insert()       *******************************************/
/************************************************************************************************************************/



/************************************************************************************************************************/
/*  FUNÇÃO......: formulario_edit()                                                                                     */
/*  DESCRIÇÃO...: Monta um formulário para editção no banco, colocando os campos um baixo dos outros.                   */
/*  ARGUMENTOS..: $id, $titulo, $campos, $legendas, $tamanhos                                                           */
/*                -------------------------------------------                                                           */
/*                $id       = ID do registro a ser modificado                                                           */
/*                $titulo   = String contendo o texto a ser exibido no inicio do formulário.                            */
/*                $campos   = VETOR contendo os campos a serem exibidos no formulário.                                  */
/*                $legendas = VETOR contendo as legendas para serem exibidas antes de cada campo.                       */
/*                $tamanhos = VETOR contendo os Tamanhos em porcentagem que cada campo irá ocupar no formulário.        */
/*                $mascaras = VETOR contendo qual mascara (Javascrip) vai ser usado no campo.                           */
/*                            Consulte a funcao ativa_mascara() para saber quais as máscara possiveis.                 */
/*  RETORNO.....: NULL                                                                                                  */
/*                                                                                                                      */
/*  OBS.........: Os campos do tipo VETOR devem ser passados com o mesmo numero de elemntos!!                           */
/*                                                                                                                      */
/************************************************************************************************************************/

function formulario_edit($id, $titulo, $tabelas, $campos, $legendas, $tamanhos, $mascaras) {
  global $_TABTAM, $CON;

  echo "<CENTER>";
  echo "<div id=\"titulo_form\">$titulo</div>";
  echo "<form name=edit action=preview_edit.php?modulo=$_GET[modulo] method=post>";
  quebra(1);
  echo "<table border=0 width=$_TABTAM>";

  $tabs = explode(",",$tabelas);
  $tot_tabelas = sizeof($tabs);

  for ($i=0;$i<$tot_tabelas;$i++) {
    $tab = explode(" ",$tabs[$i]);
    $alias = $tab[1];
    $nome = $tab[0];
    $aliases[$alias]=$nome;
  }
 
   /* Obtem as chaves estrangeiras da primeira tabela no banco! */
                          
    $primeira = explode(" ", $tabs[0]);
    $tabela = $primeira[0];
    $chaves = "SELECT pt.tgargs FROM pg_class pc,
                pg_proc pg_proc, pg_proc pg_proc_1, pg_trigger pg_trigger,
                pg_trigger pg_trigger_1, pg_proc pp, pg_trigger pt
                WHERE  pt.tgrelid = pc.oid AND pp.oid = pt.tgfoid
                AND pg_trigger.tgconstrrelid = pc.oid
                AND pg_proc.oid = pg_trigger.tgfoid
                AND pg_trigger_1.tgfoid = pg_proc_1.oid
                AND pg_trigger_1.tgconstrrelid = pc.oid
                AND ((pc.relname =  '$tabela')
                AND (pp.proname LIKE '%%ins')
                AND (pg_proc.proname LIKE '%%upd')
                AND (pg_proc_1.proname LIKE '%%del')
                AND (pg_trigger.tgrelid=pt.tgconstrrelid)
                AND (pg_trigger_1.tgrelid = pt.tgconstrrelid))";

    $result_chaves=pg_exec($CON,$chaves);
    $tot_chaves = pg_num_rows($result_chaves);

    /* Fim da Rotina */

  $campos_sql="";
  $tot=sizeof($campos);
  for ($i=0;$i<$tot;$i++) {
    if ($i!=($tot-1)) { 
      $campos_sql.=$campos[$i] . ",";
    }else{
      $campos_sql.=$campos[$i];
    }
  } 
   
  $sql="SELECT $campos_sql FROM $tabelas WHERE $campos[0] = $id";
  $explode = explode(".", $campos[0]);
  $campo_atual = $explode[1];
  echo "<input type=\"hidden\" name=\"$campo_atual\" value=\"$id\">";
  
  $result_edit=pg_exec($CON,$sql);
  $reg=pg_fetch_array($result_edit,0);

  $tot=sizeof($campos);
  for ($i=1;$i<$tot;$i++) {
    $explode = explode(".", $campos[$i]);
    $alias_atual = $explode[0];
    $campo_atual = $explode[1];

    $dados= pg_meta_data($CON,$aliases[$alias_atual]);
    $tipo_atual = $dados[$campo_atual]['type'];
    $requerido = $dados[$campo_atual]['not null'];
     
    $negrito="";
    $negritof="";
    if ($requerido) {
      $negrito = "<b>";
      $regritof="</b>";
    }

    $achou=0;

    for ($j=0;$j<$tot_chaves;$j++) {
      $reg_chave = pg_fetch_array($result_chaves,$j);
      $fk = explode("\\000", $reg_chave[0]);
      if ($campo_atual == $fk[4]) {
        $sql_fk = "SELECT * FROM $fk[2]";
        $result_fk = pg_exec($CON,$sql_fk);
        $linhas_fk = pg_num_rows($result_fk);
        $achou = 1;
        break;
      }
    }

    $select="";
    if ($achou==1) {
       $select  = "<select name=\"$campo_atual\">\n";
       $select .= "<option value=\"\"> ----> Escolha <---- </option>\n";
       for ($k=0;$k<$linhas_fk;$k++) {
         $estrangeiro = pg_fetch_array($result_fk,$k);
         $id_estr     = $estrangeiro[0];
         $show_estr   = $estrangeiro[1];
         $selecionar  = "";
         if ($reg[$i]==$id_estr) $selecionar = "selected";
         $select     .= "<option value=\"$id_estr\" $selecionar>$show_estr</option>\n";

       }
       $select  .= "</select>\n";
    }


    $mask_atual=$mascaras[$i];

    echo "<TR><TD align=right valign=top>$negrito $legendas[$i] $negritof</td>";
 
    $key_up=ativa_mascara($mask_atual); 
    switch($tipo_atual){
        case "varchar"  : if ($key_up=="senha") {
                            echo "<td><input type=hidden name=\"senha_original\" value=\"$reg[$i]\"><input id=$mask_atual $key_up type=\"password\" name=\"$campo_atual\" size=\"$tamanhos[$i]\" value=\"$reg[$i]\"></td></tr>";
                          }else{
                            echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\" value=\"$reg[$i]\"></td></tr>";
                          }
                          break;
        case "text"     : echo "<td><textarea id=$mask_atual $key_up name=\"$campo_atual\" cols=\"$tamanhos[$i]\">$reg[$i]</textarea></td></tr>";
                          break;
        case "date"     : $data=converte_data($reg[$i],"/");
			  echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\" value=\"$data\"></td></tr>";
                          break;
	case "time"	: echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\" value=\"$reg[$i]\"></td></tr>";
			  break;
        case "int4"     : if ($mask_atual=="none") {
                            echo "<td><input id=$mask_atual $key_up type=\"text\" name=\"$campo_atual\" size=\"$tamanhos[$i]\" value=\"$reg[$i]\"></td></tr>";
                          }else{
                            if ($achou==1) echo "<td>$select</td></tr>";
                          }
                          break;



    }


  }
  echo "<TR><TD colspan=2>";
  quebra(1);
  echo "<input type=button value=\"Cancelar\" onclick=\"javascript: self.history.back();\"><input type=submit value=\"Avançar\"></TD></TR>";
  echo "</table>";
  echo "</form>";
}

/************************************************************************************************************************/
/******************************   FIM    DA   FUNÇÃO  : formulario_editar()    ******************************************/
/************************************************************************************************************************/

/************************************************************************************************************************/
/*  FUNÇÃO......: preview_edit()                                                                                        */
/*  DESCRIÇÃO...: Monta um preview baseado formulário para adastro no banco, colocando os campos um baixo dos outros.   */
/*  ARGUMENTOS..: $titulo, $tabelas, $campos, $legendas, $tamanhos                                                      */
/*                ------------------------------------------------                                                      */
/*                $titulo   = String contendo o texto a ser exibido no inicio do formulário.                            */
/*                $tabelas  = Tabelas de onde os campos estao armazenados.                                              */
/*                $campos   = VETOR contendo os campos a serem exibidos no formulário.                                  */
/*                $legendas = VETOR contendo as legendas para serem exibidas antes de cada campo.                       */
/*                $tamanhos = VETOR contendo os tamanhos dos campos a serem exibidos.                                   */
/*  RETORNO.....: NULL                                                                                                  */
/*                                                                                                                      */
/*  OBS.........: Os campos do tipo VETOR devem ser passados com o mesmo numero de elemntos!!                           */
/*                                                                                                                      */
/************************************************************************************************************************/


function preview_edit($titulo, $tabelas, $campos, $legendas, $tamanhos) {
  global $CON, $_TABTAM;

  $tabs = explode(",",$tabelas);
  $tot_tabelas = sizeof($tabs);

  for ($i=0;$i<$tot_tabelas;$i++) {
    $tab = explode(" ",$tabs[$i]);
    $alias = $tab[1];
    $nome = $tab[0];
    $aliases[$alias]=$nome;
  }


  $tot=sizeof($campos);
  for ($i=1;$i<$tot;$i++) {
    $explode = explode(".", $campos[$i]);
    $alias_atual = $explode[0];
    $campo_atual = $explode[1];

    $dados = pg_meta_data($CON,$aliases[$alias_atual]);
    $tipo_atual = $dados[$campo_atual]['type'];
    $requerido = $dados[$campo_atual]['not null'];

    echo "<CENTER>";
    if (($requerido==1) and ($_POST[$campo_atual]==NULL))
     msgerro("Alguns campos são obrigatórios!<BR /> Click <a href=\"#\" onclick=\"javascript: self.history.back();\">aqui</a> para voltar!");
    }


  echo "<CENTER>";
  $chave=array_keys($_POST);
  $chave=$chave[0];
  echo "<div id=\"titulo_form\">$titulo</div>";
  echo "<form name=preview_edit action=update.php?modulo=$_GET[modulo] method=post>";
  echo "<input type=\"hidden\" name=\"$chave\" value=\"$_POST[$chave]\">";
  quebra(1);
  echo "<table border=0 width=$_TABTAM>";

  for ($i=1;$i<$tot;$i++) {
    $explode = explode(".", $campos[$i]);
    $alias_atual = $explode[0];
    $campo_atual = $explode[1];

    echo "<TR><TD align=right valign=top width=20%><b>$legendas[$i]</b></td>";
    echo "<td width=\"$tamanhos[$i]\"><input type=\"hidden\" name=\"$campo_atual\" ";
 
    if ($campo_atual == "senha" ) 
        if ($_POST['senha_original']!=$_POST[$campo_atual]) 
           $_POST[$campo_atual]=md5($_POST[$campo_atual]);

    echo "value=\"$_POST[$campo_atual]\">";

    if ($campo_atual=="senha") $_POST[$campo_atual] = ereg_replace(".","*",$_POST[$campo_atual]);
    echo "$_POST[$campo_atual]</td></tr>\n";

  }
  echo "<TR><TD colspan=1 align=right>";
  quebra(1);
  echo "<input type=button value=\"Corrigir\" onclick=\"javascript: self.history.back();\"><input type=submit value=\"Concluir\"></TD><td></td></TR>";
  echo "</table>";
  echo "</form>";

}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : preview_edit()   *****************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: update()                                                                                              */
/*  DESCRIÇÃO...: Da um update em uma tabela no banco com base nos dados recebidos do preview via _POST                 */
/*  ARGUMENTOS..: $tabelas                                                                                              */
/*                --------                                                                                              */
/*                $tabelas  = Tabelas de onde os campos serão armazenados.                                              */
/*  RETORNO.....: NULL                                                                                                  */
/*                                                                                                                      */
/************************************************************************************************************************/

function update($tabelas) {
  global $CON, $_DATAINV, $_DIRINC;

  $tab_update = explode(" ",$tabelas);
  $tab_update = $tab_update[0];

  $tot = sizeof($_POST);
  $campos="";
  $valores="";

  $keys = array_keys($_POST);
  $chave = $keys[0];

  for ($i=1;$i<$tot;$i++) {
    if ($i==($tot-1))
      $fim = "";
    else
      $fim = ", ";

    echo "<CENTER>";
    $campos.=$keys[$i] . $fim;
    $v=$keys[$i];
    $campo=$_POST[$v];

    $meta=pg_meta_data($CON,$tab_update);
    $tipo=$meta[$v]['type'];

    switch($tipo) {
      case "date": if (($_DATAINV == "True") && ($campo!=NULL)) $campo = converte_data_ingles($campo,"/");
                   if ($campo==NULL) $campo='1900/01/01';
                   break;
    }
    
    $sql="UPDATE $tab_update SET $v = '$campo' WHERE $chave = '$_POST[$chave]'";
    pg_exec($CON,$sql) or msgerro("Impossível inserir dados na base de dados!");
  }

  echo "<div id=\"msg_insert\">Dados Modificados com sucesso!";
  quebra(1);
  echo "Click <a href=\"" . $_DIRINC . "/acoes/index.php?modulo=$_GET[modulo]\">aqui</a> para voltar.</div>";
  quebra(3);

}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : update()       *******************************************/
/************************************************************************************************************************/

/************************************************************************************************************************/
/*  FUNÇÃO......: excluir()                                                                                             */
/*  DESCRIÇÃO...: Exclui registros de uma tabela selecionados na pagina de listagem                                     */
/*  ARGUMENTOS..: $titulo, $tabelas, $campo, $registros                                                                 */
/*                -------------------------------------                                                                 */
/*                $titulo   = String contendo o titulo que será exibido na hora da remoção.                             */
/*                $tabelas  = String com as tabelas no qual se deseja remover do banco, porem na hora do explode a      */
/*                            função assume que os registros estão na primeira tabela informada nessa variavel.         */
/*                $campo    = Chave primaria da tabela no qual sera usada para o vetor $registros (abaixo)              */
/*                $registros= VETOR contendo os registros a serem removidos.                                            */
/*  RETORNO.....: NULL                                                                                                  */
/*                                                                                                                      */
/************************************************************************************************************************/

function excluir($titulo, $tabelas, $campo, $registros) {
  global $CON, $_DIRINC;
  echo "<CENTER>";
  echo "<div id=\"titulo_form\">$titulo</div>";
  quebra(4);
  echo "<table border=0 width=75%>";

  $tab_excluir = explode(" ",$tabelas);
  $tab_excluir = $tab_excluir[0];

  $tot=sizeof($registros);
  $chaves = array_keys($registros);

  for ($i=0;$i<$tot;$i++) {
    $vez=$chaves[$i];
    if ($registros[$vez]!=0) {
       $campo_atual = explode(".", $campo);
       $sql_excluir = "DELETE FROM $tab_excluir where $campo_atual[1] = $chaves[$i]";
       $result_excluir = pg_exec($CON,$sql_excluir) or msgerro("Impossível excluir os dados no banco!");
    }
  }
  echo "<center>Registros excluídos com sucesso!";
  quebra(1);
  echo "Click <a href=\"$_DIRINC/acoes/index.php?modulo=$_GET[modulo]\">aqui</a> para voltar.</div>";
  quebra(4);
}


/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : update()       *******************************************/
/************************************************************************************************************************/


/************************************************************************************************************************/
/*  FUNÇÃO......: listar()	  								                        */
/*  ARGUMENTOS..: $tabelas, $where, $order, $tamanhos, $colunas, $legendas                                              */
/*                -------------------------------------------------------                                               */
/*                $tabelas  = String contendo as tabelas e os alias separadas por , sem espaço de uma para outra.       */
/*                            Ja pronta para o SELECT do SQL. Ex: "clientes cl,produtos p, cheques c"                   */
/*                $where    = String com a clausa WHERE do SQL. Ex: "c.id_cliente = cl.id_cliente"                      */
/*                $order    = Numero inteiro representando o indice do vetor $colunas onde por padrao ficara ordenado.  */
/*                            Ex: 1 -> Ficara ordenado pelo segundo campo                                               */
/*                $tamanhos = VETOR contendo os Tamanhos em porcentagem que cada campo irá ocupar na listagem.          */
/*                $colunas  = VETOR contendo as colunas (campos) do SELECT que serão listados na tabela.                */
/*                            Deve ter o alias antes de cada campo. Ex: array("cl.nome", "cl.endereco", "c.id_cheque")  */
/*                $legendas = VETOR contendo as Legendas que serão exibidas no cabeçalho de cada coluna para os campos. */
/*                            Podendo usar espaços, pontos, etc.. Ex: array("Cód. Cliente", "Nome:", "Endereço:")       */
/*															*/
/*  OBS.........: Os campos do tipo VETOR devem ser passados com o mesmo numero de elemntos!!                           */
/*                                                                                                                      */
/************************************************************************************************************************/

function listar($tabelas, $where, $order, $tamanhos, $colunas, $legendas) {
  global $CON, $_DIRINC, $_DIRIMGS, $_TOTPAG, $_DATAINV, $_ORDERTIPO, 
         $_TAMTAB, $_HINT_NOVO, $_HINT_EDIT, $_HINT_DEL, $_HINT_BUSCA, $_HINT_PRINT,
         $_HINT_ALL, $_HINT_NONE, $_HINT_INV, $_HINT_BP, $_HINT_BA, $_HINT_BN, $_HINT_BU,
         $_COR_NONE, $_COR_SEL;

  // Separa as tabelas dos alias, informadas pelo argumento $tabelas colocando no vetor $aliases onde 
  // o indice é o próprio alias.

  $tabs = explode(",",$tabelas);
  $tot_tabelas = sizeof($tabs);
 
  for ($i=0;$i<$tot_tabelas;$i++) { 
    $tab = explode(" ",$tabs[$i]);
    $alias = $tab[1];
    $nome = $tab[0];
    $aliases[$alias]=$nome;
  }

  // EOR - Fim da Rotina


  // Prepara a string $campos para receber os elementos do argumento $colunas (vetor) para montar o SELECT
  // Levando em consideração o argumento order, ou o _GET[_ORDER] caso o usuario tenha alterado clicando
  // no cabeçalho de coluna.

  $tam = sizeof($colunas);
  $campos = NULL;
  for ($i=0;$i<$tam;$i++) 
   if ($i<($tam-1)) 
     $campos.=$colunas[$i] . ",";
    else
     $campos.=$colunas[$i];

  if (!isset($_GET['_ORDER'])) {
    $ordem=" $colunas[$order]";
    $o = $order;
  }else{
    $o = $_GET['_ORDER'];
    $ordem = " $colunas[$o]";
  }

  if (!isset($_GET['_ORDERTIPO'])) 
    $ordemtipo = $_ORDERTIPO;
  else
    $ordemtipo = $_GET['_ORDERTIPO'];
  

  $sql="SELECT $campos FROM $tabelas WHERE $where ORDER BY $ordem";
//echo $sql;
  if (isset($_GET['_ORDER'])) 
   $ordem=$_GET['_ORDER'];
  else
   $ordem=0;
  

  // EOR - Fim da Rotina


  // Calcula, pagina inicial, fim, total de paginas, para montar o navegador (Ultima Página, Primeira, etc..)
  // Leva em consideração o total de registros por página a ser exibido.

  $tot_reg = linhas($sql);
 
  if (isset($_GET['PAG_ATUAL'])) 
    $PAG_ATUAL = $_GET['PAG_ATUAL'];
  else
    $PAG_ATUAL = 1;
  
  if ($PAG_ATUAL==1) 
   $ANT = 1;
  else
   $ANT = $PAG_ATUAL - 1;
  
  if ($_TOTPAG>=$tot_reg) 
    $POS = 1;
  else
    $POS = $PAG_ATUAL + 1;
  
  if ($_TOTPAG>=$tot_reg) 
    $ULTIMA = 1;
  else
    if (($tot_reg % $_TOTPAG)!=0) 
      $ULTIMA = ceil($tot_reg / $_TOTPAG) ;
    else
      $ULTIMA = $tot_reg / $_TOTPAG;
    
  $FIM=$PAG_ATUAL * $_TOTPAG;
  $INICIO=($FIM - $_TOTPAG)+1;
  
  if (($PAG_ATUAL * $_TOTPAG) >= $tot_reg) $FIM=$tot_reg;

  $INI=$INICIO-1;

  // EOR - Fim da Rotina

  echo "<CENTER>";
  // Monta o cabeçalho da tabela - Primeira Tabela
  echo "<table width=$_TAMTAB border=0 cellpadding=0 cellspaccing=0>";

    // Barra de ferramentas: Novo, Editar, Excluir, Consultar e Imprimir

  $temp    = explode("/",$_SERVER['PHP_SELF']);
  $dirs    = sizeof($temp);
  $arquivo = explode(".",$temp[$dirs-1]);
  $modulo  = $arquivo[0];
  
  echo "<tr><td><a href=\"$_DIRINC/acoes/novo.php?modulo=". $_GET['modulo'] . "\"><img src=\"$_DIRIMGS/new.png\" title=\"$_HINT_NOVO\"></a></td>";
  echo "<td><a href=\"#\" onclick=\"editar();\"><img src=\"$_DIRIMGS/edit.png\" title=\"$_HINT_EDIT\"></a></td>";
  echo "<td><a href=\"#\" onclick=\"excluir();\"><img src=\"$_DIRIMGS/remover.png\" title=\"$_HINT_DEL\"></a></td>";
  echo "<td><img src=\"$_DIRIMGS/busca.png\" title=\"$_HINT_BUSCA\"></td>";
  echo "<td><img src=\"$_DIRIMGS/relatorio.png\" title=\"$_HINT_PRINT\"></td>";
  echo "<td><img src=\"$_DIRIMGS/linha.png\"></td>";
  
    // Barra de ferramentas Seleção: Tudo, Nenhum e Inverter Seleção

  echo "<td><a href=\"#\" onclick=\"tudo('$_COR_SEL');\"><img src=\"$_DIRIMGS/tudo.png\" title=\"$_HINT_ALL\"></a></td>";
  echo "<td><a href=\"#\" onclick=\"nada('$_COR_NONE');\"><img src=\"$_DIRIMGS/nenhum.png\" title=\"$_HINT_NONE\"></a></td>";
  echo "<td><a href=\"#\" onclick=\"inverte('$_COR_SEL','$_COR_NONE');\"><img src=\"$_DIRIMGS/inverter.png\" title=\"$_HINT_INV\"></a></td>";
  echo "<td><img src=\"$_DIRIMGS/linha.png\"></td>";
  
    // Informativo de registros

  echo "<td width=100%>Total de Registros: <b>$tot_reg </b> (De: $INICIO Até: $FIM)</td>";

    // Navegador (Proximo, último, primeiro, etc...)

  echo "<td><a href=\"index.php?modulo=$_GET[modulo]&PAG_ATUAL=1&_ORDER=$ordem&_ORDERTIPO=$ordemtipo\"><img src=\"$_DIRIMGS/primeiro.png\" title=\"$_HINT_BP(1)\"></a></td>";
  echo "<td><a href=\"index.php?modulo=$_GET[modulo]&PAG_ATUAL=$ANT&_ORDER=$ordem&_ORDERTIPO=$ordemtipo\"><img src=\"$_DIRIMGS/anterior.png\" title=\"$_HINT_BA($ANT)\"></a></td>";
  echo "<td>$PAG_ATUAL</td>";
  echo "<td><a href=\"index.php?modulo=$_GET[modulo]&PAG_ATUAL=$POS&_ORDER=$ordem&_ORDERTIPO=$ordemtipo\"><img src=\"$_DIRIMGS/proximo.png\" title=\"$_HINT_BN($POS)\"></a></td>";
  echo "<td><a href=\"index.php?modulo=$_GET[modulo]&PAG_ATUAL=$ULTIMA&_ORDER=$ordem&_ORDERTIPO=$ordemtipo\"><img src=\"$_DIRIMGS/ultimo.png\" title=\"$_HINT_BU($ULTIMA)\"></a></td>";
  echo "</tr></table>";

 
  // EOR - Fim da Rotina 


  // Monta uma tabela com o cabeçalho de colunas, contendo os campos - Segunda tabela 
  // Montando assim os cabeçalhos para o ORDER BY (imagem para cima ou para baixo).
  // Primeiro FORM: Formulario invisivel para editar o registro selecionado!

  echo "<div id=\"titulo_tabela\">";
  echo "<TABLE width=$_TAMTAB border=0 cellpadding=0 cellspaccing=0>";
  echo "<TR class=\"listtop\">";
  echo "<form name=editarreg action=$_DIRINC/acoes/editar.php?modulo=$_GET[modulo] method=post><input type=hidden name=editarid></form>";

  $ordemtipo2="DESC";
  for ($i=0;$i<$tam;$i++) {
    $img = "<img src=\"\">";
    if ($o==$i) 
      if ($ordemtipo == "DESC") {
         $img="<img src=\"$_DIRIMGS/orderby.png\">";
         $ordemtipo2 = "";
      }else{
         $img="<img src=\"$_DIRIMGS/orderby2.png\">";
         $ordemtipo2 = "DESC";
      }

    echo "<TD valign=top width=$tamanhos[$i]><a class=offwhitebold href=\"$_SERVER[PHP_SELF]?modulo=$_GET[modulo]&_ORDER=$i&_ORDERTIPO=$ordemtipo2&PAG_ATUAL=$PAG_ATUAL\">$legendas[$i] $img</a></TD>";
  }
  echo "</TR>";

  // EOR - Fim da Rotina - Segunda Tabela


  // Monta a SQL para listar paginado os registros na tabela
    
  $listar = "$sql $ordemtipo OFFSET $INI LIMIT $_TOTPAG";
  $result_listar = pg_exec($CON,$listar);
  $linhas_tmp = pg_num_rows($result_listar);
  
    // Inicia a tabela da listagem

    // Mostra mensagem de base vazia caso esteja.

  if ($tot_reg==0) 
    echo "<tr><td align=center colspan=$tam>Sem registros no banco de dados!</td></tr>" ;

    // Cria um form com campos hidden para ficar com 1 ou 0 para saber se esta ou nao marcado 
    // (Evitar de aparecer o checkbox)

  echo "<form name=\"teste\" action=teste method=post>";

  for ($i=0;$i<$linhas_tmp;$i++) {
    $linha_tmp = pg_fetch_array($result_listar,$i);
    $cod=$linha_tmp[0];
    echo "<input type=hidden name=\"campo[$cod]\" value=0 id=\"campo[$cod]\">";
    echo "<TR bgcolor=\"$_COR_NONE\" name=\"linha[$i]\" id=\"linha[$i]\" ";
    echo "onmouseover=\"this.style.cursor = 'pointer'\"  onclick=\"if (document.getElementById('campo[$cod]').value == 0) ";
    echo "{document.getElementById('campo[$cod]').value = '1'; document.getElementById('campo2[$cod]').value = '1'; this.style.background = ";
    echo "'$_COR_SEL'; }else{document.getElementById('campo[$cod]').value = '0'; document.getElementById('campo2[$cod]').value = '0' ;";
    echo " this.style.background= '$_COR_NONE'};\"\">\n";

     // Para cada campo esta rodina vai no banco e obtem o seu tipo, caso seja um dos implementados
     // formata a sua saida

    for ($j=0;$j<$tam;$j++) {
      $campo_explode = explode(".",$colunas[$j]);
      $alias_atual = $campo_explode[0];
      $tab_atual = $aliases[$alias_atual];
      $campo_atual = $campo_explode[1];
      $result_meta = pg_meta_data($CON,$tab_atual);
      $tipo = $result_meta[$campo_atual]['type'];
       
      $align="left";
      switch ($tipo) {
        // Tipos de dados implementados:  
        // date   -> Converte a data para o padrao brasileiro caso a variável global $_DATAINV esteja em True
        // float8 -> Substitui os pontos por virgulas e virgulas por pontos

        case "date"   : if ($_DATAINV == "True") $linha_tmp[$j] = converte_data($linha_tmp[$j],"/");
               	        break;

	case "float8" : $linha_tmp[$j] = converte_real($linha_tmp[$j],2);
                        $align="right";
		        break;
      }
        
      echo "<TD WIDTH=$tamanhos[$j] align=$align>$linha_tmp[$j]</td>";
    }
    // Termina o for dos campos (Linha por Linha)

    echo "</tr>";
    flush();
  }
  // Termina o for dos registros
    
  echo "</form></table></div>";
   
  // EOR - Fim da Rotina


  // Monta um form com campos hidden usado para excluir
  $modulo = $_GET['modulo'];
  echo "<form name=\"excluirreg\" action=\"$_DIRINC/acoes/excluir.php?modulo=$modulo\" method=\"post\">";
  for ($i=0;$i<$linhas_tmp;$i++) {
    $linha_tmp = pg_fetch_array($result_listar,$i);
    $cod=$linha_tmp[0];
    echo "<input type=hidden name=\"campo2[$cod]\" value=0 id=\"campo2[$cod]\">";
  }
  echo "</form>";
  echo "</CENTER>";
  // Fim da Rotina
}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : listar()   ***********************************************/
/************************************************************************************************************************/



/************************************************************************************************************************/
/*  FUNÇÃO......: msgerro()                                                                                             */
/*  ARGUMENTOS..: $txt                                                                                                  */
/*                ----                                                                                                  */
/*                $txt      = Texto contento a mensagem que será exibido caso o erro ocorra.                            */
/*                                                                                                                      */
/*  OBS.........: Caso a variável global $_ERROS esteja para True, os dois erros serão mostrados, os internos do php    */
/*                e o erro do sistema gerado por essa função, portanto aconselha-se deixar a variável $_ERROS em False. */
/*                                                                                                                      */
/************************************************************************************************************************/

function msgerro($txt) {
  global $_ADM, $_EMAIL, $_DIRIMGS;

  echo "<div id=erro_titulo>O seguinte erro foi ocasionado:</div>";
  quebra(1);
  echo "<div id=erro><img src=\"$_DIRIMGS/erro.png\" /> $txt</div>";
  quebra(2);
  echo "<div id=erro_rodape>Entre em contato com $_ADM (<a href=\"mailto:$_EMAIL\"> $_EMAIL</a>) para maiores informações!";
  quebra(1);
  echo "Abortando processamento...</div>";
  quebra(2);
  exit (1);
}

/************************************************************************************************************************/
/*************************************   FIM    DA   FUNÇÃO  : msgerro()  ***********************************************/
/************************************************************************************************************************/
?>
