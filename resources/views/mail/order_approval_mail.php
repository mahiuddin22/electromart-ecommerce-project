<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Approval Notice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    .email-container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    .email-header {
      background-color: #007bff;
      color: #ffffff;
      padding: 20px;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      text-align: center;
    }
    .email-header h2 {
      margin: 0;
      font-size: 24px;
    }
    .email-body {
      padding: 30px;
      text-align: center;
    }
    .email-body p {
      font-size: 18px;
      margin-bottom: 20px;
    }
    .btn-approve {
      background-color: #28a745;
      color: #ffffff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
    }
    .btn-approve:hover {
      background-color: #218838;
    }
    .email-footer {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="email-container">
    <div class="email-header">
      <h2>Order Approved</h2>
    </div>
    <div class="email-body">
      <p>Great news! Your order has been approved.</p>
      <a href="{!! route('order.details', $checkout->id) !!}" class="btn btn-primary text-white">View Order</a>
    </div>
    <div class="email-footer">
      <p>If you have any questions, feel free to contact our support team.</p>
    </div>
  </div>

</body>
</html>