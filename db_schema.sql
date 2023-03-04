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

CREATE TABLE IF NOT EXISTS profileDetails (
    image_path TEXT NOT NULL, 
    job_title TEXT NOT NULL,
    current_location TEXT NOT NULL,
    about TEXT NOT NULL,
    phone_no VARCHAR(15),
    more_about TEXT,
    status TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS skillDetails (
    skill_id INTEGER PRIMARY KEY AUTOINCREMENT,
    skill_name TEXT NOT NULL,
    summary TEXT NOT NULL,
    more_detail TEXT NOT NULL,
    visibility  VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS awardDetails (
    award_id INTEGER PRIMARY KEY AUTOINCREMENT,
    award_name TEXT NOT NULL,
    summary TEXT NOT NULL,
    more_detail TEXT NOT NULL,
    visibility  VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS educationDetails (
    education_id INTEGER PRIMARY KEY AUTOINCREMENT,
    education_name TEXT NOT NULL,
    summary TEXT NOT NULL,
    more_detail TEXT NOT NULL,
    visibility  VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS careerDetails (
    career_id INTEGER PRIMARY KEY AUTOINCREMENT,
    career_name TEXT NOT NULL,
    summary TEXT NOT NULL,
    more_detail TEXT NOT NULL,
    visibility  VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);

CREATE TABLE IF NOT EXISTS projectDetails (
    image_path TEXT NOT NULL,
    project_id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    subtitle TEXT NOT NULL,
    detail TEXT NOT NULL,
    visibility  VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES loginDetails(user_id)
);


--title, sub title, content, author name(first name + last name), status(published/ draft), date of publish if published, likes


--insert default data (if necessary here)
INSERT INTO loginDetails ("email", "first_name", "last_name", "password") VALUES( "janedoe@gmail.com", "Jane", "Doe", "JD");

INSERT INTO profileDetails ("image_path", "job_title", "current_location", "about", "phone_no", "more_about", "status", "user_id") 
VALUES( "/images/profile.png",
        "Back-End Developer", 
        "New York", 
        "Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptate, reiciendis perspiciatis praesentium nemo asperiores blanditiis labore odio soluta quod quae sed, dicta suscipit, at dolorum iure excepturi adipisci distinctio? reiciendis perspiciatis praesentium nemo asperiores blanditiis labore odio soluta quod quae sed, dicta suscipit, at dolorum iure excepturi adipisci distinctio?", 
        "+92234567890", 
        "I am a skilled and experienced full stack developer with a passion for creating innovative and scalable web applications. With a strong background in both front-end and back-end development, I am proficient in a wide range of programming languages and frameworks, including JavaScript, Python, Ruby on Rails, and React.
                In my previous role as a full stack developer at ABC Company, I was responsible for designing and
                building new features for the company's web platform, as well as maintaining and optimizing existing
                features. I worked closely with the product and design teams to ensure that the platform was
                user-friendly and intuitive. I also led a team of junior developers, providing mentorship and guidance
                as needed.
                In addition to my technical skills, I am a proactive and collaborative team player who is able to
                effectively communicate and work with cross-functional teams. I am always seeking new challenges and
                opportunities to learn and grow as a developer. I am excited to bring my skills and experience to a new
                company and contribute to the success of a dynamic and innovative team", 
        "public", 
        1);

INSERT INTO skillDetails ("skill_name", "summary", "more_detail", "visibility", "user_id") VALUES( "Express", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "public", 1);
INSERT INTO awardDetails ("award_name", "summary", "more_detail", "visibility", "user_id") VALUES( "Grammy", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "public", 1);
INSERT INTO educationDetails ("education_name", "summary", "more_detail", "visibility", "user_id") VALUES( "B.Sc. CS", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "public", 1);
INSERT INTO educationDetails ("education_name", "summary", "more_detail", "visibility", "user_id") VALUES( "B.Sc. CS", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "private", 1);
INSERT INTO careerDetails ("career_name", "summary", "more_detail", "visibility", "user_id") VALUES( "Web Developer", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "public", 1);
INSERT INTO projectDetails ("image_path", "title", "subtitle", "detail", "visibility", "user_id") VALUES( "/images/project.jpeg", "Qualia", "Project subtitle", "This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.", "public", 1);


COMMIT;

