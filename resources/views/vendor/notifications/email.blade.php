<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Family Flowers' }}</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px;">
        <div style="background: #D26F8B; padding: 20px; text-align: center; border-radius: 20px 20px 0 0;">
            <h2 style="color: white; margin: 0;">🌺 Family Flowers</h2>
        </div>
        
        <div style="border: 1px solid #F0E4E8; border-top: none; padding: 30px; background: white; border-radius: 0 0 20px 20px;">
            @foreach ($introLines as $line)
                <p style="color: #333; line-height: 1.5;">{{ $line }}</p>
            @endforeach
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $actionUrl }}" 
                   style="background: #D26F8B; color: white; padding: 12px 30px; text-decoration: none; border-radius: 50px; display: inline-block;">
                    {{ $actionText }}
                </a>
            </div>
            
            @foreach ($outroLines as $line)
                <p style="color: #666; font-size: 12px;">{{ $line }}</p>
            @endforeach
            
            <hr style="border: none; border-top: 1px solid #F0E4E8; margin: 20px 0;">
            
            <p style="font-size: 11px; color: #999; text-align: center;">
                © {{ date('Y') }} Family Flowers. Цветы с любовью.
            </p>
        </div>
    </div>
</body>
</html>