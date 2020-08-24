<?php


namespace Felis;


class LoginView extends View
{
    public function __construct(array &$session, array $get) {
        if(isset($session["errormsg"])){

            if(isset($get['e'])) {
                $this->failed = true;
            }


            else{
                $this->failed = false;
            }

        }
    }

    public function presentForm() {
        $html = <<<HTML
<form method="get" action="post/login.php">
    <fieldset>
        <legend>Login</legend>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
            <input type="submit" value="Log in"> <a href="">Lost Password</a>
        </p>
        <p><a href="./">Felis Agency Home</a></p>

    </fieldset>
</form>
HTML;

        return $html;


    }

    /**
     * @return bool
     */
    public function isFailed()
    {
        if ($this->failed) {
            $html = <<<HTML
    <p class="msg">Invalid login credentials</p>
HTML;
            return $html;
        }

    }



    private $failed;

}