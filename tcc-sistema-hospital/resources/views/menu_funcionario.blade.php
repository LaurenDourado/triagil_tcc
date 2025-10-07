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
      background-color: rgba(75, 0, 130, 0.8);
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

    .botao-voltar {
      background: none;
      color: #5cd4b2;
      font-weight: bold;
      font-size: 1rem;
      margin-top: 1rem;
      text-decoration: none;
      display: inline-block;
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
      Bem-vindo(a), {{ Auth::guard('funcionario')->user()->nome }}!
    </div>

    <!-- Botões principais -->
    <a href="{{ route('dashboard.funcionario.cards') }}" class="botao botao-azul">
      Ir para Dashboard
    </a>

    <a href="{{ route('dashboard.consultorios') }}" class="botao botao-verde">
      Gerenciar Consultórios
    </a>

    <!-- Botão Voltar -->
    <a href="{{ url('/') }}" class="botao-voltar">Voltar</a>
  </div>

</body>
</html>