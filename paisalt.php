<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
//include "include/error.php";
$id = $_POST['id'];

require_once "beans/Pais.class.php";
require_once "controller/PaisController.class.php";

$pais = new Pais();
$pc = new PaisController();
$pais = $pc->getPais($id);
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
                <h3>Altera&ccedil;&atilde;o de Cadastro de  Pa&iacute;s</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $pais->getCdPais(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <div class="form-group">
                        <label>Pa&iacute;s</label>
                        <input id="pais" class="form-control" required="" value="<?php echo $pais->getDsPais(); ?>"/>
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




    <script src="js/pais.js"></script>

 </body>
</html>