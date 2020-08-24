<?php


namespace Felis;


class LoginController
{
    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $get) {
        // Create a Users object to access the table
        $users = new Users($site);

        $email = strip_tags($get['email']);
        $password = strip_tags($get['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;


        $root = $site->getRoot();
        if($user === null) {
            // Login failed
            $this->redirect = "$root/login.php?e";
            $session["errormsg"] = "\"$root/login.php?e\"";

        } else {
            if($user->isStaff()) {
                $this->redirect = "$root/staff.php";
            } else {
                $this->redirect = "$root/client.php";
            }
        }
        /*if(isset($get['e'])) {
            $this->failed = true;
        }*/
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /*/**
     * @return bool
     */
   /* public function isFailed()
    {
        return $this->failed;
    }*/



    private $redirect;	// Page we will redirect the user to.
    //private $failed;

}