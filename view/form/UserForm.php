<div id="content">
    <form method="post" action="">
        <fieldset>
            <legend>User Test</legend>
                <label>UserId *:</label>
                <input type="text" placeholder="userId" name="userId" value="<?php
                if (isset($content)) {
                    echo $content->getId();
                }
                ?>"/>

                <label>Username *:</label>
                <input type="text" placeholder="name" name="name" value="<?php
                if (isset($content)) {
                    echo $content->getName();
                }
                ?>" />

                <label>Password *:</label>
                <input type="text" placeholder="Password" name="password" value="<?php
                if (isset($content)) {
                    echo $content->getPassword();
                }
                ?>" />

                <label>Mail *:</label>
                <input type="text" placeholder="mail" name="mail" value="<?php
                if (isset($content)) {
                    echo $content->getMail();
                }
                ?>" />

            <label>* Required fields</label>
            <input type="submit"    name="action"   value="add_user" />
            <input type="submit"    name="action"   value="modify_user" />
            <input type="submit"    name="action"   value="delete_user" />
            <input type="reset"     name="reset"    value="reset" />
        </fieldset>
    </form>
</div>