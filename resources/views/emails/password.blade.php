<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
You have requested to reset your password. Please use the following link to set a new password.

<a href="{{ action('PasswordResetController@resetPasswordPage', [$token, $email])}}">
    {{action('PasswordResetController@resetPasswordPage', [$token, $email])}}
</a>
</body>
</html>
