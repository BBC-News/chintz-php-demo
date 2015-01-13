<?php

require_once __DIR__.'/vendor/autoload.php';

// An organism we want to render?
$elementName = 'elementA';

$chintzParams = array(
    'chintz-base-path' => dirname(__FILE__) . '/vendor/pgchamberlin/chintz'
);

$chintzParser = new Chintz_Parser($chintzParams);
$chintzParser->prepare($elementName);

$data = array(
    'title' => 'Chintz Library Rendering Demo',
    'items' => array(
        array(
            'subtitle' => 'Simple example nested item',
            'name' => 'Bobbins',
            'occupation' => 'Philosopher'
        ),
        array(
            'subtitle' => 'Another nested item',
            'name' => 'Bobbinella',
            'occupation' => 'Scientist'
        )
    )
);

?>
<!doctype html>
<html>
<head>
    <style type="text/css">
        <?= $chintzParser->rawCSS() ?>
    </style>
</head>
<body>
    <?= $chintzParser->render($elementName, $data) ?>
</body>
</html>
