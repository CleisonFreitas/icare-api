<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PIN de recuperação</title>
</head>
<body>
    <p>Olá {{ $usuario->nome ?? $usuario->email }},</p>

    <p>Você solicitou a recuperação de senha. Use o código PIN abaixo para validar a operação:</p>

    <h2 style="letter-spacing:4px">{{ $pin }}</h2>

    <p>Esse código expira em 60 minutos. Caso você não tenha solicitado, ignore este e-mail.</p>

    <p>Atenciosamente,<br/>Equipe iCare</p>
</body>
</html>
