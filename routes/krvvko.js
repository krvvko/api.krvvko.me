const express = require('express');
const router = express.Router();
const db = require('../db/database');

router.get('/', (req, res) => {
    db.all("SELECT * FROM Krvvko", [], (err, rows) => {
        if (err) {
            res.status(500).json({ error: err.message });
            return;
        }
        res.json({
            "message": "success",
            "data": rows
        });
    });
});

router.post('/', (req, res) => {
    const { AboutMeShort, AboutMeLong, ContactLinks } = req.body;
    const sql = 'INSERT INTO Krvvko (AboutMeShort, AboutMeLong, ContactLinks) VALUES (?, ?, ?)';
    const params = [AboutMeShort, AboutMeLong, JSON.stringify(ContactLinks)];

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