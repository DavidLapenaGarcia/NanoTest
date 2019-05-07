<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Input Author to search:</legend>

            <label>Name:</label>
            <input type="text" placeholder="First Name" name="name" value="<?php
                if (isset($content['name'])) {
                    echo $content['name'];
                }
            ?>">
            <label>Surname *:</label>
            <input type="text" placeholder="Surname" name="surname" value="<?php
                if (isset($content['surname'])) {
                    echo $content['surname'];
                }
            ?>" require>
            <label>AUID:</label>
            <input type="text" placeholder="AUID" name="auid" value="<?php
                if (isset($content['auid'])) {
                    echo $content['auid'];
                }
            ?>">

            <label>Affiliation City:</label>
            <input type="text" placeholder="City" name="city" value="<?php
                if (isset($content['city'])) {
                    echo $content['city'];
                }
            ?>">
            <label>Affiliation Country:</label>
            <input type="text" placeholder="Country" name="country" value="<?php
                if (isset($content['country'])) {
                    echo $content['country'];
                }
            ?>">
            <label>AF-ID:</label>
            <input type="text" placeholder="Af-Id" name="afid" value="<?php
                if (isset($content['afid'])) {
                    echo $content['afid'];
                }
            ?>">
            <label>* Required fields</label>
            <input type="submit" name="action" value="by_author" />
            <input type="reset" name="reset" value="reset" />
        </fieldset>
    </form>
    <div>
        <div>
        <?php 
        // include("view/form/MessagesForm.php");
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