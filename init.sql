-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS devops_login;

-- Switch to the devops_login database
USE devops_login;

-- Create the table if it doesn't exist
CREATE TABLE IF NOT EXISTS devops_login (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    plain_password VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id)
);
