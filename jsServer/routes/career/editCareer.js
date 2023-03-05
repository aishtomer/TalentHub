const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


router.get("/", (req, res) => {

    let career_id = req.query.career_id;    // get the career_id from the query string
    req.session.career_id = career_id;  // store the career_id in the session object

    // fetch the data of a specific career from the database
    global.db.get("SELECT * FROM careerDetails WHERE career_id = ?", [career_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // render the editCareer template with the fetched data
            res.render("editCareer", {careerData: row});
        }
    });
});


router.post("/", (req, res) => {

    // retrieve the career_id from the session object
    let career_id = req.session.career_id;

    // retrieve form data
    const career_name = req.body.career_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;

    // set visibility based on the value of make_public
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }

    // update the career data in the database
    global.db.run("UPDATE careerDetails SET career_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE career_id = ?", [career_name, summary, more_detail, visible, career_id], function (err) {
        if (err) {
            next(err);
        }
    });

    // redirect to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
