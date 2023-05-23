<?php
include '../database/config.php';

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    // Check for existing email or name
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email OR (firstname = :firstname AND lastname = :lastname)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->execute();

    if ($stmt->fetchColumn() > 0) {
        // Show rejection message
        
        echo "<script>
                setTimeout(function() {
                    var errorMessage = document.getElementById('error-message');
                    errorMessage.style.display = 'none';
                }, 3000);
              </script>";
    } else {
        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, gender) VALUES (:firstname, :lastname, :email, :password, :gender)");

            // Bind the parameter values
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':gender', $gender);

            // Execute the statement
            $stmt->execute();

            echo "New record created successfully.";

echo '<script>
    setTimeout(function(){
        window.location.href = "create.php";
    }, 2000); // 2 seconds
</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Signup Form</h2>
    <form action="" method="POST">
        <fieldset>
            <legend>Personal information:</legend>
            First name:<br>
            <input type="text" name="firstname"><br>
            Last name:<br>
            <input type="text" name="lastname"><br>
            Email:<br>
            <input type="email" name="email"><br>
            Password:<br>
            <input type="password" name="password"><br>
            Gender:<br>
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Female">Female
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
    
    <script>
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'block';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
