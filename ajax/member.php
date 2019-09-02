<?php
require_once __DIR__ . '/../functions.php';

$return = ['success' => false];

if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'add':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $stud_no = filter_input(INPUT_GET, 'stud_no', FILTER_SANITIZE_STRING);
            $return['success'] = add_member($mysqli, $no, $stud_no);
            break;
        case 'delete':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $return['success'] = delete_member($mysqli, $no);
            break;
        case 'update':
        case 'edit':
            $no = filter_input(INPUT_GET, 'no', FILTER_SANITIZE_STRING);
            $stud_no = filter_input(INPUT_GET, 'stud_no', FILTER_SANITIZE_STRING);
            $return['success'] = update_member($mysqli, $no, $stud_no);
            break;
        case 'fetch':
            $stud_no = filter_input(INPUT_GET, 'stud_no', FILTER_SANITIZE_STRING);
            $stud_name = get_student($mysqli, $stud_no);
            if ($stud_name !== false)
                $return = [
                    'success' => true,
                    'stud_name' => $stud_name
                ];
    }
}

print json_encode($return);