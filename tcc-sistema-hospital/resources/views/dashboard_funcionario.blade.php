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
      background: url('{{ asset('imagens/ficha.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      padding: 1rem;
    }

    /* Container título + pesquisa */
    .search-container {
      background-color: #0b6785;
      border-radius: 1rem;
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      width: 100%;
      max-width: 700px;
      margin: 0 auto 2rem auto;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .search-container h1 {
      font-size: 1.4rem;
      font-weight: 700;
      color: #ffffff;
      text-align: center;
    }

    .search-bar {
      background-color: #0b6785;
      border-radius: 1rem;
      padding: 0.6rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      width: 100%;
    }

    .search-bar img {
      height: 28px;
      width: 28px;
    }

    .search-input {
      background-color: #fff;
      border-radius: 9999px;
      padding: 0.6rem 1rem;
      width: 100%;
      border: none;
      outline: none;
      font-size: 0.95rem;
      color: #333;
    }

    /* Botão sintomas */
    .btn-sintomas {
      background: linear-gradient(90deg, #4b0082, #6a0dad);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      font-weight: 600;
      transition: transform 0.2s;
      width: 100%;
      text-align: center;
    }

    .btn-sintomas:hover {
      transform: scale(1.05);
    }

    /* Botão Voltar */
    .logout-link { 
      color: #322172;
      font-size: 1rem;
      align-items: center;
      justify-content: center;
      padding: 8px 20px;
      text-decoration: underline;
      transition: 0.3s; 
    }

    .logout-link:hover {
      color: #55B594;
    }

    /* Modal responsivo */
    #modal .modal-content {
      width: 90%;
      max-width: 400px;
    }

    /* Ajustes mobile */
    @media (max-width: 640px) {
      body {
        padding: 0.8rem;
      }

      .search-container {
        padding: 1rem;
        gap: 0.8rem;
      }

      .search-container h1 {
        font-size: 1.2rem;
      }

      .btn-sintomas {
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
      }

      .card {
        padding: 1rem;
        width: 100%;
      }

      #pacientesContainer {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- Container título + pesquisa -->
  <div class="search-container">
    <h1>Gerenciamento de pacientes</h1>

    <div class="search-bar">
      <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo">
      <input 
        id="searchInput"
        type="text" 
        placeholder="Nome do paciente"
        class="search-input"
        onkeyup="filtrarCards()"
      >
    </div>
  </div>

  <!-- Cards -->
  <div id="pacientesContainer" class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl mx-auto">

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
          'Código de Atendimento' => $triagem->codigo ?? '-',
          'Doenças' => isset($triagem->doencas) ? implode(', ', $triagem->doencas) : '-',
          'Sintomas' => isset($triagem->sintomas) ? implode(', ', $triagem->sintomas) : '-',
          'Tempo' => $triagem->tempo_sintomas ?? '-',
          'Intensidade' => $triagem->intensidade ?? '-',
          'Emergência' => $triagem->emergencia ?? '-',
          'Alergias' => $triagem->alergias ?? '-',
          'Medicação' => $triagem->medicacao ?? '-',
        ];
      @endphp

      <div class="card border-l-8 rounded-2xl p-4 shadow-lg cursor-move transition hover:scale-[1.02] {{ $corFundo }}"
           data-detalhes='@json($dadosTriagem)'
           draggable="true">
        
        @if(isset($triagem->codigo))
          <div class="inline-block bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full mb-2">
            Código: {{ $triagem->codigo }}
          </div>
        @endif

        <h2 class="nome text-lg font-bold break-words">{{ $paciente->name }}</h2>
        <p class="text-sm font-semibold">Prioridade: {{ $prioridade }}</p>
        <button onclick="abrirModal(this)" class="btn-sintomas mt-3">Ver sintomas</button>
      </div>
    @endforeach

    @if($pacientes->isEmpty())
      <p class="col-span-full text-center text-gray-600">Nenhum paciente cadastrado.</p>
    @endif

  </div>

  <!-- Botão Voltar -->
  <a href="{{ route('dashboard.funcionario') }}" 
    class="logout-link fixed bottom-4 left-4 z-50 bg-white/70 backdrop-blur-md rounded-lg shadow px-3 py-1">
      Voltar
  </a>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4">
    <div class="modal-content bg-white rounded-2xl p-6 text-center shadow-lg">
      <h2 class="text-lg font-bold text-gray-800 mb-3">Informações da Pré-Triagem</h2>
      <div id="conteudoModal" class="text-left text-gray-700 space-y-2 text-sm sm:text-base"></div>
      <button onclick="fecharModal()" class="mt-5 bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800 w-full sm:w-auto">
        Fechar
      </button>
    </div>
  </div>

  <script>
    // Filtro
    function filtrarCards() {
      const termo = document.getElementById('searchInput').value.toLowerCase();
      const cards = document.querySelectorAll('.card');

      cards.forEach(card => {
        const nome = card.querySelector('.nome').textContent.toLowerCase();
        card.style.display = nome.includes(termo) ? 'block' : 'none';
      });
    }

    // Modal
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