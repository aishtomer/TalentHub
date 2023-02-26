const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
const bcrypt = require('bcrypt'); // import bcrypt package
const saltRounds = 10; // Generate a salt with 10 rounds
const salt = bcrypt.genSaltSync(saltRounds); // generate a salt


router.get("/", (req, res) => {
    global.db.all("SELECT user_id, email, first_name, last_name from loginDetails", 
        function (err, users) {
            if (err) {
                console.log(err);
            } else {
                // Render the articles grouped by author to the 'reader-home' page
                res.render("user.ejs", { userDetails: users });
            }
    });
});

router.post("/", (req, res, next) => {
    let email = req.body.email; // Get the email  from the form
    let first_name = req.body.first_name; // Get the first name from the form
    let last_name = req.body.last_name; // Get the last name from the form
    let password = req.body.password; // Get the password from the form

    // Hash the password using the generated salt
    let hashedPassword = bcrypt.hashSync(password, salt);
    
    // query the database for all existing emails
    global.db.all("SELECT email from loginDetails", function(err, rows){
        if (err){
            next(err);
        } else {
            var found = false;
            for (let row of rows){
                // if the email already exists in the database, set found to true
                if (row.email == email){
                    found = true;
                    break;
                }
            }
            // if the email doesn't already exist in the database
            if (!found){
                // insert new user's information into loginDetails table
                global.db.run(
                    "INSERT INTO loginDetails ('email', 'first_name', 'last_name', 'password') VALUES( ?, ?, ?, ?);",
                    [email, first_name, last_name, hashedPassword],
                    function (err) {
                        if (err) {
                            console.log("Fuck!!!!");
                            next(err);
                        } else {
                            // set user_id in the session
                            req.session.user_id = this.lastID;
                        }
                    }
                );
                // redirect user to login page
                res.redirect("/");
            } else {
                res.send("already have an account with this email");
            }
        }
    });
});



// export the router so that it can be used in other parts of the application.
module.exports = router;