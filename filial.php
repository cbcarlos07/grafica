<?php include "include/head.php"; ?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
include "include/error.php";

if(isset($_POST['id'])){
    $_id = $_POST['id'];
    $_SESSION['cliente'] = $_id;
}else{
    $_id = $_SESSION['cliente'];
}
$descricao = "";


if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}

 // paginacao
$pagina = (isset($_POST['pagina'])) ? $_POST['pagina'] : 1;



include_once "controller/ClienteController.class.php";
include_once "controller/FilialController.class.php";
include_once "beans/Cliente.class.php";
include_once "beans/Filial.class.php";
include_once "services/FilialListIterator.class.php";


$clienteController = new ClienteController();
$cliente =  $clienteController->getCliente($_id);
$filialController = new FilialController();
$total = $filialController->getTotalFilial($_id);

//seta a quantidade de itens por página, neste caso, 2 itens
$registros = 10;
//$registros = (isset($_POST['registros'])) ? $_POST['registros'] : 10;

//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total/$registros);


//variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;

$lista = $filialController->getList($_id, $descricao,$inicio, $registros);
$pListIterator = new FilialListIterator($lista);



?>




 <link href="css/btn-style.css" type="text/css" rel="stylesheet">
 <link href="css/tree.css" type="text/css" rel="stylesheet">

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

            <div class="col-lg-3" ><h4><a href="cliente.php"><img src="images/back.png" class="img-responsive" width="30" title="Voltar">Filiais</a> de <b><?php echo $cliente->getNmResponsavel(); ?></b> </h4></div>
            <div class="col-lg-7" >
                <div style="margin-left: -150px;">
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
            </div>
            <div class="col-lg-2">
                <a href="#" data-url="filialcad.php" data-id="<?php echo $_id; ?>" class="btn btn-primary novo-item">Novo Item</a>
            </div>
            <div class="row"></div>
            <div class="col-lg-12">
                <ul id="tree1">
                  <li><a href="cliente.php"><?php echo $cliente->getDsNmFantasia(); ?></a>
                   <ul></ul>
                  </li>

                </ul>
            </div>
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
                            $filial = new Filial();
                            while ($pListIterator->hasNextFilial()){
                                $filial =  $pListIterator->getNextFilial();

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $filial->getCdFilial(); ?></th>
                                    <td><?php echo $filial->getNmResponsavel(); ?></td>
                                    <td><?php echo $filial->getDsNmFantasia(); ?></td>
                                    <td><?php
                                        $cpfcnpj = "";
                                        if(strlen($filial->getNrCpfCnpj()) == 11 ) {
                                            $cpf1 = substr($filial->getNrCpfCnpj(), 0, 3);
                                            $cpf2 = substr($filial->getNrCpfCnpj(), 3, 3);
                                            $cpf3 = substr($filial->getNrCpfCnpj(), 6, 3);
                                            $cpf4 = substr($filial->getNrCpfCnpj(), 9, 2);
                                            $cpfcnpj = "$cpf1.$cpf2.$cpf3-$cpf4";
                                        }else{
                                            //00.000.000/0000-00
                                            $cpf1 = substr($filial->getNrCpfCnpj(), 0, 2);
                                            $cpf2 = substr($filial->getNrCpfCnpj(), 2, 3);
                                            $cpf3 = substr($filial->getNrCpfCnpj(), 5, 3);
                                            $cpf4 = substr($filial->getNrCpfCnpj(), 8, 4);
                                            $cpf5 = substr($filial->getNrCpfCnpj(), 10, 2);
                                            $cpfcnpj = "$cpf1.$cpf2.$cpf3/$cpf4-$cpf5";
                                        }
                                        echo $cpfcnpj;
                                        ?></td>


                                    <td class="action">
                                        <a href="#" data-url="filialalt.php" data-id="<?php echo $filial->getCdFilial();  ?>"  class="btn btn-danger btn-xs btn-alterar btn-acao">Alterar</a>
                                        <a href="#" data-id="<?php echo $filial->getCdFilial(); ?>" data-nome="<?php echo $filial->getNmResponsavel(); ?>"  data-toggle="modal" data-target="#delete-modal" class="delete btn btn-danger btn-xs">Excluir</a>
                                        <a href="#" data-url="departamento.php" data-id="<?php echo $filial->getCdFilial();  ?>" data-cliente="<?php echo $_id; ?>" class="btn btn-danger btn-xs btn-carteira btn-acao">Departamento</a>
                                        <a href="#" data-url="filialficha.php" data-id="<?php echo $filial->getCdFilial();  ?>" class="btn btn-danger btn-xs btn-imprimir btn-acao">Imprimir</a>

                                    </td>

                                </tr>
                                <?php // echo 'R$ '.number_format($filial->getNrValor(),2,',','.'); ?>
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
                var form     = $('<form method="post" action="filial.php">'+
                    '<input type="hidden" name="registros" value="'+registro+'">'+
                    '</form>');
                $('body').append(form);
                form.submit();
            });
        </script>
        <script src="js/filial.js"></script>
        <script src="js/tree.js"></script>
    </section>

 </body>
</html>
