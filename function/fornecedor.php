<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include ("../include/error.php");
$id           = 0;
$fantasia     =  "";
$razao        =  "";
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

if(isset($_POST['fantasia'])){
    $fantasia = $_POST['fantasia'];
}

if(isset($_POST['razao'])){
    $razao = $_POST['razao'];
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
        add($fantasia, $razao, $cpfcnpj, $telefone, $email,  $endereco, $numero,
            $complemento);
        break;
    case 'A':
        change($id, $fantasia, $razao, $cpfcnpj, $telefone, $email,  $endereco, $numero,
            $complemento);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($fantasia, $razao, $cpfcnpj, $telefone, $email,  $endereco, $numero,
             $complemento){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Fornecedor.class.php";
    require_once "../beans/FoneFornecedor.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/FornecedorController.class.php";
    require_once "../controller/FoneFornecedorController.class.php";

    $fornecedor = new Fornecedor();
    $fornecedor->setDsNmFantasia($fantasia);
    $fornecedor->setDsRazaoSocial($razao);
    $vowels = array(".", "-","/");
    $novocpf = str_replace($vowels,'',$cpfcnpj);
    $fornecedor->setNrCpfCnpj($novocpf);
    $fornecedor->setDsEmail($email);
    $vowels = array(".", "-");
    $novocep= str_replace($vowels,'',$endereco);
    $fornecedor->setNrCep($novocep);
    $fornecedor->setNrCasa($numero);
    $fornecedor->setDsComplemento($complemento);

    $fornecedorController = new FornecedorController();
    $genId = $fornecedorController->insert($fornecedor);
   // echo "Codigo: $genId";
    $arr = json_decode($telefone);
    $foneFornecedor = new FoneFornecedor();
    $foneFornecedorController = new FoneFornecedorController();
    $teste = false;
    if($genId > 0){
       foreach ($arr as $item  => $value){
           $foneFornecedor->setFornecedor(new Fornecedor());
           $foneFornecedor->getFornecedor()->setCdFornecedor($genId);
           $foneFornecedor->setNrTelefone($value->{'Telefone'});
           $foneFornecedor->setObsTelefone($value->{'Observacao'});
           $foneFornecedor->setNmContato($value->{'Contato'});
           $foneFornecedor->setTipoContato(new TipoContato());
           $foneFornecedor->getTipoContato()->setCdTipoContato($value->{'#'});
           $teste = $foneFornecedorController->insert($foneFornecedor);
       }
    }
    if($genId > 0)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $fantasia, $razao, $cpfcnpj, $telefone, $email,  $endereco, $numero,
                $complemento){
    require_once "../beans/Fornecedor.class.php";
    require_once "../beans/FoneFornecedor.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../controller/FornecedorController.class.php";
    require_once "../controller/FoneFornecedorController.class.php";
    //echo "Alterar";
    $fornecedor = new Fornecedor();
    $fornecedor->setCdFornecedor($id);
    $fornecedor->setDsRazaoSocial($razao);
    $fornecedor->setDsNmFantasia($fantasia);
    $vowels = array(".", "-","/");
    $novocpf = str_replace($vowels,'',$cpfcnpj);
    $fornecedor->setNrCpfCnpj($novocpf);
    $fornecedor->setDsEmail($email);
    $vowels = array(".", "-");
    $novocep= str_replace($vowels,'',$endereco);
    $fornecedor->setNrCep($novocep);
    $fornecedor->setNrCasa($numero);
    $fornecedor->setDsComplemento($complemento);

    $fornecedorController = new FornecedorController();
    $alterarBool= $fornecedorController->update($fornecedor);
    //echo "Teste: $teste";
    $arr = json_decode($telefone);
    $foneFornecedor = new FoneFornecedor();
    $foneFornecedorController = new FoneFornecedorController();
    $foneFornecedorController->delete($id);
    $teste = false;

        foreach ($arr as $item  => $value){
            $foneFornecedor->setFornecedor(new Fornecedor());
            $foneFornecedor->getFornecedor()->setCdFornecedor($id);
            $foneFornecedor->setNrTelefone($value->{'Telefone'});
            $foneFornecedor->setObsTelefone($value->{'Observacao'});
            $foneFornecedor->setNmContato($value->{'Contato'});
            $foneFornecedor->setTipoContato(new TipoContato());
            $foneFornecedor->getTipoContato()->setCdTipoContato($value->{'#'});
            $teste = $foneFornecedorController->insert($foneFornecedor);
        }
   // echo "Retorno : ".$alterarBool;
    if($alterarBool)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../beans/FoneFornecedor.class.php";
    require_once "../controller/FoneFornecedorController.class.php";
    require_once "../controller/FornecedorController.class.php";
    $fornecedorController = new FornecedorController();
    $foneFornecedorController = new FoneFornecedorController();
    $foneFornecedorController->delete($id);
    $teste = $fornecedorController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

