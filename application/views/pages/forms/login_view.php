<div class="row justify-content-center">
    <div class="col-6">

        <div class="text-center">
            <h3>Login</h3>
            <p>Dont have an account? <a href="register">Click here to register</a></p>
        </div>

        <!-- FORM -->
        <form id="form" method="POST">
            <div class="form-group my-4">
                <label>Email address</label>
                <input type="text" name='email' class="form-control" placeholder="Enter email" value="long@mail.com">
                <div class="text-danger mt-2" id="emailErr"></div>
            </div>

            <div class="form-group my-4">
                <label>Password</label>
                <input type="password" name='pswd' class="form-control" placeholder="Enter password" value="123">
                <div class="text-danger mt-2" id="pswdErr"></div>
            </div>

            <div class="text-danger mt-3" id="authErr"></div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            </div>
        </form>

    </div>
</div>

<!-- JQUERY AJAX -->
<script type="text/javascript">
    $(
        $('#form').submit(function(e) {
            // var req = $(this)
            //     .serializeArray()
            //     .reduce(function(a, x) { a[x.name] = x.value; return a; }, {});
            // req=JSON.stringify(req);

            var req = $(this).serialize();

            $.ajax({
                url: "<?= base_url('login/process') ?>",
                type: "POST",
                data: req,

                success: function(result) {
                    result = JSON.parse(result);
                    $('#emailErr').html(result.email);
                    $('#pswdErr').html(result.pswd);
                    $('#authErr').html(result.auth);

                    if (!result.auth){
                        location.href="<?= base_url() ?>";
                    }
                },

                error: function() {

                },
            });

            return false;
        })
    );
</script>