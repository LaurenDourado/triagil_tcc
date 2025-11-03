@extends('layouts.app')
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Menu Funcionário - TriÁgil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
@section('content')
<style>
    body {
        background: url("{{ asset('imagens/sala.jpg') }}") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
    }

    .card-custom, .form-control, .form-select, label, .btn, .logout-link, h2 {
        font-family: 'Unbounded', sans-serif;
    }

    .card-custom {
        background-color: #0b6785;
        border-radius: 20px;
        padding: 2.5rem;
        width: 100%;
        max-width: 550px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        margin: 2rem auto;
        color: white;
    }

    .form-control, .form-select {
        background-color: #ffffff;
        border: 1px solid #ced4da;
        color: #495057;
        border-radius: 12px;
        font-weight: 400; 
    }

    .form-control:focus, .form-select:focus {
        border-color: #5cd4b2;
        box-shadow: 0 0 0 0.25rem rgba(92, 212, 178, 0.5);
    }

    label {
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
        display: block;
    }

    .header-logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        flex-wrap: wrap; /* Ajusta para mobile */
    }

    .header-logo-container .logo {
        width: 45px;
        height: 45px;
        margin-right: 10px;
        margin-bottom: 10px; /* Espaço extra em mobile */
    }

    .header-logo-container h2 {
        color: #ffffff;
        margin: 0;
        font-weight: 700;
        text-align: center;
    }

    .btn-success, .btn-danger {
        border-radius: 12px;
        color: white;
        font-weight: 700;
        padding: 1rem;
        transition: transform 0.2s, background-color 0.3s;
        text-transform: uppercase;
        display: block;
        width: 100%;
    }

    .btn-success {
        background-color: #5cd4b2;
        border-color: #5cd4b2;
    }

    .btn-success:hover {
        background-color: #4ac09d;
        border-color: #4ac09d;
        transform: scale(1.02);
    }

    .btn-danger {
        background-color: #c9302c;
        border-color: #c9302c;
    }

    .btn-danger:hover {
        background-color: #a72320;
        border-color: #a72320;
        transform: scale(1.02);
    }

    /* Botão Voltar / Meu Perfil */
    .logout-link { 
        color: #7CDA77;
        font-size: 1rem;
        text-decoration: underline;
        margin-top: 10px;
        transition: color 0.3s ease; 
        display: inline-block;
    }

    .logout-link:hover {
        color: #9ff19a;
    }

    @media (max-width: 767.98px) {
        .card-custom {
            padding: 1.5rem;
            margin: 1rem auto;
        }

        /* Garante que o botão fique visível em mobile */
        .logout-link {
            display: block;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

<div class="container">
    <div class="card card-custom shadow mb-4">
        <div class="header-logo-container">
            <img src="../imagens/Monograma.png" alt="Logo TriÁgil" class="logo">
            <h2>Meu Cadastro</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <div class="card-body p-0">
            <form action="{{ route('paciente.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label>Nome completo</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $paciente->name) }}" required>
                    </div>
                    <div class="col-md-3 mb-4"> 
                        <label>CPF</label>
                        <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $paciente->cpf) }}" required>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label>Idade</label>
                        <input type="number" name="idade" class="form-control" value="{{ old('idade', $paciente->idade) }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $paciente->email) }}" required>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <label>Telefone</label>
                        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $paciente->telefone) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Gênero</label>
                        <select name="genero" class="form-select" required>
                            <option value="feminino" {{ $paciente->genero == 'feminino' ? 'selected' : '' }}>Feminino</option>
                            <option value="masculino" {{ $paciente->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="outro" {{ $paciente->genero == 'outro' ? 'selected' : '' }}>Outro</option>
                        </select>
                    </div>
                </div>

                <div class="mb-5"> 
                    <label>Senha (deixe em branco para manter a atual)</label>
                    <input type="password" name="password" class="form-control" placeholder="Nova senha (opcional)">
                </div>

                <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
            </form>

            <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100" 
                    onclick="return confirm('Tem certeza que deseja excluir seu cadastro? Esta ação não pode ser desfeita.')">
                    Excluir meu cadastro
                </button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('dashboard.paciente') }}" class="logout-link">Voltar</a>
            </div>
        </div>
    </div>
</div>
@endsection
</head>
