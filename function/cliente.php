<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include ("../include/error.php");
$id           = 0;
$responsavel  =  "";
$empresa      =  "";
$cpfcnpj      =  "";
$telefone     =  "";
$email        =  "";
$endereco     =  0;
$numero       =  "";
$complemento  =  "";
$acao         = $_POST['acao'];


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
        add($responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
            $complemento);
        break;
    case 'A':
        change($id, $responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
            $complemento);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
             $complemento){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Cliente.class.php";
    require_once "../beans/FoneCliente.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/ClienteController.class.php";
    require_once "../controller/FoneClienteController.class.php";

    $cliente = new Cliente();
    $cliente->setNmResponsavel($responsavel);
    $cliente->setDsNmFantasia($empresa);
    $vowels = array(".", "-","/");
    $novocpf = str_replace($vowels,'',$cpfcnpj);
    $cliente->setNrCpfCnpj($novocpf);
    $cliente->setDsEmail($email);
    $vowels = array(".", "-");
    $novocep= str_replace($vowels,'',$endereco);
    $cliente->setNrCep($novocep);
    $cliente->setNrCasa($numero);
    $cliente->setDsComplemento($complemento);

    $clienteController = new ClienteController();
    $genId = $clienteController->insert($cliente);
    //echo "Teste: $teste";
    $arr = json_decode($telefone);
    $foneCliente = new FoneCliente();
    $foneClienteController = new FoneClienteController();
    $teste = false;
    if($genId > 0){
       foreach ($arr as $item  => $value){
           $foneCliente->setCliente(new Cliente());
           $foneCliente->getCliente()->setCdCliente($genId);
           $foneCliente->setNrTelefone($value->{'Telefone'});
           $foneCliente->setObsTelefone($value->{'Observacao'});
           $foneCliente->setNmContato($value->{'Contato'});
           $foneCliente->setTipoContato(new TipoContato());
           $foneCliente->getTipoContato()->setCdTipoContato($value->{'#'});
           $teste = $foneClienteController->insert($foneCliente);
       }
    }
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $responsavel, $empresa, $cpfcnpj, $telefone, $email,  $endereco, $numero,
                $complemento){
    require_once "../beans/Cliente.class.php";
    require_once "../beans/FoneCliente.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/ClienteController.class.php";
    require_once "../controller/FoneClienteController.class.php";
    //echo "Alterar";
    $cliente = new Cliente();
    $cliente->setCdCliente($id);
    $cliente->setNmResponsavel($responsavel);
    $cliente->setDsNmFantasia($empresa);
    $vowels = array(".", "-","/");
    $novocpf = str_replace($vowels,'',$cpfcnpj);
    $cliente->setNrCpfCnpj($novocpf);
    $cliente->setDsEmail($email);
    $vowels = array(".", "-");
    $novocep= str_replace($vowels,'',$endereco);
    $cliente->setNrCep($novocep);
    $cliente->setNrCasa($numero);
    $cliente->setDsComplemento($complemento);

    $clienteController = new ClienteController();
    $alterarBool= $clienteController->update($cliente);
    //echo "Teste: $teste";
    $arr = json_decode($telefone);
    $foneCliente = new FoneCliente();
    $foneClienteController = new FoneClienteController();
    $foneClienteController->delete($id);
    $teste = false;

        foreach ($arr as $item  => $value){
            $foneCliente->setCliente(new Cliente());
            $foneCliente->getCliente()->setCdCliente($id);
            $foneCliente->setNrTelefone($value->{'Telefone'});
            $foneCliente->setObsTelefone($value->{'Observacao'});
            $foneCliente->setNmContato($value->{'Contato'});
            $foneCliente->setTipoContato(new TipoContato());
            $foneCliente->getTipoContato()->setCdTipoContato($value->{'#'});
            $teste = $foneClienteController->insert($foneCliente);
        }
   // echo "Retorno : ".$alterarBool;
    if($alterarBool)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../beans/FoneCliente.class.php";
    require_once "../controller/FoneClienteController.class.php";
    require_once "../controller/ClienteController.class.php";
    $clienteController = new ClienteController();
    $foneClienteController = new FoneClienteController();
    $foneClienteController->delete($id);
    $teste = $clienteController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

