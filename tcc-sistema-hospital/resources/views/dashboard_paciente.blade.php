<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel do Paciente - TriÁgil</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
body, html { 
    margin: 0; 
    padding: 0; 
    font-family: 'Unbounded', cursive; 
    height: 100%; 
    color: white;
}

.container-dashboard { 
    background: url("{{ asset('../imagens/sala.jpg') }}") no-repeat center center; 
    background-size: cover; 
    min-height: 100vh; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    padding: 20px;
    position: relative;
}

.card-container {
    background-color: #13678A;
    border-radius: 30px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
    width: 100%;
    max-width: 600px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
}

.logo-container {
    margin-bottom: 30px;
    text-align: center;
}

.logo-container img {
    width: 90px;
    height: auto;
}

.welcome-message {
    font-family: 'Unbounded', cursive;
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 1.5rem;
}

.btn-option { 
    color: white; 
    font-weight: bold; 
    padding: 24px 0;
    margin: 12px 0; 
    border-radius: 25px; 
    font-size: 16px; 
    text-decoration: none; 
    transition: 0.3s; 
    display: block;
}

.btn-pre-triagem {
    background-color: #322172;
}
.btn-pre-triagem:hover { 
    background-color: #24175d; 
}

.btn-guia-socorros {
    background-color: #6CD0B1;
}
.btn-guia-socorros:hover { 
    background-color: #55B594; 
}

.btn-resultado {
    background-color: #ADFC88;
    color: #000;
}
.btn-resultado:hover {
    background-color: #a0dc84ff;
    color: #000;
}
.btn-resultado[disabled] {
    background-color: #d6d6d6;
    color: #777;
    cursor: not-allowed;
}

.logout-link { 
    color: #7CDA77;
    font-size: 1rem;
    text-decoration: underline;
    margin-top: 10px;
    transition: color 0.3s ease; 
}

.logout-link:hover {
    color: #9ff19a;
}

/* Botão de perfil fixo no canto superior direito da tela */
.btn-perfil {
    position: fixed;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #6CD0B1, #322172);
    color: white;
    border-radius: 50px;
    padding: 12px 22px;
    display: flex;
    align-items: center;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    z-index: 1000;
}
.btn-perfil:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    background: linear-gradient(135deg, #55B594, #24175d);
}
.btn-perfil i {
    margin-right: 8px;
    font-size: 1.2rem;
}

.alert-success, .alert-danger { 
    position: absolute; 
    top: 20px; 
    left: 50%; 
    transform: translateX(-50%); 
    z-index: 1000; 
    width: 90%; 
    max-width: 500px;
}

/* Responsividade */
@media (max-width: 600px) {
    .container-dashboard {
        /* Adiciona padding extra no topo para o botão fixo */
        padding-top: 80px; /* 20px original + ~60px para o botão */
        align-items: flex-start; /* Alinha no topo para que o conteúdo possa rolar */
    }

    .card-container {
        padding: 40px 25px;
        /* 🎯 AUMENTAR MARGEM SUPERIOR PARA NÃO OCULTAR O BOTÃO DE PERFIL FIXO */
        margin-top: 30px; 
    }
    .logo-container img {
        width: 50px;
    }
    .welcome-message {
        font-size: 20px;
    }
    .btn-option {
        font-size: 14px;
        padding: 20px 0;
    }
    .btn-perfil {
        font-size: 0.85rem;
        padding: 10px 16px;
        top: 15px;
        right: 15px;
    }
    .logout-link {
        font-size: 0.85rem;
        padding: 6px 12px;
    }
}
</style>
</head>
<body>
<div class="container-dashboard">

        <a href="{{ route('paciente.crud') }}" class="btn-perfil">
        <i class="bi bi-person-circle"></i> Meu Perfil
    </a>

        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="card-container">

        <div class="logo-container">
            <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo TriÁgil" />
        </div>

                @if(isset($paciente))
        <div class="welcome-message">
            Bem-vindo(a), {{ $paciente->name }}!
        </div>
        @endif

                <a href="{{ route('formulario.pre-triagem') }}" class="btn-option btn-pre-triagem w-100">Formulário Pré-Triagem</a>
        <a href="{{ route('guia.primeiro-socorros') }}" class="btn-option btn-guia-socorros w-100">Guia de Primeiro Socorros</a>

                @if(Auth::guard('paciente')->user()->preTriagem)
            <a href="{{ route('resultado.prioridade', ['codigo' => Auth::guard('paciente')->user()->preTriagem->codigo]) }}" class="btn-option btn-resultado w-100">Ver Código e Resultado</a>
        @else
            <button class="btn-option btn-resultado w-100" disabled>Ainda não preencheu o formulário</button>
        @endif

                <div class="text-center mt-3">
            <a href="{{ url('/identificacao') }}" class="logout-link">Voltar</a>
        </div>
        
    </div>
</div>
</body>
</html>