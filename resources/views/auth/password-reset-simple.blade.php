<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Восстановление пароля</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px;">
        <div style="background: #D26F8B; padding: 20px; text-align: center; border-radius: 20px 20px 0 0;">
            <h2 style="color: white; margin: 0;">🌺 Family Flowers</h2>
        </div>
        
        <div style="border: 1px solid #F0E4E8; border-top: none; padding: 30px; background: white; border-radius: 0 0 20px 20px;">
            <h3>Здравствуйте, {{ $user->name ?? 'пользователь' }}!</h3>
            
            <p>Вы получили это письмо, так как кто-то запросил сброс пароля для вашего аккаунта.</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $resetUrl }}" style="background: #D26F8B; color: white; padding: 12px 30px; text-decoration: none; border-radius: 50px;">
                    Сбросить пароль
                </a>
            </div>
            
            <p style="font-size: 12px; color: #999;">
                Ссылка действительна в течение 60 минут.<br>
                Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо.
            </p>
        </div>
    </div>
</body>
</html>