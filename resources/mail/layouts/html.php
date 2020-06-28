<?php

declare(strict_types=1);

/* @var $content string Mail contents as view render result */
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?= $content ?>

<footer style="margin-top: 5em">
-- <br />
Mailed by Yii
</footer>

</body>
</html>
