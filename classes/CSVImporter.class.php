<?php
/*
CSVImporter V 1.0 - Just Another CSV Importer Class
Description: Import CSV data into a specific MySQL database table 
Author: Rub�n Crespo �lvarez <rumailster@gmail.com>
PHP Version: > 4.0
http://peachep.wordpress.com
*/

//--------------------- Class CSVImporter
class CSVImporter {

    var $table;
    var $Csv;
    var $truncate;
    var $cnx;


    function CSVImporter ($table, $Csv, $truncate, $cnx) {
        $this->table = $table;
        $this->Csv = $Csv;
        $this->truncate = $truncate;
        $this->cnx = $cnx;
    }

    function result () {
        $sql = "SELECT * FROM ".$this->table;
        $result = mysql_query ($sql, $this->cnx);
        return $result;
    }

    function listFields() {
        $result = $this->result ();
        $numFields = mysql_num_fields ($result);

        for ($i=0; $i < $numFields; $i++) {
            $fields[] = mysql_field_name ($result, $i);
        }

        return $fields;
    }

    function InsertData ($values) {

        $fields = $this->listFields ();
        $result = $this->result ();
        $n = 0;

        for ($i = 0; $i <= 3; $i++) {
            $sql = "INSERT INTO ".$this->table." (";

            for ($i = 0; $i < count($fields); $i++) {
                $sql .= $fields [$i];
                if ($i < count ($fields) - 1) {
                    $sql .= ", ";
                }
            }

            $sql .= ") VALUES (";

            for ($i = 0; $i < count($values); $i++) {
                if (mysql_field_type ($result, $n) == 'string' OR mysql_field_type ($result, $n) == 'blob') {
                    $sql .= "'".$values [$i]."'";
                } else {
                    $sql .= $values [$i];
                }

                if ($i < count ($values) - 1) {
                    $sql .= ", ";
                }
                $n++;
            }

            $sql .= ")";
            //echo $sql;
            mysql_query ($sql, $this->cnx);
            if ( mysql_errno($this->cnx) != 0 ) {
                echo mysql_errno($this->cnx);
            }
        }
    }

    function TruncateTable () {

        $sql='TRUNCATE table '.$this->table;

        if (mysql_query ($sql, $this->cnx)) {
            $exito="si";
        } else {
            $exito="no";
        }
        return $exito;
    }

    function Upload () {

        ini_set ('auto_detect_line_endings','1');

        if ($this->truncate == "yes") {
            $this->TruncateTable ();
        }

        $row = 1;

        $fp = fopen ($this->Csv, "r");

        while ($data = fgetcsv ($fp, 1000, ";")) {
            $this->InsertData ($data);
        }

        fclose($fp);
    }
}

//--------------------- Class CSVImporter

?>