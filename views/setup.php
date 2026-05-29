<?php
$token = $_GET['token'] ?? '';
// Token Validierung
$stmt = $pdo->prepare("SELECT email FROM users WHERE invite_token = ?");
$stmt->execute([$token]);
$invited_user = $stmt->fetch();

if (!$invited_user): ?>
    <div class="auth-container animated-fade-in" style="width: 100%; max-width: 500px; margin: 60px auto; padding: 0 20px;">
        <div class="glass-card text-center" style="padding: 40px; text-align: center; box-sizing: border-box;">
            <div style="width: 64px; height: 64px; background: rgba(255, 69, 58, 0.15); border: 1px solid rgba(255, 69, 58, 0.3); border-radius: 18px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px auto; box-shadow: 0 0 25px rgba(255, 69, 58, 0.2);">
                <i class="fa-solid fa-circle-xmark" style="font-size: 26px; color: #ff453a;"></i>
            </div>
            <h2 style="font-family: 'Urbanist', sans-serif; font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 8px;">Ungültiger Token</h2>
            <p style="color: var(--text-muted, #94a3b8); font-size: 15px; margin-bottom: 25px;">Dieser Einladungslink ist ungültig, abgelaufen oder wurde bereits verwendet.</p>
            <a href="index.php?action=login" class="btn btn-secondary" style="display: block; width: 100%; padding: 14px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; text-decoration: none; font-weight: 600; transition: all 0.3s ease; box-sizing: border-box;">Zurück zum Login</a>
        </div>
    </div>

<?php else: ?>
    <div class="auth-container animated-fade-in" style="width: 100%; max-width: 500px; margin: 60px auto; padding: 0 20px;">
        <div class="glass-card" style="padding: 40px; box-sizing: border-box;">
            
            <div class="brand-header" style="text-align: center; margin-bottom: 35px;">
                <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #AF52DE, #5E5CE6); border-radius: 18px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px auto; box-shadow: 0 0 25px rgba(175, 82, 222, 0.4);">
                    <i class="fa-solid fa-user-plus" style="font-size: 26px; color: #fff;"></i>
                </div>
                <h2 style="font-family: 'Urbanist', sans-serif; font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -0.5px; margin-bottom: 8px;">Konto einrichten</h2>
                <p style="color: var(--text-muted, #94a3b8); font-size: 14px;">Einladung für: <strong style="color: #fff;"><?php echo htmlspecialchars($invited_user['email']); ?></strong></p>
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'username_exists'): ?>
                <div class="alert alert-danger" style="background: rgba(255, 69, 58, 0.15); border: 1px solid rgba(255, 69, 58, 0.3); color: #ff453a; padding: 14px; border-radius: 12px; margin-bottom: 25px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <i class="fa-solid fa-triangle-exclamation"></i> Dieser Benutzername ist leider schon vergeben.
                </div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger" style="background: rgba(255, 69, 58, 0.15); border: 1px solid rgba(255, 69, 58, 0.3); color: #ff453a; padding: 14px; border-radius: 12px; margin-bottom: 25px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <i class="fa-solid fa-triangle-exclamation"></i> Fehler. Passwort zu kurz (min. 8 Zeichen)?
                </div>
            <?php endif; ?>

            <form action="index.php?action=setup_process" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                
                <div class="form-group" style="margin: 0;">
                    <label class="input-label" style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted, #94a3b8); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Wähle deinen Benutzernamen</label>
                    <div class="input-wrapper" style="position: relative;">
                        <i class="fa-solid fa-id-card" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted, #94a3b8); font-size: 16px;"></i>
                        <input type="text" name="username" placeholder="z.B. max_muster" required pattern="[a-zA-Z0-9_]{3,20}" title="3-20 Zeichen, nur Buchstaben, Zahlen und Unterstriche" style="width: 100%; padding: 14px 16px 14px 48px; background: rgba(0, 0, 0, 0.25); border: 1px solid var(--glass-border, rgba(255,255,255,0.1)); border-radius: 12px; color: #fff; font-size: 15px; font-family: inherit; transition: all 0.3s ease; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <div class="form-group" style="margin: 0;">
                    <label class="input-label" style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted, #94a3b8); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Wähle dein Passwort</label>
                    <div class="input-wrapper" style="position: relative;">
                        <i class="fa-solid fa-key" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted, #94a3b8); font-size: 16px;"></i>
                        <input type="password" name="password" placeholder="Mindestens 8 Zeichen" required minlength="8" style="width: 100%; padding: 14px 16px 14px 48px; background: rgba(0, 0, 0, 0.25); border: 1px solid var(--glass-border, rgba(255,255,255,0.1)); border-radius: 12px; color: #fff; font-size: 15px; font-family: inherit; transition: all 0.3s ease; outline: none; box-sizing: border-box;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; background: linear-gradient(135deg, #AF52DE, #5E5CE6); border: none; border-radius: 12px; color: #fff; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(175, 82, 222, 0.3); transition: all 0.3s ease; margin-top: 10px; box-sizing: border-box;">
                    Account aktivieren <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
<?php endif; ?>