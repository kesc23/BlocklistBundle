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
        <h1>blocklist title!</h1>
        <div class="dashboard-widgets cards">
            <div class="card" style="width: 50%">
                <div></div>
            </div>
            <div class="card" style="width: 50%">
                <div>
                    <?php $leads = $contact->getFromBlocklist();
                    if( $leads ):?>
                    <h3>Esses contatos serão deletados</h3>
                    <div style="max-height: 400px"><?php
                        foreach( $leads as $lead )
                        {
                            echo "<p>Email: {$lead}</p>";
                        }
                    ?></div><?php
                    endif;
                ?></div>
            </div>
        </div>
    </div>
</div>