const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// Handle GET requests
router.get("/", (req, res) => {

    let skill_id = req.query.skill_id;  // Get skill_id from query string
    req.session.skill_id = skill_id;    // Store skill_id in session

    // Get skill details from the database
    global.db.get("SELECT * FROM skillDetails WHERE skill_id = ?", [skill_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // Render the editSkills template and pass the skill data to it
            res.render("editSkills", {skillData: row});
        }
    });
});


// Handle POST requests
router.post("/", (req, res) => {

    // Get skill_id from session
    let skill_id = req.session.skill_id;

    // Get skill details from the request body
    const skill_name = req.body.skill_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // Determine skill visibility based on the value of the make_public checkbox
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
    
    // Update the skill details in the database
    global.db.run("UPDATE skillDetails SET skill_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE skill_id = ?", [skill_name, summary, more_detail, visible, skill_id], function (err) {
        if (err) {
            next(err);
        }
    });

    // Redirect to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
