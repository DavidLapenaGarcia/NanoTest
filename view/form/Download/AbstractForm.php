<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Input the Abstract to search:</legend>
            <label>Abstract *:</label>
            <textarea name="abstract"  rows="10" cols="100" placeholder="<?php
            if (isset($content['abstract'])) {
                echo $content['abstract'];
            }else{
                echo "Abstract to search";
            }
            ?>"></textarea>
            <label>* Required fields</label>
            <input type="submit" name="action" value="by_abstract" />
            <input type="reset" name="reset" value="reset" />
        </fieldset>
    </form>
    <p>
        For DMPG membranes, our results show insertion of ∼70% of the maculatin 1.1 molecules, with an angle of insertion of approximately 35° to the membrane normal and with a predominant α-helical structure. These results suggest that maculatin 1.1 acts through a pore-forming mechanism to lyse bacterial membranes.
    </p>
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