<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->



<link href="css/image-css.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/jquery.min.js"></script>

 <body class="sticky-header left-side-collapsed"  >
    <section>
    <!-- left side start-->
		<?php include "include/menu.html"?>
    <!-- left side end-->

    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  include "include/supbar.php"; ?>
			<!--notification menu end -->


            <div class="row"></div>
            <br />
            <div style="text-align: center;">
            <h3>Cadastro de Usu&aacute;rio</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-7">

                <div class="mensagem alert "></div>
                <form method="post" id="form" data-toggle="validator">

                    <input id="id" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <input id="atual" value="N" type="hidden">

                    <input id="id-cargo" value="0" type="hidden">

                    <div class="form-group col-lg-3">
                        <label for="usuario">Nome</label>
                        <input id="usuario" class="form-control" required="" placeholder="Primeiro Nome" required=""/>
                    </div>
                    <div class="form-group col-lg-9">
                        <label for="sobrenome">Sobrenome</label>
                        <input id="sobrenome" class="form-control" required="" placeholder="Sobrenome" required=""/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="login">Login</label>
                        <input id="login" type="text" class="form-control" required="">
                    </div>

                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="senha">Digite a Senha</label>
                        <input id="senha" type="password" class="form-control" required="" data-minlength="6"/>
                        <span class="help-block">Mínimo de seis (6) digitos</span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="resenha">Repita a Senha</label>
                        <input id="resenha" type="password" class="form-control" required="" data-minlength="6"
                               data-match="#senha" data-match-error="Atenção! As senhas não estão iguais."/>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="cargo">Cargo</label>
                        <select id="cargo" class="form-control" required="">
                            <option value="">Selecione</option>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="cpf">CPF</label>
                        <input id="cpf" type="text" class="form-control" >
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="rg">RG</label>
                        <input id="rg" type="text" class="form-control" >
                    </div>



                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <div class="checkbox-inline1"><label> Ativo? </label> <input checked type="checkbox" id="ativo" value="S"></div>

                    </div>
                    <div class="row"></div>
                    <div id="example-content">

                        <div id="frame">

                            <div id="image-area" title="Somente Imagens JPG">

                                <span id="drop-message"> Arraste a imagem aqui </span>

                            </div>

                            <span id="title"> Somente Imagens JPG </span>
                        </div>
                    </div>


            </div>

                    <div class="row">
                    <hr />
                        <div class="btn-group col-lg-5" style="margin-left: 155px;">
                            <button class=" btn btn-success" id="btn-save" onclick="salvar()">Salvar</button>
                            <a class="btn btn-warning btn-voltar" data-url="usuario.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
                        </div>
                    </div>

                </form>
            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

	</section>





    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery-3.1.1.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>




    <script src="js/jquery.mask.js"></script>


    <script src="js/html5-file-upload-code.js"></script>

    <script src="js/scripts.js"></script>
    <script src="js/validator.min.js"></script>

    <script src="js/validarcpf.js"></script>
    <script src="js/usuario.js"></script>

 </body>
</html>