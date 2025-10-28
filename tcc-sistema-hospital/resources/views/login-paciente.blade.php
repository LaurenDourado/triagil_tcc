<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login do Paciente - TriÁgil</title>

  <!-- Fonte Unbounded do Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Unbounded', cursive;
      background: url("{{ asset('imagens/enfermagem.jpg') }}") no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    .container-full-height {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .card-login {
      background-color: #13678A;
      border-radius: 30px;
      width: 100%;
      max-width: 600px;
      padding: 50px 40px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .logo-container {
      margin-bottom: 30px;
    }

    .logo-container img {
      width: 90px;
      height: auto;
    }

    .card-login h2 {
      font-size: 24px;
      margin-bottom: 25px;
      font-weight: 600;
    }

    .form-control {
      border-radius: 30px;
      padding: 12px 20px;
      font-size: 16px;
      margin-bottom: 20px;
      border: 2px solid rgba(255, 255, 255, 0.5);
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      transition: border-color 0.3s, background-color 0.3s;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
      outline: none;
      background-color: rgba(255, 255, 255, 0.2);
      border-color: #ffffff;
      color: white;
    }

    .btn-entrar {
      background-color: #322172;
      color: white;
      border-radius: 25px;
      font-weight: 600;
      width: 100%;
      padding: 14px 0;
      font-size: 16px;
      border: none;
      cursor: pointer;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }

    .btn-entrar:hover {
      background-color: #24175d;
    }

    .link-login {
      color: #7CDA77;
      text-decoration: underline;
      transition: 0.3s;
    }

    .link-login:hover {
      color: #1f8d19ff;
    }

    .btn-voltar {
      color: #7CDA77;
      text-decoration: underline;
      font-size: 1rem;
      display: inline-block;
      margin-top: 10px;
      transition: color 0.3s ease;
    }

    .btn-voltar:hover {
      color: #9ff19a;
    }

    p.text-center {
      margin-top: 15px;
      margin-bottom: 10px;
    }

    @media (max-width: 600px) {
      .card-login {
        padding: 40px 25px;
      }
      .logo-container img {
        width: 50px;
      }
      .form-control {
        font-size: 14px;
        padding: 10px 16px;
      }
      .btn-entrar {
        font-size: 14px;
        padding: 12px 0;
      }
    }
  </style>
</head>

<body>
  <div class="container-full-height">
    <div class="card-login">
      <div class="logo-container">
        <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo TriÁgil" />
      </div>

      <h2>Login do Paciente</h2>

      <!-- Mensagens de erro da sessão -->
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      <!-- Mensagens de validação -->
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Formulário de login -->
      <form method="POST" action="{{ route('paciente.login.submit') }}">
        @csrf
        <input type="text" name="cpf" class="form-control" placeholder="CPF" value="{{ old('cpf') }}" required />
        <input type="password" name="password" class="form-control" placeholder="Senha" required />
        <button type="submit" class="btn btn-entrar">Entrar</button>
      </form>

      <p class="text-center">
        Ainda não tem cadastro?
        <a href="{{ route('paciente.register') }}" class="link-login">Cadastre-se</a>
      </p>

      <!-- Botão Voltar centralizado -->
      <div class="text-center">
        <a href="{{ route('identificacao') }}" class="btn-voltar">Voltar</a>
      </div>
    </div>
  </div>
</body>
</html>
