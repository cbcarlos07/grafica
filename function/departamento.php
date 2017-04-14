<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include ("../include/error.php");
$id           = 0;
$filial       = 0;
$responsavel  =  "";
$departamento =  "";
$telefone     =  "";
$email        =  "";

$acao         = $_POST['acao'];

if(isset($_POST['filial'])){
    $filial = $_POST['filial'];
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['responsavel'])){
    $responsavel = $_POST['responsavel'];
}

if(isset($_POST['departamento'])){
    $departamento = $_POST['departamento'];
}


if(isset($_POST['telefone'])){
    $telefone = $_POST['telefone'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}


switch ($acao){
    case 'C':
        add($filial, $responsavel, $departamento, $telefone, $email );
        break;
    case 'A':
        change($id, $filial, $responsavel, $departamento, $telefone, $email );
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;

}

function add($filial, $responsavel, $dsdepartamento, $telefone, $email ){
    // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Departamento.class.php";
    require_once "../beans/FoneDepartamento.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../beans/Filial.class.php";
    require_once "../controller/DepartamentoController.class.php";
    require_once "../controller/FoneDepartamentoController.class.php";
    //echo "Filial: ".$filial;
    $departamento = new Departamento();
    $departamento->setFilial(new Filial());
    $departamento->getFilial()->setCdFilial($filial);
    $departamento->setNmResponsavel($responsavel);
    $departamento->setDsDepartamento($dsdepartamento);
    $departamento->setDsEmail($email);

    $departamentoController = new DepartamentoController();
    $genId = $departamentoController->insert($departamento);
  //  echo "Gerado: $genId";
    $arr = json_decode($telefone);
    $foneDepartamento = new FoneDepartamento();
    $foneDepartamentoController = new FoneDepartamentoController();
    $teste = false;
    if($genId > 0){
        foreach ($arr as $item  => $value){
            $foneDepartamento->setDepartamento(new Departamento());
            $foneDepartamento->getDepartamento()->setCdDepartamento($genId);
            $foneDepartamento->setNrTelefone($value->{'Telefone'});
            $foneDepartamento->setObsTelefone($value->{'Observacao'});
            $foneDepartamento->setNmContato($value->{'Contato'});
            $foneDepartamento->setTipoContato(new TipoContato());
            $foneDepartamento->getTipoContato()->setCdTipoContato($value->{'#'});
            $teste = $foneDepartamentoController->insert($foneDepartamento);
        }
    }
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $filial, $responsavel, $dsdepartamento, $telefone, $email){
    require_once "../beans/Departamento.class.php";
    require_once "../beans/FoneDepartamento.class.php";
    require_once "../beans/TipoContato.class.php";
    require_once "../beans/Filial.class.php";
    require_once "../controller/DepartamentoController.class.php";
    require_once "../controller/FoneDepartamentoController.class.php";
    // echo "cliente: ".$cliente;
    $departamento = new Departamento();
    $departamento->setCdDepartamento($id);
    $departamento->setFilial(new Filial());
    $departamento->getFilial()->setCdFilial($filial);
    $departamento->setNmResponsavel($responsavel);
    $departamento->setDsDepartamento($dsdepartamento);
    $departamento->setDsEmail($email);

    $departamentoController = new DepartamentoController();
    $alterarBool= $departamentoController->update($departamento);
    //echo "Teste: $teste";
    $arr = json_decode($telefone);
    $foneDepartamento = new FoneDepartamento();
    $foneDepartamentoController = new FoneDepartamentoController();
    $foneDepartamentoController->delete($id);
    $teste = false;

    foreach ($arr as $item  => $value){
        $foneDepartamento->setDepartamento(new Departamento());
        $foneDepartamento->getDepartamento()->setCdDepartamento($id);
        $foneDepartamento->setNrTelefone($value->{'Telefone'});
        $foneDepartamento->setObsTelefone($value->{'Observacao'});
        $foneDepartamento->setNmContato($value->{'Contato'});
        $foneDepartamento->setTipoContato(new TipoContato());
        $foneDepartamento->getTipoContato()->setCdTipoContato($value->{'#'});
        $teste = $foneDepartamentoController->insert($foneDepartamento);
    }
    // echo "Retorno : ".$alterarBool;
    if($alterarBool)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../beans/FoneDepartamento.class.php";
    require_once "../controller/FoneDepartamentoController.class.php";
    require_once "../controller/DepartamentoController.class.php";
    $departamentoController = new DepartamentoController();
    $foneDepartamentoController = new FoneDepartamentoController();
    $foneDepartamentoController->delete($id);
    $teste = $departamentoController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

