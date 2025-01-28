<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
            <div class="container">
                <div class="form-group row justify-content-center">
                      <h2>Login</h2>
                </div>
                <form method="post" id="login_form">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="userName">Username</label>
                            <input type="text" class="form-control" id="userName" name="userName" value="" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" id="pwd" name="pwd" value=""  >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    <div class="col-md-6">
                        <button type="submit" id="submitButton" class="btn btn-primary mb-2 form-control">Login</button> 
                        
                    </div>
                    </div>
                </form>
            </div>
    </body>


</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
var baseUrl = '<?php echo base_url() ?>';
 $(document).ready(function() {
        $('#login_form').on('submit', function(e) {

            e.preventDefault();
            $.ajax({
                    url: baseUrl+'admin/login',  
                    type: 'POST',
                    data: $(this).serialize(), 
                    dataType: 'json',
                    success: function(response) {
                        if(response.success){

                            window.location.href = baseUrl+'admin/dashboard';
                        } else {
                            alert(response.message);
                            window.location.href = baseUrl+'admin';
                        }
                        
                    },
                });

        });
});
</script>