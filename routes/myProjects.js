const express = require('express');
const router = express.Router();
const db = require('../db/database');

router.get('/', (req, res) => {
    db.all("SELECT * FROM MyProjects", [], (err, rows) => {
        if (err) {
            res.status(500).json({ error: err.message });
            return;
        }
        res.json(rows);
    });
});

router.get('/project/:id', (req, res) => {
    const id = req.params.id;

    const sql = "SELECT * FROM MyProjects WHERE id = ?";
    const params = [id];

    db.get(sql, params, (err, row) => {
        if (err) {
            res.status(500).json({ error: err.message });
            return;
        }
        if (row) {
            res.json(row);
        } else {
            res.status(404).json({ message: "Project not found" });
        }
    });
});

router.post('/', (req, res) => {
    // Extract project details from request body
    // Remember to convert arrays/objects to JSON strings for storage
    const {
        ProjectName, ProjectShortDescription, ProjectLongDescription, ProjectCreationDay,
        ProjectUrl, ProjectSourceUrl, ProjectTechnologies, ProjectImages,
        ProjectDeployed, ProjectDifficulty
    } = req.body;

    const sql = `INSERT INTO MyProjects (
        ProjectName, ProjectShortDescription, ProjectLongDescription, ProjectCreationDay,
        ProjectUrl, ProjectSourceUrl, ProjectTechnologies, ProjectImages,
        ProjectDeployed, ProjectDifficulty
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;

    const params = [
        ProjectName, ProjectShortDescription, ProjectLongDescription, ProjectCreationDay,
        ProjectUrl, ProjectSourceUrl, JSON.stringify(ProjectTechnologies), JSON.stringify(ProjectImages),
        ProjectDeployed, ProjectDifficulty
    ];

    db.run(sql, params, function (err) {
        if (err) {
            res.status(400).json({ error: err.message });
            return;
        }
        res.json({
            "message": "success",
            "data": req.body,
            "id": this.lastID
        });
    });
});

module.exports = router;
