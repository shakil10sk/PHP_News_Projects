
<?php
include "config.php";
session_start();
session_unset();
if (session_destroy()) {

    header("Location: {$hostname}");
} else {
    echo "not destroy";
}

?>