<?php
require_once __DIR__ . '/functions.php';

$info = question_6($mysqli);
$q6 = true;
?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Library Management System</title>
</head>
<body>
<?php include_once __DIR__ . '/navbar.php'; ?>
<div class="container">
    <div class="row">
        <?php include_once __DIR__ . '/sidebar.php'; ?>
        <main class="col-md-9 mt-4">
            <h2 id="title">Question 6</h2>
            <h4>List the students who reached the borrowed limit 3.</h4>
            <style>
                main table td:nth-child(1) {
                    max-width: 70px;
                    min-width: 70px;
                }
            </style>
            <table id="only_table" class="table table-striped table-sm" data-order='[[ 0, "asc" ]]' data-page-length='25'>
                <thead>
                <tr>
                    <th>Student No</th>
                    <th>Student Name</th>
                    <th>Book Count</th>
                </tr>
                </thead>
                <tbody id="info_table">
                <?php foreach ($info as $item): ?>
                    <tr>
                        <td><?php echo $item['no']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['count']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#only_table').DataTable({
            responsive: true,
            scroller: true
        });
    });
</script>
</body>
</html>