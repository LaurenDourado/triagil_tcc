<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Pré-Triagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Unbounded', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            background: url('../imagens/medico.png') no-repeat center center fixed;
        }

        .logo-container {
           margin-bottom: 30px;
           text-align: center;
        }

        .logo-img {
            width: 80px;
            height: auto;
        }

        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #13678A;
            padding: 40px 30px;
            border-radius: 30px;
            color: #ffffff;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
        }

        h3 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
        }

        label {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .question {
            display: inline-block;
            border-bottom: 1px solid #fff; /* cor branca */
            padding-bottom: 4px;
            margin-bottom: 15px;
        }

        .form-check-label {
            font-weight: 400;
            margin-right: 15px;
        }

        .form-control {
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
        }

        .form-check {
            margin-bottom: 10px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: #322172;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #24175d;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .form-container {
                padding: 30px 20px;
                margin: 20px;
            }

            .form-check-label {
                display: block;
                margin-bottom: 8px;
            }

            .form-check-inline {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="../imagens/Monograma.png" alt="Logo TriÁgil" class="logo-img">
        </div>

        <h3>Formulário de Pré-Triagem</h3>

        <form action="{{ route('formulario.pre-triagem.store') }}" method="POST">
            @csrf

            <!-- Doenças crônicas -->
            <div class="mb-3">
                <label class="question">Você possui alguma doença crônica?</label><br>
                @foreach (['Cardiovasculares', 'Respiratórias', 'Metabólicas', 'Autoimunes', 'Neurodegenerativas'] as $doenca)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="doencas[]" value="{{ $doenca }}" class="form-check-input">
                        <label class="form-check-label">{{ 'Doenças ' . $doenca }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Medicação -->
            <div class="mb-3">
                <label class="question">Faz uso contínuo de medicação?</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="uso_medicacao" value="Sim" class="form-check-input">
                    <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="uso_medicacao" value="Não" class="form-check-input">
                    <label class="form-check-label">Não</label>
                </div>
                <input type="text" name="qual_medicacao" class="form-control" placeholder="Se sim, qual?">
            </div>

            <!-- Alergias -->
            <div class="mb-3">
                <label class="question">Possui alergias? Quais?</label>
                <input type="text" name="alergias" class="form-control">
            </div>

            <!-- Sintomas -->
            <div class="mb-3">
                <label class="question">Você apresenta algum dos sintomas abaixo?</label><br>
                @foreach (['Febre', 'Dor no Peito', 'Tosse', 'Dificuldade para respirar', 'Dor de cabeça', 'Náusea/Vômito', 'Cansaço extremo', 'Outro'] as $sintoma)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="sintomas[]" value="{{ $sintoma }}" class="form-check-input">
                        <label class="form-check-label">{{ $sintoma }}</label>
                    </div>
                @endforeach
                <input type="text" name="sintomas_outro" class="form-control" placeholder="Especifique">
            </div>

            <!-- Tempo dos sintomas -->
            <div class="mb-3">
                <label class="question">Há quanto tempo apresenta os sintomas?</label><br>
                @foreach (['Menos de 24h', '1 a 3 dias', '4 a 7 dias', 'Mais de 1 semana'] as $tempo)
                    <div class="form-check form-check-inline">
                        <input type="radio" name="tempo_sintomas" value="{{ $tempo }}" class="form-check-input">
                        <label class="form-check-label">{{ $tempo }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Intensidade -->
            <div class="mb-3">
                <label class="question">Qual a intensidade dos sintomas?</label><br>
                @foreach (['Leve', 'Moderada', 'Grave'] as $nivel)
                    <div class="form-check form-check-inline">
                        <input type="radio" name="intensidade" value="{{ $nivel }}" class="form-check-input">
                        <label class="form-check-label">{{ $nivel }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Atendimento médico -->
            <div class="mb-3">
                <label class="question">Você já procurou atendimento médico para esses sintomas?</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="atendimento_medico" value="Sim" class="form-check-input">
                    <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="atendimento_medico" value="Não" class="form-check-input">
                    <label class="form-check-label">Não</label>
                </div>
            </div>

            <!-- Emergência -->
            <div class="mb-3">
                <label class="question">Você sente que está em uma situação de EMERGÊNCIA?</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="emergencia" value="Sim" class="form-check-input">
                    <label class="form-check-label">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="emergencia" value="Não" class="form-check-input">
                    <label class="form-check-label">Não</label>
                </div>
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-submit">Enviar</button>
        </form>
    </div>
</body>
</html>