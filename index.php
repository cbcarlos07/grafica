<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$login = "";
$senha = "";
$checked = "";
if(isset($_COOKIE['login'])){
    $login = $_COOKIE['login'];
    $senha = $_COOKIE['senha'];
    $checked = "checked";

}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>SSG - Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="grafica, orcamento" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<!--<link rel="short icon" href="images/logo.jpg">-->
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
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form"   >
						<div class="sign-in-form-top">
							<p><span>Grafica</span>
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
							<form id="form-login" method="post">
								<div class="mensagem alert">

								</div>
							<div class="log-input" style="margin-left: 5%">
								<div class="log-input-left">
								   <input type="text" name="usuario" class="user"
                                          placeholder="Usu&aacute;rio" id="usuario" value="<?php echo $login; ?>"/>
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
								   <input type="password" name="senha" class="lock"
                                          id="senha" placeholder="senha" value="<?php echo $senha; ?>"/>
								</div>
								<!--
								<span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span>
								<div class="clearfix"> </div>
								-->

								<div class="checkbox-inline"><label>
                                        <input type="checkbox" <?php echo $checked; ?> value="S" id="lembrar">Lembrar-me</label>
                                </div>
							</div>
							<!--<input type="submit" value="Login to your account">-->
							<div style="margin-left: -6%;">
								<button class="btn btn-block btn-logar" onclick="logar('D')">Logar no sistema</button>
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
			   <p>&copy 2017 Sistema de Gerenciamento de Gráfico. All Rights Reserved
			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/acaologin.js"></script>
</body>
</html>