<?php
require_once __DIR__ . '/functions.php';

$info = get_members($mysqli);
$member_tab = true;
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
            <div class="modal fade" id="multipurpose_model" tabindex="-1" role="dialog" aria-labelledby="multipurpose_model_label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="multipurpose_model_label">Add Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="sr-only" for="mem_no">Member No.</label>
                            <input type="text" class="form-control btn-small mb-2" name="mem_no" id="mem_no" placeholder="Member No">
                            <label class="sr-only" for="stud_no">Student No.</label>
                            <input type="text" class="form-control btn-small mb-2" name="stud_no" id="stud_no" placeholder="Student No" onkeyup="fetch_info()">
                            <label class="sr-only" for="stud_name">Student Name</label>
                            <input type="text" class="form-control btn-small" name="stud_name" id="stud_name" placeholder="Student Name" disabled>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-small" data-dismiss="modal">Cancel</button>
                            <button type="button" id="add_btn" class="btn btn-primary btn-small" data-dismiss="modal" onclick="add_info()">Add</button>
                            <button type="button" id="save_btn" class="btn btn-primary btn-small" style="display: none;" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <h2 id="title">
                Members
                <a class="align-items-center text-muted" href="#" onclick="clean_modal()" data-toggle="modal" data-target="#multipurpose_model"><span data-feather="plus-circle"></span></a>
            </h2>
            <style>
                main table .feather {
                    width: 15px;
                    height: 15px;
                }
                main table td:nth-child(1) {
                    max-width: 70px;
                    min-width: 70px;
                }
                main table td:nth-child(2) {
                    max-width: 100px;
                    min-width: 100px;
                }
            </style>
            <div class="table-responsive">
                <table id="only_table" class="table table-striped table-sm" data-order='[[ 1, "asc" ]]' data-page-length='25'>
                    <thead>
                    <tr>
                        <th style="min-width: 50px;"></th>
                        <th>Member No</th>
                        <th>Student No</th>
                        <th>Student Name</th>
                    </tr>
                    </thead>
                    <tbody id="info_table">
                    <?php foreach ($info as $item): ?>
                        <tr id="info_row_<?php echo $item['no']; ?>">
                            <td>
                                <a class="align-items-center text-danger mr-2 small d-inline-flex" href="javascript:delete_info('<?php echo $item['no']; ?>')" title="Delete"><span data-feather="x"></span> Delete</a>
                                <a class="align-items-center text-info small d-inline-flex" href="javascript:edit_info('<?php echo $item['no']; ?>')" title="Edit"><span data-feather="edit"></span> Edit</a>
                            </td>
                            <td id="info_no_<?php echo $item['no']; ?>"><?php echo $item['no']; ?></td>
                            <td id="info_stud_no_<?php echo $item['no']; ?>"><?php echo $item['stud_no']; ?></td>
                            <td id="info_name_<?php echo $item['no']; ?>"><?php echo $item['name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <script>
                    function clean_modal() {
                        $('#mem_no').val('').removeAttr('disabled');
                        $('#stud_no').val('');
                        $('#stud_name').val('');
                        $('#multipurpose_model_label').text('Add Member');
                        $('#add_btn').show();
                        $('#save_btn').hide();
                    }
                    function add_info() {
                        let mem_no = $('#mem_no').val();
                        let stud_no = $('#stud_no').val();
                        $.ajax({
                            method: 'GET',
                            url: './ajax/member.php',
                            dataType: 'json',
                            data: {type: 'add', no: mem_no, stud_no: stud_no},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    window.location.reload();
                                } else {
                                    alert('An unexpected error occurred!');
                                }
                            },
                            error: function () {
                                alert('An unexpected error occurred!');
                            }
                        });
                    }
                    function edit_info(index) {
                        $('#multipurpose_model_label').text('Edit Member');
                        $('#mem_no').val($('#info_no_'+index).text()).attr('disabled', 'disabled');
                        $('#stud_no').val($('#info_stud_no_'+index).text());
                        $('#stud_name').val($('#info_name_'+index).text());
                        $('#save_btn').show().attr('onclick', "edit_info_action('"+index+"')");
                        $('#add_btn').hide();
                        $('#multipurpose_model').modal('show');
                    }
                    function edit_info_action(mem_no) {
                        let stud_no = $('#stud_no').val();
                        $.ajax({
                            method: 'GET',
                            url: './ajax/member.php',
                            dataType: 'json',
                            data: {type: 'update', no: mem_no, stud_no: stud_no},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    window.location.reload();
                                } else {
                                    alert('An unexpected error occurred!');
                                }
                            },
                            error: function () {
                                alert('An unexpected error occurred!');
                            }
                        });
                    }
                    function delete_info(mem_no) {
                        $.ajax({
                            method: 'GET',
                            url: './ajax/member.php',
                            dataType: 'json',
                            data: {type: 'delete', no: mem_no},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    window.location.reload();
                                } else {
                                    alert('An unexpected error occurred!');
                                }
                            },
                            error: function () {
                                alert('An unexpected error occurred!');
                            }
                        });
                    }
                    function fetch_info() {
                        let stud_no = $('#stud_no').val();
                        $.ajax({
                            method: 'GET',
                            url: './ajax/member.php',
                            dataType: 'json',
                            data: {type: 'fetch', stud_no: stud_no},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    $('#stud_name').val(response.stud_name);
                                }
                            }
                        });
                    }
                </script>
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