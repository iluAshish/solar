<!DOCTYPE html>
<html>
<head>
    <title>New Booking Request</title>
</head>
<body>
    <h1>New Booking Request</h1>
    <p>A new booking request has been received:</p>
    <ul>
        <li><strong>Product:</strong> {{ $booking->product }}</li>
        <li><strong>Name:</strong> {{ $booking->name }}</li>
        <li><strong>Email:</strong> {{ $booking->email }}</li>
        <li><strong>Phone:</strong> {{ $booking->phone }}</li>
    </ul>
    <p>Please follow up promptly.</p>
</body>
</html>
