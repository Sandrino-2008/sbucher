<?php
// Verbinde zur Datenbank
require_once __DIR__ . '/config/database.php';

// Deine neuen Zugangsdaten
$username = 'admin';
$password = 'Start123!'; 
$email    = 'sandrobucher12@gmail.com';

// Den korrekten Hash über deinen Server generieren
$hash = password_hash($password, PASSWORD_BCRYPT);

try {
    // Admin anlegen oder updaten, falls er schon existiert
    $stmt = $pdo->prepare("
        INSERT INTO users (username, email, password_hash, role) 
        VALUES (?, ?, ?, 'admin')
        ON DUPLICATE KEY UPDATE 
        password_hash = VALUES(password_hash),
        role = 'admin'
    ");
    
    $stmt->execute([$username, $email, $hash]);
    
    echo "<div style='background:#111; color:#fff; padding:50px; font-family:sans-serif; text-align:center;'>";
    echo "<h1 style='color:#32D74B;'>Erfolgreich!</h1>";
    echo "<p>Dein Admin-Account ist bereit.</p>";
    echo "<p>Benutzername: <b>$username</b></p>";
    echo "<p>Passwort: <b>$password</b></p>";
    echo "<br><br><a href='index.php' style='color:#0A84FF; text-decoration:none; font-weight:bold;'>Hier geht's zum Login</a>";
    echo "</div>";

} catch (Exception $e) {
    echo "Fehler bei der Datenbank: " . $e->getMessage();
}
?>