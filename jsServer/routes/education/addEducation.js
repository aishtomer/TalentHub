const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;


// Handle GET request for the '/' route
router.get("/", (req, res) => {
    // Render the 'addEducation' view
    res.render("addEducation");
});


// Handle POST request for the '/' route
router.post("/", (req, res) => {

    // Get data from the request body
    const education_name = req.body.education_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // Set visibility based on the value of the 'make_public' checkbox
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }

    // Insert data into the educationDetails table
    global.db.run("INSERT INTO educationDetails (education_name, summary, more_detail, visibility, user_id) VALUES (?, ?, ?, ?, ?)", [education_name, summary, more_detail, visible, user_id], function (err) {
        if (err) {
            // Call the error handling middleware if there is an error
            next(err);
        }
    });

    // Redirect to the 'edit' route
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
