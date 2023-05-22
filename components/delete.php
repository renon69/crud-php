<?php
include '../database/config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    if (isset($_GET['confirm'])) {
        $confirm = $_GET['confirm'];

        if ($confirm === 'true') {
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Record deleted successfully.";
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "view.php";
                        }, 3000); // 3 seconds
                    </script>';
            } else {
                echo "Error deleting record.";
            }
        } else {
            echo "Deletion canceled.";
        }
    } else {
        echo "Are you sure you want to delete this record?";
        echo '<br>';
        echo '<a href="delete.php?id=' . $user_id . '&confirm=true">Yes</a> | ';
        echo '<a href="view.php">No</a>';
    }
}
?>
