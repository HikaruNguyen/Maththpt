<?php

/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 13/1/2017
 * Time: 10:02 PM
 */
class CRUDUtils
{
    public static $DB_CATEGORY = "tbl_category";
    public static $DB_BODE = "tbl_test";
    public static $DB_CONTAIN = "tbl_content";
    public static $DB_USER = "user";
    public static $DB_MANAGER = "tbl_manager";

    public static function manageChuyenDe($type, $id, $name)
    {
        $db = new DB_ADAPTER();
        if ($type == 'edit') {
            $object = array("name" => $name);
            $condistion = array("id" => $id);
            $result = $db->update(CRUDUtils::$DB_CATEGORY, $object, $condistion);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'add') {
            $object = array("name" => $name);
            $result = $db->insert_to_database(CRUDUtils::$DB_CATEGORY, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'delete') {
            $object = array("id" => $id);
            $result = $db->delete(CRUDUtils::$DB_CATEGORY, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public static function manageBoDe($type, $id, $displayname, $author, $activated)
    {
        $db = new DB_ADAPTER();
        if ($type == 'edit') {
            $object = array("displayname" => $displayname, "author" => $author, "activated" => $activated);
            $condistion = array("id" => $id);
            $result = $db->update(CRUDUtils::$DB_BODE, $object, $condistion);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'add') {
            $object = array("displayname" => $displayname, "author" => $author, "activated" => $activated);
            $result = $db->insert_to_database(CRUDUtils::$DB_BODE, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'delete') {
            $object = array("id" => $id);
            $result = $db->delete(CRUDUtils::$DB_BODE, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public static function manageContent($type, $id, $testID, $cateID, $question, $image, $answerA, $answerB, $answerC, $answerD, $answerTrue)
    {
        $db = new DB_ADAPTER();
        if ($type == 'edit') {
            $object = array("testID" => $testID, "cateID" => $cateID, "question" => $question, "image" => $image,
                "answerA" => $answerA, "answerB" => $answerB, "answerC" => $answerC, "answerD" => $answerD, "answerTrue" => $answerTrue);
            $condistion = array("id" => $id);
            $result = $db->update(CRUDUtils::$DB_CONTAIN, $object, $condistion);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'add') {
            $object = array("testID" => $testID, "cateID" => $cateID, "question" => $question, "image" => $image,
                "answerA" => $answerA, "answerB" => $answerB, "answerC" => $answerC, "answerD" => $answerD, "answerTrue" => $answerTrue);
            $result = $db->insert_to_database(CRUDUtils::$DB_CONTAIN, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'delete') {
            $object = array("id" => $id);
            $result = $db->delete(CRUDUtils::$DB_CONTAIN, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public static function manageUser($type, $id, $username, $fullname, $email, $typeUser)
    {
        $db = new DB_ADAPTER();
        if ($type == 'edit') {
            $object = array("username" => $username, "fullname" => $fullname, "email" => $email, "type" => $typeUser);
            $condistion = array("id" => $id);
            $result = $db->update(CRUDUtils::$DB_USER, $object, $condistion);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'add') {
            $object = array("username" => $username, "fullname" => $fullname, "email" => $email, "type" => $typeUser);
            $result = $db->insert_to_database(CRUDUtils::$DB_USER, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'delete') {
            $object = array("id" => $id);
            $result = $db->delete(CRUDUtils::$DB_USER, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public static function manageManager($type, $id, $username, $fullname, $email)
    {
        $db = new DB_ADAPTER();
        if ($type == 'edit') {
            $object = array("username" => $username, "fullname" => $fullname, "email" => $email);
            $condistion = array("id" => $id);
            $result = $db->update(CRUDUtils::$DB_MANAGER, $object, $condistion);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'add') {
            $object = array("username" => $username, "fullname" => $fullname, "email" => $email);
            $result = $db->insert_to_database(CRUDUtils::$DB_MANAGER, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else if ($type == 'delete') {
            $object = array("id" => $id);
            $result = $db->delete(CRUDUtils::$DB_MANAGER, $object);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }
}