<?php require "header.php"; ?>

<?php
/** @var Book $book */
/** @var Author[] $authors */
?>

<?php if($book->id):?>
    <h1>Редактирование книги</h1>
<?php else: ?>
    <h1>Добавление книги</h1>
<?php endif?>

<div class="row">
    <form class="form-horizontal" role="form" action="/index.php?action=addedit" method="post">
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label">Наименование:</label>
            <div class="col-sm-3">
                <input type="text" name="book[name]" value="<?=htmlspecialchars($book->name)?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label">Дата:</label>
            <div class="col-sm-3">
                <input type="text" name="book[name]" value="<?=htmlspecialchars($book->date)?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-sm-offset-2 control-label">Авторы:</label>
            <div class="col-sm-3">
                <select class="form-control">
                    <?php foreach($authors as $author): ?>
                        <option value="<?=$author->id?>"><?=htmlspecialchars($author->lastname)?> <?=htmlspecialchars($author->firstname)?> <?=htmlspecialchars($author->middlename)?></option>
                    <? endforeach; ?>
                </select>
                <a href="javascript:void(0)" class="btn-primary">+</a>
            </div>
            <?php foreach($book->authors as $author): ?>
                <div class="row" data-author="<?=$author->id?>">
                    <b><?=htmlspecialchars($author->lastname)?> <?=htmlspecialchars($author->firstname)?> <?=htmlspecialchars($author->middlename)?></b>
                    <a href="javascript:void(0)" class="remove_author">x</a>
                    <input type="hidden" name="book[author][]" value="<?=$author->id?>">
                </div>
            <? endforeach; ?>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary col-sm-3 col-sm-offset-3" value="Сохранить">
        </div>
    </form>
</div>

<?php require "footer.php"; ?>
