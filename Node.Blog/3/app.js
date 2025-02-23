require('dotenv').config();

const express = require('express');
const morgan = require('morgan');
const mongoose = require('mongoose');
const blogRoutes = require('./routes/blogRoutes');
const loginRoutes = require('./routes/loginRoutes');


// express-app
const app = express();
//connect to mongoDB
const PORT = process.env.PORT || 3000;
const dbURI = process.env.MONGODB_URI;
console.log('Mongo URI:', dbURI);

mongoose.connect(dbURI,{useNewUrlParser:true, useUnifiedTopology: true} )
    .then((result) => app.listen(PORT))
    .catch(err => console.log(err));
//register view-engine

app.set('view engine', 'ejs');

// middleware and static files
app.use(express.static('public'));
app.use(express.urlencoded({extended: true}));
app.use(morgan('dev'));


//routes
app.get('/', (req, res) => {
    res.redirect('blogs');
});
app.get('/about', (req, res) => {
    res.render('profile/about', {title: 'About me', info: 'This is me'});
});

//blog routes
app.use('/blogs', blogRoutes);

//login routes
app.use('/login', loginRoutes);
app.get('/about-me', (req, res) => {
    res.redirect('about');
});
app.use((req, res) => {
    res.status(404).render('404', {title: '404 -Page Not Found'});
});