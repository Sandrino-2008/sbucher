-- 1. Die Kalender-Kategorien (z.B. "Arbeit", "Privat", "Freunde")
CREATE TABLE IF NOT EXISTS calendars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Der Ersteller des Kalenders
    name VARCHAR(100) NOT NULL,
    color VARCHAR(7) DEFAULT '#007AFF', -- Apple-Blau als Standardfarbe
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Die eigentlichen Kalendereinträge (Events)
CREATE TABLE IF NOT EXISTS calendar_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    calendar_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    FOREIGN KEY (calendar_id) REFERENCES calendars(id) ON DELETE CASCADE
);

-- 3. Die Einladungen / Geteilten Kalender
CREATE TABLE IF NOT EXISTS calendar_shares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    calendar_id INT NOT NULL,
    invite_token VARCHAR(64) UNIQUE NOT NULL, -- Der geheime Link-Teil
    shared_with_user_id INT NULL, -- Wird befüllt, sobald ein Freund den Link anklickt
    FOREIGN KEY (calendar_id) REFERENCES calendars(id) ON DELETE CASCADE
);