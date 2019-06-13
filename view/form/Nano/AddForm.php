<div id="content">
<?php 
        if (isset($content)) { 
                //var_dump($content);
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
                
                <label>author *:</label>
                <input  type="text" placeholder="authors" name="authors" 
                        value="<?php if (isset($content)) { echo $content->getAuthor(); } ?>" />
                
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
    <div>
<?php
    if (isset($content)) {
                    echo <<<EOT
                <table>
                        <tr>
                                <td>ID</td>
                                <td>{$content->getId()}</td>
                        </tr>
                        <tr>
                                <td>Doi</td>
                                <td>{$content->getDoi()}</td>
                        </tr>
                        <tr>
                                <td>Title</td>
                                <td>{$content->getTitle()}</td>
                        </tr>
                        <tr>
                                <td>Abstract</td>
                                <td>{$content->getAbstract()}</td>
                        </tr>
                        <tr>
                                <td>PubType</td>
                                <td>{$content->getPubType()}</td>
                        </tr>
                        <tr>
                                <td>LinkWeb</td>
                                <td>{$content->getLinkWeb()}</td>
                        </tr>
                        <tr>
                                <td>Crossref</td>
                                <td>{$content->getJsonCrossref()}</td>
                        </tr>
                        <tr>
                                <td>Article</td>
                                <td>{$content->getJsonArticle()}</td>
                        </tr>
                        <tr>
                                <td>Scopus</td>
                                <td>{$content->getJsonScopus()}</td>
                        </tr>
                        <tr>
                                <td>JsonRetieval</td>
                                <td>{$content->getJsonRetieval()}</td>
                        </tr>
                </table>
                <label>KEYWORDS: </label>
                <table>
EOT;
   
                if( !is_null($content->getKeywords()) ) {
                       
                        foreach ($content->getKeywords() as $key) {
                                echo <<<EOT
                                <tr>
                                        <td>Totem</td>
                                        <td>{$key->getTotem()}</td>
                                </tr>
                                <tr>
                                        <td>Contented</td>
                                        <td>{$key->getContented()}</td>
                                </tr>    
EOT;
                        }
                }else{
                        echo "Have not keyword";
                }
                echo "</table>";
    }
?>
    </div>
    
</div>