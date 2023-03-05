const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;

// listen to a get request on '/' route
router.get("/", (req, res) => {
    // Retrieving profile details of the user with user_id
    global.db.get("SELECT loginDetails.user_id, loginDetails.email, loginDetails.first_name, loginDetails.last_name, profileDetails.image_path, profileDetails.job_title, profileDetails.current_location, profileDetails.about, profileDetails.phone_no, profileDetails.more_about, profileDetails.status FROM loginDetails INNER JOIN profileDetails ON loginDetails.user_id = profileDetails.user_id WHERE loginDetails.user_id = ?;", [user_id], 
        function (err, profileDetails) {
            if (err) {
                console.log(err);
            } else {
                // Retrieving skill details of the user with user_id and visibility as public
                global.db.all(`SELECT * FROM skillDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, skillRows) {
                    if (err) {
                        // If error is encountered, the error message is passed to the next middleware function
                        next(err);  
                    } else {
                        // Retrieving award details of the user with user_id and visibility as public
                        global.db.all(`SELECT * FROM awardDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, awardRows) {
                            if (err) {
                                // If error is encountered, the error message is passed to the next middleware function
                                next(err);
                            } else {
                                // Retrieving education details of the user with user_id and visibility as public
                                global.db.all(`SELECT * FROM educationDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, educationRows) {
                                    if (err) {
                                        // If error is encountered, the error message is passed to the next middleware function
                                        next(err);
                                    } else {
                                        // Retrieving career details of the user with user_id and visibility as public
                                        global.db.all(`SELECT * FROM careerDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, careerRows) {
                                            if (err) {
                                                // If error is encountered, the error message is passed to the next middleware function
                                                next(err);
                                            } else {
                                                // Retrieving project details of the user with user_id and visibility as public
                                                global.db.all("SELECT * FROM projectDetails WHERE user_id = ? AND visibility = 'public'", [user_id], function (err, projectRows) {
                                                    if (err) {
                                                        // If error is encountered, the error message is passed to the next middleware function
                                                        next(err);
                                                    } else {
                                                        // Render the viewProfile template with the retrieved data as parameters
                                                        res.render("viewProfile", {profileDetailRows: profileDetails, skillDetailRows: skillRows, awardDetailRows : awardRows, educationDetailRows : educationRows, careerDetailRows : careerRows, projectDetailRows : projectRows});
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            }
    });
});



// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;