<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resultado da Pré-Triagem</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Unbounded', cursive;
    min-height: 100%;
    background: url('{{ asset("imagens/sala.jpg") }}') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
}

.resultado-container {
    max-width: 600px;
    width: 90%;
    background-color: #13678A;
    padding: 40px 35px;
    border-radius: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.4);
    text-align: center;
}

.logo {
    width: 90px;
    margin-bottom: 25px;
}

h2, h3 {
    font-family: 'Unbounded', cursive;
    font-weight: 600;
    margin-bottom: 20px;
}

.prioridade {
    font-size: 1.4rem;
    font-weight: 700;
    padding: 18px;
    border-radius: 20px;
    margin-bottom: 25px;
}

.emergencia { background-color: #FF0000; color: white; }
.urgente { background-color: #EAD642; color: black; }
.pouco-urgente { background-color: #68D760; color: white; }
.sem-sintomas { background-color: #2e00fbff; color: white; }

.codigo-card {
    background-color: #322172;
    color: #ffffff;
    border-radius: 20px;
    padding: 18px;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 20px;
}

p {
    font-size: 1rem;
}

a.btn-voltar {
    color: #7CDA77;
    font-size: 1rem;
    text-decoration: underline;
    font-weight: 600;
    display: inline-block;
    margin-top: 20px;
    transition: color 0.3s ease;
}

a.btn-voltar:hover {
    color: #9ff19a;
}

@media (max-width: 600px) {
    .resultado-container {
        padding: 30px 20px;
        border-radius: 20px;
    }

    .logo {
        width: 60px;
        margin-bottom: 20px;
    }

    h2, h3 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .prioridade {
        font-size: 1.2rem;
        padding: 15px;
        border-radius: 18px;
    }

    .codigo-card {
        font-size: 1.2rem;
        padding: 15px;
        border-radius: 18px;
    }

    p {
        font-size: 0.95rem;
    }

    a.btn-voltar {
        font-size: 0.9rem;
        margin-top: 15px;
    }
}
</style>
</head>
<body>

<div class="resultado-container">
    <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo TriÁgil" class="logo">

    @if($preTriagem)
        <h2>Olá, {{ $preTriagem->paciente->name }}</h2>

        <div class="prioridade 
            @if($preTriagem->prioridade === 'Emergência') emergencia 
            @elseif($preTriagem->prioridade === 'Urgente') urgente 
            @elseif($preTriagem->prioridade === 'Pouco urgente') pouco-urgente 
            @else sem-sintomas @endif">
            Sua prioridade é: {{ $preTriagem->prioridade }}
        </div>

        <div class="codigo-card">
            Código único de atendimento: <br>
            <span class="fs-3">{{ $preTriagem->codigo }}</span>
        </div>

        <p>Apresente este código na recepção do hospital.</p>

    @else
        <h3 class="text-danger">Pré-Triagem não encontrada</h3>
        <p>O código informado é inválido ou não existe.</p>
    @endif

    <a href="{{ route('paciente.dashboard') }}" class="btn-voltar">Voltar</a>
</div>

</body>
</html>
