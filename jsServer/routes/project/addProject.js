const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
const multer = require('multer');   // import multer package
const path = require('path');   // import path package
const fs = require('fs');   // import fs package
var user_id = 1;

// Define multer storage options
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        // specify the destination directory for uploaded files
        cb(null, 'public/uploads')
    },
    filename: function (req, file, cb) {
        const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9)
        // set the filename to be unique with a timestamp and original file extension
        cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname))
    }
});

// Initialize multer with the storage options
const upload = multer({ storage: storage });


// Handle GET request to '/' route
router.get("/", (req, res) => {
    // render the addProject view
    res.render("addProject");
});


// Handle POST request to '/' route with upload middleware
router.post('/', upload.single('projectImage'), function(req, res) {

    // Get values from the request
    const projectImage = req.file ? "/uploads/" + req.file.filename : req.body.defaultImage;
    const title = req.body.title;
    const subtitle = req.body.subtitle;
    const detail = req.body.detail;
    const make_public = req.body.make_public;

    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
  
    // Define SQL queries
    const getProfileQuery = "SELECT * FROM projectDetails WHERE project_id=?";
    if (projectImage !== undefined){
        var updateProfileQuery = "INSERT INTO projectDetails (image_path, title, subtitle, detail, visibility, user_id) VALUES(?, ?, ?, ?, ?,?)";
        global.db.run(updateProfileQuery, [projectImage, title, subtitle, detail, visible, user_id], function(err) {
            if (err) {
                console.error(err);
                return res.status(500).send("Internal server error");
            }
        });
    } else {
        var updateProfileQuery = "INSERT INTO projectDetails (image_path, title, subtitle, detail, visibility, user_id) VALUES(?, ?, ?, ?, ?,?)";
        global.db.run(updateProfileQuery, ["/images/project.jpeg", title, subtitle, detail, visible, user_id], function(err) {
            if (err) {
                console.error(err);
                return res.status(500).send("Internal server error");
            }
        });
    }

    // redirect to the edit page
    res.redirect('/edit');
});
  
  

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;