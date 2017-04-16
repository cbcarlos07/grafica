<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 22/02/17
 * Time: 20:43
 */
include "../include/error.php";
$id         = 0;
$nome       =  "";
$sobrenome  = "";
$login      =  "";
$senha      = "";
$acao       = $_POST['acao'];
$ativo      = "";
$cargo      = 0;
$cpf        = "";
$rg         = "";
$foto       = "";
$senhaatual = "";
$lembrar    = "";

if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}

if(isset($_POST['sobrenome'])){
    $sobrenome = $_POST['sobrenome'];
}

if(isset($_POST['login'])){
    $login = $_POST['login'];
}

if(isset($_POST['senha'])){
    $senha = $_POST['senha'];
}

if(isset($_POST['ativo'])){
    $ativo = $_POST['ativo'];
}
if(isset($_POST['cargo'])){
    $cargo = $_POST['cargo'];
}

if(isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}
if(isset($_POST['rg'])){
    $rg = $_POST['rg'];
}
if(isset($_POST['foto'])){
    $foto = $_POST['foto'];
}
if(isset($_POST['atual'])){
    $senhaatual = $_POST['atual'];
}
if(isset($_POST['lembrar'])){
    $lembrar = $_POST['lembrar'];
}

switch ($acao){
    case 'C':
        add( $nome, $sobrenome, $login, $senha,
            $ativo, $cargo, $cpf, $rg,
            $foto, $senhaatual);
        break;
    case 'A':
        change($id, $nome, $sobrenome, $login, $senha,
            $ativo, $cargo, $cpf, $rg,
            $foto, $senhaatual);
        break;
    case 'E':
        delete($id);
        break;
    case 'L':
        getLista($id);
        break;
    case 'D':
        login($login, $senha, $lembrar);
        break;
    case 'S':
        sair();
        break;


}

function add($nome, $sobrenome, $login, $senha, $ativo, $cargo, $cpf, $rg, $foto, $senhaatual){
   // echo "<script>alert('Adicionar'); </script>";
    require_once "../beans/Usuario.class.php";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/UsuarioController.class.php";

    $usuario = new Usuario();
    $usuario->setNmUsuario($nome);
    $usuario->setNmSobrenome($sobrenome);
    $usuario->setDsLogin($login);
    $usuario->setDsSenha($senha);
    $usuario->setSnAtivo($ativo);
    $usuario->setCargo(new Cargo());
    $usuario->getCargo()->setCdCargo($cargo);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $usuario->setNrCPF($novocpf);
    $usuario->setNrRg(str_replace("-",'',$rg));
    $usuario->setDsFoto($foto);
    $usuario->setSnSenhaAtual($senhaatual);

    $usuarioController = new UsuarioController();
    $teste = $usuarioController->insert($usuario);
    //echo "Teste: $teste";
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}


function change($id, $nome, $sobrenome, $login, $senha, $ativo, $cargo, $cpf, $rg, $foto, $senhaatual){
    require_once "../beans/Usuario.class.php";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/UsuarioController.class.php";
   // echo "Senha atual: ".$senhaatual;
    //echo "Codigo id: ".$id;
    $usuario = new Usuario();
    $usuario->setCdUsuario($id);
    $usuario->setNmUsuario($nome);
    $usuario->setNmSobrenome($sobrenome);
    $usuario->setDsLogin($login);
    $usuario->setDsSenha($senha);
    $usuario->setSnAtivo($ativo);
    $usuario->setCargo(new Cargo());
    $usuario->getCargo()->setCdCargo($cargo);
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $usuario->setNrCPF($novocpf);
    $usuario->setNrRg(str_replace("-",'',$rg));
    $usuario->setDsFoto($foto);
    $usuario->setSnSenhaAtual($senhaatual);

    $usuarioController = new UsuarioController();
    $teste = $usuarioController->update($usuario);

    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function delete($id){
    require_once "../controller/UsuarioController.class.php";
    $usuarioController = new UsuarioController();
    $teste = $usuarioController->delete($id);
    //echo "Retorno: ".$teste;
    if($teste)
        echo json_encode(array('retorno' => 1));
    else
        echo json_encode(array('retorno' => 0));
}

function getLista($id){
    require_once "../beans/Usuario.class.php";
    require_once "../beans/Cargo.class.php";
    require_once "../controller/UsuarioController.class.php";
    require_once "../services/UsuarioListIterator.class.php";

    $usuario =  new Usuario();
    $usuarioController = new UsuarioController();
    $lista  = $usuarioController->getLista("");
    $usuarioLista = new UsuarioListIterator($lista);

    while ($usuarioLista->hasNextUsuario()){
        $usuario = $usuarioLista->getNextUsuario();

        $select = "";
        if($id == $usuario->getCdUsuario()){
            $select = "selected";
        }
        echo "<option $select value='".$usuario->getCdusuario()."'>".$usuario->getNmUsuario()."</option>>";
    }

}

function login($login, $senha, $lembrar){
    require_once '../beans/Usuario.class.php';
    require_once '../controller/UsuarioController.class.php';
    $uc = new UsuarioController();




    $acesso = $uc->getLoginUserBool($login, $senha);
    if($acesso){
        try{
            $usuario = $uc->getLoginUser($login, $senha);
            session_start();
            if($usuario->getSnSenhaAtual() == 'S'){
                if($lembrar == 'S'){
                    $ck_login = "login";
                    $ck_vlogin = $login;
                    setcookie($ck_login, $ck_vlogin, time() + (86400 * 30), "/"); // 86400 = 1 day

                    $ck_pwd = "senha";
                    $ck_vpwd = $senha;
                    setcookie($ck_pwd, $ck_vpwd, time() + (86400 * 30), "/"); // 86400 = 1 day

                    $ck_check = "checked";
                    $ck_vcheck = 'S';
                    setcookie($ck_check, $ck_vcheck, time() + (86400 * 30), "/"); // 86400 = 1 day
                }
                $_SESSION['login'] = $login;
                $_SESSION['cargo'] = $usuario->getCargo()->getDsCargo();
                $_SESSION['cdusuario'] = $usuario->getCdUsuario();
                $_SESSION['foto'] = $usuario->getDsFoto();
                echo json_encode(array("retorno" => 1,"codigo" => $usuario->getCdUsuario() ));
            }else{
                $_SESSION['login'] = $login;
                $_SESSION['cargo'] = $usuario->getCargo()->getDsCargo();
                $_SESSION['cdusuario'] = $usuario->getCdUsuario();
                $_SESSION['foto'] = $usuario->getDsFoto();
                echo json_encode(array("retorno" => 0,"codigo" => $usuario->getCdUsuario() ));

            }
        }catch (Exception $exception){
            echo json_encode(array("retorno" => -1));
        }
    }else{
        echo json_encode(array("retorno" => -1));
    }




}

function sair(){
    session_start();
   // echo "Sair";
    unset($_SESSION['login']);
    session_destroy();
    //$_SESSION['login'] = "";
    header('Location: ..');
}
