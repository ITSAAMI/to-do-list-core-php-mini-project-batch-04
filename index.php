<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit" name="add">Add Task</button>
        </form>

        <ul class="tasks">
            <?php
            $file = "tasks.txt";

            // Add a new task
            if (isset($_POST['add']) && !empty($_POST['task'])) {
                $task = trim($_POST['task']);
                file_put_contents($file, $task . PHP_EOL, FILE_APPEND);
            }

            // Delete a task
            if (isset($_POST['delete'])) {
                $lineToDelete = $_POST['taskLine'];
                $tasks = file($file, FILE_IGNORE_NEW_LINES);
                unset($tasks[$lineToDelete]);
                file_put_contents($file, implode(PHP_EOL, $tasks) . PHP_EOL);
            }

            // Display tasks
            if (file_exists($file)) {
                $tasks = file($file, FILE_IGNORE_NEW_LINES);
                foreach ($tasks as $index => $task) {
                    echo "<li>
                            <span>$task</span>
                            <form method='POST' style='display: inline;'>
                                <input type='hidden' name='taskLine' value='$index'>
                                <button type='submit' name='delete'>Delete</button>
                            </form>
                          </li>";
                }
            }
            ?>
        </ul>
    </div>
</body>

</html>
