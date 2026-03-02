<?php
session_start(); // this is very important, don't forget it to ensure data persistence!

class Appointments {
    public $clinicName;
    public $patientName;
    public $age;
    public $appointDate;
    public $appointTime;
    public $appointType;
    
    public function __construct($clinic, $name, $age, $date, $time, $type) {
        $this->clinicName = $clinic;
        $this->patientName = $name;
        $this->age = $age;
        $this->appointDate = $date;
        $this->appointTime = $time;
        $this->appointType = $type;
    }
    public function getClinicName() { return $this->clinicName; }
    public function getPatientName() { return $this->patientName; }
    public function getAge() { return $this->age; }
    public function getAppointDate() { return $this->appointDate; }
    public function getAppointTime() { return $this->appointTime; }
    public function getAppointType() { return $this->appointType; }
}
if (!isset($_SESSION["appointment_list"])) { // create a new array if session variable does not exist
    $_SESSION["appointment_list"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clinic = $_POST["clinicName"];
    $name = $_POST["patientName"];
    $age = $_POST["age"];
    $date = $_POST["appointDate"];
    $time = $_POST["appointTime"];
    $type = $_POST["appointType"];
    
    $newAppointment = new Appointments($clinic, $name, $age, $date, $time, $type);
    $_SESSION["appointment_list"][] = $newAppointment; //append the new appointment to the session array
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
            </tr>
            <?php
                foreach ($_SESSION["appointment_list"] as $i) {
                ?>
                <tr class="displayRow">
                    <td><?= $i->getClinicName(); ?></td>
                    <td><?= $i->getPatientName(); ?></td>
                    <td><?= $i->getAge(); ?></td>
                    <td><?= $i->getAppointDate(); ?></td>
                    <td><?= $i->getAppointTime(); ?></td>
                    <td><?= $i->getAppointType();?></td>
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