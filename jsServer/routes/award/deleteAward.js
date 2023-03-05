const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// GET request to delete a draft
router.get("/", (req, res) => {
    // get the award_id from the query string
    let award_id = req.query.award_id;
    // delete the row from the articleRecords table where award_id = award_id
    global.db.run("DELETE FROM awardDetails WHERE award_id = ?", [award_id], function (err) {
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