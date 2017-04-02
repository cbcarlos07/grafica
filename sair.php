<?php include "include/head.php"; ?>

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


            <br>


            <div class="row"></div>
            <hr />
            <div class="mensagem alert "></div>
            <script src="js/tooltip.js"></script>
            <div id="page-wrapper" class="tabela">
            <div class="graphs">
                <div class="xs tabls">
                    <div class="bs-example4" data-example-id="contextual-table">
                        <div class="" style="margin-left: 40%;">
                            <h3>Deseja realmente sair?</h3>
                            <div style="margin-left: 7% " ">
                            <a href="#" class="btn btn-primary btn-yes " style="width: 90px;">Sim</a>
                            <a href="#" class="btn btn-default btn-no " style="width: 90px;">N&atilde;o</a>
                            </div>
                        </div>
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
        <script src="js/bairro.js"></script>
    </section>
    <script>
       $('.btn-yes').on('click',function () {
         //  alert('Sair');
          var form = $('<form method="post" action="function/usuario.php">'+
                        '<input type="hidden" name="acao" value="S">'+
                        '</form>')
           $('body').append(form);
          form.submit();
       });
       $('.btn-no').on('click',function () {
           var form = $('<form method="post" action="cliente.php">'+

               '</form>')
           $('body').append(form);
           form.submit();
       });
    </script>

 </body>
</html>
