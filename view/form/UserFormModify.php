<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>Search, modify or delete User</legend>
            <label>Username *:</label>
            <input type="text" placeholder="Username" name="username" value="<?php
            if (isset($content)) {
                echo $content->getUsername();
            }
            ?>" />
            <label>Password *:</label>
            <input type="text" placeholder="Password" name="password" value="<?php
            if (isset($content)) {
                echo $content->getPassword();
            }
            ?>" />

            <label>* Required fields</label>
            <input type="submit" name="action" value="search" />
            <input type="submit" name="action" value="modify" />
            <input type="reset" name="reset" value="reset" />
        </fieldset>
    </form>
</div>