const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
const multer = require('multer');
const path = require('path');
const fs = require('fs');
var user_id = 1;

const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, 'public/uploads')
    },
    filename: function (req, file, cb) {
        const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9)
        cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname))
    }
});

const upload = multer({ storage: storage });

// listen to a get request on '/' route
router.get("/", (req, res) => {
    global.db.get("SELECT loginDetails.user_id, loginDetails.email, loginDetails.first_name, loginDetails.last_name, profileDetails.job_title, profileDetails.current_location, profileDetails.about, profileDetails.phone_no, profileDetails.more_about, profileDetails.status FROM loginDetails INNER JOIN profileDetails ON loginDetails.user_id = profileDetails.user_id WHERE loginDetails.user_id = ?;", [user_id], 
        function (err, data) {
            if (err) {
                console.log(err);
            } else {
                res.render("editProfileHeader.ejs", {headerData: data});
            }
    });
});


router.post('/', upload.single('profileImage'), function(req, res) {
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
        console.error(err);
        return res.status(500).send("Internal server error");
      }
      
      if (!row) {
        // User profile doesn't exist in database
        return res.status(404).send("Profile not found");
      }

      // Update the profile details in the database
        if (profileImage !== undefined){
            var updateProfileQuery = "UPDATE profileDetails SET image_path=?, job_title=?, current_location=?, phone_no=?, about=? WHERE user_id=?";
            global.db.run(updateProfileQuery, [profileImage, jobTitle, currentLocation, phoneNumber, about, user_id], function(err) {
                if (err) {
                    console.error(err);
                    return res.status(500).send("Internal server error");
                }
            });

            // Remove old profile image file if it's not the default image
            if (row.image_path !== "/images/profile.png") {
                fs.unlink("public" + row.image_path, function(err) {
                if (err) {
                    console.error(err);
                }
                });
            }
        } else {
            var updateProfileQuery = "UPDATE profileDetails SET job_title=?, current_location=?, phone_no=?, about=? WHERE user_id=?";
            global.db.run(updateProfileQuery, [jobTitle, currentLocation, phoneNumber, about, user_id], function(err) {
                if (err) {
                console.error(err);
                return res.status(500).send("Internal server error");
                }
            });
        }

        var updateProfileQuery = "UPDATE loginDetails SET first_name=?, last_name=? WHERE user_id=?";
        global.db.run(updateProfileQuery, [firstName, lastName, user_id], function(err) {
            if (err) {
                console.error(err);
                return res.status(500).send("Internal server error");
            }
            // Redirect to the updated profile page
            res.redirect('/edit');
        });
    });
  });
  
  

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;