
-- cinema.sql

PRAGMA foreign_keys = ON;

-- Drop tables if they already exist
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS movie;
DROP TABLE IF EXISTS person;

-- Movie Table
CREATE TABLE movie (
    mid INTEGER PRIMARY KEY AUTOINCREMENT,
    mtitle TEXT NOT NULL DEFAULT '',
    myear INTEGER NOT NULL
);

-- Person Table
CREATE TABLE person (
    pid INTEGER PRIMARY KEY AUTOINCREMENT,
    pname TEXT NOT NULL DEFAULT '',
    pgender TEXT NOT NULL DEFAULT 'M'
        CHECK (pgender IN ('M', 'F')),
    pdob DATE NOT NULL
);

-- Role Table
CREATE TABLE role (
    mid INTEGER NOT NULL,
    pid INTEGER NOT NULL,
    part TEXT NOT NULL DEFAULT 'A'
        CHECK (part IN ('A', 'D')),
    PRIMARY KEY (mid, pid),
    FOREIGN KEY (mid) REFERENCES movie(mid),
    FOREIGN KEY (pid) REFERENCES person(pid)
);

-- Insert Movies
INSERT INTO movie VALUES (1, 'Rear Window', 1954);
INSERT INTO movie VALUES (NULL, 'To Catch A Thief', 1955);
INSERT INTO movie VALUES (NULL, 'The Maltese Falcon', 1941);
INSERT INTO movie VALUES (NULL, 'The Birds', 1963);
INSERT INTO movie VALUES (NULL, 'North By Northwest', 1959);
INSERT INTO movie VALUES (NULL, 'Casablanca', 1942);
INSERT INTO movie VALUES (NULL, 'Anatomy Of A Murder', 1959);

-- Insert Persons
INSERT INTO person VALUES (1, 'Alfred Hitchcock', 'M', '1899-08-13');
INSERT INTO person VALUES (NULL, 'Cary Grant', 'M', '1904-01-18');
INSERT INTO person VALUES (NULL, 'Grace Kelly', 'F', '1929-11-12');
INSERT INTO person VALUES (NULL, 'Humphery Bogart', 'M', '1899-12-25');
INSERT INTO person VALUES (NULL, 'Sydney Greenstreet', 'M', '1879-12-27');
INSERT INTO person VALUES (NULL, 'James Stewart', 'M', '1908-05-20');

-- Insert Roles
INSERT INTO role VALUES (1, 1, 'D');
INSERT INTO role VALUES (1, 3, 'A');
INSERT INTO role VALUES (1, 6, 'A');
INSERT INTO role VALUES (2, 1, 'D');
INSERT INTO role VALUES (2, 2, 'A');
INSERT INTO role VALUES (2, 3, 'A');
INSERT INTO role VALUES (3, 4, 'A');
INSERT INTO role VALUES (3, 5, 'A');
INSERT INTO role VALUES (4, 1, 'D');
INSERT INTO role VALUES (5, 1, 'D');
INSERT INTO role VALUES (5, 2, 'A');
INSERT INTO role VALUES (6, 4, 'A');
