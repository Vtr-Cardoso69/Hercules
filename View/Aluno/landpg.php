<div>
<?php
    // Inicia sessão para mostrar opções conforme estado de autenticação
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $logged = isset($_SESSION['user_id']);

    if (!$logged) {
        // Usuário não autenticado: botão de login alinhado à direita mantendo inline-flex
        echo "<div class='login-wrap'>";
        echo "<a class='login-button1' href='/SISTEMA/View/login.php' title='Login'>";
        echo "<span>Login</span>";        
        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"20px\" viewBox=\"0 -960 960 960\" width=\"20px\" fill=\"#ff7a00\"><path d=\"M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z\"/></svg>";
        echo "</a>";
        echo "</div>";
    }else{
          $nome = htmlspecialchars($_SESSION['user_nome'] ?? $_SESSION['user_email']);
       
        echo "<div class='login-wrap'>";
        echo "<a class='login-bar-button' href='/SISTEMA/Controller/LogoutController.php' title='Logout'>";
        echo "<span>Sair</span>";             
        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"20px\" viewBox=\"0 -960 960 960\" width=\"20px\" fill=\"#ff7a00\"><path d=\"M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z\"/></svg>";
        echo "</a>";
        echo "</div>";          
    }
?>
</div>

<style>
    .login-wrap {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        justify-content: flex-end;
        z-index: 1001;
    }
    .login-button, .login-button1 {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        background-color: #121212; /* escuro */
        color: #fff;
        border: 2px solid #452c15ff; /* laranja */
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        letter-spacing: 0.4px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.35);
        transition: transform .15s ease, box-shadow .2s ease, background-color .2s ease, border-color .2s ease;
    }
    .login-button:hover, .login-button1:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.5);
        background-color: #1a1a1a;
        border-color: #ff9327ff; /* laranja mais claro no hover */
    }
    .login-button svg {
        fill: #ff0303ff;
        transition: fill .2s ease;
    }
     .login-button1 svg {
        fill: #ffffffff;
        transition: fill .2s ease;
    }
    .login-button:hover svg {
        fill: #ff8f20ff;
    }
     .login-button1:hover svg {
        fill: #ff8f20ff;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/SISTEMA/Assets/CSS/landpg.css">
      <title>Hercules Gym</title>
     
    <style>
        /* Estilo para o menu lateral */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #f1f1f1;
        }
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .menu-button {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 30px;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
            z-index: 999;
        }
        #main {
            transition: margin-left .5s;
        }



        .login-wrap, .login-bar-wrap {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            justify-content: flex-end;
            z-index: 1001;
        }
        .login-bar-button1, .login-bar-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            background-color: #121212; /* escuro */
            color: #fff;
            border: 2px solid #452c15ff; /* laranja */
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.35);
            transition: transform .15s ease, box-shadow .2s ease, background-color .2s ease, border-color .2s ease;
        }
        .login-bar-button1:hover, .login-bar-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.5);
            background-color: #1a1a1a;
            border-color: #ff9327ff; /* laranja mais claro no hover */
        }
        .login-bar-button1 svg {
            fill: #ff0303ff;
            transition: fill .2s ease;
        }
        .login-bar-button1:hover svg {
            fill: #ff8f20ff;
        }
        .login-bar-button svg {
            fill: #ffffffff;
            transition: fill .2s ease;
        }
        .login-bar-button:hover svg {
            fill: #ff8f20ff;
        }
    </style>

    <!-- Menu Lateral -->
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="/SISTEMA/View/Aluno/historico.php">Histórico</a>
        <a href="#cards">Treinos</a>
    </div>

    <!-- Botão do Menu -->
    <button class="menu-button" onclick="openNav()">&#9776;</button>

    <div id="main">
        <!-- 🏋️ HERO / CAPA -->
        <div class="hero">
            <img src="/SISTEMA/Assets/img/banner.jpg" alt="Hercules Gym" class="hero-img">
            <div class="hero-text">
                <h1>HERCULES GYM</h1>
                <p>Força. Foco. Disciplina.</p>
                <a href="#cards" class="btn">Conheça nossos planos</a>
            </div>
        </div>

    
