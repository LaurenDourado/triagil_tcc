<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pacientes no Hospital - TriÁgil</title>

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

    .drag-handle {
      cursor: grab;
    }

    /* Mobile styles */
    @media (max-width: 768px) {
      #pacientesTable {
        display: block;
        width: 95%;
        margin: 0 auto;
      }
      #pacientesTable thead,
      #pacientesTable tbody,
      #pacientesTable tr,
      #pacientesTable th,
      #pacientesTable td {
        display: block;
        width: 100%;
      }
      #pacientesTable thead {
        display: none;
      }
      #pacientesTable tr {
        margin-bottom: 15px;
        background: rgba(255,255,255,0.9);
        border-radius: 12px;
        padding: 10px;
      }
      #pacientesTable td {
        text-align: left;
        padding: 8px;
        position: relative;
      }
      #pacientesTable td::before {
        content: attr(data-label);
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
        color: #13678A;
      }
      .drag-handle {
        text-align: right;
        font-size: 1.5rem;
        margin-top: 5px;
      }
    }
  </style>
</head>
<body class="min-h-screen">

  <div class="max-w-6xl mx-auto p-6">

    <!-- Barra de pesquisa + logo -->
    <div class="bg-[#13678A] rounded-2xl p-6 mb-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
          <img src="../imagens/Monograma.png" alt="Logo TriÁgil" class="h-10">
        </div>
        <div class="flex-1">
          <input
            type="text"
            id="searchInput"
            placeholder="Nome do paciente"
            class="w-full px-4 py-2 rounded-full shadow text-[#13678A] font-medium focus:outline-none"
          />
        </div>
      </div>
    </div>

    <!-- Tabela de Pacientes -->
    <div class="shadow-lg rounded-2xl p-6 bg-[#13678A] overflow-x-auto">
      <h2 class="text-xl font-semibold mb-4 text-white">Pacientes e Pré-Triagem</h2>

      <table class="w-full min-w-[900px] table-auto border-collapse" id="pacientesTable">
        <thead class="bg-[#7CDA77] text-white text-center">
          <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Nome</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Doenças</th>
            <th class="px-4 py-2">Sintomas</th>
            <th class="px-4 py-2">Emergência</th>
            <th class="px-4 py-2">Prioridade</th>
            <th class="px-4 py-2">Criado em</th>
            <th class="px-4 py-2">Mover</th>
          </tr>
        </thead>

        <tbody id="sortable-list">
          @foreach($pacientes as $paciente)
          @php
            $triagem = $paciente->preTriagem;
            $prioridade = $triagem->prioridade ?? 'Sem sintomas';
          @endphp
          <tr class="text-center odd:bg-gray-50 even:bg-gray-100">
            <td class="px-4 py-2" data-label="ID">{{ $paciente->id }}</td>
            <td class="px-4 py-2 font-medium text-gray-700 nome-paciente" data-label="Nome">{{ $paciente->name }}</td>
            <td class="px-4 py-2 text-gray-600" data-label="Email">{{ $paciente->email }}</td>
            <td class="px-4 py-2" data-label="Doenças">{{ isset($triagem->doencas) ? implode(', ', $triagem->doencas) : '-' }}</td>
            <td class="px-4 py-2" data-label="Sintomas">{{ isset($triagem->sintomas) ? implode(', ', $triagem->sintomas) : '-' }} {{ $triagem->sintomas_outro ?? '' }}</td>
            <td class="px-4 py-2" data-label="Emergência">{{ $triagem->emergencia ?? '-' }}</td>
            <td class="px-4 py-2" data-label="Prioridade">
              <span class="
                text-white px-3 py-1 rounded-full text-sm font-semibold
                @if($prioridade == 'Emergência') bg-[#D62828]
                @elseif($prioridade == 'Urgente') bg-[#F6C23E] text-black
                @elseif($prioridade == 'Pouco urgente') bg-[#2D6A4F]
                @else bg-gray-400
                @endif
              ">
                {{ $prioridade }}
              </span>
            </td>
            <td class="px-4 py-2 text-gray-500" data-label="Criado em">{{ $paciente->created_at->format('d/m/Y') }}</td>
            <td class="px-4 py-2 drag-handle text-gray-500 text-xl" data-label="Mover">≡</td>
          </tr>
          @endforeach

          @if($pacientes->isEmpty())
          <tr>
            <td colspan="9" class="px-4 py-4 text-center text-gray-600">Nenhum paciente cadastrado.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <!-- Drag & Drop + Busca -->
  <script>
    new Sortable(document.getElementById('sortable-list'), {
      animation: 150,
      handle: '.drag-handle',
    });

    document.getElementById('searchInput').addEventListener('input', function () {
      const searchTerm = this.value.toLowerCase();
      const rows = document.querySelectorAll('#pacientesTable tbody tr');

      rows.forEach(row => {
        const nome = row.querySelector('.nome-paciente')?.textContent?.toLowerCase() || '';
        row.style.display = nome.includes(searchTerm) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
