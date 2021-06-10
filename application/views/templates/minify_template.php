<html>

<?php
$this->load->view('templates/head', $title);
?>

<body>


        <div class="d-flex flex-column align-items-center justify-content-center my-3">
        <a class="nav-link" href="<?= base_url('users') ?>">
            <img src="https://image.flaticon.com/icons/png/128/1791/1791961.png" width="50px" height="50px">
            </a>        

            <div class="mt-3">
                <h2 class="text-primary">CI Auth</h2>
            </div>
        </div>
    

        <main class="bg-light p-5">
            <?php $this->load->view($main_content) ?>
        </main>


</body>

</html>