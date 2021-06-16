<div class="row justify-content-center">
    <div class="col-6">

        <div class="text-center">
            <h3>Register</h3>
            <p>Already have an account? <a href="login">Click here to login</a></p>
        </div>

        <form id="form" method='POST'>
            <div class="form-group my-4">
                <label>Email address</label>
                <input type="text" name='email' value='test01@mail.com' class="form-control" placeholder="Enter email">
                <div class="text-danger mt-2" id="emailErr"></div>
            </div>

            <div class="form-group my-4">
                <label>Password</label>
                <input type="password" name='pswd' value='123' class="form-control" placeholder="Password">
                <div class="text-danger mt-2" id="pswdErr"></div>
            </div>

            <div class="form-group my-4">
                <label>Confirm Password</label>
                <input type="password" name='cf_pswd' value='' class="form-control" placeholder="Confirm Password">
                <div class="text-danger mt-2" id="cf_pswdErr"></div>
            </div>

            <div class="form-group form-check my-4">
                <input type="checkbox" name="terms" class="form-check-input" checked>
                <label class="form-check-label">Terms and Conditions</label>
                <div class="text-danger mt-2" id="termsErr"></div>
            </div>


            <div class="d-flex justify-content-center">
                <button class="btn btn-primary mt-3">Register</button>
            </div>
        </form>


    </div>
</div>

<script type="text/javascript">
    $(
        $('#form').submit(function(e) {
            var req = $(this).serialize();

            $.ajax({
                url: "<?= base_url('register/process') ?>",
                type: 'POST',
                data: req,

                success: function(result){
                    // console.log(result);
                    result = JSON.parse(result);
                    $('#emailErr').html(result.email);
                    $('#pswdErr').html(result.pswd);
                    $('#cf_pswdErr').html(result.cf_pswd);
                    $('#termsErr').html(result.terms);

                    if(result.is_valid){
                        location.href = "<?= base_url('login') ?>"
                    }
                },

                error: function(){

                },
            });

            return false;
        })
    );
</script>