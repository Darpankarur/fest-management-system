<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Events - Fest Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c379eeb1c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a href="index.php" class="navbar-brand">Fest Management</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item active"><a href="events.php" class="nav-link">Events</a></li>
                </ul>
                <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Log out</a>
                <?php } else { ?>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h3>
            Events
            <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="add_event.php" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add</a>
            <?php } ?>
        </h3>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Entry Fee</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'includes/db_connect.php';

                $query = "SELECT * FROM events NATURAL JOIN categories";
                $result = mysqli_query($con, $query);

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $row['event_name']; ?></td>
                    <td><?php echo $row['event_type']; ?></td>
                    <td><?php echo $row['event_fee']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td>
                        <a href="view_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-primary btn-sm">
                            <i class="far fa-eye"></i> View
                        </a>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                        <a href="edit_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-warning btn-sm">
                            <i class="far fa-edit"></i> Edit
                        </a>
                        <a href="delete_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i> Delete
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php }
                } else {
                    $error_message = 'Something went wrong';
                }
                ?>
            </tbody>
        </table>
        <?php if (isset($error_message)) { ?>
        <small class="d-block text-danger mt-2">
            <?php echo $error_message; ?>
        </small>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>