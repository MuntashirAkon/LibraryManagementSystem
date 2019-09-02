<?php
require_once __DIR__ . '/../functions.php';

$return = ['success' => false];

if(isset($_GET['type'])){
    switch ($_GET['type']){
        case 'add':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);;
            $return['success'] = add_student($mysqli, $no, $name);
            break;
        case 'delete':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);;
            $return['success'] = delete_student($mysqli, $no);
            break;
        case 'update':case 'edit':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);;
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);;
            $return['success'] = update_student($mysqli, $no, $name);
            break;
    }
}

print json_encode($return);