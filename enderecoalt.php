
<?php
include "include/head.php";
$id = $_POST['id'];
//echo "Cep: ".$id;
require_once "beans/Endereco.class.php";
require_once "controller/EnderecoController.class.php";

$endereco = new Endereco();
$enderecoController = new EnderecoController();

$endereco = $enderecoController->getEndereco($id);

 ?>


<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


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
            <h3>Alterar Cadastro de Endere&ccedil;o</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $endereco->getCdEndereco(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <input id="cdbairro" value="<?php echo $endereco->getBairro()->getCdBairro(); ?>" type="hidden">
                    <input id="id-cidade" value="<?php echo $endereco->getBairro()->getCidade()->getCdCidade(); ?>" type="hidden">
                    <input id="id-logradouro" value="<?php echo $endereco->getTpLogradouro()->getCdTpLogradouro(); ?>" type="hidden">
                    <div class="form-group col-lg-4">
                        <label for="cidade">Cidade</label>
                        <select id="cidade" class="form-control" required="">
                        </select>
                    </div>
                    <div class="col-lg-2 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="cep">CEP</label>
                        <input id="cep" class="form-control" required="" value="<?php echo $endereco->getNrCep(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-10">
                        <label for="logradouro">Logradouro</label>
                        <input id="logradouro" class="form-control" required="" value="<?php echo $endereco->getDsLogradouro(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="tplogradouro">Tipo de Logradouro</label>
                        <select id="tplogradouro" class="form-control" required=""> </select>
                    </div>
                    <div class="col-lg-2 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-logradouro"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="bairro">Bairro</label>
                        <select class="form-control" id="bairro">
                            <option value="<?php echo $endereco->getBairro()->getCdBairro(); ?>"><?php echo $endereco->getBairro()->getNmBairro(); ?></option>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-bairro"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="endereco.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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
    <script src="js/endereco.js"></script>

 </body>
</html>