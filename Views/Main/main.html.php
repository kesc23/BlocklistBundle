<?php
$header = 'Block List';
?>
<div class="content-body">
    <div class="pa-md">
        <?php if( ! $end ): ?>
        <div style="margin: 0px auto">
            <form action="/api/blocklist-bundle/oauth" method="post">
                <fieldset>
                    <label class="control-label required" for="clientKey">Seu client Id</label>
                    <input class="form-control" type="text" name="clientKey" id="clientKey">
                </fieldset>
                <fieldset>
                    <label class="control-label required" for="clientSecret">Seu client secret</label>
                    <input class="form-control" type="password" name="clientSecret" id="clientSecret">
                </fieldset>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <?php endif ?>

        <h1>Hello!</h1>
    </div>
</div>
