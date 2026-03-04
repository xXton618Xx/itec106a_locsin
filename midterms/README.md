- Documentation on how to run the website via XAMPP control panel

-- Database Set-up
1. turn on the host services in XAMPP control panel:
    - Start Apache
    - Start MySQL
2. using the web browser's 'localhost/phpmyadmin/, you can create the database by clicking the 'New'
3. name your database to whatever you prefer, use your surname for easier reference.
4. once database is created, create a new table named 'appointments', using the following command:
    create table appointments (
        appID int(3) primary key auto_increment,
        clinicName varchar(50),
        patientName varchar(100),
        age int(2),
        appDate varchar(30),
        appTime varchar(30),
        appType varchar(50)
    );
5. once the table is created, create the dbconn.php file, and follow the comment there.
6. remember the contents of appointments.php, most especially the getter function names
    they are critical in calling them for the rest of the PHP expressions.
7. make sure that the folder is in the /htdocs folder inside the /xampp folder.
    this is to ensure that the code will be visible in the browser as localhost/yourfoldername
8. the style.css is an optional file, you can remove it or modify it if you want, 
    what matters first is that the localhost is working as intended.
9. if you have any questions, you can message me through messenger.