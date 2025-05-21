<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
       

    <div class="container">
        <h1>
        Hello <?php session_start();
        echo $_SESSION['username'] ?>
        </h1>
        
       <h2>Your Tasks</h2>
    <table border="1">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Delete</th>
                    </tr>
                </thead>
        <tbody>
            <!-- PHP will loop here and fill this part with rows -->
            <?php
            include("../database.php");


        $user_id = $_SESSION['user_id'];

        $query = "SELECT * FROM tasks WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);



        $task_name_data = "";
        $status_data = "";

        // fetching data from db
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
               // echo "<td>" . htmlspecialchars($row['task_name']) . "</td>";

               echo "<td>
                        <form method='POST' action='edit.php'>
                            <input type='hidden' name='edit_task_id' value='" . $row['id'] . "'>
                            <input type='text' name='edit_task_name' value='" . htmlspecialchars($row['task_name']) . "'>
                            <button type='submit' name='edit_name'>Edit</button>
                        </form>
                    </td>";
                echo "<td>
                        <form method='POST' action='edit.php'>
                            <input type='hidden' name='edit_task_id' value='" . $row['id'] . "'>
                            <select name='statusManual'>
                                <option value='pending'" . ($row['status'] === 'pending' ? ' selected' : '') . ">Pending</option>
                                <option value='completed'" . ($row['status'] === 'completed' ? ' selected' : '') . ">Completed</option>
                            </select>
                            <button type='submit' name='edit'>Edit</button>
                        </form>
                    </td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td><form method='POST' action='delete.php'><input type='hidden' name='task_id' value='" . $row['id'] . "'><button type='submit' name='delete'>Delete</button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No tasks found.</td></tr>";
        }
        mysqli_close($conn);
        ?>
        </tbody>
    </table>

 <form action="add.php" method="POST" style="margin-top:20px">
            <label for="task_name">New Task Name: </label>
            <input type="text" name="task_name" placeholder="Add a new task">
            <br>
          <label for="status">Status</label>
            <select name="status" id="status">
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            </select>
            <br>
            <button type="submit" name="add">Add task</button>
        </form>


    </div>


        <a href="../index.php" class="logout-btn">Logout</a>

</body>
</html>