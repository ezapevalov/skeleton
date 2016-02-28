<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="/">Главная</a>
            <a class="blog-nav-item" href="/auth">Вход</a>
        </nav>
    </div>
</div>

<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">Skeleton</h1>
        <p class="lead blog-description">We hear. We think. We help :)</p>
    </div>

    <? foreach ( $vars['comments'] as $c ): ?>
        <div class="row col-md-12">
            <? if ( $c['edited'] ): ?>
                <span style="float: right;" class="label label-warning">отредактирован администратором</span>
            <? endif ?>
            <div class="image_block">
                <? if ( $c['image'] ): ?>
                    <img src="/uploads/comments/<?=$c['id']?>/<?=$c['image']?>">
                <? else: ?>
                    <img src="/uploads/no-image.png">
                <? endif ?>
            </div>
            <div class="meta">
                <p class="comment_name"><?=$c['name']?></p>
                <p class="comment_date"><?=date('d.m.Y h:i', $c['date'])?></p>
            </div>
            <div style="clear: both;"></div>
            <p class="comment"><?=$c['comment']?></p>
        </div>

        <div style="clear: both;"></div>
        <hr>
    <? endforeach ?>


    <h3 id="lure">А Вы как думаете? Напишите! :)</h3>

    <form class="form-inline row col-md-12">
        <div class="row col-md-8" id="user_contacts">
            <div class="form-group" id="image_block">
                <button class="btn btn-info btn-lg" id="upload_hidden_button">
                    <i class="glyphicon glyphicon-camera"></i>
                    <input class="disabled" type="file" id="upload_hidden_input">
                </button>
                <img src="" id="uploaded_image">
            </div>
            <div class="form-group" id="user_name_block">
                <label class="sr-only" for="user_name">Имя</label>
                <input type="text" class="form-control input-lg required" id="user_name" placeholder="Имя">
            </div>
            <div class="form-group" id="user_email_block">
                <label class="sr-only" for="user_email">Email</label>
                <input type="email" class="form-control input-lg required" id="user_email" placeholder="Email">
            </div>
        </div>
        <div class="form-group row col-md-8">
            <textarea id="user_comment" class="form-control input-lg required" rows="3" placeholder="Ваш комментарий"></textarea>
        </div>
    </form>

    <div class="row col-md-12" id="preview">
        <div id="preview_image_block">
            <img src="/uploads/ragecomic.png">
        </div>
        <div id="preview_meta">
            <p id="preview_name">Евгений Запевалов</p>
            <p id="preview_date">5.12.2015 16:34</p>
        </div>
        <div style="clear: both;"></div>
        <p id="preview_comment">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries
        </p>
    </div>

    <div class="row col-md-12" id="form_buttons">
        <button class="btn btn-lg btn-success" id="submit_button">Отправить</button>
        <span id="activate_preview_block">
            <span> или </span>
            <a href="#" id="preview_button">посмотреть</a>
            <span>сначала?</span>
        </span>
        <span id="deactivate_preview_block">
            <span> или </span>
            <a href="#" id="back_from_preview_button">изменить</a>
            <span>что-то?</span>
        </span>
    </div>
    <div style="clear: both"></div>
    <h3 id="congratulations">Ура! Вас услышали! Совсем скоро Ваш коментарий появится в общем списке :)</h3>
</div><!-- /.container -->

<div style="clear: both"></div>
<p></p>

<!-- empty fields modal dialog -->
<div id="validation_error_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Хьюстон, у нас проблемы...</h4>
            </div>
            <div class="modal-body">
                <p id="empty_fields">Заполните, пожалуйста, пустые поля. Мы пометили их <span class="label label-danger">красненьким</span> для Вас :)</p>
                <p id="wrong_email">Хм, <b id="wrong_email_value">&nbsp;</b> не похоже на Email. Исправите?</p>
                <p id="taken_email">Похоже, что email <b id="taken_email_value">&nbsp;</b> уже кто-то застолбил. Давайте попробуем другой?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Понял!</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- wrong image modal dialog -->
<div id="wrong_image_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Хьюстон, у нас проблемы...</h4>
            </div>
            <div class="modal-body">
                <p id="wrong_extension">Похоже, что Ваша картинка и не картинка вовсе. Давайте попробуем другую?</p>
                <p id="save_error">Что-то пошло не так, давайте попробуем еще раз?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Понял!</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->