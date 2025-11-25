<?php
require 'Connection.php';

if (isset($_POST['dept_id'])) {

    $dept_id = $_POST['dept_id'];

    $sql = "SELECT d_id, d_name FROM sampledoctor WHERE dept_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $dept_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = "<option value=''>Select Doctor</option>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row['d_id'] . "'>" . $row['d_name'] . "</option>";
        }
    } else {
        $options .= "<option>No doctors available</option>";
    }

    echo $options;
}
?>
