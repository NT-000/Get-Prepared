const express = require('express');
const router = express.Router();
const loginController = require('../controllers/loginController');

router.get('/', loginController.login_get);
router.post('/login', loginController.login_post);
router.get('/login/register', loginController.register_get);
router.post('/login/register', loginController.register_post);

module.exports = router;