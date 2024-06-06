<!-- resources/views/emails/password_reset.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
</head>
<body>
<p>Hola,</p>
<p>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla:</p>
<p>
    <a href="{{ route('password.reset', $token) }}">
        Restablecer Contraseña
    </a>
</p>
<p>Si no has solicitado restablecer tu contraseña, puedes ignorar este correo.</p>
<p>Gracias,</p>
<p>El equipo de Wholesale Peninsula Vintage</p>
</body>
</html>
