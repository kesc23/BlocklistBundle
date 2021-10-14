<?php

?>
<div class="content-body">
    <?php if( ! $end ): ?>
    <script>
        function getUrl( node )
        {
            fullDomain  = `https://${document.domain}/api/blocklist-bundle/oauth`;
            node.action = fullDomain;
        }
    </script>
    <div style="margin: 0px auto">
        <form action="" method="post" onload="getUrl(this)">
            <fieldset>
                <label for="clientSecret">Seu client secret</label>
                <input type="password" name="clientSecret" id="clientSecret">
            </fieldset>
            <fieldset>
                <label for="clientId">Seu client Id</label>
                <input type="text" name="clientId" id="clientId">
            </fieldset>
            <button type="submit">Enviar</button>
        </form>
    </div>
    <?php endif ?>

    <h1>Hello!</h1>
</div>
