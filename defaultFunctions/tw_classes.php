<?php
require_once('../Global/config.php');
function getClasses() {
    $db = pdoConnect();

    $sql = "SELECT class_name, instructor, time , section FROM `tw_classes`";
    $classes = [];

    foreach ($db->query($sql) as $result) {
        $classes[] = [
            'class_name' => $result['class_name'],
            'section' => $result['section'],
            'instructor' => $result['instructor'],
            'time' => $result['time']
        ];
    }

    return $classes;
}





?>