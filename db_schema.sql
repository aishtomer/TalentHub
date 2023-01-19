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

CREATE TABLE IF NOT EXISTS articleRecords (
    article_id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    subtitle TEXT NOT NULL,
    content TEXT NOT NULL,
    status VARCHAR(15),
    creation_date TEXT,
    last_modified TEXT,
    publication_date TEXT,
    likes INT DEFAULT 0 NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS blogSettings (
    blog_title TEXT NOT NULL,
    blog_subtitle TEXT NOT NULL,
    author_name TEXT NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS comments (
    article_id INT,
    text TEXT NOT NULL,
    pub_date TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);



--title, sub title, content, author name(first name + last name), status(published/ draft), date of publish if published, likes


--insert default data (if necessary here)



COMMIT;

