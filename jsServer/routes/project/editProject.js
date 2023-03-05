const express = require("express"); // import express package
const bodyParser = require('body-parser'); // import body-parser package
const router = express.Router(); // create an instance of express router
const assert = require('assert'); // import assert package
const session = require('express-session'); // import express-session package
const multer = require('multer');   // import multer package
const path = require('path');   // import path package
const fs = require('fs');   // import fs package
var user_id = 1;

// configure storage for multer package
const storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, 'public/uploads')
    },
    filename: function (req, file, cb) {
        const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9)
        cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname))
    }
});

// initialize upload variable using multer package and configured storage
const upload = multer({ storage: storage });

// listen to a get request on '/' route
router.get("/", (req, res) => {
    
    var project_id = req.query.project_id;  // retrieve project id from query parameters
    req.session.project_id = project_id;    // store project id in session

    // retrieve project details from database based on project id
    global.db.get("SELECT * from projectDetails WHERE project_id = ?", [project_id], 
        function (err, data) {
            if (err) {
                console.log(err);
            } else {
                // render editProject template with project details
                res.render("editProject", {projectData: data});
            }
    });
});


// listen to a post request on '/' route and handle file upload using multer
router.post('/', upload.single('projectImage'), function(req, res) {
    var project_id = req.session.project_id;    // retrieve project id from session

    // retrieve input fields from request
    const projectImage = req.file ? "/uploads/" + req.file.filename : req.body.defaultImage;
    const title = req.body.title;
    const subtitle = req.body.subtitle;
    const detail = req.body.detail;
    const make_public = req.body.make_public;

    // determine visibility based on make_public input field
    if (make_public === 'on'){
        var visible = "public";
    } else {
        var visible = "private";
    }
  

    const getProfileQuery = "SELECT * FROM projectDetails WHERE project_id=?";
    global.db.get(getProfileQuery, [project_id], function(err, row) {
        if (err) {
            console.error(err);
            return res.status(500).send("Internal server error");
        }
        
        if (!row) {
            return res.status(404).send("Profile not found");
        }

        if (projectImage !== undefined){
            // update project details in database
            var updateProfileQuery = "UPDATE projectDetails SET image_path=?, title=?, subtitle=?, detail=?, visibility = ?, user_id=? WHERE project_id=?";
            global.db.run(updateProfileQuery, [projectImage, title, subtitle, detail, visible, user_id, project_id], function(err) {
                if (err) {
                    console.error(err);
                    return res.status(500).send("Internal server error");
                }
            });

            // delete old image file if it is not the default image
            if (row.image_path !== "/images/project.jpeg") {
                fs.unlink("public" + row.image_path, function(err) {
                    if (err) {
                        console.error(err);
                    }
                });
            }
        } else {
            // update project details in database
            var updateProfileQuery = "UPDATE projectDetails SET title=?, subtitle=?, detail=?, visibility = ?, user_id=? WHERE project_id=?";
            global.db.run(updateProfileQuery, [title, subtitle, detail, visible, user_id, project_id], function(err) {
                if (err) {
                    console.error(err);
                    return res.status(500).send("Internal server error");
                }
            });
        }

        res.redirect('/edit');
    });
  });
  
  

// This exports the router as a module so that it can be used in other parts of the application.
module.exports = router;