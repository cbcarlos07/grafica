<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$nome      =  "";
$obs       =  "";
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['obs'])){
    $obs = $_POST['obs'];
}

switch ($acao){
    case 'C':
        add($nome, $obs);
        break;
    case 'A':
        change($id, $nome, $obs);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($nome, $obs){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/CargoController.class.php";

    $cargo = new Cargo();
    $cargo->setDsCargo($nome);
    $cargo->setObsCargo($obs);

    $cargoController = new CargoController();
    $teste = $cargoController->insert($cargo);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $obs){
    require_once "../beans/Cargo.class.php";
    require_once "../controller/CargoController.class.php";

    $cargo = new Cargo();
    $cargo->setCdCargo($id);
    $cargo->setDsCargo($nome);
    $cargo->setObsCargo($obs);

    $cargoController = new CargoController();
    $teste = $cargoController->update($cargo);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/CargoController.class.php";
    $cargoController = new CargoController();
    $teste = $cargoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getLista($id){
    require_once "../beans/Cargo.class.php";
    require_once "../controller/CargoController.class.php";
    require_once "../services/CargoListIterator.class.php";

    $cargo =  new Cargo();
    $cargoController = new CargoController();
    $lista  = $cargoController->getListaByCargo("");
    $cargoLista = new CargoListIterator($lista);

    while ($cargoLista->hasNextCargo()){
        $cargo = $cargoLista->getNextCargo();

        $select = "";
        if($id == $cargo->getCdCargo()){
            $select = "selected";
        }
        echo "<option $select value='".$cargo->getCdCargo()."'>".$cargo->getDsCargo()."</option>>";
    }

}
