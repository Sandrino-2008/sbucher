-- database/schema.sql
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    invite_token VARCHAR(64) UNIQUE NULL,
    token_created_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Standard-Admin anlegen (Passwort muss beim ersten Login oder via System gesetzt werden, 
-- hier als Platzhalter oder direkt mit Hash einfügen)
-- Passwort 'admin123' zur Initialisierung:
-- INSERT INTO users (username, email, password_hash, role) VALUES ('admin', 'deine-admin-email@sbucher.ch', '$2y$10$tZ2R8u6Zf9mZ8xJ.Q2hWae1Qf6R2kLwZ/A.6hG7tGg8Y7tGg8Y7tG', 'admin');
