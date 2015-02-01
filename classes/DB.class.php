<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBclass
 *
 * @author DaPa
 */
class DB {
    public $link;
    public $hostname;
    public $username;
    public $database;
    protected  $password;

    function __construct($config_file = "../config/mysql.inc.php") {
        require($config_file);
        $this->hostname = $HOSTNAME;
        $this->username = $USERNAME;
        $this->password = $PASSWORD;
        $this->database = $DATABASE;
    }

    function conectar() {
        $this->link = mysql_connect($this->hostname, $this->username, $this->password);
        mysql_select_db($this->database, $this->link);
    }

    function desconectar() {
        mysql_close();
    }

    function consulta($SQL) {
        return mysql_query($SQL);
    }
}
?>
