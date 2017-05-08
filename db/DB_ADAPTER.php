<?php

/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 11:24 AM
 */
class DB_ADAPTER
{
    function __construct()
    {
        $this->connect();
    }


    function connect()
    {
        global $db_host, $db_user, $db_pass, $db_name;
        $connection = @mysql_connect($db_host, $db_user, $db_pass);
        if (!$connection) {
            echo "Lỗi kết nối db";
            return false;
        }

        $db = @mysql_select_db($db_name, $connection);
        @mysql_query('SET NAMES utf8');
        @mysql_query('SET CHARACTER SET utf8');
        @mysql_query('SET COLLATION_CONNECTION="utf8_general_ci"');
        @mysql_query("SET @@global.sql_mode='MYSQL40'");
        if (!$db) {
            echo "Lỗi kết nối db";
            return false;
        }
        return $connection;
    }

    /*
    param1:tenbang(tblDanhMuc)
    param2: doi tuong moi can thay (array('dm_name'=>xyz,'dm_name'=>xyz,))
    param3:array('dm_id'=>1)
    */
    function update($tbl_name, $object, $condistion)
    {
        if ($tbl_name != "") {
            $con_update = "";
            $condistion_temp = "";
            $new_value_tmp = "";
            foreach ($object as $key => $value) {
                $new_value_tmp .= $key . "='" . $value . "',";
            }
            trim($new_value_tmp);
            $new_value = substr($new_value_tmp, 0, strlen($new_value_tmp) - 1);

            if (is_array($condistion)) {
                foreach ($condistion as $key => $value) {
                    $condistion_temp .= $key . "='" . $value . "' AND ";
                }
                trim($condistion_temp);
                $con_update = substr($condistion_temp, 0, strlen($condistion_temp) - 4);

            } else {
                $con_update = $condistion;
            }

            $sql = "UPDATE " . $tbl_name . " SET " . $new_value . " WHERE " . $con_update;
            $result = @mysql_query($sql) or die(@mysql_error());
            return $result;
        }

    }

    function insert_to_database($tb_name, $object)
    {
        if ($tb_name != "") {
            $field_tmp = '';
            $value_tmp = "";
            foreach ($object as $key => $value) {
                $field_tmp .= $key . ',';
                $value_tmp .= "'" . $value . "',";
            }

            trim($field_tmp);
            trim($value_tmp);
            $values = substr($value_tmp, 0, strlen($value_tmp) - 1);
            $fields = substr($field_tmp, 0, strlen($field_tmp) - 1);


            $sql = "INSERT INTO " . $tb_name . " (" . $fields . ") VALUES(" . $values . ")";
            $result = @mysql_query($sql) or die(@mysql_error());
            return $result;
        }

    }

    function insert_to_database_multiple_rows($tb_name, $listobject)
    {
        if ($tb_name != "") {
            $field_tmp = '';
            $value_tmp = "";
            $object0 = $listobject[0];
            foreach ($object0 as $key => $value) {
                $field_tmp .= $key . ',';
//                $value_tmp .= "'" . $value . "',";
            }

            trim($field_tmp);
//            trim($value_tmp);
//            $values = substr($value_tmp, 0, strlen($value_tmp) - 1);
            $fields = substr($field_tmp, 0, strlen($field_tmp) - 1);

            $sql = "INSERT INTO " . $tb_name . " (" . $fields . ") VALUES ";
            foreach ($listobject as $object) {
                $value_tmp = "";
                foreach ($object as $key => $value) {
                    $value_tmp .= "'" . $value . "',";
                }
                trim($value_tmp);
                $values = substr($value_tmp, 0, strlen($value_tmp) - 1);
                $sql .= " (" . $values . "),";
            }
            $sql = substr($sql, 0, strlen($sql) - 1);
            $result = @mysql_query($sql) or die(@mysql_error());
            return $result;
        }

    }

    function delete($tbl_name, $condistion)
    {
        $condistion_temp = "";
        if ($tbl_name != "") {
            $con_del = "";
            if (is_array($condistion)) {
                foreach ($condistion as $key => $value) {
                    $condistion_temp .= $key . "='" . $value . "' AND ";
                }
                trim($condistion_temp);
                $con_del = substr($condistion_temp, 0, strlen($condistion_temp) - 4);
            } else {
                $con_del = $condistion;
            }
            $sql = "DELETE FROM " . $tbl_name . " WHERE " . $con_del;
            $result = @mysql_query($sql) or die(@mysql_error());
            return $result;
        }
    }

    function get_data_use_query($sql)
    {
        $result = mysql_query($sql) or die(@mysql_error());
        $num_rows = @mysql_num_rows($result);
        $data = array();
        $tmp = array();


        if ($num_rows > 0) {
            while ($rows = @mysql_fetch_assoc($result)) {

                foreach ($rows as $key => $value) {
                    $tmp[$key] = $value;
                }
                array_push($data, $tmp);
            }
        }

        return $data;
    }

