<div class="dashboard-wrapper animated-fade-in">
    
    <header class="dashboard-header glass-card">
        <div class="user-profile">
            <div class="avatar"><?php echo strtoupper(substr($_SESSION['username'], 0, 2)); ?></div>
            <div>
                <h3>Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
                <span class="role-tag <?php echo is_admin() ? 'admin-tag' : 'user-tag'; ?>">
                    <?php echo is_admin() ? 'Administrator' : 'Mitarbeiter'; ?>
                </span>
            </div>
        </div>
        
        <div class="header-navigation">
            <?php if (is_admin()): ?>
                <button class="nav-tab active" data-target="links-view">
                    <i class="fa-solid fa-link"></i> Links
                </button>
                <button class="nav-tab" data-target="admin-view">
                    <i class="fa-solid fa-user-plus"></i> Einladen
                </button>
            <?php endif; ?>
            <a href="index.php?action=logout" class="btn-logout" title="Ausloggen">
                <i class="fa-solid fa-power-off"></i>
            </a>
        </div>
    </header>

    <div id="links-view" class="tab-content active">
        <div class="grid-container">
            
            <div class="category-card glass-card">
                <div class="category-title">
                    <i class="fa-solid fa-share-nodes icon-social"></i> Marketing / Social
                </div>
                <div class="links-list">
                    <a href="https://www.tiktok.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-brands fa-tiktok main-icon"></i> TikTok Dashboard
                        </span>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-brands fa-instagram main-icon"></i> Instagram Business
                        </span>
                    </a>
                    <a href="https://www.pinterest.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-brands fa-pinterest main-icon"></i> Pinterest Analytics
                        </span>
                    </a>
                </div>
            </div>

            <div class="category-card glass-card">
                <div class="category-title">
                    <i class="fa-solid fa-shirt icon-pod"></i> Print on Demand Partner
                </div>
                <div class="links-list">
                    <a href="https://www.printful.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-box-open main-icon"></i> Printful
                        </span>
                    </a>
                    <a href="https://www.printify.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-pallet main-icon"></i> Printify
                        </span>
                    </a>
                    <a href="https://www.redbubble.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-bubble-chart main-icon"></i> Redbubble Studio
                        </span>
                    </a>
                    <a href="https://www.spreadshirt.ch/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-tshirt main-icon"></i> Spreadshirt Partner
                        </span>
                    </a>
                    <a href="https://www.gelato.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-globe main-icon"></i> Gelato Global
                        </span>
                    </a>
                </div>
            </div>

            <div class="category-card glass-card">
                <div class="category-title">
                    <i class="fa-solid fa-screwdriver-wrench icon-tools"></i> Interne Tools
                </div>
                <div class="links-list">
                    <a href="https://docs.google.com/forms/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-square-poll-horizontal main-icon"></i> Google Forms (Umfragen)
                        </span>
                    </a>
                    <a href="https://onedrive.live.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-cloud main-icon"></i> OneDrive Cloud
                        </span>
                    </a>
                    <a href="https://outlook.live.com/" target="_blank" rel="noopener" class="link-item">
                        <span class="link-content">
                            <i class="fa-solid fa-envelope-open-text main-icon"></i> Firmen-Mailbox
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <?php if (is_admin()): ?>
            <div id="admin-view" class="tab-content">
                <div class="glass-card" style="padding: 40px; text-align: center; width: 100%; box-sizing: border-box;">
                    
                    <div class="brand-header" style="margin-bottom: 30px;">
                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #AF52DE, #5E5CE6); border-radius: 18px; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px auto; box-shadow: 0 0 25px rgba(175, 82, 222, 0.4);">
                            <i class="fa-solid fa-user-plus" style="font-size: 26px; color: #fff;"></i>
                        </div>
                        <h2 style="font-family: 'Urbanist', sans-serif; font-size: 28px; font-weight: 700; color: #fff; letter-spacing: -0.5px; margin-bottom: 8px;">Team erweitern</h2>
                        <p style="color: var(--text-muted); font-size: 14px;">Generiere einen sicheren Einladungslink für neue Mitarbeiter oder Partner.</p>
                    </div>

                    <?php if (isset($_GET['invited'])): ?>
                        <div class="alert alert-success" style="width: 100%; margin: 0 auto 25px auto; background: rgba(48, 209, 88, 0.15); border: 1px solid rgba(48, 209, 88, 0.3); color: #30d158; padding: 14px; border-radius: var(--radius-sm); font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; justify-content: center; box-sizing: border-box;">
                            <i class="fa-solid fa-paper-plane"></i> Einladung erfolgreich versendet!
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error']) && $_GET['error'] === 'invite'): ?>
                        <div class="alert alert-danger" style="width: 100%; margin: 0 auto 25px auto; background: rgba(255, 69, 58, 0.15); border: 1px solid rgba(255, 69, 58, 0.3); color: #ff453a; padding: 14px; border-radius: var(--radius-sm); font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 10px; justify-content: center; box-sizing: border-box;">
                            <i class="fa-solid fa-triangle-exclamation"></i> Einladung fehlgeschlagen.
                        </div>
                    <?php endif; ?>

                    <form action="index.php?action=invite_process" method="POST" style="width: 100%; display: flex; flex-direction: column; gap: 15px; text-align: left; box-sizing: border-box;">
                        
                        <div class="form-group" style="margin: 0; width: 100%;">
                            <label class="input-label" style="display: block; font-size: 13px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">E-Mail-Adresse des Nutzers</label>
                            <div class="input-wrapper" style="position: relative; width: 100%;">
                                <i class="fa-solid fa-envelope" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 16px;"></i>
                                <input type="email" name="email" placeholder="partner@sbucher.ch" required style="width: 100%; padding: 14px 16px 14px 48px; background: rgba(0, 0, 0, 0.25); border: 1px solid var(--glass-border); border-radius: var(--radius-sm); color: #fff; font-size: 15px; font-family: inherit; transition: all 0.3s ease; outline: none; box-sizing: border-box;">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; background: linear-gradient(135deg, #AF52DE, #5E5CE6); border: none; border-radius: var(--radius-sm); color: #fff; font-size: 15px; font-weight: 700; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(175, 82, 222, 0.3); transition: all 0.3s ease; box-sizing: border-box;">
                            Einladungs-Link senden <i class="fa-solid fa-arrow-right"></i>
                        </button>

                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>