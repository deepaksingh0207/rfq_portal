<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VendorTemp $vendorTemp
 * @var string[]|\Cake\Collection\CollectionInterface $purchasingOrganizations
 * @var string[]|\Cake\Collection\CollectionInterface $accountGroups
 * @var string[]|\Cake\Collection\CollectionInterface $schemaGroups
 */
?>
<?= $this->Html->css('cstyle.css') ?>
<?= $this->Html->css('table.css') ?>
<?= $this->Html->css('listing.css') ?>
<?= $this->Html->css('v_index.css') ?>
<div class="container-fluid">
    <div class="row">
        <div class="column-responsive">
            <div class="vendorTemps form content">
                <h3 class="mb-2 text-info"><?= __('Change Password') ?></h3>
                <?= $this->Form->create() ?>
                <div class="col-12 mt-3">
                    <?php
                    echo $this->Form->control('email', ['class' => 'form-control', 'div' => 'form-group', 'placeholder' => 'Enter Email', 'label' => 'Email', 'required']);
                    ?>
                </div>
                <div class="forget-buttons">
                
                <?php echo $this->Form->button('Change Password', array('class' => 'btn btn-custom mt-3')); ?>
                <!-- <a href="/bsms" class="login_btn btn mt-3">Login</a> -->
                </div>
                <?= $this->Form->end() ?>
                <!-- <img src="<?= $this->Url->build('/') ?>img/ft-icon.png" class="ft-icon"> -->
                <img src="<?= $this->Url->build('/') ?>img/apar_logo.png" class="vekpro-logo">
            </div>
        </div>
    </div>
</div>