CREATE USER 'receitas'@'localhost' IDENTIFIED BY 'senha';

CREATE DATABASE receitas;

GRANT ALL PRIVILEGES ON receitas.* TO 'receitas'@'localhost' IDENTIFIED BY 'senha';

CREATE TABLE instructions (
    id int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    content text,
    PRIMARY KEY (id)
);

CREATE TABLE ingredients (
    id int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);

CREATE TABLE recipe (
    id int(11) NOT NULL AUTO_INCREMENT,
    ins_id int(11) NOT NULL,
    ing_id int(11) NOT NULL,
    quantity varchar(255) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (ins_id) REFERENCES instructions (id),
    FOREIGN KEY (ing_id) REFERENCES ingredients (id)
);

CREATE TABLE assigned_categories (
    ins_id int(11) NOT NULL,
    cat_id int(11) NOT NULL,
    CONSTRAINT id PRIMARY KEY (ins_id, cat_id),
    FOREIGN KEY (ins_id) REFERENCES instructions (id),
    FOREIGN KEY (cat_id) REFERENCES categories (id)
);

CREATE TABLE admin_password (
    id int(11) NOT NULL AUTO_INCREMENT,
    admin_password varchar(255) NOT NULL,
    PRIMARY KEY (id)
);