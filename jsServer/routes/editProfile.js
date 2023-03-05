const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package

// listen to a get request on '/' route
router.get("/", (req, res) => {
    var user_id = 1;
    // Get profile details for the user with the specified user_id
    global.db.get("SELECT loginDetails.user_id, loginDetails.email, loginDetails.first_name, loginDetails.last_name, profileDetails.image_path, profileDetails.job_title, profileDetails.current_location, profileDetails.about, profileDetails.phone_no, profileDetails.more_about, profileDetails.status FROM loginDetails INNER JOIN profileDetails ON loginDetails.user_id = profileDetails.user_id WHERE loginDetails.user_id = ?;", [user_id], 
        function (err, profileDetails) {
            if (err) {
                console.log(err);
            } else {
                // Get all skill details for the user
                global.db.all(`SELECT * FROM skillDetails WHERE user_id = ?`, [user_id], function (err, skillRows) {
                    if (err) {
                        next(err);
                    } else {
                        // Get all award details for the user
                        global.db.all(`SELECT * FROM awardDetails WHERE user_id = ?`, [user_id], function (err, awardRows) {
                            if (err) {
                                next(err);
                            } else {
                                // Get all education details for the user
                                global.db.all(`SELECT * FROM educationDetails WHERE user_id = ?`, [user_id], function (err, educationRows) {
                                    if (err) {
                                        next(err);
                                    } else {
                                        // Get all career details for the user
                                        global.db.all(`SELECT * FROM careerDetails WHERE user_id = ?`, [user_id], function (err, careerRows) {
                                            if (err) {
                                                next(err);
                                            } else {
                                                // Get all project details for the user
                                                global.db.all("SELECT * FROM projectDetails WHERE user_id = ?", [user_id], function (err, projectRows) {
                                                    if (err) {
                                                        next(err);
                                                    } else {
                                                        // Render the edit profile page with all the retrieved details
                                                        res.render("editProfile.ejs", {profileDetailRows: profileDetails, skillDetailRows: skillRows, awardDetailRows : awardRows, educationDetailRows : educationRows, careerDetailRows : careerRows, projectDetailRows : projectRows});
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

// Define a route to handle the publication form submission
router.post('/', (req, res) => {
    var user_id = 1;
    // Extract the publication status from the request body
    const publication_status = req.body.publication_status;

    // Toggle the publication status in the database
    const newStatus = publication_status === 'public' ? 'private' : 'public';
    global.db.run('UPDATE profileDetails SET status = ? WHERE user_id = ?', [newStatus, user_id], (err) => {
        if (err) {
            console.error(err);
            res.status(500).send('Internal server error');
        } else {
            res.redirect('/edit');
        }
    });
});


// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;