CREATE DATABASE IF NOT EXISTS assignment3;
USE assignment3;

CREATE TABLE users
(
username VARCHAR(20) NOT NULL,
password VARCHAR(20) NOT NULL,
PRIMARY KEY (username)
);

INSERT INTO users (username, password) VALUES ('tculino', 'thomas');
INSERT INTO users (username, password) VALUES ('fcoutau', 'françois');