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
    if(validarCampo() == true){
        jQuery('#form').submit(function () {
            // alert("Submit");
            var codigo     = document.getElementById('id').value;
            var usuario    = document.getElementById('usuario').value;
            var sobrenome  = document.getElementById('sobrenome').value;
            var login      = document.getElementById('login').value;
            var senha      = document.getElementById('senha').value;
            var chk_ativo  = document.getElementById('ativo');
            var cargo      = document.getElementById('cargo').value;
            var cpf        = document.getElementById('cpf').value;
            var rg         = document.getElementById('rg').value;
            var foto;
            try{
                foto      = document.getElementById('foto').src;
            }catch (err){
                foto = "";
            }

            var atual     = document.getElementById('atual').value;
            var acao      = document.getElementById('acao').value;
            var ativo;
            if(chk_ativo.checked == true)
                ativo = 'S';
            else
                ativo = 'N';

            //alert("Sobrenome: "+sobrenome);
            //

            $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/usuario.php',
                beforeSend : carregando,
                data: {
                    'id'         : codigo,
                    'nome'       : usuario,
                    'sobrenome'  : sobrenome,
                    'login'      : login,
                    'senha'      : senha,
                    'ativo'      : ativo,
                    'cargo'      : cargo,
                    'cpf'        : cpf,
                    'rg'         : rg,
                    'foto'       : foto,
                    'atual'      : atual,
                    'acao'       : acao
                },
                success: function (data) {
                    //alert(data.retorno);
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

}

function deletar(codigo, acao){

    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "function/usuario.php",
        beforeSend: carregando,
        data: {
            'id' : codigo,
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
        location.href = "usuario.php";
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
var  cargo = $("#cargo");
$('.btn-refresh').on('click', function () {
    var id = document.getElementById('id-cargo').value;
    //alert('Codigo da cidade: '+cidade);
    $.post("function/cargo.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){
            cargo.find("option").remove();
            cargo.append(data);
        });
});

$(document).ready(function(){
    var id = document.getElementById('id-cargo').value;
    //alert('Codigo da cidade: '+cidade);
    $.post("function/cargo.php",
        {
            'id': id,
            'acao': "L"
        },
        function(data){
            cargo.find("option").remove();
            cargo.append(data);
        });
});


$(document).ready(function(){
    $('#cpf').mask('000.000.000-00');

});

$(document).ready(function(){
    $('#rg').mask('0000000-0');

});

/**
 * Created by carlos on 04/03/17.
 */
var image = $('#image-area');
$(document).ready(function(){
     var imagem = document.getElementById('imagem').value;
     //alert("Imagem: "+imagem);
    // console.log("Imagem: "+imagem);
     if(imagem != ""){
        var src  =  '<img src="'+imagem+'" width="'+350+'" id="foto" style="margin-top: -150px;"/>';
         image.empty().html(src);
     }

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
        $('input[id="cpf"]').css("border-color","red").focus();
        //campocpf.value = "";
        campocpf.focus();

    }
});

$('#senha').focusout(function(){
    var mensagem = $('.mensagem');
    var senha = document.getElementById('senha').value;
    if(senha == ""){

        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Senha n&atilde;o pode estar vazia</p>').fadeIn("fast");

        $('input[id="senha"]').css("border-color","red").focus();
    }else{
        mensagem.empty().html('<p class="alert"></p>');
        $('input[id="senha"]').css("border-color","#ccc");
    }


});


$('#resenha').focusout(function(){
    var senha = document.getElementById('senha').value;
    var resenha = document.getElementById('resenha').value;
    var btn_save = document.getElementById('btn-save');
    if(resenha == ""){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Senha n&atilde;o pode estar vazia</p>').fadeIn("fast");

        $('input[id="resenha"]').css("border-color","red");
        btn_save.disabled = true;
    }else{
        btn_save.disabled = false;
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert"></p>');
        if(senha == resenha){
            mensagem.empty().html('<p class="alert"></p>');
            $('input[id="resenha"]').css("border-color","#ccc");
        }else{
            btn_save.disabled = true;
            mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>As senhas n&atilde;o s&atilde;o iguais</p>').fadeIn("fast");
            $('input[id="resenha"]').css("border-color","red");
        }
    }


});




function validarCampo() {
    var mensagem = $('.mensagem');
    var usuario   = document.getElementById('usuario').value;
    var login     = document.getElementById('login').value;
    var senha     = document.getElementById('senha').value;
    var resenha     = document.getElementById('resenha').value;

    if ((usuario == "" || login == "") || (senha != resenha) || (senha == "" || resenha == "")){
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Voc&ecirc; precisa preencher os campos</p>').fadeIn("fast");
        if(usuario == ""){
            colorirCampo(usuario, "red", 1);
            return false;
        }
        else if (login == ""){
            colorirCampo(login, "red", 1);
            return false;
        }else if(senha == ""){
            colorirCampo(senha, "red", 1);
            return false;
        }
        else if(resenha == ""){
            colorirCampo(resenha, "red", 1);
            return false;
        }
        else if(senha != resenha){
            colorirCampo(senha,"red",1);
            colorirCampo(resenha,"red",1);
        }

    }else{
        colorirCampo(usuario, "#ccc", 0);
        colorirCampo(login, "#ccc", 0);
        colorirCampo(cpf, "#ccc", 0);
        colorirCampo(rg, "#ccc", 0);
        return true;

    }
}

function colorirCampo(campo, cor, focus) {
        if(focus == 1)
          $('input[id="'+campo+'"]').css("border-color",cor).focus();
        else
            $('input[id="'+campo+'"]').css("border-color",cor);
}