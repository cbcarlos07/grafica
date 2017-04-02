<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */

$id        = 0;
$nome      =  "";
$uf        =  "";
$pais      =  0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['estado'])){
    $nome = $_POST['estado'];
}

if(isset($_POST['uf'])){
    $uf = $_POST['uf'];
}

if(isset($_POST['pais'])){
    $pais = $_POST['pais'];
}

switch ($acao){
    case 'C':
        add($nome, $uf, $pais);
        break;
    case 'A':
        change($id, $nome, $uf, $pais);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getEstados($id);
        break;

}

function add($nome, $uf, $pais){
    require_once "../beans/Estado.class.php";
    require_once "../beans/Pais.class.php";
    require_once "../controller/EstadoController.class.php";

    $estado = new Estado();
    $estado->setNmEstado($nome);
    $estado->setDsUF($uf);
    $estado->setPais(new Pais());
    $estado->getPais()->setCdpais($pais);

    $estadoController = new EstadoController();
    $teste = $estadoController->insert($estado);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $uf, $pais){
    require_once "../beans/Estado.class.php";
    require_once "../controller/EstadoController.class.php";
    require_once "../beans/Pais.class.php";


    $estado = new Estado();
    $estado->setCdEstado($id);
    $estado->setNmEstado($nome);
    $estado->setDsUF($uf);
    $estado->setPais(new Pais());
    $estado->getPais()->setCdpais($pais);

    $estadoController = new EstadoController();
    $teste = $estadoController->update($estado);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/EstadoController.class.php";
    $estadoController = new EstadoController();
    $teste = $estadoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function getEstados($id){
    require_once "../beans/Estado.class.php";
    require_once "../controller/EstadoController.class.php";
    require_once "../services/EstadoListIterator.class.php";

    $ec = new EstadoController();
    $lista = $ec->getLista("");
    $eListIterator = new EstadoListIterator($lista);
    $estado = new Estado();
    if($eListIterator->hasNextEstado()){
        while($eListIterator->hasNextEstado()) {
            $estado = $eListIterator->getNextEstado();
            $select = "";
            if ($estado->getCdEstado() == $id) {
                $select = "selected";
            }
            echo "<option " . $select . " value='" . $estado->getCdEstado() . "'>" . $estado->getNmEstado() . "</option>";
        }
    }else{
        echo "<option value=''>N&atilde;o possui dados cadastrados</option>";
    }
}
