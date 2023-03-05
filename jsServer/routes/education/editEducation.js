const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


// Route to render the page to edit education details
router.get("/", (req, res) => {

    let education_id = req.query.education_id;  // Get the education_id from the query string
    req.session.education_id = education_id;    // Store education_id in session

    // Retrieve education data from the database
    global.db.get("SELECT * FROM educationDetails WHERE education_id = ?", [education_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // Render editEducation page with educationData object
            res.render("editEducation", {educationData: row});
        }
    });
});


// Route to update education details in the database
router.post("/", (req, res) => {

    // Retrieve education_id from session
    let education_id = req.session.education_id;

    // Retrieve education details from request body
    const education_name = req.body.education_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // Determine visibility based on make_public field
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
    
    // Update education details in database
    global.db.run("UPDATE educationDetails SET education_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE education_id = ?", [education_name, summary, more_detail, visible, education_id], function (err) {
        if (err) {
            next(err);
        }
    });
    
    // Redirect to edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
