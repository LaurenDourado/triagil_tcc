@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Gerenciar Pacientes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Formulário -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Cadastrar / Atualizar Paciente</div>
        <div class="card-body">
            <form action="{{ route('paciente.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ old('id', $paciente->id ?? '') }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Nome completo" value="{{ $paciente->name ?? '' }}" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="cpf" class="form-control" placeholder="CPF" value="{{ $paciente->cpf ?? '' }}" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="idade" class="form-control" placeholder="Idade" value="{{ $paciente->idade ?? '' }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ $paciente->email ?? '' }}" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="telefone" class="form-control" placeholder="Telefone" value="{{ $paciente->telefone ?? '' }}" required>
                    </div>
                    <div class="col-md-4">
                        <select name="genero" class="form-select" required>
                            <option value="">Selecione o gênero</option>
                            <option value="feminino" {{ (isset($paciente) && $paciente->genero == 'feminino') ? 'selected' : '' }}>Feminino</option>
                            <option value="masculino" {{ (isset($paciente) && $paciente->genero == 'masculino') ? 'selected' : '' }}>Masculino</option>
                            <option value="outro" {{ (isset($paciente) && $paciente->genero == 'outro') ? 'selected' : '' }}>Outro</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Senha (opcional)">
                </div>

                <button type="submit" class="btn btn-success w-100">Salvar</button>
            </form>
        </div>
    </div>

    <!-- Tabela -->
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Idade</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->cpf }}</td>
                <td>{{ $p->idade }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->telefone }}</td>
                <td>{{ $p->genero }}</td>
                <td>
                    <a href="{{ route('paciente.edit', $p->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('paciente.destroy', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection