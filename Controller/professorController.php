<?php
require_once 'C:/Turma1/xampp/htdocs/SISTEMA/Model/ProfessorModel.php';

class ProfessorController {
    private $ProfessorModel;

    public function __construct($pdo) {
        $this->ProfessorModel = new ProfessorModel($pdo);
    }

    public function listar() {
        return $this->ProfessorModel->buscarTodosProfessores();
    }

    public function buscarProfessor($id) {
        return $this->ProfessorModel->buscarProfessor($id);
    }

    public function cadastrar($nome, $email, $senha) {
        return $this->ProfessorModel->cadastrarProfessor($nome, $email, $senha);
    }

    public function deletar($id) {
        return $this->ProfessorModel->deletarProfessor($id);
    }

    public function editar($id, $nome, $email, $senha = null) {
        return $this->ProfessorModel->editarProfessor($id, $nome, $email, $senha);
    }

    public function autenticar($email, $senha) {
        return $this->ProfessorModel->autenticar($email, $senha);
    }
}