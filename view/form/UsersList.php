<div id="content">
    <fieldset>
        <legend>User list</legend>    
        <?php
            if (isset($content)) {
                echo <<<EOT
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Mail</th>
                            <th>Detail</th>
                        </tr>                             
EOT;
                foreach ($content as $user) {
                    echo <<<EOT
                        <tr>
                            <td>{$user->getId()}</td>
                            <td>{$user->getFirstName()}</td>
                            <td>{$user->getPassword()}</td>                        
                            <td>{$user->getMail()}</td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="userId" value="{$user->getId()}"/>
                                    <button type="submit" name="action" value="search">Detail</button>
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