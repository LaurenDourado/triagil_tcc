<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Paciente - TriÁgil</title>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: 'Unbounded', sans-serif;
  background: url('{{ asset("imagens/ficha.jpg") }}') no-repeat center center fixed;
  background-size: cover;
}

.container {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px;
}

.card-register {
  width: 100%;
  max-width: 420px;
  padding: 30px;
  border-radius: 20px;
  background-color: #13678A;
  color: white;
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.card-register h2 {
  font-weight: 700;
  font-size: 24px;
  margin-bottom: 25px;
}

.form-control {
  border-radius: 25px;
  height: 45px;
  padding: 10px 20px;
  font-size: 15px;
  margin-bottom: 15px;
  border: none;
  outline: none;
}

.form-control::placeholder {
  color: #bbb;
}

.form-check {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 8px;
}

.form-check-label {
  font-size: 15px;
}

.btn-register {
  background: linear-gradient(90deg, #322172, #43267b);
  border: none;
  font-weight: bold;
  border-radius: 25px;
  transition: 0.3s;
  height: 45px;
  font-size: 16px;
  color: #fff;
}

.btn-register:hover {
  background-color: #210c50;
  color: #fff;
}

.logo-container {
    margin-bottom: 30px;
    text-align: center;
}

.logo-container img {
    width: 80px;
    height: auto;
}


.link-login {
  color: #7CDA77;
  text-decoration: underline;
  transition: 0.3s;
}

.link-login:hover {
  color: #5cc063;
}

p.text-center {
  margin-top: 15px;
}

@media (max-width: 480px) {
  .card-register {
    padding: 25px 20px;
    border-radius: 20px;
  }

  .form-control,
  .btn-register {
    font-size: 14px;
  }
}
</style>
</head>
<body>
  <div class="container">
    <div class="card-register">
      <div class="logo-container">
        <img src="/imagens/Monograma.png" alt="Logo TriÁgil" />
      </div>
      <h2 class="text-center">Cadastre-se</h2>

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('paciente.register.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="Nome Completo" value="{{ old('name') }}" required>
        <input type="text" name="cpf" class="form-control" placeholder="CPF" value="{{ old('cpf') }}" required>
        <input type="number" name="idade" class="form-control" placeholder="Idade" value="{{ old('idade') }}" required>
        <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
        <input type="text" name="telefone" class="form-control" placeholder="Telefone" value="{{ old('telefone') }}" required>
        <input type="password" name="password" class="form-control" placeholder="Senha" required>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a senha" required>

        <div class="mb-3">
          <div class="form-check">
            <input type="radio" name="genero" value="feminino" id="feminino" required>
            <label class="form-check-label" for="feminino">Feminino</label>
          </div>
          <div class="form-check">
            <input type="radio" name="genero" value="masculino" id="masculino" required>
            <label class="form-check-label" for="masculino">Masculino</label>
          </div>
          <div class="form-check">
            <input type="radio" name="genero" value="outro" id="outro" required>
            <label class="form-check-label" for="outro">Outro</label>
          </div>
        </div>

        <button type="submit" class="btn btn-register w-100">Cadastrar</button>
      </form>

      <p class="text-center mt-3">
        Já tem conta? <a href="{{ url('/login/paciente') }}" class="link-login">Entre aqui</a>
      </p>
    </div>
  </div>
</body>
</html>