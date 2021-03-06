<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include "include/error.php";
$descricao = "";


if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}

 // paginacao
$pagina = (isset($_POST['pagina'])) ? $_POST['pagina'] : 1;



include_once "controller/FornecedorController.class.php";
include_once "beans/Fornecedor.class.php";
include_once "services/FornecedorListIterator.class.php";


$fornecedorController = new FornecedorController();
$total = $fornecedorController->getTotalFornecedor();

//seta a quantidade de itens por página, neste caso, 2 itens
$registros = 10;
//$registros = (isset($_POST['registros'])) ? $_POST['registros'] : 10;

//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total/$registros);


//variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;

$lista = $fornecedorController->getList($descricao, $inicio, $registros);
$pListIterator = new FornecedorListIterator($lista);



?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
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

            <div class="col-lg-1" ><h2>Fornecedor</h2></div>
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
                <a href="#" data-url="fornecedorcad.php" class="btn btn-primary novo-item">Novo Item</a>
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
                                <th>Fantasia</th>
                                <th>Raz&atilde;o Social</th>
                                <th>CPF/CNPJ</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $fornecedor = new Fornecedor();
                            while ($pListIterator->hasNextFornecedor()){
                                $fornecedor =  $pListIterator->getNextFornecedor();

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $fornecedor->getCdFornecedor(); ?></th>
                                    <td><?php echo $fornecedor->getDsNmFantasia(); ?></td>
                                    <td><?php echo $fornecedor->getDsRazaoSocial(); ?></td>
                                    <td><?php
                                        $cpfcnpj = "";
                                        if(strlen($fornecedor->getNrCpfCnpj()) == 11 ) {
                                            $cpf1 = substr($fornecedor->getNrCpfCnpj(), 0, 3);
                                            $cpf2 = substr($fornecedor->getNrCpfCnpj(), 3, 3);
                                            $cpf3 = substr($fornecedor->getNrCpfCnpj(), 6, 3);
                                            $cpf4 = substr($fornecedor->getNrCpfCnpj(), 9, 2);
                                            $cpfcnpj = "$cpf1.$cpf2.$cpf3-$cpf4";
                                        }else{
                                            //00.000.000/0000-00
                                            $cpf1 = substr($fornecedor->getNrCpfCnpj(), 0, 2);
                                            $cpf2 = substr($fornecedor->getNrCpfCnpj(), 2, 3);
                                            $cpf3 = substr($fornecedor->getNrCpfCnpj(), 5, 3);
                                            $cpf4 = substr($fornecedor->getNrCpfCnpj(), 8, 4);
                                            $cpf5 = substr($fornecedor->getNrCpfCnpj(), 12, 2);
                                            $cpfcnpj = "$cpf1.$cpf2.$cpf3/$cpf4-$cpf5";
                                        }
                                        echo $cpfcnpj;
                                        ?></td>


                                    <td class="action">
                                        <a href="#" data-url="fornecedoralt.php" data-id="<?php echo $fornecedor->getCdFornecedor();  ?>"  class="btn btn-danger btn-xs btn-alterar btn-acao">Alterar</a>
                                        <a href="#" data-id="<?php echo $fornecedor->getCdFornecedor(); ?>" data-nome="<?php echo $fornecedor->getDsNmFantasia(); ?>"  data-toggle="modal" data-target="#delete-modal" class="delete btn btn-danger btn-xs">Excluir</a>
                                        <!--<a href="#" data-url="filial.php" data-id="<?php echo $fornecedor->getCdFornecedor();  ?>" class="btn btn-danger btn-xs btn-carteira btn-acao">Filial</a>-->
                                        <a href="#" data-url="fornecedorficha.php" data-id="<?php echo $fornecedor->getCdFornecedor();  ?>" class="btn btn-danger btn-xs btn-imprimir btn-acao">Imprimir</a>

                                    </td>

                                </tr>
                                <?php // echo 'R$ '.number_format($fornecedor->getNrValor(),2,',','.'); ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Pagina&ccedil;&atilde;o</div>
                        <div class="panel-body">
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


        </div>
	<!-- //header-ends -->

		<!--footer section start-->
			<?php include "include/footer.php"; ?>
        <!--footer section end-->

<?php  include "include/enfile.php";?>
        <script>
            $('.btn-page').on('click', function(){
                //alert('Pagina');
                var url      = $(this).data('url');
                var pagina   = $(this).data('page');
                var form     = $('<form action="'+url+'" method="post">'+
                                '<input type="hidden" name="pagina" value="'+pagina+'">'+
                                '</form>');
                $('body').append(form);
                form.submit();

            });

            $('.registros').on('change', function () {
                var registro = document.getElementById('registro').value;
                var form     = $('<form method="post" action="fornecedor.php">'+
                    '<input type="hidden" name="registros" value="'+registro+'">'+
                    '</form>');
                $('body').append(form);
                form.submit();
            });
        </script>
        <script src="js/fornecedor.js"></script>
    </section>

 </body>
</html>
