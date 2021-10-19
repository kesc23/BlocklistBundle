<?php
$view->extend( 'MauticCoreBundle:Default:content.html.php' );

$header = 'Block List';

?>
<div class="content-body">
    <div class="pa-md">
        <pre><?php
        print_r( $contact->addToBlocklist( 'kesc23@hotmail.com' ) );
        print_r( $contact->getTables() );
        print_r( $contact->dostos() );
        ?></pre>
        <h1>Hello!</h1>
    </div>
</div>