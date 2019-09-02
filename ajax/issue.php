<?php
require_once __DIR__ . '/../functions.php';

$return = ['success' => false];

if(isset($_GET['type'])){
    switch ($_GET['type']){
        case 'add':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $iss_date = filter_input(INPUT_GET, 'iss_date', FILTER_SANITIZE_STRING);
            $mem_no = filter_input(INPUT_GET, 'mem_no', FILTER_SANITIZE_STRING);
            $book_no = filter_input(INPUT_GET, 'book_no', FILTER_SANITIZE_STRING);
            $return['success'] = add_issue($mysqli, $no, $iss_date, $mem_no, $book_no);
            break;
        case 'delete':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $return['success'] = delete_issue($mysqli, $no);
            break;
        case 'update':case 'edit':
        $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
        $iss_date = filter_input(INPUT_GET, 'iss_date', FILTER_SANITIZE_STRING);
        $mem_no = filter_input(INPUT_GET, 'mem_no', FILTER_SANITIZE_STRING);
        $book_no = filter_input(INPUT_GET, 'book_no', FILTER_SANITIZE_STRING);
        $return['success'] = update_issue($mysqli, $no, $iss_date, $mem_no, $book_no);
        break;
        case 'fetch_stud':
            $mem_no = filter_input(INPUT_GET, 'mem_no', FILTER_SANITIZE_STRING);
            $stud_name = get_member($mysqli, $mem_no);
            if($stud_name !== false)
                $return = [
                    'success' => true,
                    'stud_name' => $stud_name
                ];
            break;
        case 'fetch_book':
            $book_no = filter_input(INPUT_GET, 'book_no', FILTER_SANITIZE_STRING);
            $book_name = get_book($mysqli, $book_no);
            if($book_name !== false)
                $return = [
                    'success' => true,
                    'book_name' => $book_name
                ];
    }
}

print json_encode($return);
