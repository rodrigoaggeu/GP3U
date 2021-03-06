<?php
if(!isset($_SESSION)){
    session_start();
}

require_once '../DAO/UnidadeDao.php';
require_once '../model/Unidade.php';
require_once '../DAO/Conexao.php';

//done
class UnidadeController {
    
    //done
    public function insereUnidade() {
        if (isset($_POST['descricao']))
            $descricao = $_POST['descricao'];
        if (isset($_POST['sigla']))
            $sigla = $_POST['sigla'];

        $conexao = new conexao();
        $unidade = new unidade();
        $unidade->setDescricao($descricao);
        $unidade->setSigla($sigla);
        $unidadeDao = new unidadeDao();
        $unidadeDao->adiciona($conexao, $unidade);
    }
    
    //done
    public function excluiUnidade() {
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        var_dump($id);
        $conexao = new conexao();
        $unidade = new unidade();
        $unidade->setId($id);
        $unidadeDao = new unidadeDao();
        $unidadeDao->exclui($conexao, $unidade);
        unset($id);
    }
    
    //done
    public function listaUnidade() {
        $conexao = new conexao();
        $unidadeDao = new unidadeDao();
        $unidadeDao->lista($conexao);
    }
    
    public function listaOptions() {
        $conexao = new conexao();
        $unidadeDao = new UnidadeDao();
        $unidadeDao->listaSelect($conexao);
    }

    public function listaOptionsEdicao($id) {
        $conexao = new conexao();
        $unidadeDao = new UnidadeDao();
        $unidadeDao->listaSelectEdicao($conexao, $id);
    }

    //done
    public function editaUnidade() {
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        if (isset($_POST['descricao']))
            $descricao = $_POST['descricao'];
        if (isset($_POST['sigla']))
            $sigla = $_POST['sigla'];
        $conexao = new conexao();
        $unidade = new unidade();
        $unidade->setId($id);
        $unidade->setDescricao($descricao);
        $unidade->setSigla($sigla);
        $unidadeDao = new unidadeDao();
        $unidadeDao->edita($conexao, $unidade);
    }
}

$cad = new UnidadeController();

if (isset($_POST['cadastrar']))
    $cadastrar = $_POST['cadastrar'];

if (isset($_POST['excluir']))
    $excluir = $_POST['excluir'];

if (isset($_POST['editar']))
    $editar = $_POST['editar'];


if (isset($cadastrar)) {
    $cad->insereUnidade();
    header("Location: ../view/UnidadeView.php");
}

if (isset($excluir)) {
    $cad->excluiUnidade();
    header("Location: ../view/UnidadeView.php");
}

if (isset($editar)){
    $cad->editaUnidade();
    header("Location: ../view/UnidadeView.php");    
}