<html>

<?php $this->load->view('templates/head',$title??'CI Auth') ?>

<body">
    <?php $this->load->view('templates/header', $title) ?>

    <div class="container h-50">
        <?php $this->load->view($main_content) ?>
    </div>

    <?php $this->load->view('templates/footer') ?>
</body>

</html>