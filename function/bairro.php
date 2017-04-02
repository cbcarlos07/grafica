<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
require_once "../include/error.php";
$id        = 0;
$nome      = "";
$cidade    = 0;
$zona      = 0;
$bairro    = 0;
$acao = $_POST['acao'];


if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['cidade'])){
    $cidade = $_POST['cidade'];
}
if(isset($_POST['zona'])){
    $zona = $_POST['zona'];
}

if(isset($_POST['bairro'])){
    $bairro = $_POST['bairro'];
}





switch ($acao){
    case 'C':
        add($nome, $cidade, $zona);
        break;
    case 'A':
        change($id, $nome, $cidade, $zona);
        break;
    case 'E':
        delete($id);
        break;
    case 'B': //bairro por cidade
        getBairros($cidade, $bairro);

}

function add($nome, $cidade, $zona){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Bairro.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Zona.class.php";

    $bairro = new Bairro();
    $bairro->setNmBairro($nome);
    $bairro->setCidade(new Cidade());
    $bairro->getCidade()->setCdCidade($cidade);
    $bairro->setZona(new Zona());
    $bairro->getZona()->setCdZona($zona);

    $bairroController = new BairroController();
    $teste = $bairroController->insert($bairro);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $cidade, $zona){
    // echo "<script>alert('Adicionar'); </script>";

    require_once "../beans/Bairro.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../beans/Cidade.class.php";
    require_once "../beans/Zona.class.php";

    $bairro = new Bairro();
/*    echo "Codigo do bairro: ".$id."<br>";
    echo "Codigo do Cidade: ".$cidade."<br>";*/
    $bairro->setCdBairro($id);
    $bairro->setNmBairro($nome);
    $bairro->setCidade(new Cidade());
    $bairro->getCidade()->setCdCidade($cidade);
    $bairro->setZona(new Zona());
    $bairro->getZona()->setCdZona($zona);
    $bairroController = new BairroController();
    $teste = $bairroController->update($bairro);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/BairroController.class.php";
    $bairroController = new BairroController();
    $teste = $bairroController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getBairros($cidade, $cdBairro){
    require_once "../beans/Bairro.class.php";
    require_once "../controller/BairroController.class.php";
    require_once "../services/BairroListIterator.class.php";
    $bairro = new Bairro();
    $bc = new BairroController();
    $lista = $bc->getListByCidade("",$cidade);
    $bList = new BairroListIterator($lista);
    if($bList->hasNextBairro()) {
        while ($bList->hasNextBairro()) {
            $bairro = $bList->getNextBairro();
            $select = "";
            if($cdBairro > 0){
                if($cdBairro == $bairro->getCdBairro()){
                    $select = "selected";
                }
            }
            echo "<option ".$select." value='" . $bairro->getCdBairro() . "'>" . $bairro->getNmBairro() . "</option>";
        }
    }else {
        if ($cidade > 0) {

            echo "<option value=''>N&atilde;o possui bairros cadastrados</option>";
        }else{
            echo "<option value=''>Selecione uma cidade </option>";
        }

    }
}
