<?php   

class AlunoModel{
    
    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function buscarTodosAlunos(): array{
        $stmt = $this->pdo->query('SELECT * FROM alunos');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function buscarAluno($id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM alunos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }

    public function cadastrarAluno($nome, $email, $senha){
        $sql = ('INSERT INTO alunos (nome, email, senha) VALUES (:nome, :email, :senha)');
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            'nome'=>$nome,
            'email'=>$email,
            'senha'=>password_hash($senha, PASSWORD_DEFAULT)
        ]);
    }

    // Busca aluno pelo email (útil para validações)
    public function buscarPorEmail($email): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM alunos WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }

    // Busca aluno pelo nome (útil se armazenamos o nome no registro de treinos)
    public function buscarPorNome($nome): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM alunos WHERE nome = :nome');
        $stmt->execute(['nome' => $nome]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }

    public function editarAluno($id, $nome, $email, $senha){
        $sql= "UPDATE alunos SET nome=?, email=?, senha=? WHERE id=?";
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT), $id]);
    }
    
    public function deletarAluno($id){
        $sql = "DELETE FROM alunos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function autenticar($email, $senha){
        $sql = "SELECT * FROM alunos WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($aluno && password_verify($senha, $aluno['senha'])) {
            return $aluno;
        }
        
        return false;
    }
}