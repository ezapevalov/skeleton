<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="/">Отзывы</a>
            <a class="blog-nav-item" href="/">Главная</a>
            <a class="blog-nav-item pull-right" href="/auth/logout">Выход</a>
        </nav>
    </div>
</div>

<div class="container-fluid">
    <div class="row" style="margin-top: 20px"></div>
    <h1>Отзывы</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th id="date">
                    <a href="#" class="order_by_toggle" order_by="date">
                        Дата
                        <? if ( $vars['order_by'] == 'date' ): ?>
                            <? if ( $vars['order_type'] == 'ASC' ): ?>
                                <i class="glyphicon glyphicon-arrow-up"></i>
                            <? else: ?>
                                <i class="glyphicon glyphicon-arrow-down"></i>
                            <? endif ?>
                        <? endif?>
                    </a>
                </th>
                <th>Иконка</th>
                <th>
                    <a href="#" class="order_by_toggle" order_by="name">
                        Имя
                        <? if ( $vars['order_by'] == 'name' ): ?>
                            <? if ( $vars['order_type'] == 'ASC' ): ?>
                                <i class="glyphicon glyphicon-arrow-up"></i>
                            <? else: ?>
                                <i class="glyphicon glyphicon-arrow-down"></i>
                            <? endif ?>
                        <? endif?>
                    </a>
                </th>
                <th>
                    <a href="#" class="order_by_toggle" order_by="email">
                        Email
                        <? if ( $vars['order_by'] == 'email' ): ?>
                            <? if ( $vars['order_type'] == 'ASC' ): ?>
                                <i class="glyphicon glyphicon-arrow-up"></i>
                            <? else: ?>
                                <i class="glyphicon glyphicon-arrow-down"></i>
                            <? endif ?>
                        <? endif?>
                    </a>
                </th>
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
