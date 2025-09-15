<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Funcionário</title>

    <!-- Fonte Unbounded do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Unbounded', cursive;
            background: url('../imagens/enfermagem.jpg') no-repeat center center fixed;
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
            background-color: #13678A; /* Azul do paciente */
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

        /* Logo no topo */
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
            background-color: rgba(255, 255, 255, 0.1); /* fundo claro translúcido */
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
            background-color: #322172; /* Roxo */
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

        /* Mensagem de erro */
        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* Responsividade */
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
            <!-- Logo do Funcionário -->
            <div class="logo-container">
                <img src="/imagens/Monograma.png" alt="Logo TriÁgil" />
            </div>

            <h2>Login do Funcionário</h2>

            <!-- Exibição de erro -->
            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Formulário de login -->
            <form action="{{ route('login.funcionario.submit') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required class="form-control" />
                <input type="password" name="password" placeholder="Senha" required class="form-control" />
                <button type="submit" class="btn btn-entrar">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>