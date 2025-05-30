const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const userSchema = new Schema({
    name: String,
    username: String,
    password: String,
    date: Date,
    email: String,
    occupation: String,
}, {timestamps: true});

const User = mongoose.model('User', userSchema);
module.exports = User;