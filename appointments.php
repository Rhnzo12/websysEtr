<?php
session_start();
include('db.php');

if (isset($_POST['schedule_appointment'])) {
    $pet_id = $_POST['pet_id'];
    $appointment_date = $_POST['appointment_date'];
    $service_type = $_POST['service_type'];

    $query = "INSERT INTO appointments (user_id, pet_id, appointment_date, service_type) 
              VALUES ('{$_SESSION['user_id']}', '$pet_id', '$appointment_date', '$service_type')";
    
    if ($db->query($query) === TRUE) {
        echo "Appointment scheduled successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$query = "SELECT * FROM appointments WHERE user_id = '{$_SESSION['user_id']}'";
$result = $db->query($query);

while ($appointment = $result->fetch_assoc()) {
    echo "Appointment ID: " . $appointment['id'] . "<br>";
    echo "Pet ID: " . $appointment['pet_id'] . "<br>";
    echo "Date: " . $appointment['appointment_date'] . "<br>";
    echo "Service Type: " . $appointment['service_type'] . "<br>";
    echo "Status: " . $appointment['status'] . "<br>";
    echo "<hr>";
}
?>

<form method="post">
    <input type="date" name="appointment_date" required>
    <select name="service_type">
        <option value="veterinary">Veterinary</option>
        <option value="grooming">Grooming</option>
        <option value="other">Other</option>
    </select>
    <input type="number" name="pet_id" placeholder="Pet ID" required>
    <button type="submit" name="schedule_appointment">Schedule Appointment</button>
</form>
