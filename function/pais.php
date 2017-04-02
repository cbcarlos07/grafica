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
        getPaises($id);
        break;

}

function add($nome){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Pais.class.php";
    require_once "../controller/PaisController.class.php";

    $pais = new Pais();
    $pais->setDsPais($nome);

    $paisController = new PaisController();
    $teste = $paisController->insert($pais);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome){
    require_once "../beans/Pais.class.php";
    require_once "../controller/PaisController.class.php";

    $pais = new Pais();
    $pais->setCdPais($id);
    $pais->setDsPais($nome);

    $paisController = new PaisController();
    $teste = $paisController->update($pais);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/PaisController.class.php";
    $paisController = new PaisController();
    $teste = $paisController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getPaises($id){
    require_once "../beans/Pais.class.php";
    require_once "../controller/PaisController.class.php";
    require_once "../services/PaisListIterator.class.php";

    $pais = new Pais();
    $paisController = new PaisController();
    $lista = $paisController->getLista("");
    $paisList = new PaisListIterator($lista);

    if($paisList->hasNextPais()) {
        while ($paisList->hasNextPais()) {
            $pais = $paisList->getNextPais();
            $select = "";
            if ($pais->getCdPais() == $id) {
                $select = "selected";
            }
            echo "<option ".$select." value='" . $pais->getCdPais() . "'>" . $pais->getDsPais() . "</option>";
        }
    }else{
        echo "<option value=''>N&atilde;o possui dados cadastrados</option>";
    }
}
