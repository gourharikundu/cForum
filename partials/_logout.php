<?php
    echo "Loggint you out....";
    session_start();
    session_unset();
    session_destroy();
    header("location: /forum/");
?>