<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$descricao = "";

if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}

// paginacao
$pagina = (isset($_POST['pagina'])) ? $_POST['pagina'] : 1;


include_once "controller/BairroController.class.php";
include_once "beans/Bairro.class.php";
include_once "services/BairroListIterator.class.php";


$bairroController = new BairroController();
$total = $bairroController->getTotalBairros();


//seta a quantidade de itens por página, neste caso, 2 itens
$registros = 10;

//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total/$registros);


//variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;

$lista = $bairroController->getListByBairro($descricao, $inicio, $registros);
$pListIterator = new BairroListIterator($lista);





?>





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


            <br>

            <div class="col-lg-1" ><h2>Bairro</h2></div>
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
                <a href="#" data-url="bairrocad.php" class="btn btn-primary novo-item">Novo Item</a>
            </div>
            <div class="row"></div>
            <hr />
            <div class="mensagem alert "></div>
            <script src="js/tooltip.js"></script>
            <div id="page-wrapper" class="tabela">
            <div class="graphs">
                <div class="xs tabls">
                    <div class="bs-example4" data-example-id="contextual-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Descri&ccedil;&atilde;o</th>
                                <th>Cidade</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $bairro = new Bairro();
                            while ($pListIterator->hasNextBairro()){
                                $bairro =  $pListIterator->getNextBairro();

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $bairro->getCdBairro(); ?></th>
                                    <td><?php echo $bairro->getNmBairro(); ?></td>
                                    <td><?php echo $bairro->getCidade()->getNmCidade(); ?></td>
                                    <td class="action">
                                        <a href="#" data-url="bairroalt.php" data-id="<?php echo $bairro->getCdBairro();  ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                        <a href="#" class="delete btn btn-warning btn-xs"
                                           data-toggle="modal"
                                           data-target="#delete-modal"
                                           data-nome="<?php echo $bairro->getNmBairro(); ?>"
                                           data-id="<?php echo $bairro->getCdBairro(); ?>"
                                           data-action="E">Excluir</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- INICIO DA PAGINAÇÃO -->
                    <div id="buttom" class="row">
                        <div class="col-md-12">
                            <ul class="pagination">
                                <?php

                                if($pagina == 1){
                                    ?>
                                    <li class="disabled">
                                        <a href="#"
                                           data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                           data-page="">&lt; Anterior</a>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="page-item">  <a href="#"
                                                               data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                                               data-page="<?php echo $pagina-1; ?>"
                                                               class="btn-page">&lt; Anterior</a>
                                    </li>
                                    <?php
                                }

                                for($i = 1; $i < $numPaginas + 1; $i++){
                                    $disabled = "";

                                    if($pagina == $i){
                                        $disabled = "active";
                                    }
                                    ?>

                                    <li class="<?php echo $disabled; ?>">
                                        <a href="#"
                                           data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                           data-page="<?php echo $i; ?>"
                                           class="btn-page"
                                        ><?php echo $i; ?>
                                        </a>
                                    </li>

                                    <?php
                                }
                                ?>
                                <?php
                                if($numPaginas > 1){
                                    ?>
                                    <?php
                                    if($pagina == $numPaginas){
                                        ?>
                                        <li class="disabled"><a href="#"
                                                                data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                                                data-page="<?php echo $pagina + 1; ?>"
                                            >Pr&oacute;ximo &gt; </a>
                                        </li>
                                        <?php
                                    }else {
                                        ?>
                                        <li class="next"><a href="#"
                                                            data-url="<?php echo $_SERVER['PHP_SELF']; ?>"
                                                            data-page="<?php echo $pagina + 1; ?>"
                                                            class="btn-page">Pr&oacute;ximo &gt; </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div>


                    </div>
                    <!-- FIM DA PAGINAÇÃO -->


                </div>
            </div>
        </div>


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script src="js/bairro.js"></script>
    </section>

 </body>
</html>
