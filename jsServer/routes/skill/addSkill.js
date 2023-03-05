const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;

// Handle GET requests to the '/' route to render the addSkill view
router.get("/", (req, res) => {
    res.render("addSkill");
});

// Handle POST requests to the '/' route to add a new skill to the user's profile
router.post("/", (req, res) => {
    // Extract data from the request body
    const skill_name = req.body.skill_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // Determine the visibility of the skill
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }

    // Insert the skill into the database
    global.db.run("INSERT INTO skillDetails (skill_name, summary, more_detail, visibility, user_id) VALUES (?, ?, ?, ?, ?)", [skill_name, summary, more_detail, visible, user_id], function (err) {
        if (err) {
            next(err);
        }
    });

    // Redirect the user to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
