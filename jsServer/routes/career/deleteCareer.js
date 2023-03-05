const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


router.get("/", (req, res) => {
    // get the career_id from the query string
    let career_id = req.query.career_id;

    // delete the row from the careerDetails table where career_id = career_id
    global.db.run("DELETE FROM careerDetails WHERE career_id = ?", [career_id], function (err) {
        if (err) {
            console.log(err);
            next(err);
        }
    });
    //redirect to the author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;