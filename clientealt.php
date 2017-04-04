


<?php
include "include/head.php";
require_once "beans/Cliente.class.php";
require_once "beans/EstadoCivil.class.php";
require_once "beans/Endereco.class.php";
require_once "controller/ClienteController.class.php";

$id =  $_POST['id'];

$cliente = new Cliente();
$clienteController = new ClienteController();

$cliente = $clienteController->getCliente($id);


 ?>


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
            <h3>Altera&ccedil;&atilde;o de Cadastro de Cliente</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">

                <div class="mensagem alert "></div>
                <form method="post" id="form" data-toggle="validator">
                    <input id="id" value="<?php echo $cliente->getCdCliente(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <input id="endereco"  value="<?php echo $cliente->getEndereco()->getCdEndereco(); ?>" type="hidden">
                    <input id="cdestadocivil" value="<?php echo $cliente->getEstadoCivil()->getCdEstadoCivil(); ?>" type="hidden">
                    <input id="senhaatual" value="N" type="hidden">
                    <div class="form-group col-lg-5">
                        <label for="nome">Primeiro Nome</label>
                        <input id="nome" class="form-control" required="" value="<?php echo $cliente->getNmCliente(); ?>" />
                    </div>
                    <div class="form-group col-lg-7">
                        <label for="sobrenome">Sobrenome</label>
                        <input id="sobrenome" class="form-control" required="" value="<?php echo $cliente->getNmSobrenome(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-4">
                        <label for="cpf">CPF</label>
                        <input id="cpf" class="form-control" required="" placeholder="000.000.000.-00" value="<?php echo $cliente->getNrCpf(); ?>"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="rg">RG</label>
                        <input id="rg" class="form-control" required="" placeholder="0000000-0" value="<?php echo $cliente->getNrRg(); ?>"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="telefone">Telefone  </label>
                        <input id="telefone" type="tel" class="form-control" required="" placeholder="(00)0000-0000" value="<?php echo $cliente->getNrTelefone(); ?>"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" required="" placeholder="exemplo@email.com" value="<?php echo $cliente->getDsEmail(); ?>"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="senha">Senha</label>
                        <input id="senha" class="form-control" required="" type="password" data-minlength="6"/>
                        <span class="help-block">Mínimo de seis (6) digitos</span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="resenha">Repetir Senha</label>
                        <input id="resenha" class="form-control" required="" type="password" data-minlength="6"
                               data-match="#senha" data-match-error="Atenção! As senhas não estão iguais."/>
                        <div class="help-block with-errors"></div>

                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-3">
                        <label for="nascimento">Data de Nascimento</label>
                        <?php
                        $datas = explode('-', $cliente->getDtNascimento());
                        $ano = $datas[0];
                        $mes = $datas[1];
                        $dia = $datas[2];

                        ?>
                        <input id="nascimento" class="form-control data-nasc" required="" value="<?php echo "$dia/$mes/$ano"; ?>"/>
                    </div>
                    <div class="form-group col-lg-1">
                        <label for="idade">Idade</label>
                        <input id="idade" class="form-control"  disabled=""/>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="sexo">Sexo</label>

                        <select id="sexo" class="form-control">
                            <option value="">Selecione</option>
                            <option <?php if($cliente->getTpSexo() == 'M') echo "selected"; ?> value="M">Masculino</option>
                            <option <?php if($cliente->getTpSexo() == 'F') echo "selected"; ?>value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="estadocivil">Estado Civil</label>
                        <select id="estadocivil" class="form-control" ></select>
                    </div>
                    <div class="col-lg-1 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <div style="text-align: center;">
                    <span>Endere&ccedil;o</span>
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control" placeholder="00.000-000" />
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
                        <input id="numero" class="form-control" required=""  value="<?php echo $cliente->getNrCasa(); ?>" />
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="complemento">Complemento</label>
                        <input id="complemento" class="form-control"  value="<?php echo $cliente->getDsComplemento(); ?>" />
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
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
    <script src="js/jquery.datetimepicker.full.js"></script>
    <script src="js/calcularIdade.js"></script>

    <script src="js/jquery.mask.js"></script>
    <script src="js/validarcpf.js"></script>
    <script src="js/cliente.js"></script>


 </body>
</html>