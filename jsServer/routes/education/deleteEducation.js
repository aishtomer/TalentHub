const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


// Handle HTTP GET requests to the root URL
router.get("/", (req, res) => {
    
    // get the education_id from the query string
    let education_id = req.query.education_id;
    
    // Delete education details with the given education_id from the database
    global.db.run("DELETE FROM educationDetails WHERE education_id = ?", [education_id], function (err) {
        if (err) {
            console.log(err);   // Log error if there is any
            next(err);
        } 
    });
    
    // Redirect to the edit page
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;