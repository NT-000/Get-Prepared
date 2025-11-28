<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workland Job Application</title>
</head>
<body>
<p>
    Someone just applied to your Workland job-listing.
</p>

<p><strong>Job Title:</strong>{{$job->title}}</p>

<p><strong>Application details:</strong></p>

<p><strong>Full Name:</strong>{{$application->full_name}}</p>
<p><strong>Phone:</strong>{{$application->contact_phone}}</p>
<p><strong>Email:</strong>{{$application->contact_email}}</p>
<p><strong>Message:</strong>{{$application->message}}</p>
<p><strong>Location:</strong>{{$application->location}}</p>
<p>
    Login to your Workland account to view the new application.
</p>
</body>
</html>
