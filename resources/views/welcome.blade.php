<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .main-container{
            width: 30%;
        }

        .outer-container{
            background-color: #7C638F;
            padding: 10%;
            border-radius: 10px;
        }

        .container {
            text-align: center;
        }

        .login-box {
            background-color: #e1d4ed;
            padding: 10%;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 70%;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1vw;
        }

        .login-button {
            background-color: #ffcc00;
            color: #fff;
            font-weight: bold;
            width: 50%;
            margin: 2%;
        }

        .register-button {
            background-color: #a39477;
            color: #fff;
            font-weight: bold;
            width: 50%;
            margin: 2%;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }

        .footer a {
            color: #333;
            text-decoration: none;
        }

        .footer p {
            margin-top: 10px;
            color: #999;
        }
    </style>

<body>
    <div class="main-container">
        <div class="outer-container">
            <div class="container">
                <div class="login-box">
                    <img src="{{ asset('images/work4u.png') }}" alt="Work4U Logo" class="logo">
                        <form action="{{ url('/login') }}" method="POST"> <!-- Use url() helper for generating URLs -->
                            @csrf <!-- CSRF token -->
                            <label for="email">EMAIL / IC</label>
                            <input type="text" id="login" name="login" required>
                            <label for="password">PASSWORD</label>
                            <input type="password" id="password" name="password" required>
                            <div class="cont-btn">
                                <button type="submit" class="login-button">LOGIN</button>
                                <button type="button" class="register-button" onclick="window.location.href='{{ route('register') }}'">REGISTER</button> <!-- Use url() helper for generating URLs -->
                            </div>
                        </form>
                        
                </div>
            </div>
        </div>
        <div class="footer">
            <p>© SARSAB TECHNOLOGY 2024</p>
        </div>
    </div>
</body>



