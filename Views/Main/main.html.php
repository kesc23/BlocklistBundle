<?php

$header = 'Block List';

?>
<div class="content-body">
    <div class="pa-md">
        <?php if( ! $end ): ?>
        <div style="margin: 0px auto">
            <form target="_self" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
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

        <pre>
            <?php print_t( MAUTIC_TABLE_PREFIX ) ?>
        </pre>
        <h1>Hello!</h1>
    </div>
</div>
