<div class="auth-container animated-fade-in" style="width: 100%; max-width: 500px; margin: 60px auto; padding: 0 20px; box-sizing: border-box;">
    <div class="glass-card" style="padding: 40px; box-sizing: border-box;">
        
        <div class="brand-header" style="text-align: center; margin-bottom: 35px;">
            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #AF52DE, #5E5CE6); border-radius: 18px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px auto; box-shadow: 0 0 25px rgba(175, 82, 222, 0.4);">
                <i class="fa-solid fa-compass-drafting brand-logo" style="font-size: 26px; color: #fff;"></i>
            </div>
            <h2 style="font-family: 'Urbanist', sans-serif; font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -0.5px; margin-bottom: 8px;">Internal Craft Hub</h2>
            <p style="color: var(--text-muted, #94a3b8); font-size: 14px;">Bitte logge dich ein, um fortzufahren.</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" style="background: rgba(255, 69, 58, 0.15); border: 1px solid rgba(255, 69, 58, 0.3); color: #ff453a; padding: 14px; border-radius: 12px; margin-bottom: 25px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; justify-content: center;">
                <i class="fa-solid fa-triangle-exclamation"></i> Ungültiger Username oder Passwort.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['setup_success'])): ?>
            <div class="alert alert-success" style="background: rgba(48, 209, 88, 0.15); border: 1px solid rgba(48, 209, 88, 0.3); color: #30D158; padding: 14px; border-radius: 12px; margin-bottom: 25px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; justify-content: center;">
                <i class="fa-solid fa-circle-check"></i> Account erfolgreich erstellt! Logge dich ein.
            </div>
        <?php endif; ?>

        <form action="index.php?action=login_process" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
            
            <div class="input-wrapper" style="position: relative;">
                <i class="fa-solid fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted, #94a3b8); font-size: 16px;"></i>
                <input type="text" name="username" placeholder="Benutzername" required autocomplete="username" style="width: 100%; padding: 14px 16px 14px 48px; background: rgba(0, 0, 0, 0.25); border: 1px solid var(--glass-border, rgba(255,255,255,0.1)); border-radius: 12px; color: #fff; font-size: 15px; font-family: inherit; transition: all 0.3s ease; outline: none; box-sizing: border-box;">
            </div>
            
            <div class="input-wrapper" style="position: relative;">
                <i class="fa-solid fa-lock" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted, #94a3b8); font-size: 16px;"></i>
                <input type="password" name="password" placeholder="Passwort" required autocomplete="current-password" style="width: 100%; padding: 14px 16px 14px 48px; background: rgba(0, 0, 0, 0.25); border: 1px solid var(--glass-border, rgba(255,255,255,0.1)); border-radius: 12px; color: #fff; font-size: 15px; font-family: inherit; transition: all 0.3s ease; outline: none; box-sizing: border-box;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; background: linear-gradient(135deg, #AF52DE, #5E5CE6); border: none; border-radius: 12px; color: #fff; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(175, 82, 222, 0.3); transition: all 0.3s ease; margin-top: 10px; box-sizing: border-box;">
                Einloggen <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
        </form>
    </div>
</div>