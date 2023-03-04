const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
let user_id = 1;

// get request to edit-draft page
router.get("/", (req, res) => {
    // query the articleRecords table for the row where article_id = article_id
    global.db.get("SELECT more_about FROM profileDetails WHERE user_id = ?", [user_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            // render the edit-draft page and passing the data of the selected article
            res.render("editMoreAbout", {aboutData: row});
        }
    });
});

// post request to edit-draft page
router.post("/", (req, res) => {
    // get title, subtitle and content of article from request body
    const more_about = req.body.more_about;

    // update the row in the articleRecords table where article_id = article_id with the new provided data
    global.db.run("UPDATE profileDetails SET more_about = ? WHERE user_id = ?", [more_about, user_id], function (err) {
        if (err) {
            next(err);
        }
    });
    // redirect to author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
