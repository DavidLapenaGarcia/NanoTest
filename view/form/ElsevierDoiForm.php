<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Input a DOI to search:</legend>
            <label>DOI *:</label>
            <input type="text" placeholder="data to search" name="to-search" value="<?php
            if (isset($content['toSearch'])) {
                echo $content['toSearch'];
            }
            ?>" />
            <label>* Required fields</label>
            <input type="submit" name="action" value="by_doi" />
            <input type="reset" name="reset" value="reset" />
        </fieldset>
    </form>
    <div>
        <p>
        <?php
        // FIXME
        var_dump($content);
                echo "<p> current user:</p>";
                echo get_current_user();
                echo "<p> who am i:</p>";
                echo exec('whoami');
            if (isset($content['result'])) {
                echo "<pre>";
                    var_dump($content['result']["abstracts-retrieval-response"]["affiliation"]["affiliation-city"]);
                echo "</pre>";
                echo $content['result']["abstracts-retrieval-response"]["affiliation"]["affiliation-city"];
                   //admin
            }
            ?>
        </p>

    </div>
</div>