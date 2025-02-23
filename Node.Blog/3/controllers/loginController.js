
const User = require('../models/User');

const login_get = (req, res) => {
    res.render('login/login', {title: 'Login', info: 'Login with user details'});
}
const login_post = async (req, res) => {
  try{
      const user = await User.findOne({ username: req.body.username, password: req.body.password});
          if(user){
              res.redirect('/blogs');
          }
          else{
              res.status(404).send("Wrong log in");
          }
  }catch(err){
      console.log(err);
      res.status(500).send("Server error");
  }

}
// register

const register_get = (req, res) => {
    res.render('login/register', {title: 'Register new user', info: 'Register with user details'});
}
const register_post = (req, res) => {
    console.log(req.body);
    const userData = {
        name: req.body.name,
        username: req.body.username,
        password: req.body.password,
        date: new Date(req.body.date).toISOString(),
        email: req.body.email,
        occupation: req.body.occupation
    }
    const user = new User(userData);
    user.save()
        .then((result) =>{
            console.log(result);
            res.redirect('/login');
    })
        .catch((err) => {console.log(err);})
}

module.exports = {
    login_get,
    login_post,
    register_get,
    register_post,
}