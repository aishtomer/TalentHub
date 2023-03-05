// including modules in the app
const express = require('express'); // importing express module for creating the server
const bodyParser = require('body-parser');  // importing body-parser middleware for parsing incoming request bodies
const port = 3000;  // defining the port number on which the server listens
const multer = require('multer');   // importing multer middleware for handling file uploads
const path = require('path');   // importing path module for working with file paths   
const fs = require('fs');   // importing file system module for working with files
const session = require('express-session'); // importing express-session middleware for creating secure session
const sqlite3 = require('sqlite3').verbose();   // importing sqlite3 module for database connectivity

// creating an instance of express application
const app = express();

// using body-parser middleware to parse URL-encoded request bodies
app.use(bodyParser.urlencoded({ extended: true }));

// Use express-session to create a secure session to store user information
app.use(session({
    // setting the secret key for session
    secret: 'your_secret_key',
    // setting resave to false to prevent session from being saved on every request
    resave: false,
    // setting saveUninitialized to true to save uninitialized session objects
    saveUninitialized: true
}));

// Open a connection to the database and store the connection in the global namespace
// creating a connection to the database
global.db = new sqlite3.Database('../database.db',function(err){
    if(err){
        console.error(err);
        // exiting the process if connection cannot be established
        process.exit(1); 
    }else{
        // logging a message if database connection is successful
        console.log("Database connected");
        // setting foreign key constraints in SQLite
        global.db.run("PRAGMA foreign_keys=ON"); 
    }
});

// Serve static files from the 'public' directory
app.use(express.static('public'));

// setting the views directory for rendering ejs templates
app.set('views', [  __dirname + '/views', 
                    __dirname + '/views/awards',
                    __dirname + '/views/career',
                    __dirname + '/views/education',
                    __dirname + '/views/project',
                    __dirname + '/views/skill']);

/**---------------------------------------------------------------------------------------- */
/** Import Various Routes serving the application functionality */

/**------------------------------------------------------------ */
/** VIEW PROFILE PAGE */

// using viewProfileRoute for rendering the view profile page
const viewProfileRoute= require('./routes/viewProfile');
app.use('/view', viewProfileRoute); 

/**----------------------------------------------------------- */
/** EDIT PROFILE PAGE */

// using editProfileRoute for rendering the edit profile page
const editProfileRoute= require('./routes/editProfile');
app.use('/edit', editProfileRoute); 

// using editProfileHeaderRoute for rendering the edit profile header page
const editProfileHeaderRoute= require('./routes/editProfileHeader');
app.use('/edit-header', editProfileHeaderRoute); 

// using editMoreAboutRoute for rendering the edit more about page
const editMoreAboutRoute= require('./routes/editMoreAbout');
app.use('/edit-about', editMoreAboutRoute);

// -------------SKILL REALTED ROUTES-----------//

// using editSkillRoute for rendering the edit skill page
const editSkillRoute= require('./routes/skill/editSkill');
app.use('/edit-skill', editSkillRoute);

// using addSkillRoute for rendering the add skill page
const addSkillRoute= require('./routes/skill/addSkill');
app.use('/add-skill', addSkillRoute);

// using deleteSkillRoute for rendering the delete skill page
const deleteSkillRoute= require('./routes/skill/deleteSkill');
app.use('/delete-skill', deleteSkillRoute);


// -------------AWARD REALTED ROUTES-----------//

// using editAwardRoute for rendering the edit award page
const editAwardRoute= require('./routes/award/editAward');
app.use('/edit-award', editAwardRoute);

// using addAwardRoute for rendering the add award page
const addAwardRoute= require('./routes/award/addAward');
app.use('/add-award', addAwardRoute);

// using deleteAwardRoute for rendering the delete award page
const deleteAwardRoute= require('./routes/award/deleteAward');
app.use('/delete-award', deleteAwardRoute);

// -------------PROJECT REALTED ROUTES-----------//

// using editProjectRoute for rendering the edit project page
const editProjectRoute= require('./routes/project/editProject');
app.use('/edit-project', editProjectRoute);

// using addProjectRoute for rendering the add project page
const addProjectRoute= require('./routes/project/addProject');
app.use('/add-project', addProjectRoute);

// using deleteProjectRoute for rendering the delete project page
const deleteProjectRoute= require('./routes/project/deleteProject');
app.use('/delete-project', deleteProjectRoute);

// -------------EDUCATION REALTED ROUTES-----------//

// using editEducationRoute for rendering the edit education page
const editEducationRoute= require('./routes/education/editEducation');
app.use('/edit-education', editEducationRoute);

// using addEducationRoute for rendering the add education page
const addEducationRoute= require('./routes/education/addEducation');
app.use('/add-education', addEducationRoute);

// using deleteEducationRoute for rendering the delete education page
const deleteEducationRoute= require('./routes/education/deleteEducation');
app.use('/delete-education', deleteEducationRoute);

// -------------CAREER REALTED ROUTES-----------//

// using editCareerRoute for rendering the edit career page
const editCareerRoute= require('./routes/career/editCareer');
app.use('/edit-career', editCareerRoute);

// using addCareerRoute for rendering the add career page
const addCareerRoute= require('./routes/career/addCareer');
app.use('/add-career', addCareerRoute);

// using deleteCareerRoute for rendering the delete career page
const deleteCareerRoute= require('./routes/career/deleteCareer');
app.use('/delete-career', deleteCareerRoute);


/**------------------------------------------------------------------------------ */
// Use ejs as the view engine
app.set('view engine', 'ejs');


// sets up a listener for the app on a port 300 and log a message to the console indicating that the 
// server is running and on which port it can be accessed.
app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})

