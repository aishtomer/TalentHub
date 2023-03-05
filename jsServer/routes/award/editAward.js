const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// get request to edit-draft page
router.get("/", (req, res) => {
    // get the article_id from the url query
    let award_id = req.query.award_id;
    req.session.award_id = award_id;

    // query the articleRecords table for the row where article_id = article_id
    global.db.get("SELECT * FROM awardDetails WHERE award_id = ?", [award_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // render the edit-draft page and passing the data of the selected article
            res.render("editAward", {awardData: row});
        }
    });
});

// post request to edit-draft page
router.post("/", (req, res, next) => {
    // get the article_id from the session
    let award_id = req.session.award_id;

    // get title, subtitle and content of article from request body
    const award_name = req.body.award_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
    
    // update the row in the articleRecords table where article_id = article_id with the new provided data
    global.db.run("UPDATE awardDetails SET award_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE award_id = ?", [award_name, summary, more_detail, visible, award_id], function (err) {
        if (err) {
            console.log(err)
            next(err);
        }
    });
    // redirect to author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
