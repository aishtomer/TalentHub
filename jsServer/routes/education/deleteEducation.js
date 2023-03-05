const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// GET request to delete a draft
router.get("/", (req, res) => {
    // get the education_id from the query string
    let education_id = req.query.education_id;
    console.log("entered delete");
    // delete the row from the articleRecords table where education_id = education_id
    global.db.run("DELETE FROM educationDetails WHERE education_id = ?", [education_id], function (err) {
        if (err) {
            console.log(err);
            next(err);
        } else {
            // res.redirect("/form?id=" + user_id);
            console.log("deleted a draft");
        }
    });
    //redirect to the author-home page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;