<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Kısaltıcı</title>
</head>
<body>
    <div style="text-align: center;">
        <h1>URL Kısaltıcı</h1>
        <form method="post" action="/url/shorten">
            <input type="text" name="url" placeholder="Uzun URL'yi buraya yapıştırın" required>
            <button type="submit">Kısalt</button>
        </form>
        <?php if (isset($data['error'])): ?>
            <p style="color: red;"><?php echo $data['error']; ?></p>
        <?php elseif (isset($data['short_url'])): ?>
            <p>Kısa URL: <a href="/<?php echo $data['short_url']; ?>"><?php echo $data['short_url']; ?></a></p>
        <?php endif; ?>
    </div>
</body>
</html>
