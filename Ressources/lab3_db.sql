CREATE DATABASE IF NOT EXISTS assignment3;
USE assignment3;

CREATE TABLE IF NOT EXISTS users
(
username VARCHAR(20) NOT NULL,
password VARCHAR(20) NOT NULL,
PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS news
(
title VARCHAR(100) NOT NULL,
content VARCHAR(500) NOT NULL,
image_path VARCHAR(100),
date DATETIME NOT NULL,
PRIMARY KEY (title)
);

INSERT IGNORE INTO users (username, password) VALUES ('tculino', 'thomas');
INSERT IGNORE INTO users (username, password) VALUES ('fcoutau', 'françois');