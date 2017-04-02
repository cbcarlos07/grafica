/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function chamarIdade() {
    var hoje = new Date();
    console.log("Hoje: "+hoje);
    var data = document.getElementById("nascimento").value;
    var dataNasc = data.split("/");
    var dia = dataNasc[0];
    var mes = dataNasc[1];
    var ano = dataNasc[2];
    console.log("Data do campo: "+data);
    var nascimento = new Date(mes +"/"+dia+"/"+ano);
    console.log("Nascimento: "+nascimento);
    var campoidade = document.getElementById("idade");
    var diferencaAnos = hoje.getFullYear() - nascimento.getFullYear();
    if ( new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) <
        new Date(hoje.getFullYear(), nascimento.getMonth(), nascimento.getDate()) )
        diferencaAnos--;
    //return diferencaAnos;
    console.log("Idade 1 :"+diferencaAnos);
    var mensagem = $('.mensagem');
    if(diferencaAnos < 0 || Number.isNaN(diferencaAnos)){
        campoidade.value = "";
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Insira uma data v&aacute;lida</p>').fadeIn("fast");
        data.focus();
    }else{
        campoidade.value = diferencaAnos;
        mensagem.empty().html('<p class="alert "></p>');
    }
    //campoidade.value = diferencaAnos;

}
/*
$('.data-nasc').focusout(function (){
    var hoje = new Date();
    console.log("Hoje: "+hoje);
    var data = document.getElementById("nascimento").value;
    var dataNasc = data.split("/");
    var dia = dataNasc[0];
    var mes = dataNasc[1];
    var ano = dataNasc[2];
    console.log("Data do campo: "+data);
    var nascimento = new Date(mes +"/"+dia+"/"+ano);
    console.log("Nascimento: "+nascimento);
    var campoidade = document.getElementById("idade");
    var diferencaAnos = hoje.getFullYear() - nascimento.getFullYear();
    if ( new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) <
        new Date(hoje.getFullYear(), nascimento.getMonth(), nascimento.getDate()) )
        diferencaAnos--;
    //return diferencaAnos;
    console.log("Idade 1 :"+diferencaAnos);
    var mensagem = $('.mensagem');
    if(Number.isNaN(diferencaAnos)){
        campoidade.value = "";
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Insira uma data v&aacute;lida</p>').fadeIn("fast");
        data.focus();
    }else{
        campoidade.value = diferencaAnos;
        mensagem.empty().html('<p class="alert "></p>');
    }
    //campoidade.value = diferencaAnos;


});
*/

$(document).ready(function(){
    
    console.log("Calcular idade");
    var hoje = new Date();
    console.log("Hoje: "+hoje);
    var data = document.getElementById("nascimento").value;
    if(data == "__/__/____"){
        console.log("Data vazia");
    }else{
        var nascimento = new Date(data);
    var dataNasc = data.split("/");
    var dia = dataNasc[0];
    var mes = dataNasc[1];
    var ano = dataNasc[2];
    console.log("Data do campo: "+data);
    var nascimento = new Date(mes +"/"+dia+"/"+ano);    
    var campoidade = document.getElementById("idade");
    var diferencaAnos = hoje.getFullYear() - nascimento.getFullYear();
    if ( new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) < 
         new Date(hoje.getFullYear(), nascimento.getMonth(), nascimento.getDate()) )
        diferencaAnos--;
    //return diferencaAnos;
    if(Number.isNaN(diferencaAnos)){
        console.log("Idade 2:"+diferencaAnos);
        campoidade.value = "";
    }else{
        console.log("Idade:"+diferencaAnos);
        campoidade.value = diferencaAnos;
    }


    }
    

})
    
   



function selecionarValor(codigo)
{
	var combo = document.getElementById("valor");
	
	for (var i = 0; i < combo.options.length; i++)
	{
		if (combo.options[i].value == codigo)
		{
			combo.options[i].selected = "true";
			break;
		}
	}
}


function setTotal(){
    var chale  = document.getElementById("chale");
    var campoTotal = document.getElementById("total");
    var valorTotal = valor;
    if(chale.checked == true){
        valorTotal = parseFloat(valorTotal) + parseInt(200);
    }
    //var valor = 16.00
    //var texto = valorTotal.toLocaleString("pt-br", { style: "currency" });
    console.log("Valor: "+valorTotal);
   // var texto = Number(valorTotal.toFixed(2)).toLocaleString('pt-br');
    var value1 = new Number(valorTotal).toLocaleString('br', { style: 'currency', currency: 'BRL'});
    campoTotal.value = value1.replace(".",",");
   // alert("Total");
}

$('.chale').click(function (){
   // var check = document.getElementById("check");
   console.log("Check clicado");
    setTotal();
});
/*function idade() {
    var hoje = new Date();
    console.log("Hoje: "+hoje);
    var data = document.getElementById("data").value;
    var nascimento = new Date(data);
    var campoidade = document.getElementById("idade");
    var diferencaAnos = hoje.getFullYear() - nascimento.getFullYear();
    if ( new Date(hoje.getFullYear(), hoje.getMonth(), hoje.getDate()) < 
         new Date(hoje.getFullYear(), nascimento.getMonth(), nascimento.getDate()) )
        diferencaAnos--;
    //return diferencaAnos;
    console.log("Idade:"+diferencaAnos);
    campoidade.value = diferencaAnos;
   
}
*/
//$("input").datepicker();

/*
$("button").click(function() {
    var nascimento = $("input:eq(0)").datepicker("getDate");
    var hoje = $("input:eq(1)").datepicker("getDate");
    if ( nascimento && hoje )
        $("span").text(idade(nascimento, hoje) + " anos");
});*/
/*
console.log(idade(new Date(1980, 11, 11), new Date()));
console.log(idade(new Date(2011, 1, 15), new Date()));
console.log(idade(new Date(1993, 4, 31), new Date()));
*/
