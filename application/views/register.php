<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
            <div class="container">
                <div class="form-group row justify-content-center">
                      <h2>Register Here</h2>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value=""  >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="emailID">Email ID</label>
                        <input type="text" class="form-control" id="emailID" name="emailID" value=""  >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="phnNum">Phone No.</label>
                        <input type="number" class="form-control" id="phnNum" name="phnNum" value=""  >
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Registration Fee will be 100 INR</label>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                      <input type='hidden' id='api_key' value='<?= $keyId?>'>
                      <input type='hidden' id='api_secret' value='<?= $keySecret?>'>
                      <!-- <button type="submit" id="submitButton" class="btn btn-primary mb-2">Register</button> -->
                      <button class="btn btn-primary form-control" id="rzp-button1">Register</button>
                  </div>
                </div>
            </div>
    </body>


</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var baseUrl = '<?php echo base_url() ?>';


$(document).on('click', '#rzp-button1', function() {

    var firstName = $('#firstName').val();
    var lastName  = $('#lastName').val();
    var emailID   = $('#emailID').val();
    var phnNum    = $('#phnNum').val();
    var apiKey    = $('#api_key').val();

    $.ajax({
        url: baseUrl+'register/saveUserData',
        type: 'POST',
        data: {
            firstName: firstName,
            lastName: lastName,
            emailID: emailID,
            phone: phnNum
        },
        dataType: 'json',
        success: function(response) {
          console.log(response);
          var user_id = response.user_id; 
            if(response.success){   
              var options = {
                    "key": apiKey, 
                    "amount": "10000", 
                    "currency": "INR",
                    "name": "Test", 
                    "description": "Test Transaction",
                    "image": "https://example.com/your_logo",
                    "prefill":
                    {
                      "email": emailID,
                      "contact": phnNum,
                    },

                    config: {
                      display: {
                        blocks: {
                          other: { //  name for other block
                            name: "Pay Using Debit or Credit Card",
                            instruments: [
                              {
                                method: "card",
                                networks: ["Visa", "MasterCard", "RuPay"], 
                                types: ["debit","credit","prepaid"]
                              },
                            ]
                          }
                        },
                        sequence: ["block.utib", "block.other"],
                        preferences: {
                          show_default_blocks: false // Should Checkout show its default blocks?
                        }
                      }
                    },
                    "handler": function (result) {
                          $.ajax({
                                url:  baseUrl+'register/updatePaymentStatus',
                                type: 'POST',
                                data: {
                                    payment_id: result.razorpay_payment_id,
                                    user_id: user_id  // Assuming you return the user ID from the server
                                },
                                dataType: 'json',
                                success: function(res) {
                                  console.log(res);
                                    if(res.success) {
                                        alert("Payment successful and data updated!");
                                        location.reload();
                                    } else {
                                        alert("Payment successful, but status update failed.");
                                    }
                                },
                                error: function() {
                                    alert("Error updating payment status.");
                                }
                            });
                    },
                    "modal": {
                      "ondismiss": function () {
                        if (confirm("Are you sure, you want to close the form?")) {
                          txt = "You pressed OK!";
                          console.log("Checkout form closed by the user");
                        } else {
                          txt = "You pressed Cancel!";
                          console.log("Complete the Payment")
                        }
                      }
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();

            } else{
              alert(response.message);
            }

        },
    });

});
</script>
