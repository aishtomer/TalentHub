const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package


// Handle HTTP GET request
router.get("/", (req, res) => {
    
    // Get the award ID from the request query string
    let award_id = req.query.award_id;
    
    // Delete the award from the database with the specified ID
    global.db.run("DELETE FROM awardDetails WHERE award_id = ?", [award_id], function (err) {
        if (err) {
            console.log(err);   // Log any errors that occur
            next(err);  // Pass the error to the next middleware function
        } 
    });
    
    // Redirect to the edit page after deleting the award
    res.redirect('edit');
});

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;