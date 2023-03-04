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
    res.render("addProject");
});


router.post('/', upload.single('projectImage'), function(req, res) {
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
  
    // Get the existing profile details for the user
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

    res.redirect('/edit');
});
  
  

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;