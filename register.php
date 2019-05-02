<?php include 'header.php'; ?>

<div class="d-flex justify-content-center">

    <form action="app/controllers/RegisterController.php/register" method="POST" class="login col-md-6 col-sm-12 flex-column">
        <div class="text-center  mt-3 mb-5">
            Register to get the full access over your own daily tasks.
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <small id="register-info" class="form-text text-muted">We'll never share your personal information with anyone else.</small>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
</div>
<?php include 'footer.php'; ?>
