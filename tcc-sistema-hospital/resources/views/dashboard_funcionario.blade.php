<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard de Pacientes - TriÁgil</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonte Unbounded -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- SortableJS -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

  <style>
    body {
      font-family: 'Unbounded', sans-serif;
      background-color: #f1f5f9;
      background: url('../imagens/ficha.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    /* Barra de pesquisa estilizada */
    .search-bar {
      background-color: #0b6785;
      border-radius: 1rem;
      padding: 0.6rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      width: 100%;
      max-width: 700px;
    }

    .search-bar img {
      height: 24px;
      width: 24px;
    }

    .search-input {
      background-color: #fff;
      border-radius: 9999px;
      padding: 0.6rem 1rem;
      width: 100%;
      border: none;
      outline: none;
      font-size: 0.9rem;
      color: #333;
    }

    /* Botão atualizado */
    .btn-sintomas {
      background: linear-gradient(90deg, #4b0082, #6a0dad);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 8px;
      font-weight: 600;
      transition: transform 0.2s;
    }

    .btn-sintomas:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center p-6">

  <!-- Cabeçalho com barra de pesquisa e bem-vindo -->
  <header class="w-full flex flex-col md:flex-row justify-between items-center mb-6 text-white bg-[#13678A] p-4 rounded-2xl shadow-lg">
    <div class="flex items-center gap-3">
      <img src="../imagens/Monograma.png" alt="Logo" class="w-10 h-10">
      <h1 class="text-xl font-bold">Dashboard de Pacientes</h1>
    </div>

    @if(Auth::check())
      <h2 class="mt-2 md:mt-0 text-lg font-semibold">Bem-vindo, {{ Auth::user()->name }}!</h2>
    @endif
  </header>

  <!-- Barra de pesquisa -->
  <div class="w-full flex justify-center mb-6">
    <div class="search-bar">
      <img src="../imagens/Monograma.png" alt="Ícone de busca">
      <input 
        id="searchInput"
        type="text" 
        placeholder="Nome do paciente"
        class="search-input"
        onkeyup="filtrarCards()"
      >
    </div>
  </div>

  <!-- Container de Cards -->
  <div id="pacientesContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl">

    @foreach($pacientes as $paciente)
      @php
        $triagem = $paciente->preTriagem;
        $prioridade = $triagem->prioridade ?? 'Sem sintomas';
        $corFundo = match($prioridade) {
          'Emergência' => 'bg-red-200 border-red-600 text-red-700',
          'Urgente' => 'bg-yellow-200 border-yellow-500 text-yellow-700',
          'Pouco urgente' => 'bg-green-200 border-green-600 text-green-700',
          default => 'bg-gray-200 border-gray-400 text-gray-700',
        };

        $dadosTriagem = [
          'Doenças' => isset($triagem->doencas) ? implode(', ', $triagem->doencas) : '-',
          'Sintomas' => isset($triagem->sintomas) ? implode(', ', $triagem->sintomas) : '-',
          'Tempo' => $triagem->tempo_sintomas ?? '-',
          'Intensidade' => $triagem->intensidade ?? '-',
          'Emergência' => $triagem->emergencia ?? '-',
          'Alergias' => $triagem->alergias ?? '-',
          'Medicação' => $triagem->medicacao ?? '-',
        ];
      @endphp

      <div class="card border-l-8 rounded-2xl p-4 shadow-lg cursor-move {{ $corFundo }}"
           data-detalhes='@json($dadosTriagem)'
           draggable="true">
        <h2 class="nome text-lg font-bold">{{ $paciente->name }}</h2>
        <p class="text-sm font-semibold">Prioridade: {{ $prioridade }}</p>
        <button onclick="abrirModal(this)" class="btn-sintomas mt-3">Ver sintomas</button>
      </div>
    @endforeach

    @if($pacientes->isEmpty())
      <p class="col-span-full text-center text-gray-600">Nenhum paciente cadastrado.</p>
    @endif

  </div>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-96 text-center shadow-lg">
      <h2 class="text-lg font-bold text-gray-800 mb-3">Informações da Pré-Triagem</h2>
      <div id="conteudoModal" class="text-left text-gray-700 space-y-2"></div>
      <button onclick="fecharModal()" class="mt-5 bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800">
        Fechar
      </button>
    </div>
  </div>

  <script>
    // Filtro de pesquisa
    function filtrarCards() {
      const termo = document.getElementById('searchInput').value.toLowerCase();
      const cards = document.querySelectorAll('.card');

      cards.forEach(card => {
        const nome = card.querySelector('.nome').textContent.toLowerCase();
        if (nome.includes(termo)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // Modal detalhado
    function abrirModal(botao) {
      const dados = JSON.parse(botao.parentElement.getAttribute('data-detalhes'));
      const conteudo = Object.entries(dados).map(([chave, valor]) => `
        <p><strong>${chave}:</strong> ${valor}</p>
      `).join('');

      document.getElementById('conteudoModal').innerHTML = conteudo;
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modal').classList.add('flex');
    }

    function fecharModal() {
      document.getElementById('modal').classList.add('hidden');
      document.getElementById('modal').classList.remove('flex');
    }

    // Drag & Drop
    new Sortable(document.getElementById('pacientesContainer'), {
      animation: 150,
      ghostClass: 'opacity-50'
    });
  </script>

</body>
</html>