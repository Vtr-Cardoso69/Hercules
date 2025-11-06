<?php
require_once 'C:/Turma1/xampp/htdocs/Hercules/Model/TreinoModel.php';
require_once 'C:/Turma1/xampp/htdocs/Hercules/Model/ProfessorModel.php';
require_once 'C:/Turma1/xampp/htdocs/Hercules/Model/AlunoModel.php';

class TreinoController {
    private $TreinoModel;
    private $ProfessorModel;
    private $AlunoModel;

    public function __construct($pdo) {
        $this->TreinoModel = new TreinoModel($pdo);
        $this->ProfessorModel = new ProfessorModel($pdo);
        $this->AlunoModel = new AlunoModel($pdo);
    }

    // Cadastra um novo treino
    public function cadastrar($aluno_nome, $professor_id, $descricao, $modalidade = null) {
        // Valida se professor existe
        $prof = $this->ProfessorModel->buscarProfessor($professor_id);
        if (!$prof) {
            return ['success' => false, 'message' => 'Professor não encontrado. Escolha um professor válido.'];
        }

        // Valida se o aluno existe
        $aluno = $this->AlunoModel->buscarPorNome($aluno_nome);
        if (!$aluno) {
            return ['success' => false, 'message' => 'Aluno não encontrado. Verifique se o nome está correto.'];
        }

        // Cadastra o treino
        $result = $this->TreinoModel->cadastrarTreino($aluno_nome, $professor_id, $descricao, $modalidade);
        if ($result) {
            return ['success' => true, 'message' => 'Treino cadastrado com sucesso!'];
        } else {
            return ['success' => false, 'message' => 'Erro ao cadastrar treino. Tente novamente.'];
        }
    }

    // Lista todos os treinos
    public function listar() {
        return $this->TreinoModel->buscarTodosTreinos();
    }

    // Lista treinos apenas do aluno informado (por nome)
    public function listarPorAlunoNome(string $aluno_nome): array {
        return $this->TreinoModel->buscarTreinosPorAlunoNome($aluno_nome);
    }

    // Busca um treino por ID
    public function buscarTreino($id) {
        return $this->TreinoModel->buscarTreinoPorId((int)$id);
    }

    // Deleta um treino por ID
    public function deletar($id): bool {
        return $this->TreinoModel->deletarTreino((int)$id);
    }

    // Atualiza um treino por ID
    public function atualizar($id, $aluno_nome, $professor_id, $descricao, $modalidade = null): bool {
        return $this->TreinoModel->atualizarTreino((int)$id, $aluno_nome, $professor_id, $descricao, $modalidade);
    }

}
?>
