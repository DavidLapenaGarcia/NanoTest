<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Input the Abstract to search:</legend>
            <label>Abstract *:</label>
            <textarea name="abstract" placeholder="Abstract to search" rows="10" cols="30" value="<?php
            if (isset($content['abstract'])) {
                echo $content['abstract'];
            }
            ?>"></textarea>
            <label>* Required fields</label>
            <input type="submit" name="action" value="scopus_by_abstract" />
            <input type="reset" name="reset" value="reset" />
        </fieldset>
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