<?php
// includes/auth.php
session_start();
require_once __DIR__ . '/../config/database.php';

function check_auth() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

$action = $_GET['action'] ?? 'dashboard';

// Login-Logik
if ($action === 'login_process' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php?action=dashboard');
            exit;
        }
    }
    header('Location: index.php?action=login&error=1');
    exit;
}

// Einladungs-Logik (Admin)
if ($action === 'invite_process' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    check_auth();
    if (!is_admin()) {
        header('Location: index.php?action=dashboard');
        exit;
    }
    
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    if ($email) {
        $token = bin2hex(random_bytes(32));
        
        $stmt = $pdo->prepare("INSERT INTO users (email, invite_token, token_created_at) VALUES (?, ?, NOW()) ON DUPLICATE KEY UPDATE invite_token = ?, token_created_at = NOW()");
        if ($stmt->execute([$email, $token, $token])) {
            $invite_url = "https://www.sbucher.ch/index.php?action=setup&token=" . $token;
            
            $to = $email;
            $subject = "Einladung zum sbucher.ch Internal Craft Hub";
            
            // Edles HTML-E-Mail-Design passend zur Webseite
            $message = '
            <!DOCTYPE html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body style="margin: 0; padding: 0; background-color: #060913; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">

                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #060913; padding: 60px 20px;">
                    <tr>
                        <td align="center">
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 500px; background-color: #111625; border: 1px solid #2a2f42; border-radius: 16px; padding: 40px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                                
                                <tr>
                                    <td align="center" style="padding-bottom: 25px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td bgcolor="#AF52DE" align="center" style="background: linear-gradient(135deg, #AF52DE, #5E5CE6); width: 64px; height: 64px; border-radius: 18px;">
                                                    <span style="font-size: 32px; color: #ffffff; font-weight: 300; line-height: 64px;">+</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-bottom: 10px;">
                                        <h1 style="margin: 0; font-size: 24px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">Digital Craft Hub</h1>
                                    </td>
                                end;
                                
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <p style="margin: 0; font-size: 12px; color: #5E5CE6; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">sbucher.ch</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" style="padding-bottom: 35px;">
                                        <p style="margin: 0; font-size: 15px; line-height: 1.6; color: #94a3b8; max-width: 400px;">
                                            Du wurdest exklusiv eingeladen, dem internen Management-Hub beizutreten. Richte jetzt dein Konto ein, um Zugriff auf die Tools und Dashboards zu erhalten.
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" style="padding-bottom: 25px;">
                                        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                                            <tr>
                                                <td align="center" bgcolor="#AF52DE" style="border-radius: 8px; background: linear-gradient(135deg, #AF52DE, #5E5CE6);">
                                                    <a href="' . $invite_url . '" target="_blank" style="font-size: 15px; font-weight: 700; color: #ffffff; text-decoration: none; padding: 14px 0; display: block; width: 100%; border-radius: 8px; text-align: center;">
                                                        Account einrichten →
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center">
                                        <p style="margin: 0; font-size: 12px; color: #475569; line-height: 1.4;">
                                            Dieser Link ist aus Sicherheitsgründen nur einmalig gültig. Bitte leite diese Mail nicht an Dritte weiter.
                                        </p>
                                    </td>
                                </tr>

                            </table>
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 500px; text-align: center; margin-top: 25px;">
                                <tr>
                                    <td>
                                        <p style="margin: 0; font-size: 11px; color: #475569;">
                                            Dies ist eine automatisch generierte Systembenachrichtigung.
                                        </p>
                                        <p style="margin: 6px 0 0 0; font-size: 12px; color: #64748b; font-weight: 600;">
                                            © 2026 sbucher.ch – All Rights Reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>

            </body>
            </html>
            ';
            
            // Content-Type Header auf HTML umstellen
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: no-reply@sbucher.ch\r\n";
            $headers .= "Reply-To: no-reply@sbucher.ch\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            
            mail($to, $subject, $message, $headers);
            header('Location: index.php?action=dashboard&invited=1');
            exit;
        }
    }
    header('Location: index.php?action=dashboard&error=invite');
    exit;
}

// Setup-Prozess (Neuer User setzt Username & Passwort)
if ($action === 'setup_process' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $username = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($token && $username && strlen($password) >= 8) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE invite_token = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Prüfen, ob Username existiert
            $check = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $check->execute([$username]);
            if ($check->fetch()) {
                header('Location: index.php?action=setup&token=' . $token . '&error=username_exists');
                exit;
            }
            
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $update = $pdo->prepare("UPDATE users SET username = ?, password_hash = ?, invite_token = NULL, token_created_at = NULL WHERE id = ?");
            if ($update->execute([$username, $hash, $user['id']])) {
                header('Location: index.php?action=login&setup_success=1');
                exit;
            }
        }
    }
    header('Location: index.php?action=setup&token=' . $token . '&error=1');
    exit;
}

// Logout
if ($action === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?action=login');
    exit;
}