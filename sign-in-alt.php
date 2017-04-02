<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
  $codigo = $_POST['codigo'];
  //include "include/error.php";
  include "beans/Usuario.class.php";
  include "controller/UsuarioController.class.php";

  $usuario = new Usuario();
  $usuarioController = new UsuarioController();

  $usuario = $usuarioController->getUsuario($codigo);

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Alterar senha</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Servcard, cartoes, desconto, saude, cartoes de desconto" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<!--<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>-->
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<p><span>Servcard</span>
						</div>
						<div class="signin">
							<!--<div class="signin-rit">
								<span class="checkbox1">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked="">Forgot Password ?</label>
								</span>
								<p><a href="#">Click Here</a> </p>
								<div class="clearfix"> </div>
							</div>
							-->
							<form id="form-login" method="post" data-toggle="validator">
								<div class="mensagem alert">

								</div>
                                <div class="alert alert-success">
                                    <p>Ol&aacute;, <b><span><?php echo $usuario->getDsLogin(); ?></span></b>!</p>
                                    <p>Identificamos que &eacute; seu primeiro acesso</p>
                                    <p>Por favor altere sua senha</p>
                                </div>
                                <input type="hidden" id="atual" value="S" />
                                <input type="hidden" id="id" value="<?php echo $codigo; ?>" />
                                <input type="hidden" id="usuario" value="<?php echo $usuario->getNmUsuario(); ?>" />
                                <input type="hidden" id="login" value="<?php echo $usuario->getDsLogin(); ?>" />
                                <input type="hidden" id="cargo" value="<?php echo $usuario->getCargo()->getCdCargo(); ?>" />
                                <input type="hidden" id="cpf" value="<?php echo $usuario->getNrCPF(); ?>" />
                                <input type="hidden" id="rg" value="<?php echo $usuario->getNrRg(); ?>" />
                                <input type="hidden" id="foto" value="<?php echo $usuario->getDsFoto(); ?>" />
                                <input type="hidden" id="acao" value="A" />
							<div class="log-input" style="margin-left: 5%">
                                <div class="log-input-left">
                                    <input type="password" name="senha" class="lock"  id="senha" placeholder="senha"
                                           required="" data-minlength="6"/>
                                    <span class="help-block">Mínimo de seis (6) digitos</span>
                                </div>
								<!--
								<span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span>
								<div class="clearfix"> </div>
								-->
							</div>
							<div class="log-input" style="margin-left: 5%">
								<div class="log-input-left">
								   <input type="password" name="resenha" class="lock"  id="resenha" placeholder="repita a senha" required=""
                                          data-minlength="6" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais."/>
                                    <div class="help-block with-errors"></div>
								</div>
								<!--
								<span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span>
								<div class="clearfix"> </div>
								-->
								<div class="checkbox-inline"><label><input type="checkbox" checked value="S" id="ativo" disabled="">Ativo</label></div>
							</div>
							<!--<input type="submit" value="Login to your account">-->
							<div style="margin-left: -6%;">
								<button class="btn btn-block btn-logar" onclick="salvar()">Logar no sistema</button>
							</div>
						</form>

					<!--
						<div class="new_people">
							<h4>For New People</h4>
							<p>Having hands on experience in creating innovative designs,I do offer design 
								solutions which harness.</p>
							<a href="sign-up.html">Register Now!</a>
						</div>
				-->
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer>
			   <p>&copy 2017 Servcard. All Rights Reserved
			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->

<script src="js/bootstrap.js"></script>
    <script src="js/validator.js"></script>
    <script src="js/acaologin.js"></script>

</body>
</html>