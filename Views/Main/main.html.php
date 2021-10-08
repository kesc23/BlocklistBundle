<?php

// Check if the request is Ajax
if (!$app->getRequest()->isXmlHttpRequest()) {

    // Set tmpl for parent template
    $view['slots']->set('tmpl', 'Details');
}
?>

<div>
    <h1>Hello!</h1>
</div>