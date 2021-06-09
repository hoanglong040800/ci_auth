<div class="row justify-content-center">
    <div class="col-5">

        <h3>Modify User</h3>

        <?= form_open('users/modify/'.$user->id) ?>
            <input type="hidden" name="id" value="<?= $user->id ?>">

            <div class="form-group my-4">
                <label>Email address</label>
                <input type="email" name='email' value="<?= set_value('email',$user->email) ?>" class="form-control" placeholder="Enter email">
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
            
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3">Register</button>
            </div>
        </form>


    </div>
</div>