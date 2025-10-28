<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Menu Funcionário - TriÁgil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /*  Estilos Base (Desktop/Telas Maiores) */
        body {
            background: url('../imagens/sala.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Unbounded', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px; /* Adiciona um pequeno padding para evitar que o card toque as bordas */
            box-sizing: border-box; /* Garante que o padding não aumente o tamanho total */
        }

        .card {
            background-color: #0b6785;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            width: 380px; /* Largura padrão para desktop */
            max-width: 90%; /* Limita a largura máxima para se ajustar melhor */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            /* Adicionado para rolagem em telas muito curtas, como teclados virtuais em mobile */
            max-height: 100%;
            overflow-y: auto; 
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
            /* Adiciona quebra de linha em nomes longos em mobile */
            word-wrap: break-word; 
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .botao {
            display: block;
            width: 100%;
            border: none;
            border-radius: 30px;
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

        .botao-azul { background-color: #1d4ed8; }
        .botao-verde { background-color: #5cd4b2; color: #fff; }

        .logout-link {  
            color: #7CDA77;
            font-size: 1rem;
            padding: 8px 20px;
            text-decoration: underline;
            transition: 0.3s; 
        }

        .logout-link:hover {
            text-decoration: none; /* Muda para não sublinhado no hover */
            color: #ffffff; /* Cor de hover mais visível */
        }

        /*  Media Query para Mobile */
        @media (max-width: 600px) {
            .card {
                width: 90%; /* Ocupa 90% da largura da tela */
                padding: 1.5rem; /* Reduz o padding interno */
                border-radius: 15px; /* Arredondamento menor */
                /* Garantindo que o card fique bem centralizado em telas pequenas */
                margin: auto; 
            }

            .logo {
                width: 60px; /* Reduz o tamanho do logo */
                height: 60px;
            }

            .welcome-message {
                font-size: 1rem; /* Fonte um pouco menor */
                padding: 0.5rem 0.8rem;
                margin-bottom: 1rem;
            }

            .botao {
                font-size: 0.95rem; /* Fonte dos botões um pouco menor */
                padding: 0.8rem;
                margin: 0.6rem 0;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <img src="../imagens/Monograma.png" alt="Logo TriÁgil" class="logo">

        <div class="welcome-message">
            <h2>Bem-vindo, {{ Auth::guard('funcionario')->user()->name ?? 'Funcionário' }}!</h2>
        </div>

        <a href="{{ route('dashboard.funcionario.cards') }}" class="botao botao-azul">
            Gerenciar Pacientes
        </a>

        <a href="{{ route('dashboard.consultorios') }}" class="botao botao-verde">
            Gerenciar Consultórios
        </a>

        <div style="margin-top: 1.5rem;"> 
            <a href="{{ url('/identificacao') }}" class="logout-link">Voltar</a>
        </div>
    </div>

</body>
</html>