<?php
include '../database/config.php';

try {
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM users");

    // Execute the statement
    $stmt->execute();

    // Fetch all rows as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process the result
    foreach ($result as $row) {
        // Access row data using column names
        $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $gender = $row['gender'];

        // Do something with the data
        // Example: echo $firstname;
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    if (count($result) > 0) {
                        foreach ($result as $row) {
                            $id = $row['id'];
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $email = $row['email'];
                            $gender = $row['gender'];
                ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $firstname; ?></td>
                                <td><?php echo $lastname; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $gender; ?></td>
                                <td>
                                    <a class="btn btn-info" href="update.php?id=<?php echo $id; ?>">Edit</a>&nbsp;
                                    <a class="btn btn-danger" href="delete.php?id=<?php echo $id; ?>">Delete</a>
                                </td>
                            </tr>                       
                <?php
                        }
                    }
                ?>                
            </tbody>
        </table>
    </div> 
</body>
</html>
