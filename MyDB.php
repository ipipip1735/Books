<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}

class MyDB
{

//global $config;

    private $dbh = null, $result = null, $num = 0;

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }


    /**
     * @return int
     */
    public function getNum()
    {

        return $this->num;
    }


    /**
     * @return null|PDO
     */
    public function getDbh()
    {
        return $this->dbh;
    }

    function __construct($dsn, $user, $pass)
    {
        try {
            $this->dbh = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            $dbh = null;
            global $config;
            if ($config['evn']['debug']) {
                echo "DB Error:" . $e->getMessage() . "<br/>";
            }
            die();

        }

    }

    function __destruct()
    {
        $this->dbh = null;
    }


    private function select($tables, array $project = null, $colums = "*", $limits = "", $orders = "")
    {

        $sql = "SELECT $colums FROM $tables";
        if (!is_null($project)) {
            $sql .= " WHERE";

            foreach ($project as $item => $value) {
                $tmp = explode("|", $item);

                if (!empty($tmp[2])) {
                    $sql .= " $tmp[0] $tmp[2] :$tmp[0]";
                } else {
                    $sql .= " $tmp[0]=:$tmp[0]";
                }
                if (!empty($tmp[1])) $sql .= " $tmp[1]";
            }
        }

        if (!empty($orders)) {
            $sql .= " ORDER BY $orders";
        }

        if (!empty($limits)) {
            $sql .= " LIMIT $limits";
        }

        $sth = $this->dbh->prepare($sql);

        //binding where
        if (!is_null($project)) {
            foreach ($project as $item => $value) {
                $tmp = explode("|", $item);
                $sth->bindValue(":$tmp[0]", $value);
            }
        }

        $this->sqlLog($sth);


        $bool = $sth->execute();

        if ($bool) {
            $this->result = $sth;
            $this->num = $sth->rowCount();
        }
        return $bool;
    }

    function update($tables, array $colums, array $project = null, $limits = "", $orders = "")
    {
        $sql = "UPDATE $tables";

        if (is_null($colums)) {
            return "ERROR, have no colums";
        } else {
            $sql .= " SET";
            foreach ($colums as $item => $value) {
                $sql .= " " . "$item=?,";
            }
            $sql = substr($sql, 0, -1);
        }

        if (!is_null($project)) {
            $sql .= " WHERE";

            foreach ($project as $item => $value) {
                $tmp = explode("|", $item);

                if (!empty($tmp[2])) {
                    $sql .= " $tmp[0]$tmp[2]?";
                } else {
                    $sql .= " $tmp[0]=?";
                }
                if (!empty($tmp[1])) $sql .= " $tmp[1]";
            }
        }

        if (!empty($orders)) {
            $sql .= " ORDER BY $orders";
        }

        if (!empty($limits)) {
            $sql .= " LIMIT $limits";
        }

        $sth = $this->dbh->prepare($sql);

        //binding colums
        $i = 1;
        foreach ($colums as $k => $v) {
            $sth->bindValue($i++, $v);
        }

        //binding where
        if (!is_null($project)) {
            foreach ($project as $item => $value) {
//                echo "-$i--$item--$value<br/>";
                $sth->bindValue($i++, $value);
            }
        }

        $this->sqlLog($sth);

        $bool = $sth->execute();
        if ($bool) $this->num = $sth->rowCount();
        return $bool;
    }


    function insert($tables, array $colums)
    {
        $sql = "INSERT INTO $tables";

        if (is_null($colums)) {

            return "ERROR, have no colums";

        } else {
            $sql .= "(";
            foreach ($colums as $item => $value) {
                $sql .= " $item,";
            }
            $sql = substr($sql, 0, -1) . ")";

            $sql .= " VALUES(";
            foreach ($colums as $item => $value) {
                $sql .= " :$item,";
            }
            $sql = substr($sql, 0, -1) . ")";
        }

        $sth = $this->dbh->prepare($sql);

        //binding colums
        foreach ($colums as $item => $value) {
            $sth->bindValue(":$item", $value);
        }


        $this->sqlLog($sth);

        $bool = $sth->execute();
        if ($bool) $this->num = $sth->rowCount();
        return $bool;
    }


    function delete($tables, array $project, $limits = "", $orders = "")
    {
        $sql = "DELETE FROM $tables";

        if (!is_null($project)) {
            $sql .= " WHERE";

            foreach ($project as $item => $value) {
                $tmp = explode("|", $item);

                if (!empty($tmp[2])) {
                    $sql .= " $tmp[0] $tmp[2] :$tmp[0]";
                } else {
                    $sql .= " $tmp[0]=:$tmp[0]";
                }
                if (!empty($tmp[1])) $sql .= " $tmp[1]";
            }
        }


        if (!empty($orders)) {
            $sql .= " ORDER BY $orders";
        }

        if (!empty($limits)) {
            $sql .= " LIMIT $limits";
        }


        $sth = $this->dbh->prepare($sql);


        //binding where
        if (!is_null($project)) {
            foreach ($project as $item => $value) {
                $tmp = explode("|", $item);
                $sth->bindValue(":$tmp[0]", $value);
            }
        }


        $this->sqlLog($sth);

        $bool = $sth->execute();
        if ($bool) $this->num = $sth->rowCount();
        return $bool;
    }


    function query($tables, array $project = null, $colums = "*", $limits = "", $orders = "")
    {
        if ($this->select($tables, $project, $colums, $limits, $orders)) {
            return $this->result;
        } else {
            return null;
        }
    }


    function fetch($tables, array $project = null, $colums = "*", $limits = "", $orders = "")
    {
        if ($this->select($tables, $project, $colums, $limits, $orders)) {
            return $this->result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    function fetchAll($tables, array $project = null, $colums = "*", $limits = "", $orders = "")
    {
        if ($this->select($tables, $project, $colums, $limits, $orders)) {
            return $this->result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }


    function sqlLog($sth)
    {
        global $config;
        if ($config['evn']['debug']) {
            echo $sth->queryString;
//            $sth->debugDumpParams();
            echo "<br/>";
        }
    }

}