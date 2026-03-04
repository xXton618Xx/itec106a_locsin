<?php include_once "appointments.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $clinic = $_POST['clinicName'];
    $name = $_POST['patientName'];
    $age = $_POST['age'];
    $date = $_POST['appointDate'];
    $time = $_POST['appointTime'];
    $type = $_POST['appointType'];
    $update_appointment = new Appointments($id, $clinic, $name, $age, $date, $time, $type);
    $state = $conn->prepare("UPDATE appointments SET
        clinicName = ?,
        patientName = ?,
        age = ?,
        appDate = ?,
        appTime = ?,
        appType = ?
        WHERE appID = ?
    ");
    $get_ID = $update_appointment->getAppointId();
    $get_clinic = $update_appointment->getClinicName();
    $get_name = $update_appointment->getPatientName();
    $get_age = $update_appointment->getAge();
    $get_date = $update_appointment->getAppointDate();
    $get_time = $update_appointment->getAppointTime();
    $get_type = $update_appointment->getAppointType();
    $state->bind_param("ssisssi", $get_clinic, $get_name, $get_age, $get_date, $get_time, $get_type, $get_ID);
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
        <link rel="stylesheet" href="style.css">
        <title>Document</title>
    </head>
    <body>
        <h2>Appointment Update</h2>
        <p>Below is the form for updating appointment, whose output is displayed on index.php</p>
        <form method="post">
            <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
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