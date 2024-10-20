<?php
session_start();
session_destroy();
header("Location: ../Vistes/index.view.php?page=1");
exit();
?>