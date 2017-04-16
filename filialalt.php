<?php include "include/head.php";
include "include/error.php";
$_id = $_POST['id'];
include "beans/Filial.class.php";
include "controller/FilialController.class.php";

$filial = new Filial();
$filialController = new FilialController();

$filial = $filialController->getFilial($_id);
?>

<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->



<link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" />
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

            <!-- Modal -->
            <div class="modal fade" id="cancelar-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="modalLabel">Cancelar Opera&ccedil;&atilde;o</h4>
                        </div>
                        <div class="modal-body">Deseja cancelar a opera&ccedil;&atilde;o atual? </div>
                        <div class="modal-footer">
                            <a href="#" type="button"  data-id="<?php echo $filial->getCliente()->getCdCliente(); ?>" class="btn btn-primary btn-yes">Sim</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row"></div>
            <br />
            <div style="text-align: center;">
            <h3>Alterar Cadastro de Filial</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">

                <div class="mensagem alert "></div>
                <form method="post" id="form" data-toggle="validator">
                    <input id="id" value="<?php echo $_id; ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <input id="endereco" value="<?php echo $filial->getNrCep(); ?>" type="hidden"/>
                    <input id="cliente"  type="hidden" value="<?php echo $filial->getCliente()->getCdCliente(); ?>">
                    <div class="form-group col-lg-12">
                        <label for="responsavel">Fantasia</label>
                        <input id="responsavel" class="form-control" required=""
                               autofocus placeholder="Nome Fantasia"
                               value="<?php echo $filial->getNmResponsavel(); ?>"
                        />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-12">
                        <label for="empresa">Raz&atilde;o Social</label>
                        <input id="empresa" class="form-control" required=""
                               placeholder="Raz&atilde;o Social"
                               VALUE="<?php echo $filial->getDsNmFantasia(); ?>"
                        />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-4">
                        <label for="cpfcnpj">CPF</label>
                        <input id="cpfcnpj" class="form-control" required="" placeholder="000.000.000-00"

                         value="<?php
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
                         echo $cpfcnpj;?>"
                        />
                        <?php
                          $tam = strlen($filial->getNrCpfCnpj());
                          $cpf = "";
                          $cnpj = "";
                          if($tam == 11){
                              $cpf = "checked";
                          }else{
                              $cnpj = "checked";
                          }
                        ?>
                        <span><label><input name="doc" id="checkcpf" type="radio" class="cpf" <?php echo $cpf; ?>> CPF</label>
                            &nbsp;&nbsp;&nbsp;
                            <label><input name="doc" id="checkcnpj" type="radio" class="cnpj" <?php echo $cnpj; ?>> CNPJ</label>
                        </span>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control"
                               required="" placeholder="exemplo@email.com"
                               value="<?php echo $filial->getDsEmail(); ?>"
                        />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-2">
                        <label for="telefone">Telefone  </label>
                        <input id="telefone" type="tel" class="form-control"
                               placeholder="(00)0000-0000"
                        />
                    </div>
                    <div class="form-group col-lg-2">
                        <label for="observacao">Observa&ccedil;&atilde;o</label>
                        <input id="observacao" class="form-control">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="contato">Contato</label>
                        <input id="contato" class="form-control">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="tipo">Tipo Telefone</label>
                        <select id="tipo" class="form-control"></select>
                    </div>
                    <div class="col-lg-1 form-group" style="margin-top: 30px;">
                        <label></label>
                        <a href="#div" title="Clique para atualizar a lista" class="btn btn-refresh"><i class="lnr lnr-sync"></i></a>
                    </div>
                    <div class="col-lg-1 form-group" style="margin-top: 30px;">

                        <a href="#div" class="btn btn-primary btn-add">Adicionar</a>
                    </div>
                    <div class="row"></div>
                    <table class="table table-hover">
                        <thead>
                           <th>Telefone</th><th>Observacao</th><th>Contato</th><th width="1">#</th><th>Tipo</th><th></th>
                         </thead>
                        <tbody id="tbody">
                         <?php
                         include "beans/FoneFilial.class.php";
                         include "controller/FoneFilialController.class.php";
                         include "services/FoneFilialListIterator.class.php";
                         $foneFilial = new FoneFilial();
                         $foneFilialController = new FoneFilialController();
                         $lista = $foneFilialController->getList($_id);
                         $foneFilialList = new FoneFilialListIterator($lista);
                         while ($foneFilialList->hasNextFoneFilial()){
                             $foneFilial = $foneFilialList->getNextFoneFilial();
                           ?>
                           <tr>
                               <td><?php echo $foneFilial->getNrTelefone(); ?></td>
                               <td><?php echo $foneFilial->getObsTelefone(); ?></td>
                               <td><?php echo $foneFilial->getNmContato(); ?></td>
                               <td><?php echo $foneFilial->getTipoContato()->getCdTipoContato(); ?></td>
                               <td><?php echo $foneFilial->getTipoContato()->getDsTipoContato(); ?></td>
                               <td><a href='#div' class='btn btn-danger btn-remove btn-xs'>remover</a></td>
                           </tr>
                         <?php
                         }
                         ?>
                        </tbody>
                    </table>
                    <div class="row"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div style="text-align: center;">
                                <span>Endere&ccedil;o</span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-2">
                                <label for="cep">CEP</label>
                                <input id="cep" class="form-control" placeholder="00.000-000"
                                       onblur="buscarCEP()" required=""/>
                            </div>
                            <div class="row"></div>
                            <div class="form-group col-lg-6">
                                <label for="logradouro">Logradouro</label>
                                <input id="logradouro" class="form-control" disabled="" required="" />
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="bairro">Bairro</label>
                                <input id="bairro" class="form-control" disabled="" />
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="numero">N&uacute;mero</label>
                                <input id="numero" class="form-control" required="" value="<?php echo $filial->getNrCasa(); ?>" />
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="complemento">Complemento</label>
                                <input id="complemento" class="form-control" value="<?php echo $filial->getDsComplemento(); ?>"/>
                            </div>
                        </div>
                    </div>


                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning " data-toggle="modal" data-target="#cancelar-modal">Cancelar</a>
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
    <script src="js/jquery.tabletojson.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#cep').mask('00.000-000');

        });
        $(document).ready(function(){

            //alert('Codigo da cidade: '+cidade);
            $.post("function/tipocontato.php",
                {
                    'acao': "L"
                },
                function(data){
                    $("#tipo").find("option").remove();
                    $("#tipo").append(data);
                });
        });

    </script>                                                                                                                                                   ,0ççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççççç
    <script src="js/validarcpf.js"></script>
    <script src="js/validator.min.js"></script>
    <script src="js/filial.js"></script>


 </body>
</html>