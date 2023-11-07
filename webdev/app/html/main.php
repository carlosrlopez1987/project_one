
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Basic HTML Page</title>


    <link rel="stylesheet" type="text/css" href="">


    <style>
        /* CSS styles specific to this page */
        <?php require_once realpath( __DIR__ . "/../css/main.css" ); ?>
    </style>
</head>

<body>

<header>
<div class="main-wrapper">
    <div class="header-wrapper">
        <div class="logo-div">
            <b><?php echo $Name; ?></b>
        </div>
        <div class="login-container">
            <form action="/login" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            
                <button type="submit">Login</button>
            </form>
        </div>
    
    </div>
    <div class="main-content">
        <div class="content">
        main content goes here
        </div>
    </div>
</div>
</header>
</body>

</html>