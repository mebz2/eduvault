<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="textbox.css">
</head>

<body>
    <div class="text-box-container">
        <p class="label"><?php echo $label; ?></p>
        <input
            type="<?php echo $type; ?>"
            class="text-box">
    </div>
</body>

</html>