<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */


$logradouro    = "";
$tplogradouro  = 0;
$cep       = "";
$bairro    = 0;
$id        = 0;
$acao = $_POST['acao'];


if(isset($_POST['logradouro'])){
    $logradouro = $_POST['logradouro'];
}

if(isset($_POST['tplogradouro'])){
    $tplogradouro = $_POST['tplogradouro'];
}

if(isset($_POST['cep'])){
    $cep = $_POST['cep'];
}
if(isset($_POST['bairro'])){
    $bairro = $_POST['bairro'];
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
}





switch ($acao){
    case 'C':
        add($cep, $logradouro, $tplogradouro, $bairro );
        break;
    case 'A':
        change($id, $cep, $logradouro, $tplogradouro, $bairro);
        break;
    case 'E':
        delete($id);
        break;
    case 'G':
        getEndereco($cep);
        break;
    case 'B':
        getEnderecoById($id);
        break;


}

function add($cep, $logradouro, $tplogradouro, $bairro){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Endereco.class.php";
    require_once "../controller/EnderecoController.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/TpLogradouro.class.php";
    $cep_ = array(".", "-");
    $cep = str_replace($cep_,"", $cep);
    $endereco = new Endereco();
    $endereco->setNrCep($cep);
    $endereco->setDsLogradouro($logradouro);
    $endereco->setTpLogradouro(new TpLogradouro());
    $endereco->getTpLogradouro()->setCdTpLogradouro($tplogradouro);
    $endereco->setBairro(new Bairro());
    $endereco->getBairro()->setCdBairro($bairro);

    $enderecoController = new EnderecoController();
    $teste = $enderecoController->insert($endereco);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $cep, $logradouro, $tplogradouro, $bairro){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Endereco.class.php";
    require_once "../controller/EnderecoController.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/TpLogradouro.class.php";
    $cep_ = array(".", "-");
    $cep = str_replace($cep_,"", $cep);
    $endereco = new Endereco();
    //echo "Codigo: ".$id;
    $endereco->setCdEndereco($id);
    $endereco->setNrCep($cep);
    $endereco->setDsLogradouro($logradouro);
    $endereco->setTpLogradouro(new TpLogradouro());
    $endereco->getTpLogradouro()->setCdTpLogradouro($tplogradouro);
    $endereco->setBairro(new Bairro());
    $endereco->getBairro()->setCdBairro($bairro);

    $enderecoController = new EnderecoController();
    $teste = $enderecoController->update($endereco);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($cep){
    require_once "../controller/EnderecoController.class.php";
    $enderecoController = new EnderecoController();
    $teste = $enderecoController->delete($cep);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getEndereco($cep){
    require_once "../beans/Endereco.class.php";
    require_once "../controller/EnderecoController.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/TpLogradouro.class.php";

    $endereco = new Endereco();
    $enderecoController = new EnderecoController();
    $cep_ = array(".", "-");
    $cep = str_replace($cep_,"", $cep);
    $endereco = $enderecoController->getEnderecoByCep($cep);

    if($endereco != null)
        echo json_encode(array('retorno'    => 1
        ,'codigo'     => $endereco->getCdEndereco()
        ,'logradouro' => $endereco->getTpLogradouro()->getDsTpLogradouro()." ".$endereco->getDsLogradouro()
        ,'bairro'     => $endereco->getBairro()->getNmBairro()));


    else
    {
        echo json_encode(array('retorno' => 0));
    }
}

function getEnderecoById($id){
    require_once "../beans/Endereco.class.php";
    require_once "../controller/EnderecoController.class.php";
    require_once "../beans/Bairro.class.php";
    require_once "../beans/TpLogradouro.class.php";

    $endereco = new Endereco();
    $enderecoController = new EnderecoController();
    $endereco = $enderecoController->getEnderecoById($id);

    if($endereco != null)
        echo json_encode(array('retorno'    => 1
        ,'codigo'     => $endereco->getCdEndereco()
        ,'logradouro' => $endereco->getTpLogradouro()->getDsTpLogradouro()." ".$endereco->getDsLogradouro()
        ,'bairro'     => $endereco->getBairro()->getNmBairro()
        ,'cep'        => $endereco->getNrCep()));


    else
    {
        echo json_encode(array('retorno' => 0));
    }
}


