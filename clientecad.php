<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->



<link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
            <h3>Cadastro de Cliente</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">

                <div class="mensagem alert "></div>
                <form method="post" id="form" data-toggle="validator">
                    <input id="id" value="0" type="hidden">
                    <input id="acao" value="C" type="hidden">
                    <input id="endereco"  type="hidden">
                    <div class="form-group col-lg-12">
                        <label for="responsavel">Respons&aacute;vel</label>
                        <input id="responsavel" class="form-control" required="" autofocus placeholder="Nome do Repons&aacute;vel"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-12">
                        <label for="empresa">Empresa</label>
                        <input id="empresa" class="form-control" required="" placeholder="Nome Fantasia da Empresa"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-4">
                        <label for="cpfcnpj">CPF</label>
                        <input id="cpfcnpj" class="form-control" required="" placeholder="000.000.000-00"/>
                        <span><label><input name="doc" type="radio" class="cpf" checked> CPF</label>
                            &nbsp;&nbsp;&nbsp;
                            <label><input name="doc" type="radio" class="cnpj"> CNPJ</label>
                        </span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" required="" placeholder="exemplo@email.com"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-2">
                        <label for="telefone">Telefone  </label>
                        <input id="telefone" type="tel" class="form-control" required="" placeholder="(00)0000-0000"/>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="observacao">Observa&ccedil;&atilde;o</label>
                        <input id="observacao" class="form-control">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="contato">Nome Contato</label>
                        <input id="contato" class="form-control">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="tipo">Tipo Telefone</label>
                        <select id="tipo" class="form-control"></select>
                    </div>
                    <div class="col-lg-1 form-group" style="margin-top: 30px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div style="text-align: center;">
                                <span>Endere&ccedil;o</span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-2">
                                <label for="cep">CEP</label>
                                <input id="cep" class="form-control" placeholder="00.000-000" onblur="buscarCEP()" />
                            </div>
                            <div class="row"></div>
                            <div class="form-group col-lg-6">
                                <label for="logradouro">Logradouro</label>
                                <input id="logradouro" class="form-control" disabled="" />
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="bairro">Bairro</label>
                                <input id="bairro" class="form-control" disabled="" />
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="numero">N&uacute;mero</label>
                                <input id="numero" class="form-control" required="" />
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="complemento">Complemento</label>
                                <input id="complemento" class="form-control" />
                            </div>
                        </div>
                    </div>


                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="pais.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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
    <script src="js/scripts.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script>
        $(document).ready(function(){

            $('#cep').mask('00.000-000');

        });
    </script>
    <script src="js/validarcpf.js"></script>
    <script src="js/validator.min.js"></script>
    <script src="js/cliente.js"></script>


 </body>
</html>