const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
let user_id = 1;


router.get("/", (req, res) => {
    global.db.get("SELECT more_about FROM profileDetails WHERE user_id = ?", [user_id], function (err, row) {
        if (err) {
            console.log(err);
        } else {
            res.render("editMoreAbout", {aboutData: row});
        }
    });
});


router.post("/", (req, res) => {
    const more_about = req.body.more_about;

    global.db.run("UPDATE profileDetails SET more_about = ? WHERE user_id = ?", [more_about, user_id], function (err) {
        if (err) {
            next(err);
        }
    });
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;
