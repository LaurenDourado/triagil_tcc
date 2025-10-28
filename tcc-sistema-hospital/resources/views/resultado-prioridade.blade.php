<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Pré-Triagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Unbounded', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: url('{{ asset("imagens/sala.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .resultado-container {
            max-width: 600px;
            width: 90%;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 25px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.3);
            text-align: center;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .prioridade {
            font-size: 1.5rem;
            font-weight: 700;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .emergencia { background-color: #FF0000; color: white; }
        .urgente { background-color: #EAD642; color: black; }
        .pouco-urgente { background-color: #68D760; color: white; }
        .sem-sintomas { background-color: #2e00fbff; color: white; }

        .codigo-card {
            background-color: #13678A;
            color: #ffffff;
            border-radius: 15px;
            padding: 20px;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        a.btn-dashboard {
            background-color: #322172;
            color: white;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        a.btn-dashboard:hover {
            background-color: #24175d;
            color: white;
        }

        @media (max-width: 768px) {
            .resultado-container {
                padding: 30px 20px;
            }

            .prioridade, .codigo-card {
                font-size: 1.2rem;
            }

            a.btn-dashboard {
                font-size: 1rem;
                padding: 8px 15px;
            }
        }
        .btn-voltar{
            color: #7CDA77;
            font-size: 1rem;
            align-items: center;
            justify-content: center;
            padding: 8px 20px;
            text-decoration: underline;
            transition: 0.3s; 
        }
    </style>
</head>
<body>

    <div class="resultado-container">
        <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo TriÁgil" class="logo">

        @if($preTriagem)
            <h2 class="mb-4">Olá, {{ $preTriagem->paciente->name }}</h2>

            <!-- Prioridade -->
            <div class="prioridade 
                @if($preTriagem->prioridade === 'Emergência') emergencia 
                @elseif($preTriagem->prioridade === 'Urgente') urgente 
                @elseif($preTriagem->prioridade === 'Pouco urgente') pouco-urgente 
                @else sem-sintomas @endif">
                Sua prioridade é: {{ $preTriagem->prioridade }}
            </div>

            <!-- Código único -->
            <div class="codigo-card">
                Código único de atendimento: <br>
                <span class="fs-3">{{ $preTriagem->codigo }}</span>
            </div>

            <p>Apresente este código na recepção do hospital.</p>

        @else
            <h3 class="mb-4 text-danger">Pré-Triagem não encontrada</h3>
            <p>O código informado é inválido ou não existe.</p>
        @endif

        <!-- Voltar ao dashboard -->
        <a href="{{ url()->previous() }}" class="btn-voltar">Voltar</a>
    </div>

</body>
</html>
