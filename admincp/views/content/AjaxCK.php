<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 16/1/2017
 * Time: 9:36 AM
 */
const DELETE = 'delete';
const ADD = 'add';
const UPDATE = 'edit';
$data = $_POST;

$action = $data['action'];
if (isset($data)) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    require_once('../../utils/CRUDUtils.php');
    if (isset($data['id'])) {
        $result = CRUDUtils::manageContent($action, $data['id'], $data['testID'], $data['cateID'], $data['question'], $data['image'],
            $data['answerA'], $data['answerB'], $data['answerC'], $data['answerD'], $data['answerTrue']);
    } else {
        $result = CRUDUtils::manageContent($action, null, $data['testID'], $data['cateID'], $data['question'], $data['image'],
            $data['answerA'], $data['answerB'], $data['answerC'], $data['answerD'], $data['answerTrue']);
    }

    if ($result == 1) {
        echo "1";
        exit();
    } else {
        echo "0";
        exit();
    }
}