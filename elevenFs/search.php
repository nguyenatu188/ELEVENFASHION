<?php
include 'connect.php';

if(isset($_POST['query'])){
    $search = $_POST['query'];

    $sql = "SELECT distinct pname, pImage FROM product WHERE pname LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pname = $row['pname'];
            $pImage = $row['pImage'];

            echo '<div class="container container_text col product">';
            echo '<a href="chitietsanpham.php?pname=' . urlencode($pname) . '" class="text-decoration-none">';
            echo '<img class="shadow mb-5 bg-body-tertiary rounded" src="images/' . $pImage . '" alt="" style="max-width: 200px; max-height: 200px;">';
            echo '<p style="max-width: 200px; max-height: 100px;">' . $pname . '</p>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
} else {
    echo "No query provided";
}

$conn->close();
?>
