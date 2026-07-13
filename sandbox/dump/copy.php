<?php

// The columns we are changing
// during the copy.
$changes = array(
    'username' => 'chrisdoe',
    'first_name' => 'Chris',
);

// In the above example, "id" is an
// auto increment column. So we tell
// the function to ignore it and allow
// the database to assign the correct
// auto increment value.
$what_to_ignore = array(
    'id',
);

// Make the copy.
$copy = copy_row('users','janedoe','username',$changes,$what_to_ignore);
if ($copy) {
    echo "Success";
    exit;
} else {
    echo "Failure";
    exit;
}

function copy_row($table,$id_being_copied,$id_being_copied_key = 'id',$what_to_update = array(),$what_to_ignore = array())
{

    // Connect to MySQL
    $database_host = 'YOUR_DATABASE_SERVER_HOST'; // Often "localhost"
    $database_name = 'YOUR_DATABASE_NAME';
    $database_username = 'YOUR_DATABASE_USERNAME';
    $database_password = 'YOUR_DATABASE_PASSWORD';
    $db = new PDO("mysql:host=" . $database_host . ";dbname=" . $database_name, $database_username, $database_password);

    // Get the row we are copying.
    $query = "
        SELECT *
        FROM `" . $table . "`
        WHERE `" . $id_being_copied_key . "` = :id
        LIMIT 1
    ";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id_being_copied);
    $stmt->execute();
    $q1 = $stmt->fetch(PDO::FETCH_ASSOC);

    $ins = '';
    $vals = '';

    // Make sure the row exists.
    if (! empty($q1[$id_being_copied_key])) {

        // Re-build a new MySQL query by
        // looping all columns within the row,
        // updating any columns with new values
        // if required.
        $bindings = array();
        foreach ($q1 as $name => $value) {
            if (! in_array($name, $what_to_ignore)) {
                if (array_key_exists($name,$what_to_update)) {
                    if (! empty($what_to_update[$name])) {
                        $ins .= ",`" . $name . "`";
                        $vals .= ",?";
                        $bindings[] = $what_to_update[$name];
                    }
                } else {
                    $ins .= ",`" . $name . "`";
                    $vals .= ",?";
                    $bindings[] = $value;
                }
            }
        }

        // Run the new query to
        // insert the "copied" row.
        $new_query = "
            INSERT INTO `" . $table . "` (" . ltrim($ins,',') . ")
            VALUES (" . ltrim($vals,',') . ")
        ";

        $new_stmt = $db->prepare($new_query);
        $new_stmt->execute($bindings);

        return true;

    } else {

        return false;

    }
}
