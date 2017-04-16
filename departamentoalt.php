<?php include "include/head.php";
include "include/error.php";
$_id = $_POST['id'];
$_filial = $_POST['filial'];


include "beans/Departamento.class.php";
include "controller/DepartamentoController.class.php";
$departamento = new Departamento();
$departamentoController = new DepartamentoController();
$departamento = $departamentoController->getDepartamento($_id);
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
                            <a href="#" type="button"  data-id="<?php echo $_filial; ?>" class="btn btn-primary btn-yes">Sim</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row"></div>
            <br />
            <div style="text-align: center;">
            <h3>Alterar Cadastro de Departamento</h3>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">

                <div class="mensagem alert "></div>
                <form method="post" id="form" data-toggle="validator">
                    <input id="id" value="<?php echo $_id; ?>" type="hidden">
                    <input id="acao" value="A" type="hidden">
                    <input id="filial" value="<?php echo $departamento->getFilial()->getCdFilial(); ?>" type="hidden"/>
                    <div class="form-group col-lg-12">
                        <label for="responsavel">Respons&aacute;vel</label>
                        <input id="responsavel" class="form-control" required=""
                               autofocus placeholder="Nome do Repons&aacute;vel"
                               value="<?php echo $departamento->getNmResponsavel(); ?>"
                        />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-12">
                        <label for="departamento">Departamento</label>
                        <input id="departamento" class="form-control" required=""
                               placeholder="Nome do Departamento"
                               value="<?php echo $departamento->getDsDepartamento(); ?>"
                         />
                    </div>
                    <div class="row"></div>

                    <div class="form-group col-lg-4">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" required=""
                               placeholder="exemplo@email.com"
                               value="<?php echo $departamento->getDsEmail(); ?>"
                        />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-2">
                        <label for="telefone">Telefone  </label>
                        <input id="telefone" type="tel" class="form-control" placeholder="(00)0000-0000"/>
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
                    <div class="col-lg-1 form-group" >
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
                             include "beans/FoneDepartamento.class.php";
                             include "controller/FoneDepartamentoController.class.php";
                             include "services/FoneDepartamentoListIterator.class.php";
                             $foneController = new FoneDepartamentoController();
                             $lista = $foneController->getList($_id);
                             $foneList = new FoneDepartamentoListIterator($lista);
                             $foneDepartamento = new FoneDepartamento();

                             while ($foneList->hasNextFoneDepartamento()){
                                 $foneDepartamento = $foneList->getNextFoneDepartamento();


                             ?>
                           <tr>
                               <td><?php echo $foneDepartamento->getNrTelefone(); ?></td>
                               <td><?php echo $foneDepartamento->getObsTelefone(); ?></td>
                               <td><?php echo $foneDepartamento->getNmContato(); ?></td>
                               <td><?php echo $foneDepartamento->getTipoContato()->getCdTipoContato(); ?></td>
                               <td><?php echo $foneDepartamento->getTipoContato()->getDsTipoContato();?></td>
                               <td><a href='#div' class='btn btn-danger btn-remove btn-xs'>remover</a></td>
                           </tr>
                           <?php
                             }
                           ?>


                           </tbody>

                    </table>
                    <div class="row"></div>



                    <div class="row"></div>
                    <hr />
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success" onclick="salvar()">Salvar</button>
                        <a class="btn btn-warning "  data-toggle="modal" data-target="#cancelar-modal">Cancelar</a>
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
    <script src="js/departamento.js"></script>


 </body>
</html>