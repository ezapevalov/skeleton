<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item" href="/">Главная</a>
            <a class="blog-nav-item active" href="/auth">Вход</a>
        </nav>
    </div>
</div>

<div class="container">
    <form class="form-signin" action="/auth/login" method="post">
        <p>&nbsp;</p>
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Логин" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
</div><!-- /.container -->
