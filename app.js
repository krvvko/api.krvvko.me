const express = require('express');
const cors = require('cors');
const experienceRoutes = require('./routes/experience');
const myProjectsRoutes = require('./routes/myProjects');
const krvvkoRoutes = require('./routes/krvvko');

const app = express();

app.use(cors());
app.use(express.json());

app.use('/api/experience', experienceRoutes);
app.use('/api/myProjects', myProjectsRoutes);
app.use('/api/krvvko', krvvkoRoutes);

const PORT = process.env.PORT || 4001;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
