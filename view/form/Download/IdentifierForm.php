<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Input a DOI to search:</legend>
            <label>DOI *:</label>
            <input type="text" placeholder="data to search" name="to-search" value="<?php
            if (isset($content['toSearch'])) {
                echo $content['toSearch'];
            }
            ?>">
            <label>* Required fields</label>
            <input type="submit" name="action" value="by_identifier" />
            <input type="reset" name="reset" value="reset" />
        </fieldset>
        <p>Doi Valid: 10.1016/S0014-5793(01)03313-0</p>
        <p>DOI Not found Abstract: 10.1002/anie.201601931</p>
        <p>Doi Invalid : 10.13039/501100001722</p>
    </form>
    <div>
        <table style="width:50%">
            <tr>
                <th>who am i:</th>
                <td><?php echo exec('whoami');?></td>
            </tr>
            <tr>
                <th>current user:</th>
                <td><?php echo get_current_user(); ?></td> 
            </tr>

        </table>
        <div>
        <?php
        //FIX ME
            if (isset($content['result'])) {
                echo "<pre>";
                    var_dump($content['result']);
                echo "</pre>";
                   //admin
            }
            ?>
        </div>
    </div>
    
</div>