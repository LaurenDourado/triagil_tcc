<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login </title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-2xl p-8 w-96 text-center">
    <h2>Bem-vindo, {{ Auth::guard('funcionario')->user()->name ?? 'Funcionário' }}</h2>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="bg-red-600 text-white px-4 py-2 rounded">Sair</button>
    </form>
  </div>
</body>
</html>