    function get_count_use_query($sql)
    {
        $result = mysql_query($sql) or die(@mysql_error());
        $num_rows = @mysql_num_rows($result);
        $count = 0;
        if ($num_rows > 0) {
            while ($rows = @mysql_fetch_assoc($result)) {
                foreach ($rows as $key => $value) {
                    $count = $value;
                }
            }
        }
        return (int)$count;
    }

    function get_by_conditions($tbl_name, $con)
    {
        if ($tbl_name != "") {
            $data = array();
            $tmp = array();
            if (is_array($con)) {
                $condistion_temp = "";
                foreach ($con as $key => $value) {
                    $condistion_temp .= $key . "='" . $value . "' AND ";
                }
                trim($condistion_temp);
                $condistion = substr($condistion_temp, 0, strlen($condistion_temp) - 4);
                $sql = "SELECT * FROM " . $tbl_name . " WHERE " . $condistion;
                $result = mysql_query($sql) or die(@mysql_error());
                $num_rows = @mysql_num_rows($result);

                if ($num_rows > 0) {
                    while ($rows = @mysql_fetch_assoc($result)) {

                        foreach ($rows as $key => $value) {
                            $tmp[$key] = $value;
                        }
                        array_push($data, $tmp);
                    }
                }


            } else {
                $table = trim($tbl_name);
                $sql = "SELECT * FROM " . $table . " WHERE " . $con;
                $result = mysql_query($sql) or die(@mysql_error());
                $num_rows = @mysql_num_rows($result);

                if ($num_rows > 0) {
                    while ($rows = @mysql_fetch_assoc($result)) {

                        foreach ($rows as $key => $value) {
                            $tmp[$key] = $value;
                        }
                        array_push($data, $tmp);
                    }

                }
            }
            return $data;
        }
    }

    function get_all_record($tbl_name)
    {
        if ($tbl_name != "") {
            $table = trim($tbl_name);
            $sql = "SELECT * FROM " . $table;

            $result = mysql_query($sql) or die(@mysql_error());
            $num_rows = @mysql_num_rows($result);
            $data = array();
            $tmp = array();

            if ($num_rows > 0) {
                while ($rows = @mysql_fetch_assoc($result)) {

                    foreach ($rows as $key => $value) {
                        $tmp[$key] = $value;
                    }

                    array_push($data, $tmp);
                }
            }
            return $data;
        }
    }

    function get_all_record_paging($tbl_name, $current_page, $per_page)
    {
        if ($tbl_name != "") {
            $table = trim($tbl_name);
            $sql = "SELECT * FROM " . $table;
            $sql .= " LIMIT {$current_page}, {$per_page}";
            $result = mysql_query($sql) or die(@mysql_error());
            $num_rows = @mysql_num_rows($result);
            $data = array();
            $tmp = array();

            if ($num_rows > 0) {
                while ($rows = @mysql_fetch_assoc($result)) {

                    foreach ($rows as $key => $value) {
                        $tmp[$key] = $value;
                    }

                    array_push($data, $tmp);
                }
            }
            return $data;
        }
    }

    function get_all_record_conditions_paging($tbl_name, $con, $current_page, $per_page)
    {
        if ($tbl_name != "") {
            $data = array();
            $tmp = array();
            if (is_array($con)) {
                $condistion_temp = "";
                foreach ($con as $key => $value) {
                    $condistion_temp .= $key . "='" . $value . "' AND ";
                }
                trim($condistion_temp);
                $condistion = substr($condistion_temp, 0, strlen($condistion_temp) - 4);
                $sql = "SELECT * FROM " . $tbl_name . " WHERE " . $condistion;
                $sql .= " LIMIT {$current_page}, {$per_page}";
                $result = mysql_query($sql) or die(@mysql_error());
                $num_rows = @mysql_num_rows($result);

                if ($num_rows > 0) {
                    while ($rows = @mysql_fetch_assoc($result)) {

                        foreach ($rows as $key => $value) {
                            $tmp[$key] = $value;
                        }
                        array_push($data, $tmp);
                    }
                }


            } else {
                $table = trim($tbl_name);
                $sql = "SELECT * FROM " . $table . " WHERE " . $con;
                $sql .= " LIMIT {$current_page}, {$per_page}";
                $result = mysql_query($sql) or die(@mysql_error());
                $num_rows = @mysql_num_rows($result);

                if ($num_rows > 0) {
                    while ($rows = @mysql_fetch_assoc($result)) {

                        foreach ($rows as $key => $value) {
                            $tmp[$key] = $value;
                        }
                        array_push($data, $tmp);
                    }

                }
            }
            return $data;
        }
    }

    function get_data_offset($tbl_name, $per_page, $offset)
    {
        if ($tbl_name != "") {
            $sql = "SELECT * FROM " . $tbl_name;
            $result = mysql_query($sql) or die(@mysql_error());
            $num_rows = @mysql_num_rows($result);
            $data = array();
            $tmp = array();

            if ($num_rows > 0) {
                while ($rows = @mysql_fetch_assoc($result)) {

                    foreach ($rows as $key => $value) {
                        $tmp[$key] = $value;
                    }
                    array_push($data, $tmp);
                }
            }

            return $data;
        }

    }

}