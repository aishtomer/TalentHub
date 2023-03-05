const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// Set up a route to handle GET requests
router.get("/", (req, res) => {

    // Retrieve skill_id from query parameters
    let skill_id = req.query.skill_id;

    // Delete the skill from the database using the skill_id
    global.db.run("DELETE FROM skillDetails WHERE skill_id = ?", [skill_id], function (err) {
        if (err) {
            console.log(err);
            next(err);
        }
    });

    // Redirect the user to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;