// blog_index, blog_details, blog_create_get , blog_create_post, blog_delete

const Blog = require("../models/blog");
const blog_index = (req,res) =>{
     Blog.find().sort({createdAt: -1})
         .then((result) => {
             res.render('blogs/index', {title:'All blogs', blogs: result, info:'Your blogposts' })
         })
         .catch((err) => {
             console.log(err);
         })
 }
 
 const blog_details = (req,res) => {
     const id = req.params.id;
     Blog.findById(id)
         .then(result => {
             res.render('blogs/post',{blog: result, title: 'Blog details'});
         })
         .catch((err) => {
             res.status(404).render('404', {title: 'Not Found'});
         });
 }
 const blog_create_get = (req,res) =>{
    res.render('blogs/blog', {title:'Blogs', info:'Create a post'});
 }

const blog_create_post = (req,res) =>{
    console.log(req.body);
    const blog = new Blog(req.body);
    blog.save()
        .then((result) => {
            res.redirect('blogs')
        })
        .catch((err) => {
            console.log(err);
        })
}

const blog_delete = (req,res) =>{
    const id = req.params.id;
    Blog.findByIdAndDelete(id)
        .then((result) => {
            res.json({redirect: 'blogs/blogs'});
        })
        .catch((err) => {console.log(err)
        })
}
const blog_redirect = (req,res) =>{
    res.redirect('blog/new');
}

module.exports = {
    blog_index,blog_delete, blog_create_get,blog_details, blog_create_post, blog_redirect}