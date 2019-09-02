<?php
require_once __DIR__ . '/functions.php';

$info = get_books($mysqli);
$book_tab = true;
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
                            <h5 class="modal-title" id="multipurpose_model_label">Add Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="sr-only" for="book_no">Book No.</label>
                            <input type="text" class="form-control btn-small mb-2" name="book_no" id="book_no" placeholder="Book No">
                            <label class="sr-only" for="book_name">Book Name</label>
                            <input type="text" class="form-control btn-small mb-2" name="book_name" id="book_name" placeholder="Book Name">
                            <label class="sr-only" for="author">Author</label>
                            <input type="text" class="form-control btn-small" name="author" id="author" placeholder="Author(s)">
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
                Books
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
                        <th>Book No</th>
                        <th>Book Name</th>
                        <th>Author</th>
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
                            <td id="info_name_<?php echo $item['no']; ?>"><?php echo $item['name']; ?></td>
                            <td id="info_author_<?php echo $item['no']; ?>"><?php echo $item['author']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <script>
                    function clean_modal() {
                        $('#book_no').val('').removeAttr('disabled');
                        $('#book_name').val('');
                        $('#author').val('');
                        $('#multipurpose_model_label').text('Add Book');
                        $('#add_btn').show();
                        $('#save_btn').hide();
                    }
                    function add_info() {
                        let book_no = $('#book_no').val();
                        let book_name = $('#book_name').val();
                        let author = $('#author').val();
                        $.ajax({
                            method: 'GET',
                            url: './ajax/book.php',
                            dataType: 'json',
                            data: {type: 'add', no: book_no, name: book_name, author: author},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    // $('#info_table').append('<tr id="info_row_'+book_no+'">\
    // <td>\
    //   <a class="align-items-center text-danger mr-2 small d-inline-flex" href="javascript:delete_info(\''+book_no+'\')" title="Delete"><span data-feather="x"></span> Delete</a>\
    //   <a class="align-items-center text-info small d-inline-flex" href="javascript:edit_info(\''+book_no+'\')" title="Edit"><span data-feather="edit"></span> Edit</a>\
    // </td>\
    // <td id="info_no_'+book_no+'">'+book_no+'</td>\
    // <td id="info_name_'+book_no+'">'+book_name+'</td>\
    // <td id="info_author_'+book_no+'">'+author+'</td>\
// </tr>');
//                                     feather.replace();
//                                     $('#multipurpose_model').modal('hide');
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
                        $('#multipurpose_model_label').text('Edit Book');
                        $('#book_no').val($('#info_no_'+index).text()).attr('disabled', 'disabled');
                        $('#book_name').val($('#info_name_'+index).text());
                        $('#author').val($('#info_author_'+index).text());
                        $('#save_btn').show().attr('onclick', "edit_info_action('"+index+"')");
                        $('#add_btn').hide();
                        $('#multipurpose_model').modal('show');
                    }
                    function edit_info_action(book_no) {
                        let book_name = $('#book_name').val();
                        let author = $('#author').val();
                        $.ajax({
                            method: 'GET',
                            url: './ajax/book.php',
                            dataType: 'json',
                            data: {type: 'update', no: book_no, name: book_name, author: author},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    // $('#info_name_'+book_no).text(book_name);
                                    // $('#info_author_'+book_no).text(author);
                                    // $('#multipurpose_model').modal('hide');
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
                    function delete_info(book_no) {
                        $.ajax({
                            method: 'GET',
                            url: './ajax/book.php',
                            dataType: 'json',
                            data: {type: 'delete', no: book_no},
                            beforeSend: function () {},
                            success: function (response) {
                                if(response.success) {
                                    // $('#info_row_'+book_no).remove();
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