<?php
require_once __DIR__ . '/../Model/AlunoModel.php';

class AlunoController{
    private $AlunoModel;

    public function __construct($pdo){
        $this->AlunoModel = new AlunoModel($pdo);
    }

    public function listar() {
        return $this->AlunoModel->buscarTodosAlunos();
    }

    public function buscarAluno($id){
        return $this->AlunoModel->buscarAluno($id);
    }

    public function cadastrar($nome, $email, $senha){
        return $this->AlunoModel->cadastrarAluno($nome, $email, $senha);
    }

    public function deletar($id){
        return $this->AlunoModel->deletarAluno($id);
    }

    public function editar($id, $nome, $email, $senha){
        return $this->AlunoModel->editarAluno($id, $nome, $email, $senha);
    }

    public function autenticar($email, $senha){
        return $this->AlunoModel->autenticar($email, $senha);
    }
}

