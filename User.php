<?php
if(!defined('Books'))
{
    header('Location: /login.html');
    exit();
}

class User
{

    private $db = null, $tables = "user_auth";
    public $pageSize = 0, $pageTotal = 0;


    /**
     * Books constructor.
     * @param null $conn
     */
    public function __construct($pageSize = 20, $tables = "user_auth")
    {
        global $config;

        $this->tables = $tables;
        $this->pageSize = $pageSize;
        $dsn = "mysql:host={$config['dbUser']['host']};
                dbname={$config['dbUser']['dbname']};
                charset={$config['dbUser']['charset']}";
        $this->db = new MyDB($dsn, $config['dbUser']['user'], $config['dbUser']['pass']);
    }

    function __destruct()
    {
        $this->db = null;
    }


    function addUser($colums)
    {
        $colums += array("time_authcol" => date("Y-m-d H:i:s", time()));
        return $this->db->insert($this->tables, $colums);
    }

    function deleteUser(array $project)
    {
        if ($this->db->delete($this->tables, $project, 1)) {
            return $this->db->getNum();
        } else {
            return null;
        }
    }


    function modifyUser(array $colums, array $project)
    {
        if ($this->db->update($this->tables, $colums, $project, 1)) {
            return $this->db->getNum();
        } else {
            return null;
        }

    }


    function checkUser(array $project)
    {
        $r = $this->db->fetch($this->tables, $project);
        if ($r) {
            return $r;
        } else {
            return null;
        }
    }


    function getUser($iduser_auth)
    {
        $project = array("iduser_auth" => $iduser_auth);
        return $this->db->fetch($this->tables, $project);
    }


    function getUsers($pageNum, array $project=null)
    {
        $tables = $this->tables;
        $colums = "iduser_auth, name_authcol, time_authcol, role_authcol";
        $order = "iduser_auth DESC";


        $this->db->query($tables, $project, $colums, "", $order);
        $this->itemNum = $this->db->getNum();
        $this->pageTotal = ceil($this->itemNum / $this->pageSize);
        $offset = --$pageNum * $this->pageSize;
        return $this->db->fetchAll($tables, $project, $colums, "$offset, $this->pageSize", $order);

    }


    function showAuth($n)
    {
        global $config;

        echo "<select class=\"form-control\" id='userAuthority' name='userAuthority'>";
        foreach ($config['authority'] as $item => $value) {

            if ($value == $n) {

                echo "<option value='$value' selected=\"selected\">";
            } else {
                echo "<option value='$value'>";
            }
            switch ($value) {
                case 1:
                    echo "管理员";
                    break;
                case 2:
                    echo "普通用户";
                    break;
                default:
                    echo "未授权用户";
                    break;
            }
            echo "</option>";
        }
        echo "</select>";
    }


    function userExist($name_authcol)
    {
        $project = array("name_authcol" => $name_authcol);

        if (is_null($this->db->query($this->tables, $project))) {
            return false;
        } else {
            if ($this->db->getNum() > 0) {
                return false;

            } else {
                return true;
            }
        }


    }

}