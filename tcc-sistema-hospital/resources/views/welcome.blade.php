<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bem-vindo - TriÁgil</title>

  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    * { box-sizing: border-box; }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Unbounded', Arial, sans-serif;
      background: url('imagens/hospital.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
    }

    /* Overlay escurecendo o fundo */
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(19, 103, 138, 0.65);
      z-index: -1;
    }

    .main-container {
      display: flex;
      flex-direction: row;
      min-height: 100vh;
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
      max-width: 160px;
      margin-bottom: 30px;
    }

    .left-card h2 {
      font-weight: 700;
      font-size: 2.2rem;
      margin-bottom: 40px;
      line-height: 1.3;
    }

    .left-card p {
      font-size: 1rem;
      margin-bottom: 30px;
    }

    .btn-entrar {
      background-color: #322172;
      color: #ffffff;
      font-weight: 600;
      width: 250px;
      padding: 14px 0;
      font-size: 1rem;
      border-radius: 30px;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .btn-entrar:hover {
      background-color: #24175d;
      color: #ffffff;
    }

    .right-space { flex: 1; }

    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        height: 100vh;
        min-height: 100vh;
      }

      .left-card {
        width: 100%;
        max-width: 400px;
        border-radius: 30px;
        padding: 40px 20px;
      }

      .left-card img.logo {
        max-width: 130px;
        margin-bottom: 20px;
      }

      .left-card h2 {
        font-size: 1.8rem;
      }

      .btn-entrar {
        width: 100%;
        font-size: 1rem;
        padding: 12px 0;
      }
    }
  </style>
</head>

<body>
  <div class="main-container">
    <div class="left-card">
      <img src="imagens/TriAgil(2).png" alt="Logo TriÁgil" class="logo" />
      <h2>Bem-vindo(a) ao<br>Sistema de Pré-Triagem</h2>
      <p>Aqui sua saúde vem em primeiro lugar</p>
      <a href="{{ url('identificacao') }}" class="btn-entrar">Entrar</a>
    </div>
    <div class="right-space"></div>
  </div>
</body>
</html>
