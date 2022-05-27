<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message from Support</title>
</head>
<body>
    <p><strong>Hi {{$data['name']}},</strong> </p>
    <p>We Received your Message on our site regarding mention subject {{$data['subject']}}. 
        <br>
        <strong>Your Text / Query :</strong>
        <br>
        {{$data['message']}}</p>
    <p><strong>Reply to your query:</strong> 
        <br>
        {{$data['text']}}</p>
    <p>Thanks,
        <br>
        Best Regards.
        <br>
        <strong>-From Paystoyou Support Team</strong> 
    </p>
</body>
</html>