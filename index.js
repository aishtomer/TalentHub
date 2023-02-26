// including modules in the app
const express = require('express');
const bodyParser = require('body-parser');
const port = 3000;
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
global.db = new sqlite3.Database('./database.db',function(err){
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

/**---------------------------------------------------------------------------------------- */
/** Import Various Routes serving the application functionality */

/** USERS */
const usersDetails= require('./routes/user');
app.use('/', usersDetails);


/**------------------------------------------------------------------------------ */
// Use ejs as the view engine
app.set('view engine', 'ejs');

// Landing Page
app.get('/', (req, res) => {
    res.render('user');
});


// sets up a listener for the app on a port 300 and log a message to the console indicating that the 
// server is running and on which port it can be accessed.
app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})

