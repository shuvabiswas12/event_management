create DATABASE if not EXISTS 'event_management';

USE event_management;

CREATE TABLE if not EXISTS users (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),  -- GUID for user ID
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE if not exists events (
    id CHAR(36) PRIMARY KEY, -- GUID for unique event IDs
    user_id CHAR(36) NOT NULL, -- Reference to users table
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    event_image TEXT NOT NULL,
    event_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE events ADD COLUMN max_capacity INT NOT NULL DEFAULT 50;
ALTER TABLE events drop column event_image;


CREATE TABLE attendees (
    event_id CHAR(36) NOT NULL,
    user_id CHAR(36) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (event_id, user_id),  -- Composite Primary Key
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE attendees ADD COLUMN name varchar(50) NOT NUll;
ALTER TABLE attendees ADD COLUMN email varchar(50) NOT NUll;


