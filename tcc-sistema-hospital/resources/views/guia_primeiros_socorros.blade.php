<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Guia de Primeiros Socorros</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet" />
<style>
  body, html {
    margin: 0;
    padding: 0;
    font-family: 'Unbounded', cursive;
    background: url("{{ asset('imagens/sala.jpg') }}") no-repeat center center fixed;
    background-size: cover;
    color: white;
    min-height: 100%;
  }

  .container-guia {
    max-width: 620px;
    margin: 40px auto;
    background: linear-gradient(to bottom, #13678A 0%, #13668ac8 85%, rgba(19, 102, 138, 0.61) 100%);
    border-radius: 30px;
    color: white;
    padding: 50px 40px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
    text-align: center;
  }

  .logo-container {
    margin-bottom: 30px;
    text-align: center;
  }

  .logo-container img {
    width: 90px;
    height: auto;
  }

  .container-guia h2 {
    font-family: 'Unbounded', cursive;
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 25px;
  }

  .container-guia ol {
    padding-left: 20px;
    text-align: left;
  }

  .container-guia ol li {
    margin-bottom: 12px;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
  }

  .container-guia strong {
    font-weight: 700;
  }

  .dica {
    background-color: #C0F7CF;
    color: #1a1a1a;
    font-weight: 600;
    padding: 14px 18px;
    border-radius: 15px;
    text-align: center;
    margin-top: 25px;
    font-size: 1rem;
  }

  .btn-voltar {
    display: inline-block;
    text-align: center;
    margin-top: 25px;
    text-decoration: underline;
    font-weight: 600;
    color: #7CDA77;
    font-size: 1rem;
    transition: color 0.3s ease;
  }

  .btn-voltar:hover {
    color: #9ff19a;
  }

  @media (max-width: 600px) {
    .container-guia {
      margin: 20px;
      padding: 40px 25px;
      border-radius: 25px;
    }

    .logo-container img {
      width: 50px;
    }

    .container-guia h2 {
      font-size: 20px;
    }

    .container-guia ol li {
      font-size: 0.9rem;
    }

    .dica {
      font-size: 0.95rem;
      padding: 12px 16px;
    }

    .btn-voltar {
      font-size: 0.9rem;
      margin-top: 20px;
    }
  }
</style>
</head>
<body>

<div class="container-guia">
  <div class="logo-container">
    <img src="../imagens/Monograma.png" alt="Monograma da Logo">
  </div>

  <h2>Primeiros Socorros</h2>

  <ol>
    <li><strong>Verifique a segurança</strong> do local antes de agir.</li>
    <li><strong>Ligue 192 (SAMU) ou 193 (Bombeiros)</strong> e informe o que aconteceu.</li>
    <li><strong>Se a vítima não respira</strong>, inicie RCP (compressões no peito).</li>
    <li><strong>Em caso de engasgo</strong>, use a Manobra de Heimlich (ou tapinhas nas costas em bebês).</li>
    <li><strong>Para sangramentos</strong>, pressione com pano limpo e eleve o local.</li>
    <li><strong>Para queimaduras</strong>, lave com água fria e cubra com pano seco.</li>
    <li><strong>Em desmaios ou convulsões</strong>, deite a pessoa de lado e aguarde socorro.</li>
    <li><strong>Em fraturas</strong>, imobilize e evite mover o membro afetado.</li>
  </ol>

  <div class="dica">
    Dica: mantenha a calma e sempre chame ajuda especializada.
  </div>

  <a href="{{ url()->previous() }}" class="btn-voltar">Voltar</a>
</div>

</body>
</html>
