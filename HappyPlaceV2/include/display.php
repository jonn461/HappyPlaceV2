<?php
$displayQuery=('SELECT
student.firstname, student.lastname, zip.zip_code, zip.place
FROM student 
JOIN zip USING(zip_code)');
?>
