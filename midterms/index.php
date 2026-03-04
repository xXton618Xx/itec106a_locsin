<?php include_once "appointments.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $clinic = $_POST["clinicName"];
    $name = $_POST["patientName"];
    $age = $_POST["age"];
    $date = $_POST["appointDate"];
    $time = $_POST["appointTime"];
    $type = $_POST["appointType"];
    $new_appointment = new Appointments($id, $clinic, $name, $age, $date, $time, $type);
    $state = $conn->prepare("INSERT INTO appointments (clinicName, patientName, age, appDate, appTime, appType) 
                             VALUES (?, ?, ?, ?, ?, ?)");
    $state->bind_param("ssisss", 
        $new_appointment->getClinicName(),
        $new_appointment->getPatientName(),
        $new_appointment->getAge(),
        $new_appointment->getAppointDate(),
        $new_appointment->getAppointTime(),
        $new_appointment->getAppointType()
    );
    $state->execute();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link to external CSS file, optional, can be removed if necessary -->
        <link rel="stylesheet" href="style.css">
        <title>Midterms Test 123</title>
    </head>
    <body>
        <!-- Table Output -->
        <h2>Table Output</h2>
        <p>This area shows the output in the forms below</p>
        <table class="displayTable">
            <tr class="displayRow rowHeader">
                <td>Clinic Name</td>
                <td>Patient Name</td>
                <td>Age</td>
                <td>Appointment Date</td>
                <td>Appointment Time</td>
                <td>Appointment Type</td>
                <td class="options">Options</td>
            </tr>
            <?php
                $app_list = [];
                $result = $conn->query("SELECT * FROM appointments");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $new_appointment = new Appointments(
                            $row['appID'],
                            $row['clinicName'], 
                            $row['patientName'], 
                            $row['age'], 
                            $row['appDate'], 
                            $row['appTime'], 
                            $row['appType']
                        );
                        $app_list[] = $new_appointment;
                    }
                }
                foreach ($app_list as $i) {
                ?>
                <tr class="displayRow">
                    <td><?= $i->getClinicName(); ?></td>
                    <td><?= $i->getPatientName(); ?></td>
                    <td><?= $i->getAge(); ?></td>
                    <td><?= $i->getAppointDate(); ?></td>
                    <td><?= $i->getAppointTime(); ?></td>
                    <td><?= $i->getAppointType();?></td>
                    <td class="options">
                        <div class="optbutton">
                            <a href="delete.php?id=<?= $i->getAppointId(); ?>">Delete</a>
                        </div>
                        <div class="optbutton">
                            <a href="edit.php?id=<?= $i->getAppointId(); ?>">Edit</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <!-- form input -->
        <h2>Form Appointment</h2>
        <p>Below is the form for appointment, whose output is displayed above</p>
        <form method="post">
            <table class="formTable">
                <tr class="formRow">
                    <td class="formLabel">
                        <label for="clinicName">Clinic Name</label>
                    </td>
                    <td class="formInput"><input type="text" name="clinicName" required></td>
                </tr>
                <tr class="formRow">
                    <td class="formLabel">
                        <label for="patientName">Patient Name</label>
                    </td>
                    <td class="formInput"><input type="text" name="patientName" required></td>
                </tr>
                <tr class="formRow">
                    <td class="formLabel">
                        <label for="age">Age</label>
                    </td>
                    <td class="formInput"><input type="number" name="age" required></td>
                </tr>
                <tr class="formRow">
                    <td class="formLabel">
                        <label for="appointDate">Appointment Date</label>
                    </td>
                    <td class="formInput"><input type="date" name="appointDate" required></td>
                </tr>
                <tr class="formRow">
                    <td class="formLabel">
                        <label for="appointTime">Appointment Time</label>
                    </td>
                    <td class="formInput"><input type="time" name="appointTime" required></td>
                </tr>
                <tr class="formRow">
                    <td class="formLabel">
                        <label for="appointType">Appointment Type</label>
                    </td>
                    <td class="formInput">
                        <select name="appointType">
                            <option value="Vaccination">Vaccination</option>
                            <option value="Check-Up">Check-Up</option>
                            <option value="Medicine Purchase">Medicine Purchase</option>
                            <option value="ECG Reading">ECG Reading</option>
                            <option value="Others">Others</option>
                        </select>
                    </td>
                </tr>
                <tr class="formRow">
                    <td class="formInput">
                        <button type="submit">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>