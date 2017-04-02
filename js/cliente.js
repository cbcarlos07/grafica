/**
 * Created by carlos.brito on 21/02/2017.
 */

$('.novo-item').on('click', function(){

    var url = $(this).data('url');
    //alert(url);
    var form = $('<form action="' + url + '" method="post">' +
        //'<input type="text" name="codigo" value="' + codigo + '" />' +
        '</form>');
   // var div = $('<div style="display: none;>"'+form+'</div>');
    $('body').append(form);
    form.submit();

});

function salvar(){
    //alert("Salvar");
    jQuery('#form').submit(function () {
       // alert("Submit");
        var codigo      = document.getElementById('id').value;
       // alert('End: '+codigo);
        var nome        = document.getElementById('nome').value;
        var sobrenome   = document.getElementById('sobrenome').value;
        var cpf         = document.getElementById('cpf').value;
        var rg          = document.getElementById('rg').value;
        var telefone    = document.getElementById('telefone').value;
        var email       = document.getElementById('email').value;
        var nascimento  = document.getElementById('nascimento').value;
        var sexo        = document.getElementById('sexo').value;
        var estadocivil = document.getElementById('estadocivil').value;
        var endereco    = document.getElementById('endereco').value;
        var numero      = document.getElementById('numero').value;
        var complemento = document.getElementById('complemento').value;
        var senha       = document.getElementById('senha').value;
        var senhaatual  = document.getElementById('senhaatual').value;
        var acao        = document.getElementById('acao').value;
        //alert("Numero: "+numero);
        $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/cliente.php',
                beforeSend : carregando,
                data: {
                    'id'          : codigo,
                    'nome'        : nome,
                    'sobrenome'   : sobrenome,
                    'cpf'         : cpf,
                    'rg'          : rg,
                    'telefone'    : telefone,
                    'email'       : email,
                    'nascimento'  : nascimento,
                    'sexo'        : sexo,
                    'estadocivil' : estadocivil,
                    'endereco'    : endereco,
                    'numero'      : numero,
                    'complemento' : complemento,
                    'senha'       : senha,
                    'senhaatual'  : senhaatual,
                    'acao'        : acao
                },
                success: function (data) {
                   // alert(data.retorno);
                    if (data.retorno == 1) {
                        sucesso('Opera&ccedil;&atilde;o realizada com sucesso!');
                    }
                     else {
                        errosend('N&atilde;o foi poss&iacute;vel realizar opera&ccedil;&atilde;o. Verifique se todos os campos est&atilde;o preenchidos ');
                    }
                }
              });
        return false;
    });

}

function deletar(codigo, acao){

    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/cliente.php",
        beforeSend: carregando,
        data: {
            'id'       : codigo,
            'acao'     : acao
        },
        success: function( data )
        {
            console.log("Excluir: "+data.retorno);
            if(data.retorno == 1){
                $('#delete-modal').modal('hide');
                sucesso_delete('Item excluido com sucesso. Aguarde atualiza&ccedil;&atilde;o');
            }else if(data.retorno == 0){
                errosend('N&atilde;o foi poss&iacute;vel excluir');
            }
        }
    });
    return false;
}


function carregando(){
    var mensagem = $('.mensagem');
    //alert('Carregando: '+mensagem);
    mensagem.empty().html('<p class="alert alert-warning"><img src="images/loading.gif" alt="Carregando..."> Verificando dados!</p>').fadeIn("fast");
    setTimeout(function (){

    },300);

}

function errosend(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>'+msg+'</p>').fadeIn("fast");
}
function sucesso(msg){
    //alert("Mensagem: "+msg);
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.href = "cliente.php";
    },2000);
}
function sucesso_delete(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.reload();
    },2000);

}

function verifica(Msg)
{
    return confirm(Msg) ;
}

$('.btn-voltar').on('click', function(){
    var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    //alert('Url: '+url);
    var form = $('<form action="'+url+'" method="post">' +

        '</form>');
    $('body').append(form);
    form.submit();
});

$('.btn-alterar').on('click', function(){
    var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id = $(this).data('id');
    var form = $('<form action="'+url+'" method="post">' +
               '<input type="hidden" value="'+id+'" name="id">'+
               '</form>');
    $('body').append(form);
    form.submit();
});

$('.btn-acao').on('click', function(){
    var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id = $(this).data('id');
    var form = $('<form action="'+url+'" method="post">' +
        '<input type="hidden" value="'+id+'" name="id">'+
        '</form>');
    $('body').append(form);
    form.submit();
});

