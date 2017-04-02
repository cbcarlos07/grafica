<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$id = $_POST['id'];
require_once "beans/Cargo.class.php";
require_once "controller/CargoController.class.php";


$cargo = new Cargo();
$cargoController = new CargoController();

$cargo = $cargoController->getCargo($id);

?>


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
            <h3>Altera&ccedil;&atilde;o de Cadastro de Cargo</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $cargo->getCdCargo(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input id="cargo" class="form-control" required="" value="<?php echo $cargo->getDsCargo(); ?>"/>
                    </div>
                    <div class="row"></div>
                    <div class="form-group">
                        <label for="observacao">Observa&ccedil;&atilde;o</label>
                        <textarea id="observacao" class="form-control" rows="5"><?php echo $cargo->getObsCargo(); ?></textarea>
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




    <script src="js/cargo.js"></script>

 </body>
</html>