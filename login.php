<?php include 'header.php'; ?>
<div class="d-flex justify-content-center">
    <form action="" method="POST" class="login col-md-6 col-sm-12 flex-column">
        <div class="text-center mt-3 mb-5">
            Login to access your daily tasks.
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>

<?php include 'footer.php'; ?>