$('.delete').on('click', function(){
    var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
    var acao = $(this).data('action');

    //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
    //console.log("Nome para deletar: "+nome);
    $('span.nome').text(nome);

    $('.delete-yes').on('click', function(){
        deletar(id,acao);
    });
    //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

    //$('#myModal').modal('show'); // modal aparece
});

$('.btn-search').on('click', function () {
   alert('Form');
});

$("#nascimento").datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
    mask: true
});


$.datetimepicker.setLocale('pt-BR');

var cmbestadocivil = $("#estadocivil");
$('.btn-refresh').on('click', function () {
    var id = document.getElementById('cdestadocivil').value;
    //alert('Codigo da cidade: '+cidade);
    $.post("function/estadocivil.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){

            cmbestadocivil.find("option").remove();
            cmbestadocivil.append(data);
        });
});



$(document).ready(function(){
    var id = document.getElementById('cdestadocivil').value;
    //alert('Codigo da cidade: '+cidade);
    $.post("function/estadocivil.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){
            cmbestadocivil.find("option").remove();
            cmbestadocivil.append(data);
        });

});
var documento = $('#cpfcnpj');
$('.cpf').click(function(){
    documento.mask('000.000.000-00');
    documento.attr("placeholder","000.000.000-00");

});
$('.cnpj').click(function(){
    documento.mask('00.000.000/0000-00');
    documento.attr("placeholder","00.000.000/0000-00");
});




function buscarCEP() {
    //alert("CE OUt");
    var cep = document.getElementById("cep").value;
    //alert('Buscar CEp');
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/endereco.php",
        data: {
            'cep': cep,
            'acao': 'G' //[G]et Endereco
        },
        success: function (data) {
            var logradouro   = document.getElementById('logradouro');
            var bairro       = document.getElementById('bairro');
            var endereco     = document.getElementById('endereco');
            var numero       = document.getElementById('numero');
            // alert("Retorno: " + data.retorno);
            if (data.retorno == 0) {
                logradouro.value = "";
                bairro.value     = "";
                endereco.value   = 0;
                errosend("CEP n&atilde;o localizado ou n&atilde;o est&aacute; cadastrado");

            } else {
                // alert('Codigo do endereco: ' + data.logradouro);
                var mensagem = $('.mensagem');
                mensagem.empty().html('<p class="alert "></p>');

                logradouro.value = data.logradouro;
                bairro.value     = data.bairro;
                endereco.value   = data.codigo;
                numero.focus();

            }
        }
    })
}
$('#cep').focusout(function () {

});

$(document).ready(function () {
    var id = document.getElementById("endereco").value;
    if(id > 0){
  //  alert('Buscar '+id);
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: "function/endereco.php",
                data: {
                    'id': id,
                    'acao': 'B' //[B]usca Endereco
                },
                success: function (data) {
                    var logradouro   = document.getElementById('logradouro');
                    var bairro       = document.getElementById('bairro');
                    var endereco     = document.getElementById('endereco');
                    var cep          = document.getElementById('cep');
                    // alert("Retorno: " + data.retorno);
                    if (data.retorno == 0) {
                        logradouro.value = "";
                        bairro.value     = "";
                        endereco.value   = 0;
                        errosend("CEP n&atilde;o localizado ou n&atilde;o est&aacute; cadastrado");

                    } else {
                        // alert('Codigo do endereco: ' + data.logradouro);
                        var mensagem = $('.mensagem');
                        mensagem.empty().html('<p class="alert "></p>');
                        //alert('Cep: '+data.cep);
                        logradouro.value = data.logradouro;
                        bairro.value     = data.bairro;
                        endereco.value   = data.codigo;
                        cep.value        = data.cep;
                        //numero.focus();

                    }
                }
            })
    } //fim do se
});

$('#cpf').focusout(function(){

   var cpf = document.getElementById('cpf').value;
   var verifica = validarCPF(cpf);
   var mensagem = $('.mensagem');
   //alert('Verificar: '+verifica);
    if(verifica){
        mensagem.empty().html('<p class="alert"></p>');
    }else{

        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>CPF inv&aacute;lido. Tente novamente</p>').fadeIn("fast");
        var campocpf = document.getElementById('cpf');
        $('input[name="cpf"]').css("border-color","red").focus();
        campocpf.value = "";
        campocpf.focus();

    }
});









