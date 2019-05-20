<div id="content">
    <fieldset>
        <legend>Keys list</legend>    
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <table>
                        <tr>
                            <td>id</td>
                            <td>Totem</td>
                            <td>Value</td>
                        </tr>
EOT;
                foreach ($content as $keyw) {
                    echo <<<EOT
                        <tr>
                            <td>{$keyw->getId()}</td>
                            <td>{$keyw->getTotem()}</td>
                            <td>{$keyw->getContented()}</td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="keyWordId" value="{$keyw->getId()}"/>
                                    <button type="submit" name="action" value="detail_key">Detail</button>
                                </form>
                            </td>
                        </tr>
EOT;
                }
                echo <<<EOT
                    </table>
EOT;

            }
        
        ?>
    </fieldset>
</div>