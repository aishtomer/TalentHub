-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 12, 2023 at 07:44 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20320564_talenthub`
--

-- --------------------------------------------------------

--
-- Table structure for table `awardDetails`
--

CREATE TABLE `awardDetails` (
  `award_id` int(11) NOT NULL,
  `award_name` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `more_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `awardDetails`
--

INSERT INTO `awardDetails` (`award_id`, `award_name`, `summary`, `more_detail`, `visibility`, `user_id`) VALUES
(1, 'Best Employee', 'Awarded to the top-performing employee of the years', 'The award includes a bonus and a certificate of achievements', 'Public', 1),
(2, 'Innovative Idea Award', 'Awarded to the employee with the most innovative idea', 'The award includes a cash prize and a plaque', 'Public', 1),
(3, 'Excellence in Customer Service', 'Awarded to the employee who demonstrates exceptional customer service skills', 'The award includes a gift card and a certificate of achievement', 'Public', 4),
(4, 'Teamwork Award', 'Awarded to the team that demonstrates outstanding teamwork and collaboration', 'The award includes a team outing and a trophy', 'Public', 4),
(5, 'Leadership Award', 'Awarded to the employee who demonstrates exceptional leadership skills', 'The award includes a leadership training course and a certificate of achievement', 'Public', 6),
(6, 'Rookie of the Year', 'Awarded to the top-performing new employee', 'The award includes a gift card and a certificate of achievement', 'Public', 4),
(7, 'Salesperson of the Year', 'Awarded to the top-performing salesperson', 'The award includes a commission bonus and a certificate of achievement', 'Public', 4),
(8, 'Community Service Award', 'Awarded to the employee who demonstrates exceptional commitment to community service', 'The award includes a donation to a charity of the winner\'s choice and a certificate of achievement', 'Public', 6),
(9, 'Safety Award', 'Awarded to the team that demonstrates outstanding safety practices and procedures', 'The award includes a safety training course and a plaque', 'Public', 11),
(10, 'Quality Award', 'Awarded to the team that demonstrates outstanding quality in their work', 'The award includes a quality training course and a certificate of achievement', 'Public', 11),
(11, 'Employee of the Year Award', 'This award is given to the most outstanding employee of the year for their exceptional performance and dedication.', 'The award comes with a cash prize of $5000, a certificate of recognition, and a trophy.', 'Private', 1);

-- --------------------------------------------------------

--
-- Table structure for table `careerDetails`
--

