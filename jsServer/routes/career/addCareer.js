const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;


router.get("/", (req, res) => {
    // render the addCareer page
    res.render("addCareer");
});


router.post("/", (req, res) => {

    // extract data from the request body
    const career_name = req.body.career_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // determine visibility based on whether the make_public checkbox is checked or not
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }

    // insert career details into the database
    global.db.run("INSERT INTO careerDetails (career_name, summary, more_detail, visibility, user_id) VALUES (?, ?, ?, ?, ?)", [career_name, summary, more_detail, visible, user_id], function (err) {
        if (err) {
            next(err);
        }
    });

    // redirect to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
