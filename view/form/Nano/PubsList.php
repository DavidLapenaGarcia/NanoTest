<div id="content">
    <fieldset>
        <legend>Pubs list</legend>    
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <table>
                        <tr>
                        <td>id</td>
                            <td>Doi</td>
                            <td>Title</td>
                            <td>Abstract</td>
                            <td>Pubtype</td>
                            <td>Link</td>
                            <td>Cross</td>
                            <td>Detail</td>

                        </tr>
EOT;
                foreach ($content as $pub) {
                    echo <<<EOT
                        <tr>
                        <td>{$pub->getId()}</td>
                            <td>{$pub->getDoi()}</td>
                            <td>{$pub->getTitle()}</td>
                            <td>{$pub->getAbstract()}</td>
                            <td>{$pub->getPubType()}</td>
                            <td>{$pub->getLinkWeb()}</td>
                            <td>{$pub->getJsonCrossref()}</td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="doi" value="{$pub->getDoi()}"/>
                                    <button type="submit" name="action" value="search_pub">Detail</button>
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