<div class="container">
    
    <!-- SOBRE A ACADEMIA -->
    <div class="sobre">
    <div class="container">
   
        <!-- HORARIOS -->      
        <div class="texto">
        
        <h2>Sobre Nós</h2>
        <p>A Academia Hercules é a escolha certa para quem procura uma academia completa. Oferece musculação, com uma equipe pronta para te ajudar a alcançar seus objetivos. Não é necessário agendamento para participar das atividades.</p>

        <br>

        <h2>Horários de funcionamento</h2>
        <p>
            
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Segunda-feira: 08:00 - 11:00
            Segunda-feira: 15:00 - 21:00

            <br>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Terça-feira: 08:00 - 11:00
            Terça-feira: 15:00 - 21:00

            <br>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Quarta-feira: 08:00 - 11:00
            Quarta-feira: 15:00 - 21:00

            <br>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Quinta-feira: 08:00 - 11:00
            Quinta-feira: 15:00 - 21:00

            <br>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Sexta-feira: 08:00 - 11:00
            Sexta-feira: 15:00 - 21:00
            <br>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Sábado: Fechado
            
            <br>

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/></svg>
            Domingo: Fechado
        
        </p>
    
        </div>
                   
        <div class="imagem">
        <img src="Assets/img/banner.jpg" alt="Academia por dentro">
        </div>
                
    </div>
    </div>


    <!-- ⚙️ MODALIDADES -->
    <div class="modalidades" id="cards">
        <h2>Modalidades</h2>
        <div class="cards">
            
            <div class="card1">
                <a href="/SISTEMA/View/Aluno/Treino.php?modalidade=Musculação">
                    <img src="Assets/img/forte.jpg" alt="Musculação"></a>
                <h3>Musculação</h3> 
            </div>  
                    
            <div class="card2">
                <a href="/SISTEMA/View/Aluno/Treino.php?modalidade=Funcional">
                    <img src="Assets/img/funcional.jpg" alt="Treino Funcional"></a>
                <h3>Funcional</h3>
            </div>
            
            <div class="card3">
                <a href="/SISTEMA/View/Aluno/Treino.php?modalidade=Spinning">
                    <img src="Assets/img/spinning.jpg" alt="Spinning"></a>
                <h3>Spinning</h3>
            </div>

        </div>
    </div>

    <!-- 💸 PLANOS -->
    <div class="planos" id="planos">
        <h2>Planos e Preços</h2>
        <div class="cards">
            
            <div class="card1">
                <h3>Básico</h3>
                <p>R$ 40 / 1 mês</p>
                <br>
                <a href="#" class="btn">Assinar</a>
            </div>
            
            <div class="card2">
                <h3>Premium</h3>
                <p>R$ 150 / 4 mês</p>
                <br>
                <a href="#" class="btn">Assinar</a>
            </div>
            
            <div class="card3">
                <h3>VIP</h3>
                <p>R$ 380 / 1 ano </p>
                <br>
                <a href="#" class="btn">Assinar</a>
            </div>
        
        </div>
    </div>

    <!-- 📍 LOCALIZAÇÃO -->
    <div class="localizacao">
        <h2>Onde Estamos</h2>
        <p>Localizada na Av. Siqueira Campos, 2027</p>
            <iframe
                src="https://www.google.com/maps?q=-22.426061866161312,-50.58312655762208&hl=pt&z=20&output=embed"
                width="100%"
                height="300"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
    </div>
</div>


    <!-- 📞 CONTATO / RODAPÉ -->
    <div class="rodape">
        <div class="container">
            <p>&copy; 2025 Hercules Gym | Todos os direitos reservados</p>
        </div>
    </div>
    
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}
</script>
</body>
</html>
