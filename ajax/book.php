<?php
require_once __DIR__ . '/../functions.php';

$return = ['success' => false];

if(isset($_GET['type'])){
    switch ($_GET['type']){
        case 'add':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
            $author = filter_input(INPUT_GET, 'author', FILTER_SANITIZE_STRING);
            $return['success'] = add_book($mysqli, $no, $name, $author);
            break;
        case 'delete':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $return['success'] = delete_book($mysqli, $no);
            break;
        case 'update':case 'edit':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
            $author = filter_input(INPUT_GET, 'author', FILTER_SANITIZE_STRING);;
            $return['success'] = update_book($mysqli, $no, $name, $author);
            break;
    }
}

print json_encode($return);