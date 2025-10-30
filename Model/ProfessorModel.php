<?php
class ProfessorModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function buscarTodosProfessores(): array {
        $stmt = $this->pdo->query('SELECT * FROM professores');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProfessor($id): array {
        $stmt = $this->pdo->prepare('SELECT * FROM professores WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrarProfessor($nome, $email, $senha) {
        $sql = 'INSERT INTO professores (nome, email, senha) VALUES (:nome, :email, :senha)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT)
        ]);
    }

    public function editarProfessor($id, $nome, $email, $senha = null) {
        if ($senha) {
            $sql = "UPDATE professores SET nome=:nome, email=:email, senha=:senha WHERE id=:id";
            $params = [
                'id' => $id,
                'nome' => $nome,
                'email' => $email,
                'senha' => password_hash($senha, PASSWORD_DEFAULT)
            ];
        } else {
            $sql = "UPDATE professores SET nome=:nome, email=:email WHERE id=:id";
            $params = [
                'id' => $id,
                'nome' => $nome,
                'email' => $email
            ];
        }
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
    
    public function deletarProfessor($id) {
        $sql = "DELETE FROM professores WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function autenticar($email, $senha){
        $sql = "SELECT * FROM professores WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $prof = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($prof && password_verify($senha, $prof['senha'])) {
            return $prof;
        }

        return false;
    }
}