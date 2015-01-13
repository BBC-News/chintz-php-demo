<?php

require_once __DIR__.'/vendor/autoload.php';

$mustachePartialLoader = new Chintz_Templater_Mustache_FileSystemAliasLoader();
$mustache = new Mustache_Engine(
    array(
        'partials_loader' => $mustachePartialLoader
    )
);

$chintzParams = array(
    'chintz-base-path' => dirname(__FILE__) . '/vendor/pgchamberlin/chintz',
    'handlers' => array(
        'css' => new Chintz_Handler_CSS()
    ),
    'templater' => new Chintz_Templater_Mustache($mustache, $mustachePartialLoader)
);

$chintzParser = new Chintz_Parser($chintzParams);

$elementName = 'elementA';

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
        <?= $chintzParser->getDependencies('css') ?>
    </style>
</head>
<body>
    <?= $chintzParser->render($elementName, $data) ?>
</body>
</html>
