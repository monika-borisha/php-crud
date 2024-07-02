<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head> 
<body>

<h1 class="bg-secondary text-center text-light py-2">PHP CRUD</h1>
<br>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div>
            <div class="modal-body">
                <form method="post" action="create.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <b><label for="name">Name:</label></b>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <b><label for="email">Email:</label></b>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <b><label for="contact">Contact:</label></b>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact No" autocomplete="off" maxlength="10" minlength="10" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <b><label for="password">Password:</label></b>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <b><label for="image">Image:</label></b>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
                                <label class="custom-file-label" for="image">Choose File</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <b><label for="gender">Gender</label></b><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">    
    <div class="col-11">
        <div class="input-group mb-0">
            <input type="text" class="form-control" placeholder="Search" id="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary py-2" type="button" id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
    <button class="btn btn-primary col-1" type="button" id="addBtn" data-toggle="modal" data-target="#addModal">Add</button>
</div>

<br><br>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Contact</th>
            <th scope="col">Password</th>
            <th scope="col">Gender</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'connection.php';

        $results_per_page = 2;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
    

        $offset = ($page - 1) * $results_per_page;

        $query = "SELECT * FROM user LIMIT $offset, $results_per_page";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th scope='row'>" . $row['id'] . "</th>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td><img src='image/" . $row['image'] . "' alt='Image' width='50' height='50'></td>";
                echo "<td><a href='update.php?id=" . $row['id'] . "' class='btn btn-success'>Edit</a> <a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>No data found</td></tr>";
        }

        $sql = "SELECT COUNT(id) AS total FROM user";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $results_per_page);
        ?>
    </tbody>
</table>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $page - 1; ?>" tabindex="-1">Previous</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Bootstrap jQuery link -->
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

<!-- Bootstrap Popper and JS link -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7H/ScQsAP7UibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
