<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Consultórios - TriÁgil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

  <style>
    body {
      font-family: 'Unbounded', sans-serif;
      background: url('{{ asset('imagens/ficha.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      padding: 2rem;
    }

    .page-title {
      background-color: #0b6785;
      color: #ffffff;
      font-size: 1.8rem;
      font-weight: 700;
      text-align: center;
      padding: 1rem 2rem;
      border-radius: 1rem;
      max-width: 700px;
      margin: 0 auto 2rem auto;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1rem;
    }

    .page-title img {
      height: 40px;
      width: 40px;
      object-fit: contain;
    }

    .logout-link { 
      color: #7CDA77;
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
  </style>
</head>
<body class="bg-gray-100 min-h-screen p-8">

  <!-- Título principal com logo -->
  <div class="page-title">
    <img src="{{ asset('imagens/Monograma.png') }}" alt="Logo TriÁgil">
    <span>Gerenciamento de Consultórios</span>
  </div>

  <!-- Fila geral de pacientes sem sala -->
  @if($pacientesSemSala->isNotEmpty())
    <div class="bg-white rounded-2xl shadow p-4 mb-6 max-w-6xl mx-auto">
      <h2 class="text-lg font-bold mb-2">Pacientes sem sala</h2>
      <div id="fila-geral" class="flex flex-col gap-2">
        @foreach($pacientesSemSala as $paciente)
          @php
            $triagem = $paciente->preTriagem ?? null;
            $prioridade = $triagem?->prioridade ?? 'Sem sintomas';
            $corFundo = match($prioridade) {
                'Emergência' => 'bg-red-200 border-red-600 text-red-700',
                'Urgente' => 'bg-yellow-200 border-yellow-500 text-yellow-700',
                'Pouco urgente' => 'bg-green-200 border-green-600 text-green-700',
                default => 'bg-gray-200 border-gray-400 text-gray-700',
            };
          @endphp
          <div class="patient-card border-l-8 rounded-2xl p-3 shadow cursor-move {{ $corFundo }}"
               draggable="true"
               data-id="{{ $paciente->id }}">
            <h3 class="font-bold">{{ $paciente->name }}</h3>
            <p class="text-sm font-mono">Código: {{ $triagem->codigo ?? 'Não gerado' }}</p>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  <!-- Salas fixas -->
  @if($salas->isEmpty())
    <p class="text-center text-gray-600">Nenhuma sala cadastrada.</p>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl mx-auto">
      @foreach($salas as $sala)
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
          <h2 class="text-lg font-bold mb-2">{{ $sala->nome }}</h2>
          <p class="text-sm text-gray-600 mb-4">
            Pacientes na sala: <span id="count-{{ $sala->id }}">{{ $sala->pacientes->count() }}</span>
          </p>

          <div class="flex flex-col gap-2" id="sala-{{ $sala->id }}">
            @forelse($sala->pacientes as $paciente)
              @php
                $triagem = $paciente->preTriagem ?? null;
                $prioridade = $triagem?->prioridade ?? 'Sem sintomas';
                $corFundo = match($prioridade) {
                    'Emergência' => 'bg-red-200 border-red-600 text-red-700',
                    'Urgente' => 'bg-yellow-200 border-yellow-500 text-yellow-700',
                    'Pouco urgente' => 'bg-green-200 border-green-600 text-green-700',
                    default => 'bg-gray-200 border-gray-400 text-gray-700',
                };
              @endphp
              <div class="patient-card border-l-8 rounded-2xl p-3 shadow cursor-move {{ $corFundo }}"
                   draggable="true"
                   data-id="{{ $paciente->id }}">
                <h3 class="font-bold">{{ $paciente->name }}</h3>
                <p class="text-sm font-mono">Código: {{ $triagem->codigo ?? 'Não gerado' }}</p>
                <button onclick="removerFormulario(this)" class="mt-2 bg-red-600 text-white px-3 py-1 rounded text-sm">
                  Remover da sala / Apagar formulário
                </button>
              </div>
            @empty
              <p class="empty-msg text-gray-500 text-sm">Nenhum paciente nesta sala.</p>
            @endforelse
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <!-- Botão Voltar -->
  <a href="{{ route('dashboard.funcionario') }}" 
    class="logout-link fixed bottom-4 left-4 z-50">
      Voltar
  </a>

  <script>
    const salas = @json($salas->pluck('id'));
    salas.push(0); // fila geral

    // Inicializar drag-and-drop
    salas.forEach(id => {
      const container = document.getElementById(id === 0 ? 'fila-geral' : 'sala-' + id);
      if(!container) return;

      new Sortable(container, {
        group: 'pacientes',
        animation: 150,
        swapThreshold: 0.65,
        onAdd: function(evt) {
          const pacienteId = evt.item.getAttribute('data-id');
          const novaSala = evt.to.id === 'fila-geral' ? null : evt.to.id.replace('sala-', '');

          const emptyMsg = evt.to.querySelector('.empty-msg');
          if(emptyMsg) emptyMsg.remove();

          fetch(`/salas/atualizar/${pacienteId}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ sala_id: novaSala })
          })
          .then(res => res.json())
          .then(data => console.log(data))
          .catch(err => console.error(err));

          atualizarContagem();
        }
      });
    });

    // Função remover formulário e retirar paciente da sala
    function removerFormulario(botao) {
      const card = botao.parentElement;
      const pacienteId = card.getAttribute('data-id');

      if(!confirm('Deseja realmente apagar o formulário deste paciente e retirá-lo da sala?')) return;

      fetch(`/pretriagens/${pacienteId}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(res => res.json())
      .then(data => {
          if(data.success) {
              // Remove o paciente da sala
              card.remove();
              atualizarContagem();
              alert('Formulário apagado e paciente removido da sala com sucesso!');
          } else {
              alert('Erro ao apagar formulário.');
          }
      })
      .catch(err => console.error(err));
    }

    // Atualizar contagem de pacientes por sala
    function atualizarContagem() {
      salas.forEach(sid => {
        if(sid === 0) return;
        const countEl = document.getElementById('count-' + sid);
        const salaEl = document.getElementById('sala-' + sid);
        if(countEl && salaEl) {
          const pacientesNaSala = salaEl.querySelectorAll('.patient-card').length;
          countEl.textContent = pacientesNaSala;

          // Mostrar mensagem "Nenhum paciente nesta sala" se estiver vazia
          if(pacientesNaSala === 0) {
              const emptyMsg = document.createElement('p');
              emptyMsg.classList.add('empty-msg', 'text-gray-500', 'text-sm');
              emptyMsg.textContent = 'Nenhum paciente nesta sala.';
              salaEl.appendChild(emptyMsg);
          }
        }
      });
    }
  </script>

</body>
</html>
