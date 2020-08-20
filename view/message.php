<?php
if (isset($_REQUEST['m'])) {
    $msg = Database::encryptor('decrypt', $_REQUEST['m']);
    $err = Database::encryptor('decrypt', $_REQUEST['e']);
    if ($err == 0) {
        $alert = 'alert-success';
    }    else
    {
        $alert = 'alert-danger';
    }

    ?>
    <div class="alert <?=$alert?>" role="alert">
        <i class="fa fa-exclamation"></i>&nbsp;&nbsp;
        <?=$msg?>.
    </div>
<?php
}