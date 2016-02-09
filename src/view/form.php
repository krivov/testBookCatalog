<?php require "header.php"; ?>

<?php
/** @var Book $book */
/** @var Author[] $authors */
?>

<div class="container">

<?php if($book->id):?>
    <h1>Редактирование книги</h1>
<?php else: ?>
    <h1>Добавление книги</h1>
<?php endif?>

<div class="row">
    <form class="form-horizontal" role="form" action="" method="post">
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-1 control-label">Наименование:</label>
            <div class="col-sm-3">
                <input type="text" name="book[name]" value="<?=htmlspecialchars($book->name)?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-1 control-label">Дата:</label>
            <div class="col-sm-3">
                <input type="text" name="book[date]" value="<?=htmlspecialchars($book->date)?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-1 control-label">Картинка:</label>
            <div class="col-sm-3">
                <input type="file" name="book[picture]">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-1 control-label">Авторы:</label>
            <div class="col-sm-3">
                <ul class="author_list">
                    <?php foreach($book->authors as $author): ?>
                    <li>
                        <b><?=htmlspecialchars($author->lastname)?> <?=htmlspecialchars($author->firstname)?> <?=htmlspecialchars($author->middlename)?></b>
                        (<a href="javascript:void(0)" class="remove_author">удалить</a>)
                        <input type="hidden" name="book[authors][]" value="<?=$author->id?>">
                    </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <select class="form-control" id="selectAuthor">
                    <?php foreach($authors as $author): ?>
                        <option value="<?=$author->id?>"><?=htmlspecialchars($author->lastname)?> <?=htmlspecialchars($author->firstname)?> <?=htmlspecialchars($author->middlename)?></option>
                    <? endforeach; ?>
                </select>
                <a href="javascript:void(0)" class="btn btn-primary add_author">добавить автора</a>
            </div>

        </div>
        <?php if(count($book->_errors) > 0): ?>
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <?php foreach($book->_errors as $error): ?>
                        <p class="text-danger"><?=$error?></p>
                    <? endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <input type="submit" class="btn btn-primary col-sm-2 col-sm-offset-4" value="Сохранить">
        </div>
    </form>
</div>

</div>

<?php require "footer.php"; ?>
