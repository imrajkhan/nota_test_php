# Nota Project README

This project involves creating a database named "nota" and a table named "wiki_sections" with a specific schema.



1. Create the Database
	CREATE DATABASE nota;

2. Create Table

CREATE TABLE wiki_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_created DATETIME,
    title VARCHAR(230),
    url VARCHAR(240),
    picture VARCHAR(240),
    abstract VARCHAR(256),
    UNIQUE INDEX url_idx (url(100)),
    UNIQUE INDEX picture_idx (picture(100)),
    UNIQUE INDEX abstract_idx (abstract(100))
);
