<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Menu Funcionário - TriÁgil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: url('../imagens/sala.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Unbounded', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card {
      background-color: #0b6785;
      border-radius: 20px;
      padding: 2.5rem;
      text-align: center;
      width: 380px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .logo {
      width: 80px;
      height: 80px;
      margin: 0 auto 1rem;
    }

    .welcome-message {
      color: #ffffff;
      font-weight: 600;
      border-radius: 15px;
      padding: 0.6rem 1rem;
      margin-bottom: 1.5rem;
      display: inline-block;
      font-size: 1.1rem;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-5px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .botao {
      display: block;
      width: 100%;
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      padding: 1rem;
      margin: 0.8rem 0;
      cursor: pointer;
      transition: transform 0.2s, background-color 0.3s;
      text-decoration: none;
      text-align: center;
    }

    .botao:hover {
      transform: scale(1.05);
    }

    .botao-roxo {
      background-color: #4b0082;
    }

    .botao-verde {
      background-color: #5cd4b2;
      color: #fff;
    }

    .botao-azul {
      background-color: #1d4ed8;
    }

    .logout-link { 
      color: #7CDA77;
      font-size: 1rem;
      align-items: center;
      justify-content: center;
      padding: 8px 20px;
      text-decoration: underline;
      transition: 0.3s; 
    }

    .botao-voltar:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="card">
    <img src="../imagens/Monograma.png" alt="Logo TriÁgil" class="logo">

    <!-- Mensagem de boas-vindas -->
    <div class="welcome-message">
      <h2>Bem-vindo, {{ Auth::guard('funcionario')->user()->name ?? 'Funcionário' }}!</h2>
    </div>

    <!-- Botões principais -->
    <a href="{{ route('dashboard.funcionario.cards') }}" class="botao botao-azul">
      Gerenciar Pacientes
    </a>

    <a href="{{ route('dashboard.consultorios') }}" class="botao botao-verde">
      Gerenciar Consultórios
    </a>

    <!-- Botão Voltar -->
    <div class="d-flex justify-content-center mt-6">
      <a href="{{ url('/identificacao') }}" class="logout-link">Voltar</a>
  </div>
  </div>

</body>
</html>