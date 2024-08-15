<?php
session_start();
session_unset();
session_destroy();
header("Location: ../views2/view2LoginAdmin.php");
exit();
?>