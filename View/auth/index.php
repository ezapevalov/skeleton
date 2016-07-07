<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item" href="/">Home</a>
            <a class="blog-nav-item active" href="/auth">Login</a>
        </nav>
    </div>
</div>

<div class="container">

    <form class="form-signin" method="post" action="/auth/login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" id="login" name="login" class="form-control" placeholder="Login or Email" required autofocus>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->