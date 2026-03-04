<?php
include_once "dbconn.php"; // include the database connection file, adjust the path if necessary
class Appointments {
    public $appId;
    public $clinicName;
    public $patientName;
    public $age;
    public $appointDate;
    public $appointTime;
    public $appointType;
    
    public function __construct($id, $clinic, $name, $age, $date, $time, $type) {
        $this->appId = $id;
        $this->clinicName = $clinic;
        $this->patientName = $name;
        $this->age = $age;
        $this->appointDate = $date;
        $this->appointTime = $time;
        $this->appointType = $type;
    }
    public function getAppointId() { return $this->appId; }
    public function getClinicName() { return $this->clinicName; }
    public function getPatientName() { return $this->patientName; }
    public function getAge() { return $this->age; }
    public function getAppointDate() { return $this->appointDate; }
    public function getAppointTime() { return $this->appointTime; }
    public function getAppointType() { return $this->appointType; }
}
?>