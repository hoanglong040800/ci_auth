<div class="row justify-content-center">
    <div class="col-5">

        <h3>Login</h3>

        <?= form_open('login') ?>
            <div class="form-group my-4">
                <label>Email address</label>
                <input type="email" name='email' value="<?= set_value('email') ?>" class="form-control" placeholder="Enter email">
                <div class="text-danger mt-2"><?= form_error('email') ?></div>
            </div>

            <div class="form-group my-4">
                <label>Password</label>
                <input type="password" name='pswd' value="<?= set_value('pswd') ?>" class="form-control" placeholder="Password">
                <div class="text-danger mt-2"><?= form_error('pswd') ?></div>
            </div>

            <div class="text-danger mt-3"><?= $error ?></div>
            
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            </div>
        </form>


    </div>
</div>