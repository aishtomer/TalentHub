const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;
// get request to edit-draft page
router.get("/", (req, res) => {
    res.render("addAward");
});

// post request to edit-draft page
router.post("/", (req, res) => {
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
    global.db.run("INSERT INTO awardDetails (award_name, summary, more_detail, visibility, user_id) VALUES (?, ?, ?, ?, ?)", [award_name, summary, more_detail, visible, user_id], function (err) {
        if (err) {
            next(err);
        }
    });
    // redirect to author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
