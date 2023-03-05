const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
const multer = require('multer');   // import multer package
const path = require('path');   // import path package
const fs = require('fs');   // import fs package
var user_id = 1;

// Set up multer storage configuration for file uploads
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, 'public/uploads')
    },
    filename: function (req, file, cb) {
        // Append a unique suffix to each uploaded file name
        const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9)
        cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname))
    }
});

// Create an instance of multer with the defined storage configuration
const upload = multer({ storage: storage });

// listen to a get request on '/' route
router.get("/", (req, res) => {
    // Query the database for the user's profile data
    global.db.get("SELECT loginDetails.user_id, loginDetails.email, loginDetails.first_name, loginDetails.last_name, profileDetails.job_title, profileDetails.current_location, profileDetails.about, profileDetails.phone_no, profileDetails.more_about, profileDetails.status FROM loginDetails INNER JOIN profileDetails ON loginDetails.user_id = profileDetails.user_id WHERE loginDetails.user_id = ?;", [user_id], 
        function (err, data) {
            if (err) {
                // Handle any errors that occur during the query
                console.log(err);
            } else {
                // Render the editProfileHeader.ejs template with the retrieved data
                res.render("editProfileHeader.ejs", {headerData: data});
            }
    });
});


// Listen to a POST request on the '/' route
router.post('/', upload.single('profileImage'), function(req, res) {
    // Retrieve the values from the submitted form data
    const profileImage = req.file ? "/uploads/" + req.file.filename : req.body.defaultImage;
    const firstName = req.body.first_name;
    const lastName = req.body.last_name;
    const jobTitle = req.body.job_title;
    const currentLocation = req.body.current_location;
    const phoneNumber = req.body.phone_no;
    const about = req.body.about;
  
    // Get the existing profile details for the user
    const getProfileQuery = "SELECT * FROM profileDetails WHERE user_id=?";
    global.db.get(getProfileQuery, [user_id], function(err, row) {
        if (err) {
            // Handle any errors that occur during the query
            console.error(err);
            return res.status(500).send("Internal server error");
        }
      
        if (!row) {
            // User profile doesn't exist in database
            return res.status(404).send("Profile not found");
        }

        // Update the user's profile details in the database based on the form data submitted by the user.
        if (profileImage !== undefined){
            // If a new profile image is uploaded, update the image path and other details in the database using an SQL query
            var updateProfileQuery = "UPDATE profileDetails SET image_path=?, job_title=?, current_location=?, phone_no=?, about=? WHERE user_id=?";
            global.db.run(updateProfileQuery, [profileImage, jobTitle, currentLocation, phoneNumber, about, user_id], function(err) {
                if (err) {
                    // If there is an error, log it and return an error response with status code 500
                    console.error(err);
                    return res.status(500).send("Internal server error");
                }
            });

            // If the user had a previous profile image that wasn't the default image, delete the old image file
            if (row.image_path !== "/images/profile.png") {
                fs.unlink("public" + row.image_path, function(err) {
                    if (err) {
                        // If there is an error deleting the old image file, log it but don't return an error response
                        console.error(err);
                    }
                });
            }
        } else {
            // If no new profile image is uploaded, update the user's other details in the database using an SQL query
            var updateProfileQuery = "UPDATE profileDetails SET job_title=?, current_location=?, phone_no=?, about=? WHERE user_id=?";
            global.db.run(updateProfileQuery, [jobTitle, currentLocation, phoneNumber, about, user_id], function(err) {
                if (err) {
                    // If there is an error, log it and return an error response with status code 500
                    console.error(err);
                    return res.status(500).send("Internal server error");
                }
            });
        }

        // Update the user's first name and last name in the loginDetails table using an SQL query
        var updateProfileQuery = "UPDATE loginDetails SET first_name=?, last_name=? WHERE user_id=?";
        global.db.run(updateProfileQuery, [firstName, lastName, user_id], function(err) {
            if (err) {
                // If there is an error, log it and return an error response with status code 500
                console.error(err);
                return res.status(500).send("Internal server error");
            }
            // If the update is successful, redirect the user to their updated profile page
            res.redirect('/edit');
        });
    });
  });
  
  

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;