<?php
global $blocklist_postCond;
$view->extend( 'MauticCoreBundle:Default:content.html.php' );

$header = 'Block List';

?>
<div class="content-body">
    <div class="pa-md">
        <?php if( ! $blocklist_postCond ): ?>
        <div style="margin: 0px auto">
            <form target="_self" method="post" action="/s/blocklist">
                <fieldset>
                    <label class="control-label required" for="Blocklist_mauticBaseUrl">Sua URL Base</label>
                    <input
                        class="form-control"
                        type="text"
                        value="<?php echo "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['REMOTE_ADDRESS']}" ?>"
                        name="Blocklist_mauticBaseUrl"
                        id="Blocklist_mauticBaseUrl">
                </fieldset>
                <fieldset>
                    <label class="control-label required" for="clientKey">Seu client Id</label>
                    <input class="form-control" type="text" name="Blocklist_clientKey" id="Blocklist_clientKey">
                </fieldset>
                <fieldset>
                    <label class="control-label required" for="Blocklist_clientSecret">Seu client secret</label>
                    <input class="form-control" type="password" name="Blocklist_clientSecret" id="Blocklist_clientSecret">
                </fieldset>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <?php endif ?>

        <pre>
            <?php print_r( $_POST ) ?>
        </pre>
        <h1>Hello!</h1>
    </div>
</div>