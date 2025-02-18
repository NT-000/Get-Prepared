const express = require('express');
const morgan = require('morgan');
const mongoose = require('mongoose');
const blogRoutes = require('./routes/blogRoutes');
const PORT = 3000;

// express-app
const app = express();
//connect to mongoDB
const dbURI = 'mongodb+srv://AdminThue:123test@blogDb.nb15n.mongodb.net/node-blog?retryWrites=true&w=majority&appName=blogDb';


mongoose.connect(dbURI)
.then((result) => app.listen(PORT))
.catch(err => console.log(err));
//register view-engine

app.set('view engine', 'ejs');

// listen for requests


// middleware and static files
app.use(express.static('public'));
app.use(express.urlencoded({ extended: true }));
app.use(morgan('dev'));


//routes
app.get('/', (req, res) => {
res.redirect('blogs');
});
app.get('/about', (req, res) => {
    res.render('about', {title:'About me', info:'This is me'});
});

//blog routes
app.use('/blogs',blogRoutes);
app.get('/about-me', (req, res) => {
    res.redirect( 'about');
});
app.use((req, res) => {
    res.status(404).render( '404', {title:'404 -Page Not Found'});
});