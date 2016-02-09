<?php require "header.php"; ?>

<div class="container">
    <h1>Список книг</h1>

    <div class="row">
        <form class="form-horizontal" role="form" action="/" method="get">
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-6 control-label">Сортировать по:</label>
                <div class="col-sm-3">
                    <select class="form-control" name="order_field">
                        <option value="name" <?php if ($orderField == 'name') echo 'selected' ?>>Наименованию</option>
                        <option value="date" <?php if ($orderField == 'date') echo 'selected' ?>>Дате</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-3 col-sm-offset-6 control-label">Направление сортировки</label>
                <div class="col-sm-3">
                    <select class="form-control" name="order">
                        <option value="ASC" <?php if ($order == 'ASC') echo 'selected' ?>>По возрастанию</option>
                        <option value="DESC" <?php if ($order == 'DESC') echo 'selected' ?>>По убывванию</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-3 col-sm-offset-6 control-label">Количество на странице</label>
                <div class="col-sm-3">
                    <select class="form-control" name="limit">
                        <?php for($i=1;$i<=10;$i++): ?>
                        <option value="<?=$i*10?>" <?php if ($limit == $i*10) echo 'selected' ?>><?=$i*10?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary col-sm-3 col-sm-offset-9" value="Применить">
            </div>
        </form>
    </div>
    <div class="row">
        <?php foreach($allBooks as $book): /** @var Book $book */ ?>
        <div class="col-lg-4" href="?page=book&id=<?=$book->id?>">
            <?php if($book->picture): ?>
                <img class="img-circle" src="/upload/<?=$book->picture?>" style="width: 140px; height: 140px;">
            <?php endif ?>
            <h2><?=$book->name?></h2>
            <p><a class="btn btn-default" href="?page=book&id=<?=$book->id?>" role="button">Подробнее »</a></p>
        </div><!-- /.col-lg-4 -->
        <?php endforeach; ?>
    </div>
</div>

<?php require "footer.php"; ?>
