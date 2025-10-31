<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <title>Confirmação de E-mail - DevsAPI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; margin:0; padding:0;">
    <div style="max-width:600px; margin:40px auto; background-color:#fff; border-radius:20px; padding:40px 30px;">

        <!-- Logo -->
        <div style="text-align:center; margin-bottom:25px;">
            <img src="{{ asset('assets/media/logos/logo-light.svg') }}" alt="Logo" style="height:70px;">
        </div>

        <!-- Saudação -->
        <h2 style="text-align:center; color:#181C32; font-weight:700;">
            Olá {{ $name }},
        </h2>

        <p style="text-align:center; color:#7E8299; font-size:15px; margin-top:5px; margin-bottom: 5px">
            Parabéns, estamos quase prontos para utilizar o <strong>DevsAPI</strong>!
        </p>

        <p style="text-align:center; color:#7E8299; font-size:15px; margin-top:5px;">
            Use o código abaixo para confirmar seu e-mail:
        </p>

        <!-- Token -->
        <div style="text-align:center; margin:30px 0;">
            <span
                style="display:inline-block; background-color:#e9f3ff; color:#1b84ff; font-weight:700; font-size:28px; letter-spacing:5px; padding:15px 25px; border-radius:8px;">
                {{ $token }}
            </span>
        </div>

        <!-- Rodapé -->
        <div style="text-align:center; color:#A1A5B7; font-size:13px; margin-top:40px;">
            <p>Se você não solicitou este cadastro, ignore este e-mail.</p>
            <p>&copy; {{ date('Y') }} <strong>DevsAPI</strong> — Todos os direitos reservados. </p>
            <p>Uma empresa do Grupo <a href="https://twoclicks.com.br" target="_blank"
                    class="fw-bold text-dark d-inline-flex align-items-baseline ">
                    <i class="ki-solid ki-click fs-5" style="color: #08515D"></i>
                    <span
                        style="font-family: 'edu-qld-hand', sans-serif; font-weight: 600; font-style: normal; color: #3DA9AE;">Two</span>
                    <span
                        style="font-family: 'edu-qld-hand', sans-serif; font-weight: 600; font-style: normal; color: #08515D;">Clicks</span>
                </a>
            </p>
        </div>
    </div>
</body>

</html>
