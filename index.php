<?
    include_once $_SERVER['DOCUMENT_ROOT'] . '/models/tasks.php';

    $tasksClass = new Tasks();
    $tasks = $tasksClass->getAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Задачи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script>
        isAdmin = false;
    </script>
    <style>
        .hide{
            border: 1px solid #765858;
            background: #ffeded;
            color: #7f5354;
            padding: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button id="btnLogin" type="button" class="btn btn-success">Вход</button>
        <button id="btnLogout"type="button" class="btn btn-danger">Выход</button>
        <button type="btnCreate" onclick="window.location.href = 'create.php';" class="btn btn-warning">Создать</button>

        <table class="table table-striped table-bordered mydatatable" style="width: 100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Имя</th>
                    <th>Электронная почта</th>
                    <th>Текст задачи</th>
                    <th>Статус</th>
                    <?php
                        // if(!empty($_SESSION['admin'])) {
                            echo '<th>Редактировать</th>';
                        // }
                    ?>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                <?php foreach ($tasks as $task):?>
                <tr>
                    <th><?php echo $task["name"] ?></th>
                    <th><?php echo $task["email"] ?></th>
                    <th><?php echo $task["text"] ?></th>
                    <th>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $task['id'] ?>">
                            <label class="custom-control-label" for="<?php echo $task['id'] ?>"><?php echo $task['id'] ?></label>
                        </div>
                    </th>
                    <?php
                        // if(!empty($_SESSION['admin'])) {
                            $link = "<th><a href='edit.php?id=" . $task["id"] . "' class='btn btn-info'>Редактировать</a></th>";
                            echo $link;
                        // }
                    ?>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr style="text-align: center;">
                    <th>Имя</th>
                    <th>Электронная почта</th>
                    <th>Текст задачи</th>
                    <th>Статус</th>
                     <?php
                        // if(!empty($_SESSION['admin'])) {
                            echo '<th>Редактировать</th>';
                        // }
                    ?>
                </tr>
            </tfoot>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.mydatatable').DataTable({
            searching: false,
            lengthMenu: [3],
            columnDefs: [{
                orderable: false,
                targets: [2, 4]
            }],
            lengthChange: false,
            info: false,
        });
    </script>
    <script>
        $(function() {
            $('button#btnLogin').click(function() {
                name = prompt('Ввдите имя:', '');
                password = prompt('Ввдите пароль:', '');

                $.ajax({ 
                    url: "isAdmin.php", 
                    method: "POST",  
                    data: {"name": name,"password": password},
                    success: function(data) {
                        // console.log(data);

                        if(data === 'true') {
                            isAdmin = true;
                            $('input').prop('disabled', false);
                        }

                        console.log(data);
                    } 
                });
            });

            $('button#btnLogout').click(function() {
                isAdmin = false;
                $('input').prop('disabled', true);
            });
        });
    </script>

</body>
</html>