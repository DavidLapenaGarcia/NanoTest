<div id="content">

    <form method="post" action="">
        <fieldset>
                <legend>Add Pub Test</legend>
                <label>id *:</label>
                <input type="text" placeholder="keyWordId" name="keyWordId" 
                value="<?php if (isset($content)) { echo $content->getId(); } ?>" readonly />

                <label>Totem *:</label>
                <input type="text" placeholder="totem" name="totem" 
                        value="<?php if (isset($content)) { echo $content->getTotem(); } ?>" />

                <label>Contented *:</label>
                <input  type="text" placeholder="contented" name="contented" 
                        value="<?php if (isset($content)) { echo $content->getContented(); } ?>" />

                <label>* Required fields</label>

                <button type="submit" name="action" value="add_key">Add</button>
                <button type="submit" name="action" value="update_key">Modify</button>
                <button type="submit" name="action" value="delete_key">Delete</button>
                <input type="submit" name="reset" value="reset" onClick="form_reset(this.form.id);" />

        </fieldset>
    </form>
</div>