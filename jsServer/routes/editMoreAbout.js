const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
let user_id = 1;

// listen to a get request on '/' route
router.get("/", (req, res) => {
    // Query the database to retrieve the "more about" data of the user with the given user_id
    global.db.get("SELECT more_about FROM profileDetails WHERE user_id = ?", [user_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // Render the "editMoreAbout" view with the retrieved data
            res.render("editMoreAbout", {aboutData: row});
        }
    });
});

// Define a route to handle the submission of the "more about" form
router.post("/", (req, res) => {
    // Extract the "more about" data from the request body
    const more_about = req.body.more_about;

    // Update the "more about" data in the database for the user with the given user_id
    global.db.run("UPDATE profileDetails SET more_about = ? WHERE user_id = ?", [more_about, user_id], function (err) {
        if (err) {
            next(err);
        }
    });
    // Redirect the user to the "edit" page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
