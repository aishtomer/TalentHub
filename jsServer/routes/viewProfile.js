const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
var user_id = 1;

// listen to a get request on '/' route
router.get("/", (req, res) => {
    global.db.get("SELECT loginDetails.user_id, loginDetails.email, loginDetails.first_name, loginDetails.last_name, profileDetails.image_path, profileDetails.job_title, profileDetails.current_location, profileDetails.about, profileDetails.phone_no, profileDetails.more_about, profileDetails.status FROM loginDetails INNER JOIN profileDetails ON loginDetails.user_id = profileDetails.user_id WHERE loginDetails.user_id = ?;", [user_id], 
        function (err, profileDetails) {
            if (err) {
                console.log(err);
            } else {
                global.db.all(`SELECT * FROM skillDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, skillRows) {
                    if (err) {
                        next(err);
                    } else {
                        global.db.all(`SELECT * FROM awardDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, awardRows) {
                            if (err) {
                                next(err);
                            } else {
                                global.db.all(`SELECT * FROM educationDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, educationRows) {
                                    if (err) {
                                        next(err);
                                    } else {
                                        global.db.all(`SELECT * FROM careerDetails WHERE user_id = ? AND visibility = 'public'`, [user_id], function (err, careerRows) {
                                            if (err) {
                                                next(err);
                                            } else {
                                                // query the database to select the row from blogSettings table where user_id matches the current user's id
                                                global.db.all("SELECT * FROM projectDetails WHERE user_id = ? AND visibility = 'public'", [user_id], function (err, projectRows) {
                                                    if (err) {
                                                        next(err);
                                                    } else {
                                                        // This renders the author-home page and passes in the draft articles, published articles and blog 
                                                        // details as variables to be used in the ejs template
                                                        console.log();
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