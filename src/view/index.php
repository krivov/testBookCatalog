<?php require "header.php"; ?>

<div class="container">
    <h1>Список книг</h1>

    <a href="/?page=addedit" class="btn btn-primary">Добавить книгу</a>

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

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Название</th>
            <th>Дата</th>
            <th>Изображение</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($allBooks as $book): /** @var Book $book */ ?>
            <tr>
                <td><a href="?page=book&id=<?=$book->id?>"><?=htmlspecialchars($book->name)?></a></td>
                <td><?php if ($book->date) echo date("d.m.Y", strtotime($book->date)); ?></td>
                <td>
                    <?php if($book->picture): ?>
                        <img class="img-circle" src="/upload/<?=$book->picture?>" style="width: 140px; height: 140px;">
                    <?php endif ?>
                </td>
                <td>
                    <a href="/?page=addedit&id=<?=$book->id;?>" class="btn btn-primary">Редактировать</a>
                    <a href="/?page=delete&id=<?=$book->id;?>" class="btn btn-danger">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require "footer.php"; ?>
