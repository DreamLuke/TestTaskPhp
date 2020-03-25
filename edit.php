<?
    session_start();
    echo $_SESSION['admin'];

    $id = $_GET['id'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать задачу</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container mb-3 mt-3">
        <form action="/controllers/save.php?operator=editTask&id=<?php echo $_GET['id'] ?>" method="post">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Введите имя" required>
                <small id="nameHelp" class="form-text text-muted">В это поле надо ввести имя пользователя</small>
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Введите электронную почту" required>
                <small id="emailHelp" class="form-text text-muted">В это поле надо ввести электронную почту</small>
            </div>
            <div class="form-group">
                <label for="text">Текст задачи</label>
                <textarea id="text" name="text" aria-describedby="textHelp" class="md-textarea form-control" rows="3" required></textarea>
                <small id="textHelp" class="form-text text-muted">В это поле надо ввести текст задачи</small>
            </div>
            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    
</body>
</html>
