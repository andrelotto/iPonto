var cle;
 function detect(Event) {
  // Event appears to be passed by Mozilla
  // IE does not appear to pass it, so lets use global var
  if(Event==null) {
  		alert('null');
  		Event=event;
  		}
  cle = Event.keyCode;
 }
 
 function chang(Event,quoi) {
 detect(Event);
 setTimeout('cle=""',100);
 if(cle=='13')
  while(quoi!=null) 
 	{
 	quoi = quoi.nextSibling;
 	if(quoi.tagName=='INPUT') 
 		{
 		quoi.focus();
 		// quoi.select();
 		quoi=null;
 		}
 	}
 }
  
 function ok() {
 if(cle != '13') return true;
 else return false;
 }


function validaData(){
 var currValue = document.forms[0].data.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 47 && codigo < 58 )  {
 }else{
 document.forms[0].data.value=texto;
 }

addBarra();
}

function validaHora(campo){
 var currValue = campo.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 47 && codigo < 58 )  {
 }else{
 campo.value=texto;
 }

addDoisPontos(campo);
}

function addDoisPontos(campo){
 var currValue = campo.value;
 var a = currValue.split (":").join("");

 if ( a.length > 3 )
  campo.value = a.substr(0,2) + ":" + a.substr(2,2) + ":" + a.substr(4);
 else
  if ( a.length > 1 )
   campo.value = a.substr(0,2) + ":" + a.substr(2)
}



function validaUF(){
 var currValue = document.forms[0].uf.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 64 && codigo < 91 )  {
 }else{
 document.forms[0].uf.value=texto;
 }

}
function addBarra(){
 var currValue = document.forms[0].data.value;
 var a = currValue.split ("/").join("");
 
 if ( a.length > 3 )
  document.forms[0].data.value = a.substr(0,2) + "/" + a.substr(2,2) + "/" + a.substr(4);
 else
  if ( a.length > 1 )
   document.forms[0].data.value = a.substr(0,2) + "/" + a.substr(2)
}
function validaCPF(){
 var currValue = document.forms[0].cpf.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 47 && codigo < 58 )  {
 }else{
 document.forms[0].cpf.value=texto;
 }

addPontos();
}

function addPontos(){
  var currValue = document.forms[0].cpf.value;
  var tam = currValue.length;
  if (tam == 3) {
    currValue = currValue + '.';
    document.forms[0].cpf.value=currValue;
  }else{
    if (tam == 7) {
    currValue = currValue + '.';
    document.forms[0].cpf.value=currValue;
    }else{
    if (tam == 11) {
      currValue = currValue + '-';
      document.forms[0].cpf.value=currValue;
    }
    }

  }
}

function validaCEP(){
 var currValue = document.forms[0].cep.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 47 && codigo < 58 )  {
 }else{
 document.forms[0].cep.value=texto;
 }

addTraco();
}

function addTraco(){
 var currValue = document.forms[0].cep.value;
 var tam = currValue.length;
 
 if (tam == 5) {
  currValue = currValue + '-';
  document.forms[0].cep.value=currValue;
 }
}

function validaTEL_RES(){
 var currValue = document.forms[0].tel_res.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 47 && codigo < 58 )  {
 }else{
 document.forms[0].tel_res.value=texto;
 }

addTEL_RES();
}

function addTEL_RES(){
 var currValue = document.forms[0].tel_res.value;
 var tam = currValue.length;
 
 if (tam == 2) {
  currValue = currValue + '-';
  document.forms[0].tel_res.value=currValue;
 }else{
   if (tam == 7) {
  currValue = currValue + '-';
  document.forms[0].tel_res.value=currValue;
   }
 }
}

function validaTEL_CEL(){
 var currValue = document.forms[0].tel_cel.value;
 var tot = currValue.length;
 var inputKey = currValue.substr(tot-1,1);
 var texto = currValue.substr(0,tot-1);
 var codigo = inputKey.charCodeAt(0);

if ( codigo > 47 && codigo < 58 )  {
 }else{
 document.forms[0].tel_cel.value=texto;
 }

addTEL_CEL();
}
function addTEL_CEL(){
 var currValue = document.forms[0].tel_cel.value;
 var tam = currValue.length;
 
 if (tam == 2) {
  currValue = currValue + '-';
  document.forms[0].tel_cel.value=currValue;
 }else{
   if (tam == 7) {
  currValue = currValue + '-';
  document.forms[0].tel_cel.value=currValue;
   }
 }
}


function excluir() {
  var tot=0;
  for (var i = 0; i < document.forms[1].elements.length; i++ ) {
   campo = document.forms[1].elements[i];
   if (campo.value==1) tot++;
  }

  if (tot == 0) {
    alert('Selecione ao menos um registro para excluir!');
  }else{
   if(confirm('ATENÇÃO!! Caso outros registros de outras tabelas depedam desse registro, todos os outros registros da outra tabela também serão removidos!! Você deseja realmente excluir o(s) registro(s) selecionado(s)?')) {
     document.forms[2].submit();
   }
  }
}



function editar() {
  var tot=0;
  for (var i = 0 ; i < document.forms[1].elements.length; i++ ) {
    campo = document.forms[1].elements[i];
    if (campo.value==1) tot++;
  }

  if (tot != 1) {
    alert('Selecione apenas um registro!');
  }else{
    for (var i = 0 ; i < document.forms[1].elements.length; i++ ) {
      campo = document.forms[1].elements[i];
      if (campo.value==1) {
          document.forms[0].elements[0].value=campo.name;
          break;
      }
  }
    document.forms[0].submit();
  }
 
}
function inverte(cor1,cor2) {
  var color2 = cor1;
  var color1 = cor2;
  var linha;

  for (var i = 0 ; i < document.forms[1].elements.length; i++ ) {
    linha = document.getElementById('linha['+i+']');
    campo = document.forms[1].elements[i];
    campo2 = document.forms[2].elements[i];
    if (campo.value==1) {
      campo.value=0;
      campo2.value=0;
      linha.style.background= ""+color1+"";
    }else{
      campo.value=1;
      campo2.value=1;
      linha.style.background= ""+color2+"";
    }
  }

}

function tudo(cor){
  var color = cor;
  var linha;

  for (var i = 0 ; i < document.forms[1].elements.length; i++ ) {
    linha = document.getElementById('linha['+i+']');
    campo = document.forms[1].elements[i];
    campo2 = document.forms[2].elements[i];
    campo.value=1;
    campo2.value=1;
    linha.style.background= ""+color+"";
  }

}

function nada(cor){
  var color = cor;
  var linha;

  for (var i = 0 ; i < document.forms[1].elements.length; i++ ) {
    linha = document.getElementById('linha['+i+']');
    campo = document.forms[1].elements[i];
    campo2 = document.forms[2].elements[i];
    campo.value=0;
    campo2.value=0;
    linha.style.background= ""+color+"";
  }

}


