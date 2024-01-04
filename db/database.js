const sqlite3 = require('sqlite3').verbose();
const path = require('path');
const dbPath = path.resolve(__dirname, 'data.db');

let db = new sqlite3.Database(dbPath, (err) => {
    if (err) {
        console.error(err.message);
    }
    console.log('Connected to the SQLite database.');
});

// Create tables
db.serialize(() => {
    db.run(`CREATE TABLE IF NOT EXISTS Experience (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        TechnologyName TEXT,
        Language TEXT,
        Description TEXT,
        StartDate DATE,
        KnowledgeLevel INTEGER
    )`);

    db.run(`CREATE TABLE IF NOT EXISTS MyProjects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ProjectName TEXT,
    ProjectShortDescription TEXT,
    ProjectLongDescription TEXT,
    ProjectCreationDay DATE,
    ProjectUrl TEXT,
    ProjectSourceUrl TEXT,
    ProjectTechnologies TEXT,
    ProjectImages TEXT,
    ProjectDeployed BOOLEAN,
    ProjectDifficulty INTEGER
)`);

    db.run(`CREATE TABLE IF NOT EXISTS Krvvko (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    AboutMeShort TEXT,
    AboutMeLong TEXT,
    ContactLinks TEXT
)`);
});

module.exports = db;
