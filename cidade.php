<?php include "include/head.php"; ?>
<?php
$descricao = "";

if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}

include_once "controller/CidadeController.class.php";
include_once "beans/Cidade.class.php";
include_once "services/CidadeListIterator.class.php";


$cc = new CidadeController();
$lista = $cc->getList($descricao);
$cListIterator = new CidadeListIterator($lista);



?>





<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

 <body class="sticky-header left-side-collapsed"  >
    <section>
    <!-- left side start-->
		<?php include "include/menu.html"?>
    <!-- left side end-->

        <!-- Modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
                    </div>
                    <div class="modal-body">Deseja realmente excluir o item <b><span class="nome"></span></b>? </div>
                    <div class="modal-footer">
                        <a href="#" type="button"  class="btn btn-primary delete-yes">Sim</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                    </div>
                </div>
            </div>
        </div>


    <!-- main content start-->
		<div class="main-content main-content3 main-content3copy">

			<!--notification menu start -->
			<?php  include "include/supbar.php"; ?>
			<!--notification menu end -->

            <div class="row"></div>
            <br>

            <div class="col-lg-1" ><h2>Cidades </h2></div>
            <div class="col-lg-7" >

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-pesquisa">
                    <input type="hidden" name="acao" value="P">
                    <div class="input-group h2">
                        <input  name="search"  id="search" class="form-control">
                        <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                          </span>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <a href="#" data-url="cidadecad.php" class="btn btn-primary novo-item">Novo Item</a>
            </div>
            <div class="row"></div>
            <hr />
            <div class="mensagem alert "></div>
            <div id="page-wrapper" class="tabela">
                <div class="graphs">
                    <div class="xs tabls">
                        <div class="bs-example4" data-example-id="contextual-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $cidade = new Cidade();
                                    while ($cListIterator->hasNextCidade()){
                                        $cidade = $cListIterator->getNextCidade();
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $cidade->getCdCidade(); ?></th>
                                        <td><?php echo $cidade->getNmCidade(); ?></td>
                                        <td><?php echo $cidade->getEstado()->getNmEstado();  ?></td>
                                        <td class="action">
                                            <a href="#" data-url="cidadealt.php" data-id="<?php echo $cidade->getCdCidade();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                            <a href="#" class="delete btn btn-warning btn-xs"
                                               data-toggle="modal"
                                               data-target="#delete-modal"
                                               data-nome="<?php echo $cidade->getNmCidade() ; ?>"
                                               data-id="<?php echo $cidade->getCdCidade(); ?>"
                                               data-action="E">Excluir</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script src="js/cidade.js"></script>
    </section>

 </body>
</html>
