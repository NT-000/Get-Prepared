<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new job</title>
</head>
<body>
<h1>Create new job!</h1>

<form action="/jobs" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Enter jobtitle">
    <input type="text" name="info" placeholder="Enter description of job.">
    <button type="submit">Submit form</button>
</form>
</body>
</html>
