<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Identificação - TriÁgil</title>

  <!-- Google Fonts: Unbounded -->
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

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

    /* Gradiente sobre imagem */
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
      max-width: 160px;
      margin-bottom: 30px;
    }

    .left-card h1 {
      font-weight: 700;
      font-size: 2.2rem;
      margin-bottom: 40px;
    }

    /* Botões */
    .btn-identificacao {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 250px;
      padding: 15px;
      border-radius: 30px;
      font-size: 1.1rem;
      font-weight: 600;
      margin: 10px 0;
      text-decoration: none;
      color: white;
      transition: 0.3s;
    }

    .btn-paciente {
      background-color: #322172;
    }

    .btn-paciente:hover {
      background-color: #25155f;
    }

    .btn-funcionario {
      background-color: #7CDA77;
      color: #ffffff;
    }

    .btn-funcionario:hover {
      background-color: #65c260;
      color: #ffffff;
    }

    .btn-identificacao i {
      margin-right: 10px;
      font-size: 1.3rem;
    }

    /* Responsivo */
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

      .left-card h1 {
        font-size: 1.8rem;
      }

      .btn-identificacao {
        width: 100%;
        padding: 14px;
        font-size: 1rem;
      }

      .left-card img.logo {
        max-width: 130px;
        margin-bottom: 20px;
      }

      .right-image {
        display: none;
      }
    }

    /* Ocupa espaço restante no desktop */
    .right-image {
      flex: 1;
    }
  </style>
</head>
<body>

  <div class="main-container">
    <div class="left-card">
      <img src="imagens/TriAgil(2).png" alt="Logo TriÁgil" class="logo" />
      <h1>Se Identifique</h1>

      <a href="{{ url('/login/paciente') }}" class="btn-identificacao btn-paciente">
        <i class="fas fa-user"></i> Sou Paciente
      </a>

      <a href="{{ url('/login/funcionario') }}" class="btn-identificacao btn-funcionario">
        <i class="fas fa-stethoscope"></i> Sou Funcionário
      </a>
    </div>

    <div class="right-image"></div>
  </div>

</body>
</html>