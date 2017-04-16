<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include ("../include/error.php");
$id           = 0;
$cliente      = 0;
$responsavel  =  "";
$empresa      =  "";
$cpfcnpj      =  "";
$telefone     =  "";
$email        =  "";
$endereco     =  0;
$numero       =  "";
$complemento  =  "";
$acao         = $_POST['acao'];

if(isset($_POST['cliente'])){
    $cliente = $_POST['cliente'];
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['responsavel'])){
    $responsavel = $_POST['responsavel'];
}

if(isset($_POST['empresa'])){
    $empresa = $_POST['empresa'];
}

if(isset($_POST['cpfcnpj'])){
    $cpfcnpj = $_POST['cpfcnpj'];
}

if(isset($_POST['telefone'])){
    $telefone = $_POST['telefone'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}

if(isset($_POST['endereco'])){
    $endereco = $_POST['endereco'];
}
if(isset($_POST['complemento'])){
    $complemento = $_POST['complemento'];
}

if(isset($_POST['numero'])){
    $numero = $_POST['numero'];
}

switch ($acao){
    case 'C':
        add($cliente, $responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
            $complemento);
        break;
    case 'A':
        change($id, $cliente, $responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
            $complemento);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($cliente, $responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
             $complemento){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Filial.class.php";
    require_once "../beans/FoneFilial.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../beans/Cliente.class.php";
    require_once "../controller/FilialController.class.php";
    require_once "../controller/FoneFilialController.class.php";
   // echo "cliente: ".$cliente;
    $filial = new Filial();
    $filial->setCliente(new Cliente());
    $filial->getCliente()->setCdCliente($cliente);
    $filial->setNmResponsavel($responsavel);
    $filial->setDsNmFantasia($empresa);
    $vowels = array(".", "-","/");
    $novocpf = str_replace($vowels,'',$cpfcnpj);
    $filial->setNrCpfCnpj($novocpf);
    $filial->setDsEmail($email);
    $vowels = array(".", "-");
    $novocep= str_replace($vowels,'',$endereco);
    $filial->setNrCep($novocep);
    $filial->setNrCasa($numero);
    $filial->setDsComplemento($complemento);

    $filialController = new FilialController();
    $genId = $filialController->insert($filial);
   // echo "Gerado: $genId";
    $arr = json_decode($telefone);
    $foneFilial = new FoneFilial();
    $foneFilialController = new FoneFilialController();
    $teste = false;
    if($genId > 0){
        foreach ($arr as $item  => $value){
            $foneFilial->setFilial(new Filial());
            $foneFilial->getFilial()->setCdFilial($genId);
            $foneFilial->setNrTelefone($value->{'Telefone'});
            $foneFilial->setObsTelefone($value->{'Observacao'});
            $foneFilial->setNmContato($value->{'Contato'});
            $foneFilial->setTipoContato(new TipoContato());
            $foneFilial->getTipoContato()->setCdTipoContato($value->{'#'});
            $teste = $foneFilialController->insert($foneFilial);
        }
    }
    if($genId > 0)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $cliente, $responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
                $complemento){
    require_once "../beans/Filial.class.php";
    require_once "../beans/FoneFilial.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../beans/Cliente.class.php";
    require_once "../controller/FilialController.class.php";
    require_once "../controller/FoneFilialController.class.php";
    //echo "Alterar";
    $filial = new Filial();
    $filial->setCdFilial($id);
    $filial->setCliente(new Cliente());
    $filial->getCliente()->setCdCliente($cliente);
    $filial->setNmResponsavel($responsavel);
    $filial->setDsNmFantasia($empresa);
    $vowels = array(".", "-","/");
    $novocpf = str_replace($vowels,'',$cpfcnpj);
    $filial->setNrCpfCnpj($novocpf);
    $filial->setDsEmail($email);
    $vowels = array(".", "-");
    $novocep= str_replace($vowels,'',$endereco);
    $filial->setNrCep($novocep);
    $filial->setNrCasa($numero);
    $filial->setDsComplemento($complemento);

    $filialController = new FilialController();
    $alterarBool= $filialController->update($filial);
    //echo "Teste: $teste";
    $arr = json_decode($telefone);
    $foneFilial = new FoneFilial();
    $foneFilialController = new FoneFilialController();
    $foneFilialController->delete($id);
    $teste = false;

    foreach ($arr as $item  => $value){
        $foneFilial->setFilial(new Filial());
        $foneFilial->getFilial()->setCdFilial($id);
        $foneFilial->setNrTelefone($value->{'Telefone'});
        $foneFilial->setObsTelefone($value->{'Observacao'});
        $foneFilial->setNmContato($value->{'Contato'});
        $foneFilial->setTipoContato(new TipoContato());
        $foneFilial->getTipoContato()->setCdTipoContato($value->{'#'});
        $teste = $foneFilialController->insert($foneFilial);
    }
    // echo "Retorno : ".$alterarBool;
    if($alterarBool)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../beans/FoneFilial.class.php";
    require_once "../controller/FoneFilialController.class.php";
    require_once "../controller/FilialController.class.php";
    $filialController = new FilialController();
    $foneFilialController = new FoneFilialController();
    $foneFilialController->delete($id);
    $teste = $filialController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

