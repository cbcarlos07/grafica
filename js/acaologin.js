/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var mensagem = $('.mensagem');

function logar(acao){
        //alert("Logar");
        jQuery('#form-login').submit(function(){
        //alert('Submit');
        //var dados = jQuery( this ).serialize();
        var usuario = document.getElementById("usuario").value;
        var senha = document.getElementById("senha").value;
        var lembrar = document.getElementById("lembrar");
        if(lembrar.checked == true)
            lembrar = 'S';
        else
            lembrar = 'N';
        console.log("Acao: "+acao);
        console.log("Lembrar: "+lembrar);
        console.log("usuario: "+usuario);
        $.ajax({
                dataType: 'json',
                type: "POST",
                url: "function/usuario.php",
                beforeSend: carregando,
                data: {
                    'login'   : usuario,
                    'senha'   : senha,
                    'lembrar' : lembrar,
                    'acao'     : acao
                },
                success: function( data )
                {
                    //var retorno = data.retorno;
                    //alert(data.retorno);

                    console.log("Data: "+data.retorno);
                    if(data.retorno == 1){
                        sucesso();
                      }
                     
                     else if(data.retorno == 0){
                         senhaalterar(data.codigo);
                     } 
                    else{
                        errosend();
                        $('input[name="usuario"]').css("border-color","red").focus();
                        $('input[name="senha"]').css("border-color","red").focus();
                   }
                }
        });

        return false;
        });
    }
    
    

function carregando(){
        var mensagem = $('.mensagem');
        //alert('Carregando: '+mensagem);
        mensagem.empty().html('<p class="alert alert-warning"><images src="../images/loading.gif" alt="Carregando..."> Verificando dados!</p>').fadeIn("fast");
        setTimeout(function (){
            
        },300);
        
  }

  function errosend(){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa!</strong> Por favor, verifique seu login e/ou sua senha</p>').fadeIn("fast");
}
function errosendlogin(){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-danger"><strong>Restri&ccedil;&atilde;o!</strong> Voc&ecirc; n&atilde;o t&ecirc;m permiss&atilde;o para acessar este m&oacute;dulo</p>').fadeIn("fast");
}
function sucesso(msg){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-success"><strong>OK.</strong> Estamos redirecionando <images src="images/loading.gif" alt="Carregando..."></p>').fadeIn("fast");
        var url = 'cliente.php';
        var form = $('<form action="' + url + '" method="post">' +

            '</form>');
        $('body').append(form);
        form.submit();
         //   location.href = "usuario?acao=S";
        
        //window.setTimeout()
        //delay(2000);
}

function senhaalterar(codigo){
        console.log("Alterar senha");
        var mensagem = $('.mensagem');

        mensagem.empty().html('<p class="alert alert-success"><strong>OK.</strong> Estamos redirecionando <images src="images/loading.gif" alt="Carregando..."></p>').fadeIn("fast");                
        
       //     location.href = "usuario?acao=T&codigo="+codigo;
        var url = 'sign-in-alt.php';
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="codigo" value="' + codigo + '" />' +
            '</form>');
        $('body').append(form);
        form.submit();


    //window.setTimeout()
        //delay(2000);
}


function salvar(){
  //  alert("Salvar");
  //  alert("Validar campo: "+validarCampo());
     if(validarCampo() == true){
        jQuery('#form-login').submit(function () {
            // alert("Submit");

            var codigo    = document.getElementById('id').value;
            var usuario   = document.getElementById('usuario').value;
            var login     = document.getElementById('login').value;
            var senha     = document.getElementById('senha').value;

            var chk_ativo = document.getElementById('ativo');
            var cargo     = document.getElementById('cargo').value;
            var cpf       = document.getElementById('cpf').value;
            var rg        = document.getElementById('rg').value;
            var foto      = document.getElementById('foto').value;

            var atual     = document.getElementById('atual').value;
            var acao      = document.getElementById('acao').value;
            var ativo;
            if(chk_ativo.checked)
                ativo = 'S';
            else
                ativo = 'N';

          //  alert("Foto: "+foto);
            //

            $.ajax({
                type    : 'post',
                dataType: 'json',
                url     : 'function/usuario.php',
                beforeSend : carregando,
                data: {
                    'id'         : codigo,
                    'nome'       : usuario,
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
                  //  alert(data.retorno);
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


function validarCampo() {
    var mensagem = $('.mensagem');

    var senha     = document.getElementById('senha').value;
    var resenha     = document.getElementById('resenha').value;
      //alert('senha: '+senha+" resenha: "+resenha);
    if ((senha != resenha) || (senha == "" || resenha == "")){

         if(senha == ""){
             mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Preencha o campo senha</p>').fadeIn("fast");
            colorirCampo('senha', "red", 1);
            console.log("Senha em branco");
            return false;
        }
        else if(resenha == ""){
             mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>Preencha o campo de redigitar senha</p>').fadeIn("fast");
            colorirCampo('resenha', "red", 1);
             console.log("Senha em branco");
            return false;
        }
        else if(senha != resenha){
             mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>As senhas n&atilde;o s&atilde;o iguais</p>').fadeIn("fast");
             colorirCampo('senha',"red",1);
             colorirCampo('resenha',"red",1);
             console.log("Senhas diferentes");
             return false;
        }

    }else{
        /*colorirCampo(usuario, "#ccc", 0);
        colorirCampo(login, "#ccc", 0);
        colorirCampo(cpf, "#ccc", 0);
        colorirCampo(rg, "#ccc", 0);*/
        return true;

    }
}

function colorirCampo(campo, cor, focus) {
    console.log("era para colorir");
    if(focus == 1) {
        console.log("Focus");
        $('input[id="' + campo + '"]').css("border-color", cor).focus();
    }
    else
        $('input[id="'+campo+'"]').css("border-color",cor);
}

