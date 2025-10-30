<?php
// Inicia sessão para mostrar opções conforme estado de autenticação
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logged = isset($_SESSION['user_id']);

if (!$logged) {
    // Usuário não autenticado: mostra links para cadastrar e login
    echo "<p style='text-align:center; margin:10px 0;'>";
    echo "<a href='/Hercules/View/Aluno/cadastrar.php' style='margin-right:12px;'>Cadastrar Usuário</a>";
    echo "<a href='/Hercules/View/login.php'>Login</a>";
    echo "</p>";
} else {
    // Usuário autenticado: mostra link de logout
    $nome = htmlspecialchars($_SESSION['user_nome'] ?? $_SESSION['user_email']);
    echo "<p style='text-align:center; margin:10px 0;'>Bem-vindo, {$nome} &nbsp; <a href='/Hercules/Controller/LogoutController.php' style='color:#c00;'>Sair</a></p>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title></title>
       <link rel="stylesheet" href="Assets/CSS/land.css">

  <!-- 🏋️ HERO / CAPA -->
    <div class="hero">
        <img src="Assets/img/banner.jpg" alt="Hercules Gym" class="hero-bg">
        <div class="hero-text">
            <h1>HERCULES GYM</h1>
            <p>Força. Foco. Disciplina.</p>
            <a href="#planos" class="btn">Conheça nossos planos</a>
        </div>
    </div>

    <!-- 💪 SOBRE A ACADEMIA -->
    <div class="sobre">
        <div class="container">
            <div class="texto">
                <h2>Sobre Nós</h2>
                <p>A Hercules Gym é uma academia focada em resultados reais. Nossa missão é transformar o corpo e a mente de nossos alunos com treinos intensos, estrutura completa e ambiente motivador.</p>
            </div>
            <div class="imagem">
                <img src="Assets/img/forte.jpg" alt="Academia por dentro">
            </div>
        </div>
    </div>

    <!-- ⚙️ MODALIDADES -->
    <div class="modalidades">
        <h2>Modalidades</h2>
        <div class="cards">
            <div class="card">
                <img src="Assets/img/forte.jpg" alt="Musculação">
                <h3>Musculação</h3>
            </div>
            <div class="card">
                <img src="Assets/img/forte.jpg" alt="Treino Funcional">
                <h3>Funcional</h3>
            </div>
            <div class="card">
                <img src="Assets/img/forte.jpg" alt="Spinning">
                <h3>Spinning</h3>
            </div>
        </div>
    </div>

    <!-- 💸 PLANOS -->
    <div class="planos" id="planos">
        <h2>Planos e Preços</h2>
        <div class="cards">
            <div class="card">
                <h3>Básico</h3>
                <p>R$ 99 / mês</p>
                <p>Acesso livre à musculação</p>
                <a href="#" class="btn">Assinar</a>
            </div>
            <div class="card">
                <h3>Premium</h3>
                <p>R$ 149 / mês</p>
                <p>Musculação + Funcional</p>
                <a href="#" class="btn">Assinar</a>
            </div>
            <div class="card">
                <h3>VIP</h3>
                <p>R$ 199 / mês</p>
                <p>Todas as modalidades + Personal</p>
                <a href="#" class="btn">Assinar</a>
            </div>
        </div>
    </div>

    <!-- 📍 LOCALIZAÇÃO -->
    <div class="localizacao">
        <h2>Onde Estamos</h2>
        <p>Rua da Força, 123 – Paraguaçu Paulista – SP</p>
       <iframe 
  src="https://www.google.com/maps?q=-22.426061866161312,-50.58312655762208&hl=pt&z=20&output=embed" 
  width="100%" 
  height="300" 
  style="border:0;" 
  allowfullscreen="" 
  loading="lazy">
</iframe>


    </div>

    <!-- 📞 CONTATO / RODAPÉ -->
    <div class="rodape">
        <div class="container">
            <p>&copy; 2025 Hercules Gym | Todos os direitos reservados</p>
            <p>Instagram: @herculesgym | WhatsApp: (18) 99999-9999</p>
        </div>
    </div>


</body>
</html>