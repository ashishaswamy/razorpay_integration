<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    </head>
    <body>
            <div class="container">
                <div class="form-group row justify-content-center">
                      <h2>Admin Dashboard</h2>
                </div>
                <div class="form-group">
                <h4 style="text-align: right;"><a href="<?= base_url()?>admin/logout">Logout</a></h4>
                </div>
                
                <form id="dataForm" action="" method="POST">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <select class="form-select form-control" id="status" name="status" required>
                                <option value="all" <?= ($status == 'all') ? 'selected':'' ?>>All</option>
                                <option value="pending" <?= ($status == 'pending') ? 'selected':'' ?>>Pending</option>
                                <option value="success" <?= ($status == 'success') ? 'selected':'' ?>>Success</option>
                            </select>
                        </div>
                        <div class="col-md-4">  
                            <button type="submit" class="btn btn-primary form-control">Submit</button>
                        </div>
                    </div>
                </form>

                <table id="dataTable" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count =1;
                        foreach($user_list as $value){ ?>
                        <tr>
                            <td><?= $count++; ?></td>
                            <td><?= $value['user_first_name'].' '.$value['user_last_name'] ?></td>
                            <td><?= $value['user_email'] ?></td>
                            <td><?= $value['user_phone_number'] ?></td>
                            <td><a href="<?= base_url() ?>admin/edit/<?= $value['user_id'] ?>">Edit</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
             <!-- Nav tabs
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Paid Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Payment Failed Users</a>
                </li>
                
                </ul>

                <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">profile</div>
                </div> -->
            </div>
    </body>


</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#dataTable').DataTable();
});
</script>
