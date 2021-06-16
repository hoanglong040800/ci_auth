<h1>Home Page</h1>
<h3>
    Welcome
    <span class="text-info"><?= $this->session->userdata('email') ?></span>
</h3>

<h3>
    Cookie
    <span class="text-warning"><?= get_cookie('remember_me_token', TRUE) ?></span>
</h3>