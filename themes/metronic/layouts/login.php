<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>
        <?= $template['title'] ?>
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="<?= base_url() . $setting_profile['image'] ?? "" ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= PLUGINS ?>/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= CSS ?>/style.bundle.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank">

    <?= $template['body'] ?>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="<?= PLUGINS ?>/global/plugins.bundle.js"></script>
    <script src="<?= JS ?>/scripts.bundle.js"></script>

    <?= (isset($js) ? '<script src="' . $js . '"></script>' : '') . "\r\n\x20\x20\x20\x20" ?>
</body>

</html>