CREATE TABLE `careerDetails` (
  `career_id` int(11) NOT NULL,
  `career_name` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `more_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `careerDetails`
--

INSERT INTO `careerDetails` (`career_id`, `career_name`, `summary`, `more_detail`, `visibility`, `user_id`) VALUES
(1, 'Software Engineers', 'Responsible for designing and developing software applications.', 'The role requires experience with programming languages such as Java, Python, and C++ and more', 'Public', 1),
(2, 'Data Analyst', 'Responsible for collecting and analyzing large data sets', 'The role requires experience with data visualization tools such as Tableau or Power BI', 'Public', 2),
(3, 'Graphic Designer', 'Responsible for designing visual content for print and digital media', 'The role requires experience with Adobe Creative Suite and strong design skills', 'Public', 3),
(4, 'Marketing Manager', 'Responsible for developing and implementing marketing strategies', 'The role requires experience with marketing automation tools such as HubSpot or Marketo', 'Public', 4),
(5, 'Human Resources Manager', 'Responsible for managing and overseeing the human resources department', 'The role requires knowledge of labor laws and strong leadership skills', 'Public', 5),
(6, 'Accountant', 'Responsible for managing financial records and preparing tax documents', 'The role requires experience with accounting software such as QuickBooks or Xero', 'Public', 6),
(7, 'Sales Representative', 'Responsible for selling products or services to customers', 'The role requires strong communication and negotiation skills', 'Public', 7),
(8, 'Project Manager', 'Responsible for overseeing projects from start to finish', 'The role requires experience with project management tools such as Asana or Trello', 'Public', 8),
(9, 'Web Developer', 'Responsible for designing and developing websites', 'The role requires experience with front-end and back-end technologies such as HTML, CSS, and JavaScript', 'Public', 9),
(10, 'Content Writer', 'Responsible for creating written content for various media platforms', 'The role requires strong writing and editing skills and knowledge of SEO best practices', 'Public', 10),
(11, 'Software Developer', 'Develops and maintains software applications', 'Software developers use programming languages to create, test and deploy software. They work with teams to solve technical problems, develop new features, and maintain existing software.', 'Private', 1);

-- --------------------------------------------------------

--
-- Table structure for table `educationDetails`
--

CREATE TABLE `educationDetails` (
  `education_id` int(11) NOT NULL,
  `education_name` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `more_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `educationDetails`
--

INSERT INTO `educationDetails` (`education_id`, `education_name`, `summary`, `more_detail`, `visibility`, `user_id`) VALUES
(1, 'Bachelor of Science in Computer Science', 'Completed my BSc in Computer Science from XYZ University.', 'During my studies, I took courses in data structures, algorithms, software engineering, and database systems.', 'Public', 2),
(2, 'Master of Business Administration', 'Graduated with an MBA from ABC Business School.', 'Specialized in finance and entrepreneurship.', 'Public', 3),
(3, 'Bachelor of Arts in English', 'Obtained my BA in English Literature from XYZ College.', 'Focused on Shakespearean literature and poetry.', 'Private', 5),
(4, 'Master of Science in Electrical Engineering', 'Completed my MSc in Electrical Engineering from ABC University.', 'My research focused on the development of wireless communication systems.', 'Public', 2),
(5, 'Associate of Applied Science in Culinary Arts', 'Graduated with an AAS in Culinary Arts from XYZ Community College.', 'I completed courses in cooking techniques, food safety, and nutrition.', 'Public', 7),
(6, 'Doctor of Veterinary Medicine', 'Earned my DVM from ABC University.', 'During my studies, I gained experience working with animals in a variety of settings.', 'Private', 4),
(7, 'Bachelor of Science in Biology', 'Completed my undergraduate studies in Biology at XYZ University.', 'Focused on courses related to genetics, ecology, and evolution.', 'Public', 9),
(8, 'Associate of Applied Science in Web Development', 'Graduated with an AAS in Web Development from ABC College.', 'Learned skills in HTML, CSS, JavaScript, and PHP.', 'Private', 2),
(9, 'Master of Fine Arts in Creative Writing', 'Earned an MFA in Creative Writing from XYZ University.', 'Focused on fiction writing and literary criticism.', 'Public', 10),
(10, 'Degree of Science in Nursing', 'Completed my BSN from ABC University', 'My studies included courses in anatomy, physiology, and patient care', 'Private', 1),
(11, 'Bachelor of Science', 'Undergraduate degree that provides broad education', 'Bachelor of Science is an undergraduate degree that typically provides a broad education in science, math, and technology, and may include specialized coursework in a specific field. It usually takes four years to complete.', 'Public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loginDetails`
--

CREATE TABLE `loginDetails` (
  `user_id` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loginDetails`
--

INSERT INTO `loginDetails` (`user_id`, `email`, `first_name`, `last_name`, `password`) VALUES
(1, 'sarahjones@gmail.com', 'Sarah', 'Jones', '$2y$10$.KSwn1TBW3NKKVc4PnObPeRBbO3AqgzdKOJdSyp.hC.J0Kf4MpHBG'),
(2, 'robert.lee@example.com', 'Robert', 'Lee', '$2y$10$/myzdvIIwvuMwaJogNuIZun9xM1whxS4NlHm1Vveow9St8skHXckq'),
(3, 'emily.kim@example.com', 'Emily', 'Kim', '$2y$10$BhwDC3o0W1x9Wbs5kH.LIeKaTGmtCqHrS8HqYQ1xXgMSaHm8BWcjm'),
(4, 'david.patel@example.com', 'David', 'Patel', '$2y$10$IhOnrMH2ZBsVrOReLCxH/u./rJToKLX33iTpgk7h4XK4/AEDy146y'),
(5, 'jennifer.chen@example.com', 'Jennifer', 'Chen', '$2y$10$TijHdbuL60quHchxHoym3.LXaFeLURnUDmBHK6OM8RO3OvandCezO'),
(6, 'michael.nguyen@example.com', 'Michael', 'Nguyen', '$2y$10$jJGYDsQ4XvdmlY3jScx0HOctMCiYZTOpNYn.b9fck/IpronF91BVC'),
(7, 'samantha.lee@example.com', 'Samantha', 'Lee', '$2y$10$27NR8vc73iESyz8QknD60Oo3R/S6TMdmA/ykjC8.PmS/5LmzizH1e'),
(8, 'john.smith@example.com', 'John', 'Smith', '$2y$10$xuatK0ULvajlv20j7ZJAbuhAf1dq.qeYw3KJANe8FpHIN4c7NzRUu'),
(9, 'lauren.davis@example.com', 'Lauren', 'Davis', '$2y$10$CWX3HBDBJU/e/AsUuSbboevNO2kpxn/OVCKwDqW5YLd6h7wUJej9i'),
(10, 'thomas.brown@example.com', 'Thomas', 'Brown', '$2y$10$oojFQdXNLxZlZPX8IaCtnebVqETBgtgpaYSTtvQtscjzTJoon9BA.'),
(11, 'isabella.sanchez@gmail.com', 'Isabella', 'Sanchez', '$2y$10$G/ISPx.gQb3UwV5KL9sYeuojIUJxWjusNCyZABDPoekqnRkjPZh3y'),
(12, 'tehck@gmail.com', 'Teh', 'Kar Hock', '$2y$10$iZKowjO53NNBIvO7PIRXNeJCPWHemGDa2FB9OT7ntzbE3oSDz8/.e');

-- --------------------------------------------------------

--
-- Table structure for table `projectDetails`
--

CREATE TABLE `projectDetails` (
  `image_path` text COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projectDetails`
--

INSERT INTO `projectDetails` (`image_path`, `project_id`, `title`, `subtitle`, `detail`, `visibility`, `user_id`) VALUES
('phpServer/images/project_images/Help-Scout_s-homepage.png', 1, 'E-commerce Website', 'Online shopping platform', 'Built a responsive e-commerce website using React and Node.js', 'Private', 1),
('phpServer/images/project_images/Blog-post.png', 2, 'Social Media App', 'Connect with friends and family', 'Developed a social media application using React Native and Firebase', 'Public', 1),
('temp.png', 3, 'Project Management System', 'Track tasks and deadlines', 'Created a web-based project management system using PHP and MySQL', 'Public', 2),
('temp.png', 4, 'Mobile Game', 'Endless runner', 'Developed an endless runner game using Unity and C#', 'Private', 2),
('temp.png', 5, 'Online Bookstore', 'Buy and sell books', 'Built an online bookstore using Django and PostgreSQL', 'Public', 3),
('temp.png', 6, 'Fitness Tracker', 'Track workouts and progress', 'Developed a fitness tracking app using Java and Android Studio', 'Private', 3),
('temp.png', 7, 'E-learning Platform', 'Online education portal', 'Created an e-learning platform using Angular and Firebase', 'Public', 4),
('temp.png', 8, 'Travel Blog', 'Share travel experiences', 'Built a travel blog using WordPress and PHP', 'Private', 4),
('temp.png', 9, 'Recipe App', 'Find and share recipes', 'Developed a recipe app using React Native and MongoDB', 'Public', 5),
('temp.png', 10, 'Chat Application', 'Instant messaging', 'Created a chat application using Socket.IO and Node.js', 'Private', 5),
('phpServer/images/project_images/smartGarden.jpeg', 11, 'Smart Garden', 'Automated', 'An automated garden system that uses sensors and machine learning to optimize plant growth', 'Public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skillDetails`
--

CREATE TABLE `skillDetails` (
  `skill_id` int(11) NOT NULL,
  `skill_name` text COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `more_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `visibility` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skillDetails`
--

INSERT INTO `skillDetails` (`skill_id`, `skill_name`, `summary`, `more_detail`, `visibility`, `user_id`) VALUES
(1, 'Programming', 'Proficient in Java and Python', 'I have 5 years of experience in programming and have developed many web applications and software tools', 'Public', 2),
(2, 'Graphic Design', 'Skilled in Adobe Photoshop and Illustrator', 'I have worked as a graphic designer for 3 years and have created various marketing materials and designs for clients', 'Public', 5),
(3, 'Copywriting', 'Experienced in writing SEO-friendly content', 'I have been a freelance copywriter for 2 years and have worked with multiple clients to create engaging and effective content', 'Public', 7),
(4, 'Project Management', 'Certified PMP with 8 years of experience', 'I have managed various projects in industries such as construction, IT, and healthcare', 'Public', 3),
(5, 'Data Analysis', 'Proficient in SQL and Excel', 'I have worked as a data analyst for 4 years and have experience in cleaning, analyzing, and visualizing data', 'Public', 9),
(6, 'Public Speaking', 'Experienced in presenting to large audiences', 'I have given multiple presentations and talks in conferences and events', 'Private', 1),
(7, 'Leadership', 'Managed teams of up to 20 people', 'I have experience in leading and motivating teams to achieve goals and deliver results', 'Public', 10),
(8, 'Digital Marketing', 'Certified in Google Analytics and Adwords', 'I have worked as a digital marketing specialist for 3 years and have experience in SEO, PPC, and social media marketing', 'Public', 8),
(9, 'Sales', 'Experienced in B2B sales', 'I have worked in sales for 5 years and have experience in prospecting, lead generation, and closing deals', 'Public', 4),
(10, 'Customer Service', 'Experienced in handling customer inquiries and complaints', 'I have worked in customer service for 2 years and have experience in resolving issues and providing solutions to customers', 'Public', 6),
(11, 'Web Development', 'Proficient in HTML, CSS, and JavaScript. Experience with front-end frameworks such as React and Angular, as well as back-end technologies such as Node.js and PHP.', 'Developed responsive websites and web applications using modern web technologies. Created custom themes and plugins for content management systems such as WordPress.', 'Public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userDetails`
--

CREATE TABLE `userDetails` (
  `job_position` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `about_myself` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `more_about` text COLLATE utf8_unicode_ci NOT NULL,
  `user_images` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/user_images/user_default_image.png',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userDetails`
--

INSERT INTO `userDetails` (`job_position`, `location`, `contact_no`, `about_myself`, `more_about`, `user_images`, `created_date`, `user_id`) VALUES
('Full Stack Developer', 'Los Angeles, CA', '(555) 555-1234', 'I am a creative and detail-oriented graphic designer with over seven years of high-quality work that meets and exceeds client expectations.', 'As a marketing manager, I develop marketing strategies to increase brand awareness, generate leads, and promote products. I oversee marketing campaigns, analyze data and market trends, and work with cross-functional teams to achieve marketing goals', 'phpServer/images/user_images/user.png', '2023-02-28 00:00:00', 1),
('Software Engineer', 'San Francisco, CA', '(555) 555-5678', 'I\'m a software engineer with a background in computer science. I enjoy developing complex applications and solving challenging problems.', 'As a software engineer, I design, develop, and maintain software applications. I use programming languages and development tools to create new software features, improve software performance, and fix bugs. I work collaboratively with other engineers and stakeholders to ensure successful software development.', 'images/user_images/user_default_image.png', '2023-02-28 00:00:00', 2),
('Graphic Designer', 'Chicago, IL', '(555) 555-9012', 'I\'m a graphic designer with a passion for creating beautiful and impactful designs. I\'m proficient in Adobe Photoshop, Illustrator, and InDesign.', 'As a human resources manager, I oversee HR functions such as hiring, training, and compensation, and manage employee relations. I ensure compliance with employment laws, develop HR policies and procedures, and work with managers to address workplace issues. I also provide guidance and support to employees on HR-related matters.', 'images/user_images/user_default_image.png', '2023-02-28 12:57:46', 3),
('Sales Representative', 'Houston, TX', '(555) 555-3456', 'I\'m a sales representative with a proven track record of driving revenue growth. I\'m passionate about building relationships with clients and exceeding sales targets.', 'As a graphic designer, I create visual designs, such as logos, advertisements, and web layouts, using design software and other tools. I work with clients or employers to understand design needs and preferences, and use my creative skills to develop visually appealing and effective designs.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 4),
('Human Resources Manager', 'Boston, MA', '(555) 555-7890', 'I\'m a human resources manager with a focus on employee engagement and retention. I have experience in recruitment, performance management, and employee relations.', 'As a financial analyst, I analyze financial data to assess investment opportunities, evaluate risks, and provide investment advice. I analyze financial statements, economic data, and market trends to make recommendations to clients or my employer. I also monitor and evaluate investment portfolios to ensure alignment with financial goals.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 5),
('Web Developer', 'Los Angeles, CA', '(555) 555-2345', 'I\'m a web developer with experience in front-end and back-end development. I\'m proficient in HTML, CSS, JavaScript, PHP, and MySQL.', 'As a sales manager, I manage sales teams and implement sales strategies to achieve sales goals. I develop sales plans, train and mentor sales representatives, and monitor sales performance. I also analyze market trends and customer needs to identify new sales opportunities.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 6),
('Social Media Manager', 'Miami, FL', '(555) 555-6789', 'I\'m a social media manager with experience in developing and executing social media strategies. I\'m skilled in creating engaging content, growing social media accounts, and measuring success.', 'As a project manager, I oversee project planning, execution, and monitoring to ensure successful project delivery. I develop project plans, allocate resources, and manage project budgets. I also communicate with stakeholders and team members to ensure project goals and timelines are met.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 7),
('Project Manager', 'Seattle, WA', '(555) 555-0123', 'I\'m a project manager with a focus on delivering projects on time, within budget, and to the satisfaction of stakeholders. I\'m skilled in project planning, risk management, and team management.', 'As an accountant, I prepare financial records and reports, such as balance sheets, income statements, and tax returns. I ensure compliance with accounting standards and regulations, and maintain accurate financial records. I also analyze financial data to identify trends and areas for improvement.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 8),
('Public Relations Specialist', 'Atlanta, GA', '(555) 555-4567', 'I\'m a public relations specialist with experience in media relations, crisis communications, and event planning. I\'m skilled in developing and implementing communication strategies that support business objectives.', 'As a data scientist, I analyze and interpret large amounts of data to identify patterns, trends, and insights. I use statistical analysis, machine learning, and data visualization tools to create actionable insights from complex data sets. I also communicate findings to stakeholders in a clear and concise manner.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 9),
('Financial Analyst', 'Washington, D.C.', '(555) 555-8901', 'I\'m a financial analyst with a focus on financial modeling', 'As a customer service representative, I provide customer support and resolve issues through phone, email, or chat. I handle customer inquiries, complaints, and requests, and ensure customer satisfaction. I also maintain customer records and communicate with other departments to resolve customer issues.', 'images/user_images/user_default_image.png', '2023-02-28 13:01:49', 10),
('Marketing Manager', 'Sydney, Australia', '+61 431 234 567', 'I have extensive experience in developing and implementing marketing strategies for various industries such as technology, healthcare, and education. I am a creative thinker with a passion for data-driven marketing', 'Full Stack Developers should have experience with front-end frameworks like React, Angular, Vue.js and back-end frameworks like Node.js,', 'images/user_images/user_default_image.png', '2023-02-28 15:22:24', 11),
('Full Time Student', 'MY', '+6012-399-5241', 'nothing much', 'nothing much', 'images/user_images/user_default_image.png', '2023-03-11 20:39:32', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awardDetails`
--
ALTER TABLE `awardDetails`
  ADD PRIMARY KEY (`award_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `careerDetails`
--
ALTER TABLE `careerDetails`
  ADD PRIMARY KEY (`career_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `educationDetails`
--
ALTER TABLE `educationDetails`
  ADD PRIMARY KEY (`education_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `loginDetails`
--
ALTER TABLE `loginDetails`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `projectDetails`
--
ALTER TABLE `projectDetails`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `skillDetails`
--
ALTER TABLE `skillDetails`
  ADD PRIMARY KEY (`skill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userDetails`
--
ALTER TABLE `userDetails`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awardDetails`
--
ALTER TABLE `awardDetails`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `careerDetails`
--
ALTER TABLE `careerDetails`
  MODIFY `career_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `educationDetails`
--
ALTER TABLE `educationDetails`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loginDetails`
--
ALTER TABLE `loginDetails`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `projectDetails`
--
ALTER TABLE `projectDetails`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `skillDetails`
--
ALTER TABLE `skillDetails`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `awardDetails`
--
ALTER TABLE `awardDetails`
  ADD CONSTRAINT `awardDetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginDetails` (`user_id`);

--
-- Constraints for table `careerDetails`
--
ALTER TABLE `careerDetails`
  ADD CONSTRAINT `careerDetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginDetails` (`user_id`);

--
-- Constraints for table `educationDetails`
--
ALTER TABLE `educationDetails`
  ADD CONSTRAINT `educationDetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginDetails` (`user_id`);

--
-- Constraints for table `projectDetails`
--
ALTER TABLE `projectDetails`
  ADD CONSTRAINT `projectDetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginDetails` (`user_id`);

--
-- Constraints for table `skillDetails`
--
ALTER TABLE `skillDetails`
  ADD CONSTRAINT `skillDetails_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `loginDetails` (`user_id`);

--
-- Constraints for table `userDetails`
--
ALTER TABLE `userDetails`
  ADD CONSTRAINT `fk_user_login` FOREIGN KEY (`user_id`) REFERENCES `loginDetails` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
