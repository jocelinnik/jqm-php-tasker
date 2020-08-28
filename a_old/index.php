<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery Mobile</title>
    
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
    <div data-role="page">
        <div data-role="header">
            <h1>Tasker</h1>
            <a href="signup.php" class="ui-btn ui-btn-right">Cadastrar</a>
        </div>

        <div data-role="content">
            <form action="doLogin.php" method="post">
                <div class="ui-field-contain">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>">
                </div>
                <div class="ui-field-contain">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>">
                </div>

                <input type="submit" value="Logar">
            </form>
        </div>
    </div>
</body>