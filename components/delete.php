<?php
include '../database/config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    if (isset($_POST['confirm'])) {
        // Delete the record
        $sql = "DELETE FROM `users` WHERE `id`='$user_id'";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            echo "Record deleted successfully.";
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "view.php";
                    }, 2000); // 2 seconds
                </script>';
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['cancel'])) {
        // Redirect to view.php without deleting
        header('Location: view.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Confirmation</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css">
</head>

<body>
    <div class="flex justify-center items-center h-screen">
        <div class="bg-gray-100 p-8 rounded shadow">
            <p class="text-center text-lg">Are you sure you want to delete this record?</p>
            <div class="flex justify-center mt-4">
                <form action="" method="POST">
                    <button type="submit" name="confirm" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded mx-2">Yes</button>
                    <button type="submit" name="cancel" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded mx-2">No</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
