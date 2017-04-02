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

if(isset($_POST['cidade'])){
    $cdCidade = $_POST['cidade'];
    $_SESSION['cidade'] = $cdCidade;
}else{
    $cdCidade = 0;
    $_SESSION['cidade'] = $cdCidade;
}


include_once "controller/EnderecoController.class.php";
include_once "beans/Endereco.class.php";
include_once "services/EnderecoListIterator.class.php";

$enderecoController = new EnderecoController();
$lista = $enderecoController->getList($descricao, $_SESSION['cidade']);
$pListIterator = new EnderecoListIterator($lista);



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

            <div class="col-lg-1" ><h2>Endereco</h2></div>
            <div class="col-lg-7" >

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-pesquisa">
                    <input type="hidden" name="acao" value="P">
                    <div class="input-group h2">
                        <input  name="search"  id="search" class="form-control" placeholder="Digite o CEP para pesquisa">
                        <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                          </span>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <a href="#" data-url="enderecocad.php" class="btn btn-primary novo-item">Novo Item</a>
            </div>
            <div class="row"></div>
            <hr />
            <div class="col-lg-5">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-cidade">
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Cidade</label>
                    <div class="col-sm-8">
                        <select name="cidade" class="form-control1 cidade" >
                            <option value="0">Selecione</option>
                            <?php
                              require_once "beans/Cidade.class.php";
                              require_once "controller/CidadeController.class.php";
                              require_once "services/CidadeListIterator.class.php";

                              $cidade = new Cidade();
                              $cc = new CidadeController();
                              $lista = $cc->getList("");
                              $cList = new CidadeListIterator($lista);
                              while ($cList->hasNextCidade()){
                                  $cidade = $cList->getNextCidade();
                                  $select = "";
                                  if($cdCidade ==  $cidade->getCdCidade()){
                                      $select = "selected";
                                  }
                             ?>
                               <option <?php echo $select; ?> value="<?php  echo $cidade->getCdCidade(); ?>"><?php echo $cidade->getNmCidade(); ?></option>
                            <?php
                              }
                            ?>
                        </select>
                    </div>

                </div>
            </form>
            </div>
            <div class="row"></div>
            <div class="mensagem alert "></div>
            <script src="js/tooltip.js"></script>
            <div id="page-wrapper" class="tabela">
            <div class="graphs">
                <div class="xs tabls">
                    <div class="bs-example4" data-example-id="contextual-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>CEP</th>
                                <th>Logradouro</th>
                                <th>Tipo</th>
                                <th>Bairro</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $endereco = new Endereco();
                                  while ($pListIterator->hasNextEndereco()){
                                      $endereco = $pListIterator->getNextEndereco();

                                ?>

                                <tr>
                                    <th scope="row"><?php
                                        $cep1 = substr($endereco->getNrCep(), 0,2);
                                        $cep2 = substr($endereco->getNrCep(), 2,3);
                                        $cep3 = substr($endereco->getNrCep(), 5,3);
                                        $cep = "$cep1.$cep2-$cep3";
                                        echo $cep; ?></th>
                                    <td><?php echo $endereco->getDsLogradouro(); ?></td>
                                    <td><?php echo $endereco->getTpLogradouro()->getDsTpLogradouro(); ?></td>
                                    <td><?php echo $endereco->getBairro()->getNmBairro(); ?></td>
                                    <td class="action">
                                        <a href="#" data-url="enderecoalt.php" data-id="<?php echo $endereco->getCdEndereco(); ?>" class="btn btn-primary btn-xs btn-alterar">Alterar</a>
                                        <a href="#" class="delete btn btn-warning btn-xs"
                                           data-toggle="modal"
                                           data-target="#delete-modal"
                                           data-nome="<?php echo $endereco->getNrCep(); ?>"
                                           data-id="<?php echo $endereco->getCdEndereco(); ?>"
                                           data-action="E">Excluir</a>
                                    </td>
                                </tr>
                                <?php  }
                                ?>
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
        <script src="js/endereco.js"></script>
    </section>

 </body>
</html>
