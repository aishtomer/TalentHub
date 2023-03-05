const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


// Handle GET request
router.get("/", (req, res) => {
    // get the project ID from the request's query parameters
    let project_id = req.query.project_id;

    // delete the project from the database using its ID
    global.db.run("DELETE FROM projectDetails WHERE project_id = ?", [project_id], function (err) {
        if (err) {
            console.log(err);
            next(err);
        }
    });

    // redirect to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;