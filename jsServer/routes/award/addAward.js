const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;


// get request
router.get("/", (req, res) => {
    // Render the addAward page
    res.render("addAward");
});

// post request
router.post("/", (req, res) => {
    
    // Extract the award details from the request body
    const award_name = req.body.award_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // Check if the award should be visible to everyone or only the user
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
    

    // Insert the award into the database
    global.db.run("INSERT INTO awardDetails (award_name, summary, more_detail, visibility, user_id) VALUES (?, ?, ?, ?, ?)", [award_name, summary, more_detail, visible, user_id], function (err) {
        if (err) {
            // If an error occurs, pass it to the error handler
            next(err);
        }
    });
    
    // Redirect the user to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
