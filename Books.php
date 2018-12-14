<?php
if (!defined('Books')) {
    header('Location: /login.html');
    exit();
}

class Books
{

    private $db = null;
    public $pageSize = 0, $pageTotal = 0, $tables = "";

    /**
     * @return MyDB|null
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Books constructor.
     * @param int $pageSize
     */
    public function __construct($pageSize = 20)
    {
        global $config, $dbtbpre;
        $this->tables = "{$dbtbpre}enewsgbook";
        $this->pageSize = $pageSize;
        $dsn = "mysql:host={$config['db']['host']};
                dbname={$config['db']['dbname']};
                charset={$config['db']['charset']}";
        $this->db = new MyDB($dsn, $config['db']['user'], $config['db']['pass']);
    }

    function __destruct()
    {
        $this->db = null;
    }


    function deleteItem(array $project)
    {
        $tables = $this->tables;
        if ($this->db->delete($tables, $project)) {
            return $this->db->getNum();
        } else {
            return false;
        }


    }

    function deleteItems($project)
    {
        global $config;
        $tables = $this->tables;

        $sql = "DELETE FROM $tables WHERE lyid IN ($project)";
        if ($config['evn']['debug']) echo $sql;

        $db = $this->db->getDbh();
        $r = $db->exec($sql);
        return $r;
    }


    function pageContent($pageNum, array $project = null)
    {
        $tables = $this->tables;
        $colums = "lyid, name, mycall, email, lytime, retext, lytext";
        $order = "lyid DESC";

        $this->db->query($tables, $project, $colums, "", $order);
        $this->itemNum = $this->db->getNum();
        $this->pageTotal = ceil($this->itemNum / $this->pageSize);
        $offset = --$pageNum * $this->pageSize;

        return $this->db->fetchAll($tables, $project, $colums, "$offset, $this->pageSize", $order);

    }

    function pageContentFree($pageNum, $where)
    {
        global $config;

        $sql = "SELECT lyid, `name`, mycall, email, lytime, retext, lytext FROM $this->tables WHERE $where ORDER BY lyid DESC";
        if ($config['evn']['debug']) {
            echo $sql;
            echo "<br/>";
        }

        $pdo = $this->db->getDbh();
        $sth = $pdo->query($sql);
        if ($sth) {
            $this->itemNum = $sth->rowCount();
            $this->pageTotal = ceil($this->itemNum / $this->pageSize);
            $offset = --$pageNum * $this->pageSize;
            $sql .= " LIMIT $offset, $this->pageSize";

            if ($config['evn']['debug']) {
                echo $sql;
                echo "<br/>";
            }
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        } else {
            return array();
        }
    }

}