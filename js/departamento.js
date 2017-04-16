/**
 * Created by carlos.brito on 21/02/2017.
 */

$('.novo-item').on('click', function(){

    var url = $(this).data('url');
    var _id = $(this).data('id');
    var _cliente = $(this).data('cliente');
    var form = $('<form action="' + url + '" method="post">' +
        '<input type="hidden" name="filial" value="' + _id + '" />' +
        '<input type="hidden" name="cliente" value="' + _cliente + '" />' +
        '</form>');
   // var div = $('<div style="display: none;>"'+form+'</div>');
    $('body').append(form);
    form.submit();

});

function salvar(){
    //alert("Salvar");
    jQuery('#form').submit(function () {
       // alert("Submit");
        var codigo        = document.getElementById('id').value;
        var responsavel   = document.getElementById('responsavel').value;
        var departamento  = document.getElementById('departamento').value;
        var filial        = document.getElementById('filial').value;
        var email       = document.getElementById('email').value;

        var acao        = document.getElementById('acao').value;
        var fones       = $('.table').tableToJSON();
        var telefone    = JSON.stringify(fones);
        alert("Telefone: "+telefone);
       /* if(telefone === "[]"){
            $('input[id="telefone"]').css("border-color","red").focus();

        }*/
       $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/departamento.php',
                beforeSend : carregando,
                data: {
                    'id'           : codigo,
                    'responsavel'  : responsavel,
                    'departamento' : departamento,
                    'filial'       : filial,
                    'telefone'    : telefone,
                    'email'       : email,

                    'acao'        : acao
                },
                success: function (data) {
                   // alert(data.retorno);
                    if (data.retorno == 1) {
                        sucesso('Opera&ccedil;&atilde;o realizada com sucesso!', filial);
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
        url: "function/departamento.php",
        beforeSend: carregando,
        data: {
            'id'       : codigo,
            'acao'     : 'E'
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
function sucesso(msg, id){
    //alert("Mensagem: "+msg);
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="images/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        var form =  $('<form action="departamento.php" method="post">'+
                  '<input type="hidden" value="'+id+'" name="id"> '+
                 '</form>');
        $('body').append(form);
        form.submit();
        //location.href = "filial.php";
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
    var id = $(this).data('id');
    //alert('Id: '+id);
    //alert('Url: '+url);
    var form = $('<form action="'+url+'" method="post">' +
                  '<input type="hidden" value="'+id+'" name="id" />'+
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
    var filial = $(this).data('filial');
    var form = $('<form action="'+url+'" method="post">' +
        '<input type="hidden" value="'+id+'" name="id">'+
        '<input type="hidden" value="'+filial+'" name="filial">'+
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

$('.btn-refresh').on('click', function () {

    //alert('Codigo da cidade: '+cidade);
    $.post("function/tipocontato.php",
        {
            'acao': "L"
        },
        function(data){
            $("#tipo").find("option").remove();
            $("#tipo").append(data);
        });
});



$('.btn-add').on('click',function () {
   // alert("Add");
   var corpo = document.getElementById("tbody");
   var telefone    = document.getElementById('telefone').value;
   var observacao  = document.getElementById('observacao').value;
   var contato     = document.getElementById('contato').value;
   var tipo        = document.getElementById('tipo').value;
   var dsTipo      = document.getElementById("tipo").options[document.getElementById("tipo").selectedIndex].text;

   var fone = "";
   if(telefone.length === 11){
       fone = "("+telefone.substr(0,2)+")"+telefone.substr(2,5)+"-"+telefone.substr(7,4);
   }else{
       fone = "("+telefone.substr(0,2)+")"+telefone.substr(2,4)+"-"+telefone.substr(6,4);
   }

   var content = "<tr>"+
                  "  <td>"+fone+"</td>"+
                  "  <td>"+observacao+"</td>"+
                  "  <td>"+contato+"</td>"+
                  "  <td>"+tipo+"</td>"+
                  "  <td>"+dsTipo+"</td>"+
                  "  <td><a href='#div' class='btn btn-danger btn-remove btn-xs'>remover</a></td>"+
                 "</tr>";
   $(corpo).append(content);
   limparContato('telefone');
   limparContato('observacao');
   limparContato('contato');
    document.getElementById('tipo').selectedIndex = "0";

});

function limparContato(campo) {
    document.getElementById(campo).value = "";
}

$("#tbody").on("click", ".btn-remove", function(e){
    $(this).closest('tr').remove();
});

$('.btn-yes').on('click',function () {
    //  alert('click');
    var id = $(this).data('id');
   //location.href = "filial.php";
    var form =  $('<form action="departamento.php" method="post">'+
        '<input type="hidden" value="'+id+'" name="id"> '+
        '</form>');
    $('body').append(form);
    form.submit();
});










