<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<div class="container">
    <div class="profile-card">
        <div class="profile-header">
            <h1>Your Profile</h1>
        </div>

        <div class="profile-body">
            <div class="profile-info">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Lastname:</strong> {{ $user->lastname }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Account Number:</strong> {{ $user->account->account_number }}</p>
                <p><strong>Account Created At:</strong> {{ $user->account->created_at }}</p>
                <p><strong>Available Balance:</strong>{{$user->currency}} {{$user->account->balance}}</p>
            </div>


            <div class="back-link">
                <a href="{{ route('user_main_page') }}">Back to Main Page</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
