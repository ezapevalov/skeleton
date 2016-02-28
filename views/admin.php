<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item" href="/">Главная</a>
            <a class="blog-nav-item" href="/auth/logout">Выход</a>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <div class="row" style="margin-top: 20px"></div>
    <h1>Отзывы</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th id="date">Дата</th>
                <th>Иконка</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Комментарий</th>
                <th>Активен</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ( $vars['comments'] as $c ): ?>
                <tr>
                    <td><?=$c['id']?></td>
                    <td><?=date('d.m.Y h:i', $c['date'])?></td>
                    <td>
                        <? if ( $c['image'] ): ?>
                            <img src="/uploads/comments/<?=$c['id']?>/<?=$c['image']?>">
                        <? else: ?>
                            <img src="/uploads/no-image.png">
                        <? endif ?>
                    </td>
                    <td><a href="/admin/edit/<?=$c['id']?>"><?=$c['name']?></a></td>
                    <td><?=$c['email']?></td>
                    <td><?=$c['comment']?></td>
                    <td>
                        <input comment_id="<?=$c['id']?>" class="comment-status-checkbox" type="checkbox" <?=($c['active'] ? 'checked' : '')?>>
                    </td>
                </tr>
            <? endforeach ?>
        </tbody>
    </table>
</div><!-- /.container -->
