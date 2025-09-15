<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bem-vindo - TriÁgil</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Unbounded', Arial, sans-serif;
      background: url('imagens/hospital.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
    }

    /* Overlay para escurecer imagem de fundo */
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(19, 103, 138, 0.65);
      z-index: -1;
    }

    .main-container {
      display: flex;
      flex-direction: row;
      height: 100vh;
      width: 100%;
    }

    .left-card {
      background-color: rgba(19, 103, 138, 0.95);
      color: white;
      width: 40%;
      min-width: 300px;
      padding: 60px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      border-top-right-radius: 40px;
      border-bottom-right-radius: 40px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .left-card img.logo {
      max-width: 180px;
      margin-bottom: 50px;
    }

    .left-card h2 {
      font-weight: 700;
      font-size: 1.7rem;
      margin-bottom: 20px;
      line-height: 1.3;
    }

    .left-card p {
      font-size: 1rem;
      margin-bottom: 30px;
    }

    .btn-entrar {
      background-color: #322172;
      color: white;
      font-weight: bold;
      padding: 14px 40px;
      border-radius: 30px;
      font-size: 1rem;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .btn-entrar:hover {
      background-color: #25155f;
    }

    /* Parte direita — só ocupa espaço, sem conteúdo */
    .right-space {
      flex: 1;
    }

    /* Responsividade */
    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      .left-card {
        width: 100%;
        max-width: 90%;
        border-radius: 30px;
        padding: 40px 20px;
      }

      .right-space {
        display: none;
      }

      .left-card img.logo {
        max-width: 140px;
        margin-bottom: 30px;
      }

      .left-card h2 {
        font-size: 1.4rem;
      }

      .btn-entrar {
        width: 100%;
        padding: 12px;
        font-size: 0.95rem;
      }
    }
  </style>
</head>
<body>

  <div class="main-container">
    <!-- Card fixo à esquerda -->
    <div class="left-card">
      <img src="imagens/TriAgil(2).png" alt="Logo TriÁgil" class="logo" />
      <h2>Bem-vindo(a) ao<br>Sistema de Pré-Triagem</h2>
      <p>Aqui sua saúde vem em primeiro lugar</p>
      <a href="{{ url('identificacao') }}" class="btn-entrar">Entrar</a>
    </div>

    <!-- Espaço vazio à direita com imagem de fundo visível -->
    <div class="right-space"></div>
  </div>

</body>
</html>