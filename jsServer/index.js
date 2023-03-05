// including modules in the app
const express = require('express');
const bodyParser = require('body-parser');
const port = 3000;
const multer = require('multer');
const path = require('path');
const fs = require('fs');
const session = require('express-session');
const sqlite3 = require('sqlite3').verbose();
const app = express();

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));

// Use express-session to create a secure session to store user information
app.use(session({
    secret: 'your_secret_key',
    resave: false,
    saveUninitialized: true
}));

// Open a connection to the database and store the connection in the global namespace
global.db = new sqlite3.Database('../database.db',function(err){
    if(err){
        console.error(err);
        process.exit(1); //Bail out we can't connect to the DB
    }else{
        console.log("Database connected");
        global.db.run("PRAGMA foreign_keys=ON"); //This tells SQLite to pay attention to foreign key constraints
    }
});

// Serve static files from the 'public' directory
app.use(express.static('public'));
app.set('views', [  __dirname + '/views', 
                    __dirname + '/views/awards',
                    __dirname + '/views/career',
                    __dirname + '/views/education',
                    __dirname + '/views/project',
                    __dirname + '/views/skill']);

/**---------------------------------------------------------------------------------------- */
/** Import Various Routes serving the application functionality */

/** USERS */
const viewProfileRoute= require('./routes/viewProfile');
app.use('/view', viewProfileRoute);

const editProfileRoute= require('./routes/editProfile');
app.use('/edit', editProfileRoute);

const editProfileHeaderRoute= require('./routes/editProfileHeader');
app.use('/edit-header', editProfileHeaderRoute);

const editSkillRoute= require('./routes/skill/editSkill');
app.use('/edit-skill', editSkillRoute);

const addSkillRoute= require('./routes/skill/addSkill');
app.use('/add-skill', addSkillRoute);

const deleteSkillRoute= require('./routes/skill/deleteSkill');
app.use('/delete-skill', deleteSkillRoute);

const editAwardRoute= require('./routes/award/editAward');
app.use('/edit-award', editAwardRoute);

const addAwardRoute= require('./routes/award/addAward');
app.use('/add-award', addAwardRoute);

const deleteAwardRoute= require('./routes/award/deleteAward');
app.use('/delete-award', deleteAwardRoute);

const editProjectRoute= require('./routes/project/editProject');
app.use('/edit-project', editProjectRoute);

const addProjectRoute= require('./routes/project/addProject');
app.use('/add-project', addProjectRoute);

const deleteProjectRoute= require('./routes/project/deleteProject');
app.use('/delete-project', deleteProjectRoute);

const editEducationRoute= require('./routes/education/editEducation');
app.use('/edit-education', editEducationRoute);

const addEducationRoute= require('./routes/education/addEducation');
app.use('/add-education', addEducationRoute);

const deleteEducationRoute= require('./routes/education/deleteEducation');
app.use('/delete-education', deleteEducationRoute);

const editCareerRoute= require('./routes/career/editCareer');
app.use('/edit-career', editCareerRoute);

const addCareerRoute= require('./routes/career/addCareer');
app.use('/add-career', addCareerRoute);

const deleteCareerRoute= require('./routes/career/deleteCareer');
app.use('/delete-career', deleteCareerRoute);

const editMoreAboutRoute= require('./routes/editMoreAbout');
app.use('/edit-about', editMoreAboutRoute);


/**------------------------------------------------------------------------------ */
// Use ejs as the view engine
app.set('view engine', 'ejs');


// sets up a listener for the app on a port 300 and log a message to the console indicating that the 
// server is running and on which port it can be accessed.
app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})

