<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/stylesheets/style.css">
    <?php
    if (count($stylesheets) > 0) {
        foreach ($stylesheets as $style) {
            echo '<link rel="stylesheet" href="' . $style . '">';
        }
    }
    ?>
</head>

<body>