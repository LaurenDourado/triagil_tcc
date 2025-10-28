@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Meu Cadastro</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">Atualizar Meus Dados</div>
        <div class="card-body">
            <form action="{{ route('paciente.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Nome completo</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $paciente->name) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label>CPF</label>
                        <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $paciente->cpf) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label>Idade</label>
                        <input type="number" name="idade" class="form-control" value="{{ old('idade', $paciente->idade) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $paciente->email) }}" required>
                    </div>
                    <div class="col-md-4">
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

                <div class="mb-3">
                    <label>Senha (deixe em branco para manter a atual)</label>
                    <input type="password" name="password" class="form-control" placeholder="Nova senha (opcional)">
                </div>

                <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
            </form>

            <!-- Botão para excluir o cadastro -->
            <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100" 
                    onclick="return confirm('Tem certeza que deseja excluir seu cadastro? Esta ação não pode ser desfeita.')">
                    Excluir meu cadastro
                </button>
            </form>

            <!-- Botão de voltar -->
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ url('/identificacao') }}" class="logout-link">Voltar</a>
            </div>
        </div>
    </div>
</div>
@endsection
