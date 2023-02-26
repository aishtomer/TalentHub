-- This makes sure that foreign_key constraints are observed and that errors will be thrown for violations
PRAGMA foreign_keys=ON;

BEGIN TRANSACTION;

--create your tables with SQL commands here (watch out for slight syntactical differences with SQLite)

CREATE TABLE IF NOT EXISTS loginDetails (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    password  VARCHAR(255)
);


--title, sub title, content, author name(first name + last name), status(published/ draft), date of publish if published, likes


--insert default data (if necessary here)
INSERT INTO loginDetails ("email", "first_name", "last_name", "password") VALUES( "janedoe@gmail.com", "Jane", "Doe", "JD");
INSERT INTO loginDetails ("email", "first_name", "last_name", "password") VALUES( "johndoe@gmail.com", "John", "Doe", "JohnD");
INSERT INTO loginDetails ("email", "first_name", "last_name", "password") VALUES( "aryadoe@gmail.com", "Arya", "Doe", "AD");
INSERT INTO loginDetails ("email", "first_name", "last_name", "password") VALUES( "rosedoe@gmail.com", "Rose", "Doe", "RD");


COMMIT;

