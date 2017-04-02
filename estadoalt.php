<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
require_once "beans/Estado.class.php";
require_once "controller/EstadoController.class.php";

$id = $_POST['id'];

$eC = new EstadoController();
$estado = $eC->getEstado($id);



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
                <h3>Altera&ccedil;&atilde;o de Cadastro de Estados / UF</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">

                <div class="mensagem alert "></div>
                <form method="post" id="form">
                    <input id="id" value="<?php echo $estado->getCdEstado(); ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <input id="id-pais" value="<?php echo $estado->getPais()->getCdPais(); ?>" type="hidden">
                    <div class="form-group col-lg-10">
                        <label>Estado</label>
                        <input id="estado" class="form-control" required="" value="<?php echo $estado->getNmEstado(); ?>" />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-2">
                        <label>UF</label>
                        <input id="uf" class="form-control" required="" value="<?php echo $estado->getDsUF(); ?>"/>
                    </div>
                    <div class="row"></div>

                    <div class="form-group col-lg-6">
                        <label>Estado</label>
                        <select id="pais" class="form-control" required="">
                            <option value="">Selecione</option>
                            <?php
                              require_once "beans/Pais.class.php";
                              require_once "controller/PaisController.class.php";
                              require_once "services/PaisListIterator.class.php";

                              $pc = new PaisController();
                              $lista = $pc->getList("");
                              $pListIterator = new PaisListIterator($lista);
                              $pais = new Pais();
                              while($pListIterator->hasNextPais()){
                                  $pais = $pListIterator->getNextPais();
                                  if($estado->getPais()->getCdPais() == $pais->getCdPais() ){
                                      $selected = "selected";
                                  }
                                  else{
                                      $selected = "";
                                  }
                              ?>


                                <option <?php echo $selected; ?> value="<?php  echo $pais->getCdPais(); ?>"><?php  echo $pais->getDsPais();  ?></option>
                                <?php
                                  }

                                ?>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group" style="margin-top: 25px;">
                        <label></label>
                        <a href="#" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button class="btn btn-success" onclick="save()">Salvar</button>
                        <a class="btn btn-warning btn-voltar" data-url="estado.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');">Cancelar</a>
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




    <script src="js/estado.js"></script>

 </body>
</html>