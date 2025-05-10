<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Submission Form</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h4 class="text-center mb-4">Forgot Password</h4>
        <form action="otpChecker.php" method="POST">
            <div class="mb-3">
                <label for="otp" class="form-label">OTP</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="email" 
                    name="otp" 
                    placeholder="Enter OTP" 
                    required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>
