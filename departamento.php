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
    $_SESSION['filial'] = $_id;
}else{
    $_id = $_SESSION['filial'];
}

if(isset($_POST['cliente'])){
    $_cliente = $_POST['cliente'];
    $_SESSION['cliente'] = $_cliente;
}else{
    $_cliente = $_SESSION['cliente'];
}
$descricao = "";


if(isset($_POST['search'])){
   $descricao =  $_POST['search'];
}

 // paginacao
$pagina = (isset($_POST['pagina'])) ? $_POST['pagina'] : 1;



include_once "controller/DepartamentoController.class.php";
include_once "controller/FilialController.class.php";
include_once "beans/Departamento.class.php";
include_once "beans/Filial.class.php";
include_once "services/DepartamentoListIterator.class.php";


$filialController = new FilialController();
$filial =  $filialController->getFilial($_id);
$departamentoController = new DepartamentoController();
$total = $departamentoController->getTotalDepartamento($_id);

//seta a quantidade de itens por página, neste caso, 2 itens
$registros = 10;
//$registros = (isset($_POST['registros'])) ? $_POST['registros'] : 10;

//calcula o número de páginas arredondando o resultado para cima
$numPaginas = ceil($total/$registros);


//variavel para calcular o início da visualização com base na página atual
$inicio = ($registros*$pagina)-$registros;

$lista = $departamentoController->getList($_id, $descricao,$inicio, $registros);
$pListIterator = new DepartamentoListIterator($lista);



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

            <div class="col-lg-3" ><h3><a href="#div" data-url="filial.php" data-id="<?php echo $_cliente; ?>" class="btn-voltar">Departamentos</a> de <b><?php echo $filial->getDsNmFantasia(); ?></b> </h3></div>
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
                <a href="#" data-url="departamentocad.php" data-cliente="<?php echo $_id; ?>" data-id="<?php echo $_id; ?>" class="btn btn-primary novo-item">Novo Item</a>
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
                                <th>Departamento</th>
                                <th>Respons&aacute;vel</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $departamento = new Departamento();
                            while ($pListIterator->hasNextDepartamento()){
                                $departamento =  $pListIterator->getNextDepartamento();

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $departamento->getCdDepartamento(); ?></th>
                                    <td><?php echo $departamento->getDsDepartamento(); ?></td>
                                    <td><?php echo $departamento->getNmResponsavel(); ?></td>



                                    <td class="action">
                                        <a href="#" data-url="departamentoalt.php" data-filial="<?php echo $_id; ?>"  data-id="<?php echo $departamento->getCdDepartamento();  ?>"  class="btn btn-danger btn-xs btn-alterar btn-acao">Alterar</a>
                                        <a href="#" data-id="<?php echo $departamento->getCdDepartamento(); ?>" data-nome="<?php echo $departamento->getNmResponsavel(); ?>"  data-toggle="modal" data-target="#delete-modal" class="delete btn btn-danger btn-xs">Excluir</a>
                                       <!-- <a href="#" data-url="departamento.php" data-id="<?php echo $departamento->getCdDepartamento();  ?>" class="btn btn-danger btn-xs btn-carteira btn-acao">Departamento</a> -->
                                        <a href="#" data-url="departamentoficha.php" data-id="<?php echo $departamento->getCdDepartamento();  ?>" class="btn btn-danger btn-xs btn-imprimir btn-acao">Imprimir</a>

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
        <script src="js/departamento.js"></script>
    </section>

 </body>
</html>
