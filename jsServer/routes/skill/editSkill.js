const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// get request to edit-draft page
router.get("/", (req, res) => {
    // get the article_id from the url query
    let skill_id = req.query.skill_id;
    req.session.skill_id = skill_id;

    // query the articleRecords table for the row where article_id = article_id
    global.db.get("SELECT * FROM skillDetails WHERE skill_id = ?", [skill_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // render the edit-draft page and passing the data of the selected article
            res.render("editSkills", {skillData: row});
        }
    });
});

// post request to edit-draft page
router.post("/", (req, res) => {
    // get the article_id from the session
    let skill_id = req.session.skill_id;

    // get title, subtitle and content of article from request body
    const skill_name = req.body.skill_name;
    const summary = req.body.summary;
    const more_detail = req.body.more_detail;
    const make_public = req.body.make_public;
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
    console.log(req.body);
    // update the row in the articleRecords table where article_id = article_id with the new provided data
    global.db.run("UPDATE skillDetails SET skill_name = ?, summary = ?, more_detail = ?, visibility = ? WHERE skill_id = ?", [skill_name, summary, more_detail, visible, skill_id], function (err) {
        if (err) {
            next(err);
        }
    });
    // redirect to author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
