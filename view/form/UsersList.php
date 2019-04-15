<div id="content">
    <fieldset>
        <legend>User list</legend>    
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Password</th>
                        </tr>
EOT;
                foreach ($content as $user) {
                    echo <<<EOT
                        <tr>
                            <td>{$user->getName()}</td>
                            <td>{$user->getPassword()}</td>
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