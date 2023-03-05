const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// get request to edit-draft page
router.get("/", (req, res) => {
    // get the article_id from the url query
    let career_id = req.query.career_id;
    req.session.career_id = career_id;

    // query the articleRecords table for the row where article_id = article_id
    global.db.get("SELECT * FROM careerDetails WHERE career_id = ?", [career_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // render the edit-draft page and passing the data of the selected article
            res.render("editCareer", {careerData: row});
        }
    });
});

// post request to edit-draft page
router.post("/", (req, res) => {
    // get the article_id from the session
    let career_id = req.session.career_id;

    // get title, subtitle and content of article from request body
    const career_name = req.body.career_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }

    // update the row in the articleRecords table where article_id = article_id with the new provided data
    global.db.run("UPDATE careerDetails SET career_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE career_id = ?", [career_name, summary, more_detail, visible, career_id], function (err) {
        if (err) {
            next(err);
        }
    });
    // redirect to author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
