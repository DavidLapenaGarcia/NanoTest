<div id="content">
<?php 
        if (isset($content)) { 
                // var_dump($content);
        } 
?>
    <form method="post" action="">
        <fieldset>
                <legend>Add Pub Test</legend>
                <label>id *:</label>
                <input type="text" placeholder="id" name="id" 
                value="<?php if (isset($content)) { echo $content->getId(); } ?>" readonly />

                <label>doi *:</label>
                <input type="text" placeholder="doi" name="doi" 
                        value="<?php if (isset($content)) { echo $content->getDoi(); } ?>" />

                <label>title *:</label>
                <input  type="text" placeholder="title" name="title" 
                        value="<?php if (isset($content)) { echo $content->getTitle(); } ?>" />

                <label>abstract *:</label>
                <input  type="text" placeholder="abstract" name="abstract" 
                        value="<?php if (isset($content)) { echo $content->getAbstract(); } ?>" />
                
                <label>authors *:</label>
                <input  type="text" placeholder="authors" name="authors" 
                        value="<?php if (isset($content)) { echo $content->getAuthors(); } ?>" />
                
                <label>pubType *:</label>
                <input  type="text" placeholder="pubType" name="pubType" 
                        value="<?php if (isset($content)) { echo $content->getPubType(); } ?>" />

                <label>linkWeb *:</label>
                <input  type="text" placeholder="linkWeb" name="linkWeb" 
                        value="<?php if (isset($content)) { echo $content->getLinkWeb(); } ?>" />
                
                <label>linkDownload *:</label>
                <input  type="text" placeholder="linkDownload" name="linkDownload" 
                        value="<?php if (isset($content)) { echo $content->getLinkDownload(); } ?>" />

                <label>jsonRetrieval *:</label>
                <input  type="text" placeholder="jsonRetrieval" name="jsonRetrieval" 
                        value="<?php if (isset($content)) { echo $content->getJsonRetieval(); } ?>" />
                
                <label>jsonCrossRef *:</label>
                <input  type="text" placeholder="jsonCrossref" name="jsonCrossref" 
                        value="<?php if (isset($content)) { echo $content->getJsonCrossref(); } ?>" />

                <label>jsonArticle *:</label>
                <input  type="text" placeholder="jsonArticle" name="jsonArticle" 
                        value="<?php if (isset($content)) { echo $content->getJsonArticle(); } ?>" />
                
                <label>jsonScopus *:</label>
                <input  type="text" placeholder="jsonScopus" name="jsonScopus" 
                        value="<?php if (isset($content)) { echo $content->getJsonScopus(); } ?>" />

                <label>* Required fields</label>

                <button type="submit" name="action" value="add_pub">Add</button>
                <button type="submit" name="action" value="update_pub">Modify</button>
                <button type="submit" name="action" value="delete_pub">Delete</button>
                <input type="submit" name="reset" value="reset" onClick="form_reset(this.form.id);" />

        </fieldset>
    </form>
</div>