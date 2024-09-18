<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-2" style="border-radius: 0px">
            <li class="breadcrumb-item">
                <i class="fa fa-home"></i>
                <a href="/Dashboard/index" class="small">
                    Dashboard
                </a>
            </li>
            <?php if(!empty($nav)) { ?>

                <?php foreach($nav as $text => $link ) { ?>

                        <?php if(!empty($link)) { ?>
                            <li class="breadcrumb-item active small pt-1" aria-current="page">
                                <a href="<?= $link ?>"><?= $text ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="breadcrumb-item small pt-1" aria-current="page">
                                <?= $text ?>
                                </li>
                        <?php } ?>

                <?php } ?>

            <?php } ?>
        </ol>
        </nav>
    </div>
</div>

<div class="container-row">
    <div class="col-12">
        <?= $this->Flash->render() ?>
    </div>
</div>
