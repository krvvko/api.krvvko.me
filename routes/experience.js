const express = require('express');
const router = express.Router();
const db = require('../db/database');

// GET all experiences
router.get('/', (req, res, next) => {
    db.all("SELECT * FROM Experience", [], (err, rows) => {
        if (err) {
            res.status(500).json({ error: err.message });
            return;
        }
        res.json(rows);
    });
});

// POST a new experience
router.post('/', (req, res, next) => {
    const { TechnologyName, Language, Description, StartDate, KnowledgeLevel } = req.body;
    const sql = 'INSERT INTO Experience (TechnologyName, Language, Description, StartDate, KnowledgeLevel) VALUES (?,?,?,?,?)';
    const params = [TechnologyName, Language, Description, StartDate, KnowledgeLevel];

    db.run(sql, params, function(err) {
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
