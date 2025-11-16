CREATE TABLE IF NOT EXISTS  usuarios(
    id  INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    compra VARCHAR(255),
    created_at timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS  php_sessions(
    id VARCHAR(255) PRIMARY KEY,
    data TEXT NOT NULL,
    last_access INT(11) NOT NULL
);
