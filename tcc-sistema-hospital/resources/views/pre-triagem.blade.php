<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulário de Pré-Triagem</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; }

body, html {
    margin: 0;
    padding: 0;
    font-family: 'Unbounded', sans-serif;
    min-height: 100vh;
    background: url('../imagens/enfermagem.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-container {
    width: 100%;
    max-width: 420px;
    padding: 30px;
    background-color: #13678A;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    margin: 20px;
    color: white;
}

.logo-container {
    text-align: center;
    margin-bottom: 30px;
}

.logo-img {
    width: 90px;
    height: auto;
}

h3 {
    text-align: center;
    font-weight: 700;
    margin-bottom: 25px;
    font-size: 1.5rem;
}

label.question {
    display: block;
    font-weight: 600;
    margin-bottom: 10px;
}

.form-control {
    border-radius: 25px;
    padding: 10px 20px;
    margin-bottom: 15px;
    border: none;
    background-color: rgba(255,255,255,0.1);
    color: white;
    font-size: 15px;
}

.form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.form-control:focus {
    outline: none;
    background-color: rgba(255,255,255,0.2);
}

.form-check-label {
    font-weight: 400;
    margin-right: 10px;
}

.form-check {
    margin-bottom: 8px;
}

.btn-submit {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 25px;
    background-color: #322172;
    border: none;
    color: #ffffff; /* texto branco */
    transition: 0.3s;
}

.btn-submit:hover {
    background-color: #24175d;
    color: #ffffff; /* mantém o texto branco ao passar o mouse */
}


.btn-voltar {
    display: inline-block;
    text-decoration: underline;
    font-weight: 600;
    color: #7CDA77;
    font-size: 0.95rem;
    margin-top: 15px;
    transition: 0.3s;
}

.btn-voltar:hover {
    color: #9ff19a;
}

/* Responsividade */
@media (max-width: 480px) {
    .form-container {
        padding: 25px 20px;
    }

    .logo-img {
        width: 80px; /* reduzido levemente em telas pequenas, igual login */
    }

    h3 {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }

    .form-control {
        font-size: 14px;
        padding: 10px 15px;
    }

    .btn-submit {
        font-size: 15px;
        padding: 10px;
    }
}
</style>
</head>
<body>

<div class="form-container">
    <div class="logo-container">
        <img src="../imagens/Monograma.png" alt="Logo TriÁgil" class="logo-img">
    </div>

    <h3>Formulário de Pré-Triagem</h3>

    <form action="{{ route('formulario.pre-triagem.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="question">Você possui alguma doença crônica?</label>
            @foreach (['Cardiovasculares', 'Respiratórias', 'Metabólicas', 'Autoimunes', 'Neurodegenerativas'] as $doenca)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="doencas[]" value="{{ $doenca }}" class="form-check-input">
                <label class="form-check-label">{{ 'Doenças ' . $doenca }}</label>
            </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="question">Faz uso contínuo de medicação?</label>
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

        <div class="mb-3">
            <label class="question">Possui alergias? Quais?</label>
            <input type="text" name="alergias" class="form-control">
        </div>

        <div class="mb-3">
            <label class="question">Você apresenta algum dos sintomas abaixo?</label>
            @foreach (['Febre', 'Dor no Peito', 'Tosse', 'Dificuldade para respirar', 'Dor de cabeça', 'Náusea/Vômito', 'Cansaço extremo', 'Outro'] as $sintoma)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="sintomas[]" value="{{ $sintoma }}" class="form-check-input">
                <label class="form-check-label">{{ $sintoma }}</label>
            </div>
            @endforeach
            <input type="text" name="sintomas_outro" class="form-control" placeholder="Especifique">
        </div>

        <div class="mb-3">
            <label class="question">Há quanto tempo apresenta os sintomas?</label>
            @foreach (['Menos de 24h', '1 a 3 dias', '4 a 7 dias', 'Mais de 1 semana'] as $tempo)
            <div class="form-check form-check-inline">
                <input type="radio" name="tempo_sintomas" value="{{ $tempo }}" class="form-check-input">
                <label class="form-check-label">{{ $tempo }}</label>
            </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="question">Qual a intensidade dos sintomas?</label>
            @foreach (['Leve', 'Moderada', 'Grave'] as $nivel)
            <div class="form-check form-check-inline">
                <input type="radio" name="intensidade" value="{{ $nivel }}" class="form-check-input">
                <label class="form-check-label">{{ $nivel }}</label>
            </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label class="question">Você já procurou atendimento médico para esses sintomas?</label>
            <div class="form-check form-check-inline">
                <input type="radio" name="atendimento_medico" value="Sim" class="form-check-input">
                <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="atendimento_medico" value="Não" class="form-check-input">
                <label class="form-check-label">Não</label>
            </div>
        </div>

        <div class="mb-3">
            <label class="question">Você sente que está em uma situação de EMERGÊNCIA?</label>
            <div class="form-check form-check-inline">
                <input type="radio" name="emergencia" value="Sim" class="form-check-input">
                <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="emergencia" value="Não" class="form-check-input">
                <label class="form-check-label">Não</label>
            </div>
        </div>

        <div class="mb-3">
            <label class="question">Qual o seu tipo sanguíneo?</label>
            <select name="tipo_sanguineo" class="form-control">
                <option value="" selected disabled>Selecione</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Enviar</button>
    </form>

    <div class="text-center">
        <a href="{{ route('paciente.dashboard') }}" class="btn-voltar">Voltar</a>
    </div>
</div>

</body>
</html>
