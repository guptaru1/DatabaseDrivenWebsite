<?php
namespace Felis;

/**
 * Manage users in our system.
 */
class Users extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }
    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @return User object if successful, null otherwise.
     */
    public function login($email, $password) {

        $sql =<<<SQL
SELECT * from $this->tableName
where email=? and password=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($email, $password));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));

    }
    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @return User object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));
    }

    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user) {
        $id = $user->getId();
        if ($id == null){
            return false;
        }

        $sql =<<<SQL
        UPDATE $this->tableName
        SET email = ?,name = ?,phone = ?,address = ?,notes = ?,role = ?
        WHERE id =  $id;
SQL;


        $pdo = $this->pdo();

        $statement = $pdo->prepare($sql);


        try {
            $ret = $statement->execute(array($user->getEmail(),$user->getName(),$user->getPhone(),$user->getAddress(),$user->getNotes(),$user->getRole()));

            $cnt = $statement->rowCount();

            if ($cnt == 0){
                return false;
            }

            if (!$ret){
                return false;
            }

        } catch(\PDOException $e) {
            // do something when the exception occurs...
            return false;
        }
        return true;

    }
}