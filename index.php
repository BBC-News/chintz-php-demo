<?php

require_once __DIR__.'/vendor/autoload.php';

/**
 * Set up dependencies, so we have a fully loaded Chintz client object
 */

// Set up templating, using Mustache and our custom FS Loader
$mustachePartialLoader = new Chintz_Templater_Mustache_FileSystemAliasLoader();
$mustache = new Mustache_Engine(
    array(
        'partials_loader' => $mustachePartialLoader
    )
);
$chintzTemplaterMustache = new Chintz_Templater_Mustache($mustache, $mustachePartialLoader);

// Set up dependencies handlers, in this case just our basic CSS one
$chintzHandlerCss = new Chintz_Handler_CSS();



// Initialise the parser using the deps we set up above
$chintzParser = new Chintz_Parser(
    array(
        'chintz-base-path' => dirname(__FILE__) . '/vendor/pgchamberlin/chintz',
        'handlers' => array(
            'css' => $chintzHandlerCss
        ),
        'templater' => $chintzTemplaterMustache
    )
);

// As we're going to be rendering data fixtures, we need to initialise our fixture parser
$fixtureParser = new Chintz_Fixture_Parser(
    array(
        'chintz-base-path' => dirname(__FILE__) . '/vendor/pgchamberlin/chintz'
    )
);

/**
 * We are now ready to resolve dependencies and/or render any element stored in our chintz lib :-)
 */

// This is the name of the element we want to render from Chintz, in this case an organism
$elementName = 'elementA';

// In this step the Chintz parser recursively resolves the dependencies of the element
$chintzParser->prepare($elementName);

// Here we get the fixture set "people" from Chintz and set up the data for our element
$people = $fixtureParser->getData('people');
$data = array(
    'title' => 'Chintz Library Rendering Demo',
    'people' => $people
);

// We are now ready to render a page...

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
