<div class="row justify-content-center">
    <div class="col-6">

        <div class="text-center">
            <h3>Register</h3>
            <p>Already have an account? <a href="login">Click here to login</a></p>
        </div>

        <?= form_open('/register') ?>
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

        <div class="form-group my-4">
            <label>Confirm Password</label>
            <input type="password" name='cf_pswd' value="<?= set_value('cf_pswd') ?>" class="form-control" placeholder="Confirm Password">
            <div class="text-danger mt-2"><?= form_error('cf_pswd') ?></div>
        </div>

        <div class="form-group form-check my-4">
            <input type="checkbox" name="terms" value='1' <?= set_checkbox('terms', 1) ?> class="form-check-input">
            <label class="form-check-label">Terms and Conditions</label>
            <div class="text-danger mt-2"><?= form_error('terms') ?></div>
        </div>


        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </div>
        </form>


    </div>
</div>