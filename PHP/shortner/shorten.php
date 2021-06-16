<?php
class shorten
{

    /**
     * Error dumb 
     */
    private $error = [
        'invalid_url' => 'URL is invlaid enter corect URL address',
        'failed_add' => 'Unkown Error occured: failed to generate shortened URL',
        'failed_connection' => 'Databse Connection failed',
    ];
    private $error_status = null;
    private $url = 'htts://example.com/?';
    private $length = 6;
    private $token = '';

    /**
     * database info
     */
    private $db_name = 'adeycoder';
    private $db_user = 'root';
    private $db_password = '';
    private $db_url = 'localhost';
    private $db = null;

    public function __construct()
    {
        //initilize db

        try {
            $this->db = new PDO(
                "mysql:host={$this->db_url};dbname={$this->db_name}",
                $this->db_user,
                $this->db_password
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->set_error('failed_connection');
        }
    }


    /**
     * Set error
     */
    private function set_error($e)
    {
        $this->error_status = $e;
    }

    /**
     * get error
     */
    public function get_error()
    {
        return $this->error[$this->error_status];
    }

    /**Unique key/token generator */
    public function token()
    {
        $this->key = 'abcdefghijklmnopqrstuvwxyz012345678';
        $this->token = '';

        for ($this->i = 0; $this->i < $this->length; $this->i++) {
            $this->token .= $this->key[rand(0, strlen($this->key) - 1)];
        }

        return $this->token;
    }

    /**
     * check db if token exist
     */
    public function is_exist(string $token)
    {
        if ($this->db === null) {
            $this->set_error('failed_connection');
            return FALSE;
        }

        $this->stm = $this->db->prepare("SELECT * FROM `url` WHERE token='{$token}'");
        $this->stm->execute();
        $this->stm->setFetchMode(PDO::FETCH_ASSOC);

        if ($this->stm->rowCount() === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //add to Database
    public function add($url)
    {
        //check valid url
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->set_error('invalid_url');
            return FALSE;
        }

        if ($this->db === null) {
            $this->set_error('failed_connection');
            return FALSE;
        }
        //generate token

        do {
            $this->token();
        } while ($this->is_exist($this->token));

        //
        $this->date = date("Y-m-d h:i:s");
        //add to db
        try {
            $this->stm = $this->db->prepare(
                "INSERT INTO `url` (`url`,`token`,`date`) VALUES ('{$url}','{$this->token}','{$this->date}')"
            );
            $this->stm->execute();
            return TRUE;
        } catch (PDOException $e) {
            $this->set_error('failed_add');
            echo $e->getMessage();
            return FALSE;
        }
    }

    //generated link
    public function get_shorten()
    {
        if (!empty($this->token)) {
            return $this->url . $this->token;
        }
    }

    //get url from Database
    public function get_url($token)
    {
        $this->stm = $this->db->prepare(
            "SELECT * FROM `url` WHERE `token`='{$token}'"
        );
        $this->stm->setFetchMode(PDO::FETCH_ASSOC);
        $this->stm->execute();

        $this->data = $this->stm->fetchAll()[0];

        return $this->data['url'];
    }
}
