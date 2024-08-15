<?php
session_start();
session_unset();
session_destroy();
header("Location: ../views3/view3LoginTutor.php");
exit();
?>