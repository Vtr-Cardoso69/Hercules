<?php
class TreinoModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrarTreino($aluno_nome, $professor_id, $descricao, $modalidade = null) {
        if ($modalidade !== null && $modalidade !== '') {
            $sql = 'INSERT INTO treinos (aluno_nome, professor_id, descricao, modalidade) VALUES (:aluno_nome, :professor_id, :descricao, :modalidade)';
            $params = [
                'aluno_nome' => $aluno_nome,
                'professor_id' => $professor_id,
                'descricao' => $descricao,
                'modalidade' => $modalidade
            ];
        } else {
            $sql = 'INSERT INTO treinos (aluno_nome, professor_id, descricao) VALUES (:aluno_nome, :professor_id, :descricao)';
            $params = [
                'aluno_nome' => $aluno_nome,
                'professor_id' => $professor_id,
                'descricao' => $descricao
            ];
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    
    public function buscarTodosTreinos() {
        $sql = "SELECT t.*, p.nome as professor_nome 
                FROM treinos t 
                LEFT JOIN professores p ON t.professor_id = p.id 
                ORDER BY t.data_criacao DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTreinos() {
        $sql = 'SELECT t.*, p.nome as professor_nome FROM treinos t JOIN professores p ON t.professor_id = p.id';
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lista treinos apenas do aluno informado (por nome), com join e ordenação
public function buscarTreinosPorAlunoNome(string $aluno_nome): array {
    $sql = "SELECT t.id, t.aluno_nome, t.professor_id, t.descricao, t.modalidade,
                   t.data_criacao,
                   p.nome AS professor_nome
            FROM treinos t
            LEFT JOIN professores p ON t.professor_id = p.id
            WHERE t.aluno_nome = :aluno_nome
            ORDER BY t.data_criacao DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['aluno_nome' => $aluno_nome]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Busca um treino específico por ID (com join de professor)
    public function buscarTreinoPorId(int $id): ?array {
        $sql = "SELECT t.*, p.nome as professor_nome 
                FROM treinos t 
                LEFT JOIN professores p ON t.professor_id = p.id 
                WHERE t.id = :id 
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Deleta um treino por ID
    public function deletarTreino(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM treinos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    // Atualiza um treino por ID
    public function atualizarTreino(int $id, string $aluno_nome, int $professor_id, string $descricao, ?string $modalidade = null): bool {
        $sql = 'UPDATE treinos SET aluno_nome = :aluno_nome, professor_id = :professor_id, descricao = :descricao';
        $params = [
            'aluno_nome' => $aluno_nome,
            'professor_id' => $professor_id,
            'descricao' => $descricao
        ];
        if ($modalidade !== null && $modalidade !== '') {
            $sql .= ', modalidade = :modalidade';
            $params['modalidade'] = $modalidade;
        }
        $sql .= ' WHERE id = :id';
        $params['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }   

}
