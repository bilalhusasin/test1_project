<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Log Viewer</title>
    <link rel="icon" type="image/png" href="/webAssets/img/favicon.png" />
</head>
<body>
    <h1>Error Log van Vandaag</h1>
    <pre><?= esc($logContent) ?></pre> <!-- Escape de inhoud om XSS te voorkomen -->
</body>
</html>