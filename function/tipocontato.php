<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$nome      =  "";
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

switch ($acao){
    case 'C':
        add($nome);
        break;
    case 'A':
        change($id, $nome);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getTipoContatos();
        break;

}

function add($nome){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/TipoContatoController.class.php";

    $tipoContato = new TipoContato();
    $tipoContato->setDsTipoContato($nome);

    $tipoContatoController = new TipoContatoController();
    $teste = $tipoContatoController->insert($tipoContato);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome){
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/TipoContatoController.class.php";

    $tipoContato = new TipoContato();
    $tipoContato->setCdTipoContato($id);
    $tipoContato->setDsTipoContato($nome);

    $tipoContatoController = new TipoContatoController();
    $teste = $tipoContatoController->update($tipoContato);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/TipoContatoController.class.php";
    $tipoContatoController = new TipoContatoController();
    $teste = $tipoContatoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getTipoContatos(){
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/TipoContatoController.class.php";
    require_once "../services/TipoContatoListIterator.class.php";
    $tipoContato = new TipoContato();
    $tipoContatoController = new TipoContatoController();
    $lista = $tipoContatoController->getLista("");
    $tipoContatoListIterator = new TipoContatoListIterator($lista);
    if($tipoContatoListIterator->hasNextTipoContato()) {
        while ($tipoContatoListIterator->hasNextTipoContato()) {
            $tipoContato = $tipoContatoListIterator->getNextTipoContato();

         echo " <option  value='".$tipoContato->getCdTipoContato()."'>".$tipoContato->getDsTipoContato()."</option>";
        }
    }else{
        echo "<option value=''>N&atilde;o possui dados cadastrados</option>";
    }
}
