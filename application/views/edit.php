<!DOCTYPE html>
<html>
    <head>
        <title>Update User</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
            <div class="container">
                <div class="form-group row justify-content-center">
                      <h2>Edit User Details</h2>
                </div>
                <form id="edit_form" method="post">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?= !empty($user_data['user_first_name']) ? $user_data['user_first_name'] : ''  ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?= !empty($user_data['user_last_name']) ? $user_data['user_last_name'] : ''  ?>"  >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="emailID">Email ID</label>
                            <input type="text" class="form-control" id="emailID" name="emailID" value="<?= !empty($user_data['user_email']) ? $user_data['user_email'] : ''  ?>"  >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="phnNum">Phone No.</label>
                            <input type="number" class="form-control" id="phnNum" name="phnNum" value="<?= !empty($user_data['user_phone_number']) ? $user_data['user_phone_number'] : ''  ?>"  >
                        </div>
                        
                    </div>
                    <div class="form-group row">
                    <div class="col-md-6">
                       
                        <button type="submit" id="submitButton" class="btn btn-primary mb-2">Update</button>
                        
                    </div>
                    </div>
                    <input type="hidden" id="uid" name="uid" value="<?= $user_data['user_id']	 ?>">
                </form>
            </div>
    </body>


</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
var baseUrl = '<?php echo base_url() ?>';
 $(document).ready(function() {
        $('#edit_form').on('submit', function(e) {

            e.preventDefault();
            $.ajax({
                    url: baseUrl+'admin/editUser',  
                    type: 'POST',
                    data: $(this).serialize(), 
                    dataType: 'json',
                    success: function(response) {
                        if(response.success){
                            alert(response.message);
                            window.location.href = baseUrl+'admin/dashboard';
                        } else {
                            alert(response.message);
                            //window.location.href = baseUrl+'admin';
                        }
                        
                    },
                });

        });
});


</script>
