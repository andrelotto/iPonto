<?php

define('FPDF_FONTPATH','fonts/');
include("fpdf.php");
include("../conf/common.php");

$pdf = new fpdf("L","mm","A4");


$CON = pg_connect("host=$_HOST dbname=$_DB user=$_USER password=$_PASS") or msgerro("Impossível acessar a base de dados!");

$mes=$_POST['mes'];
$ano=$_POST['ano'];
$sql_u = "SELECT * FROM unidades where id_unidade = $_POST[id_unidade]";
$result_u = pg_exec($CON,$sql_u);
$reg_u = pg_fetch_array($result_u,0);

$loja = $reg_u[1];
$endereco = $reg_u[2];
$cnpj = $reg_u[11];

$sqli_f = "SELECT * FROM funcionarios where id_unidade = $_POST[id_unidade] order by nome";
$resulti_f = pg_exec($CON,$sqli_f);

$toti_f=pg_num_rows($resulti_f);

for ($f=0;$f<$toti_f;$f++) {
  $regi_f = pg_fetch_array($resulti_f,$f);
  $funcionario = $regi_f[0];
  $sql_f = "SELECT horas_dia, horas_mes, nome, data_admissao, cargo from funcionarios where id_funcionario = $funcionario";
  $result_f = pg_exec($CON,$sql_f);
  $reg_f = pg_fetch_array($result_f,0);
  $horas_dia = $reg_f[0];




$pdf->Open();
$pdf->AddPage();

$pdf->SetMargins(0,0,0);
$pdf->SetFont("Times","B",20);

$pdf->setXY(3,3);
$pdf->Cell(0,5,'Relatório de Ponto  - SisPonto versão 0.1',0,0,'C');

$pdf->line(3,8,292,8);
/* EMPRESA */
$pdf->setXY(3,8);
$pdf->SetFont("Times","B",10);
$pdf->Cell(120,5,'Empresa:',0,0,'L');
$pdf->setXY(3,$pdf->getY()+4);
$pdf->SetFont("Times","",10);
$pdf->Cell(120,5,$loja,1,0,'L');

/* CNPJ */
$pdf->setXY(125,$pdf->getY()-4);
$pdf->SetFont("Times","B",10);
$pdf->Cell(50,5,'CNPJ:',0,0,'L');
$pdf->setXY(125,$pdf->getY()+4);
$pdf->SetFont("Times","",10);
$pdf->Cell(50,5,$cnpj,1,0,'L');


/* ENDERE�O */
$pdf->setXY(177,$pdf->getY()-4);
$pdf->SetFont("Times","B",10);
$pdf->Cell(115,5,'Endereço:',0,0,'L');
$pdf->setXY(177,$pdf->getY()+4);
$pdf->SetFont("Times","",10);
$pdf->Cell(115,5,$endereco,1,0,'L');

/* FUNCIONARIO */
$pdf->ln();
$pdf->setX(3);
$pdf->SetFont("Times","B",10);
$pdf->Cell(120,5,'Funcionário:',0,0,'L');
$pdf->setXY(3,$pdf->getY()+4);
$pdf->SetFont("Times","",10);
$pdf->Cell(120,5,$reg_f[2],1,0,'L');

/* ADMISSAO */
$pdf->setXY(125,$pdf->getY()-4);
$pdf->SetFont("Times","B",10);
$pdf->Cell(50,5,'Admissão:',0,0,'L');
$pdf->setXY(125,$pdf->getY()+4);
$pdf->SetFont("Times","",10);
$pdf->Cell(50,5,converte_data($reg_f[3],"/"),1,0,'L');


/* Cargo */
$pdf->setXY(177,$pdf->getY()-4);
$pdf->SetFont("Times","B",10);
$pdf->Cell(115,5,'Cargo:',0,0,'L');
$pdf->setXY(177,$pdf->getY()+4);
$pdf->SetFont("Times","",10);
$pdf->Cell(115,5,$reg_f[4],1,0,'L');
$pdf->line(3,32,292,32);
$pdf->setXY(3,27);
$pdf->SetFont("Times","B",10);
$pdf->Cell(20,5,'Data/Dia:',0,0,'L');
$pdf->setX(35);
$pdf->Cell(30,5,'Entradas/Saídas:',0,0,'L');
$pdf->setX(150);
$pdf->Cell(15,5,'Trab.:',0,0,'L');
$pdf->setX(170);
$pdf->Cell(25,5,'Extra/Atraso:',0,0,'L');
$pdf->setXY(3,32);



$tot_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

$pdf->SetFont("Times","",9);
$tot_horas_mes = 0;

for ($i=1;$i<=$tot_dias;$i++) {
  $data = date("Y-m-d", mktime(0,0,0, $mes, $i,$ano));
  $sql = "SELECT * from pontos where id_funcionario = $funcionario and CAST(data_hora as text) like '$data %' order by data_hora";
  $result = pg_exec($CON,$sql) or msgerro("Impossível executar busca na base de dados!");
  $tot=pg_num_rows($result);
  $dia_semana = get_dia ($i, $mes, $ano);
  if ($i%2!=0) 
     $pdf->SetFillColor(245,245,245);
  else
     $pdf->SetFillColor(255,255,255);

  if (($dia_semana == "Sáb") or ($dia_semana == "Dom")) 
     $pdf->SetFillColor(235,235,235);

  

  
  $pdf->setX(3);
  $pdf->Cell(192,4,date("d/m/Y", mktime(0,0,0, $mes, $i, $ano)),0,0,'L',1);
  $pdf->setX(20); 

  $pdf->Cell(10,4,$dia_semana,0,0,'L');

  $tot_horas = 0;
  $ultima_entrada = 0;
  $tot_horas_mes_show = NULL;

 
  for ($k=0;$k<$tot;$k++) {
   $reg=pg_fetch_array($result,$k);
   $tipo=$reg[2];


   $hora=explode(" ",$reg[3]);
   $clock=explode(":",$hora[1]);
   $hora=$clock[0];
   $min=$clock[1];
   $pdf->setX($pdf->getX()+5);
   $pdf->Cell(10,4,"$hora:$min",0,0,'L'); 

   if ($tipo==0) {
    $ultima_entrada = ($min + ($hora*60));
   }else{
     $tot_horas += (($min + ($hora*60)) - $ultima_entrada);
   }

  }
   
   $hora = $tot_horas / 60;
   $min = $tot_horas % 60;

   $horad = explode(":",$horas_dia);
   $hora_dia = $horad[0];
   $min_dia = $horad[1];

   if ($tot_horas >= (($hora_dia * 60) + $min_dia))  {
      $extra_falta = $tot_horas - (($hora_dia * 60) + $min_dia);
      $sinal = "+";
   }else{
      $extra_falta = (($hora_dia * 60) + $min_dia) - $tot_horas;
      $sinal = " -";
   }
   
      $horas_trabalhadas = date("H:i", mktime($hora, $min, 0 , $i, $mes, $ano));

   $pdf->setX(150);
   $pdf->Cell(10,4, $horas_trabalhadas ,0,0,'L'); 
   $pdf->setX(170);
   $pdf->Cell(15,4, $sinal . date("H:i", mktime($extra_falta / 60 , $extra_falta % 60, $i, $mes, $ano)),0,0,'L'); 

 

  $tot_horas_mes+=$tot_horas;
  
  $pdf->ln();
  $pdf->line(3,$pdf->getY(),195,$pdf->getY());

}
  $pdf->line(3,$pdf->gety(),3,32);
  $pdf->line(195,$pdf->gety(),195,32);
  $pdf->line(170,$pdf->gety(),170,32);
  $pdf->line(150,$pdf->gety(),150,32);
  $pdf->line(35,$pdf->gety(),35,32);
  $pdf->line(3,32,195,32);
  $pdf->line(195,$pdf->getY(),292,$pdf->getY());

  $pdf->line(292,$pdf->getY(),292,32);


  $pdf->setXY(195,32);
  $pdf->SetFont("Times","B",12);
  $pdf->Cell(97,5, "Resumo Mensal",1,0,'C');

  $periodo_i = date("d/m/Y" ,mktime(0,0,0,$mes, 1, $ano));
  $periodo_f = date("d/m/Y" ,mktime(0,0,0,$mes, $tot_dias, $ano));

  $pdf->setXY(195,40);
  $pdf->SetFont("Times","B",10);
  $pdf->Cell(15,5, "Período: ", 0,0,'L');
  $pdf->SetFont("Times","",10);
  $pdf->Cell(97,5, $periodo_i . " à " . $periodo_f, 0,0,'L');

  $pdf->setXY(195,45);
  $pdf->SetFont("Times","B",10);
  $pdf->Cell(20,5, "Emitido em: ", 0,0,'L');
  $pdf->SetFont("Times","",10);
  $pdf->Cell(97,5,date("d/m/Y \à\s H:i:s"), 0,0,'L');

  $pdf->setXY(195,50);
  $pdf->SetFont("Times","B",10);
  $pdf->Cell(20,5, "C.H. Diária: ", 0,0,'L');
  $pdf->SetFont("Times","",10);
  $pdf->Cell(15,5, $reg_f[0], 0,0,'L');

  $pdf->SetFont("Times","B",10);
  $pdf->Cell(20,5, "C.H. Mensal: ",0,0,'L');

  $pdf->SetFont("Times","",10);
  $pdf->setXY(260,50);
  $pdf->Cell(15,5, $reg_f[1] . ":00", 0,0,'R');

  $pdf->setXY(195,55);
  $pdf->SetFont("Times","B",10);
  $pdf->Cell(65,5, "Total de Horas Trabalhadas.............:  ", 0,0,'L');
  $pdf->SetFont("Times","",10);
  $tot_horas = $tot_horas_mes / 60;
  $tot_horas = explode(".", $tot_horas);
   
  if ($tot_horas[0]<10) $tot_horas[0] = "0$tot_horas[0]";
  if ($tot_horas_mes % 60 <10) { 
     $tot_horas_mes_show = "0" . $tot_horas_mes % 60;
  }else{
     $tot_horas_mes_show = $tot_horas_mes % 60;
  }

  $pdf->Cell(15,5, $tot_horas[0].":". $tot_horas_mes_show, 0,0,'R');

  $resultado = ($reg_f[1] * 60 ) - (($tot_horas[0] * 60) + ($tot_horas_mes % 60));
  $extra_falta = $resultado / 60  ;
  $extra_falta = explode(".", $extra_falta);
  
  $sinal="";
  if (($reg_f[1] * 60) >= (($tot_horas[0] * 60) + ($tot_horas_mes %60)))  $sinal = " -";
  
  $pdf->setXY(195,60);
  $pdf->SetFont("Times","B",10);
  $pdf->Cell(65,5, "Total de Horas Extras/Atrasos.........:  ", 0,0,'L');
  $pdf->SetFont("Times","",10);
  $pdf->Cell(15,5, $sinal . number_format($extra_falta[0] . "." . $resultado % 60, 2, ":", ""), 0,0,'R');
 
  $pdf->line(195,70,292,70);
  $pdf->SetXY(195,120);
  $pdf->Cell(100,5, "Reconheço a exatidão das informações contidas neste documento.", 0,0,"L");

  $pdf->line(200,145,287,145);

  $pdf->SetXY(195,145);
  $pdf->Cell(97,5, $reg_f[2], 0,0,"C");

  $pdf->SetXY(3,158);
  $pdf->SetFont("Times","B",10);
  $pdf->Cell(15,5, "OBS:" ,0,0,'L');
  $pdf->Rect(3,162,289,5);
  $pdf->Rect(3,167,289,5);
  $pdf->Rect(3,172,289,5);
  $pdf->Rect(3,177,289,5);
  $pdf->Rect(3,182,289,5);


  

}





$pdf->outPut();
?> 
