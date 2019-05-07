<div id="content">
    <fieldset>
        <legend>Pubs list</legend>    
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <table>
                        <tr>
                        <td>Doi</td>
                        <td>Title</td>
                        <td>Abstract</td>
                        <td>Pubtype</td>
                        <td>Link</td>
                        </tr>
EOT;
                foreach ($content as $pub) {
                    echo <<<EOT
                        <tr>
                            <td>{$pub->getDoi()}</td>
                            <td>{$pub->getTitle()}</td>
                            <td>{$pub->getAbstract()}</td>
                            <td>{$pub->getPubType()}</td>
                            <td>{$pub->getLinkWeb()}</td>
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