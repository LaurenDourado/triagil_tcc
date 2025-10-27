<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Consultórios - TriÁgil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

  <h1 class="text-2xl font-bold text-blue-700 mb-6 text-center">Gerenciamento de Consultórios</h1>

  @if($salas->isEmpty())
    <p class="text-center text-gray-600">Nenhuma sala cadastrada.</p>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-6xl mx-auto">

      @foreach($salas as $sala)
        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
          <h2 class="text-lg font-bold mb-2">{{ $sala->nome }}</h2>
          <p class="text-sm text-gray-600 mb-4">
            Pacientes na fila: <span id="count-{{ $sala->id }}">{{ $sala->pacientes->count() }}</span>
          </p>

          <div class="flex flex-col gap-2" id="sala-{{ $sala->id }}">
            @if($sala->pacientes->isEmpty())
              <p class="text-gray-500 text-sm">Nenhum paciente nesta sala.</p>
            @else
              @foreach($sala->pacientes as $paciente)
                @php
                  $triagem = $paciente->preTriagem ?? null;
                  $prioridade = $triagem?->prioridade ?? 'Sem sintomas';

                  $corFundo = match($prioridade) {
                    'Emergência' => 'bg-red-200 border-red-600 text-red-700',
                    'Urgente' => 'bg-yellow-200 border-yellow-500 text-yellow-700',
                    'Pouco urgente' => 'bg-green-200 border-green-600 text-green-700',
                    default => 'bg-gray-200 border-gray-400 text-gray-700',
                  };

                  $sintomas = $triagem?->sintomas ? implode(', ', $triagem->sintomas) : '';
                  if($triagem?->sintomas_outro) $sintomas .= ', ' . $triagem->sintomas_outro;
                @endphp

                <div class="patient-card border-l-8 rounded-2xl p-3 shadow cursor-move {{ $corFundo }}"
                     draggable="true"
                     data-id="{{ $paciente->id }}"
                     data-sintomas="{{ $sintomas }}">
                  <h3 class="font-bold">{{ $paciente->name }}</h3>
                  <p class="text-sm text-gray-700">
                    Doenças: {{ $triagem?->doencas ? implode(', ', $triagem->doencas) : '-' }}
                  </p>
                  <p class="text-sm font-semibold">Prioridade: {{ $prioridade }}</p>
                  <button onclick="abrirModal(this)" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded text-sm">
                    Ver sintomas
                  </button>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      @endforeach

    </div>
  @endif

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-80 text-center shadow-lg">
      <h2 class="text-lg font-bold text-gray-800 mb-2">Sintomas do Paciente</h2>
      <p id="textoSintomas" class="text-gray-600 mb-4"></p>
      <button onclick="fecharModal()" class="bg-blue-600 text-white px-4 py-2 rounded">Fechar</button>
    </div>
  </div>

  <script>
    function abrirModal(botao) {
      const sintomas = botao.parentElement.getAttribute('data-sintomas');
      document.getElementById('textoSintomas').textContent = sintomas;
      document.getElementById('modal').classList.remove('hidden');
      document.getElementById('modal').classList.add('flex');
    }

    function fecharModal() {
      document.getElementById('modal').classList.add('hidden');
      document.getElementById('modal').classList.remove('flex');
    }

    const salas = @json($salas->pluck('id'));

    salas.forEach(id => {
      const element = document.getElementById('sala-' + id);
      if(!element) return;

      new Sortable(element, {
        group: 'pacientes',
        animation: 150,
        onAdd: function(evt) {
          salas.forEach(sid => {
            const countEl = document.getElementById('count-' + sid);
            const salaEl = document.getElementById('sala-' + sid);
            if(countEl && salaEl) countEl.textContent = salaEl.children.length;
          });

          const pacienteId = evt.item.getAttribute('data-id');
          const novaSala = evt.to.id.replace('sala-', '');

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
        }
      });
    });
  </script>

</body>
</html>