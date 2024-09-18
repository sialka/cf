
<?php if($status == 'Ativo') { ?>
    <span class="badge bg-success text-white px-2"><?= $status ?></span>
<?php } ?>

<?php if($status == 'Inativo') { ?>
    <span class="badge bg-danger text-white"><?= $status ?></span>
<?php } ?>
