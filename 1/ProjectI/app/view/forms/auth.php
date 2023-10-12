<form method="POST" action="./index.php?page=auth&method=signin" class="text-center min-w-400 mx-2 p-4 mb-4 rounded-3">
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>
    <p><?php if(isset($_SESSION["auth_error"])) echo $_SESSION["auth_error"] ?></p>
    <div class="form-floating mb-2">
        <input required type="text" class="form-control" id="username" name="username" placeholder="name@example.com">
        <label for="username">Username</label>
    </div>
    <div class="form-floating mb-2">
        <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
    </div>
    <button name="button" value="signin" class="w-100 btn btn-lg btn-primary mb-1" type="submit">Sign in</button>
    <button name="button" value="register" class="w-100 btn btn-lg btn-outline-primary" type="submit">Register</button>
</form>