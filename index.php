<?php
// index.php
require_once __DIR__ . '/includes/auth.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sbucher.ch | Internal Craft Hub</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- FontAwesome für Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    
    <!-- Animierte Hintergrund-Blobs für den Liquid-Glass-Effekt -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="app-container">
        <?php
        switch ($action) {
            case 'login':
                include __DIR__ . '/views/login.php';
                break;
                
            case 'setup':
                include __DIR__ . '/views/setup.php';
                break;
                
            case 'dashboard':
            default:
                check_auth();
                include __DIR__ . '/views/dashboard.php';
                break;
        }
        ?>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>
