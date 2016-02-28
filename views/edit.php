<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="/admin">Отзывы</a>
            <a class="blog-nav-item" href="/">Главная</a>
            <a class="blog-nav-item pull-right" href="/auth/logout">Выход</a>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row" style="margin-top: 20px"></div>
    <h1>Редактирование</h1>

    <form action="/admin/update" method="post">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$vars['comment']['name']?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$vars['comment']['email']?>">
        </div>
        <div class="form-group">
            <label for="comment">Комментарий</label>
            <textarea name="comment" id="comment" class="form-control" rows="3"><?=$vars['comment']['comment']?></textarea>
        </div>

        <input type="hidden" name="comment_id" value="<?=$vars['comment']['id']?>">
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div><!-- /.container -->
