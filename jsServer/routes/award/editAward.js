const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


// Route for displaying the form for editing an award
router.get("/", (req, res) => {

    let award_id = req.query.award_id;  // get award_id from query parameter
    req.session.award_id = award_id;    // store award_id in session for future use

    // Retrieve award data from database
    global.db.get("SELECT * FROM awardDetails WHERE award_id = ?", [award_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // Render the edit award form with the award data
            res.render("editAward", {awardData: row});
        }
    });
});


// Route for submitting the form for editing an award
router.post("/", (req, res, next) => {
    
    // get award_id from session
    let award_id = req.session.award_id;

    // Get the updated award details from the request body
    const award_name = req.body.award_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
    
    // Update the award details in the database
    global.db.run("UPDATE awardDetails SET award_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE award_id = ?", [award_name, summary, more_detail, visible, award_id], function (err) {
        if (err) {
            console.log(err)
            next(err);
        }
    });
    
    // redirect to the award editing page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
