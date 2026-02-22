<?php
/**
 * @var \App\View\AppView $this
 */
?>

<!-- Load CSS files -->
<?= $this->Html->css('table.css') ?>
<?= $this->Html->css('listing.css') ?>
<?= $this->Html->css('b_index.css') ?>
<?= $this->Html->css('b_vendorCustom') ?>

<div class="buyer-profile">
    <div class="profile-page pb-4 pl-2">
        <div class="row">
            <!-- Profile Image and Basic Info -->
            <div class="col-sm-12 col-lg-3 pl-0 pr-0">
                <div class="card" style="height:100%">
                    <div class="left-s">
                        <div class="m-5 text-center">
                            <img width="200px"
                                src="<?= $this->Url->build('/') ?>img/<?= strtoupper(substr($userProfile->first_name, 0, 1)) ?>.png"
                                alt="Buyer">
                        </div>
                        <div class="desc">
                            <ul>
                                <li>
                                    <p>Name: <b><?= h($userProfile->first_name) . ' ' . h($userProfile->last_name) ?></b></p>
                                </li>
                                <li>
                                    <p>Mobile No: <b><?= h($userProfile->mobile) ?></b></p>
                                </li>
                                <li>
                                    <p>Email ID: <b><?= h($userProfile->email) ?></b></p>
                                </li>
                                <li>
                                    <p>Status: <b><span class="badge bg-success">Active</span></b></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-sm-12 col-lg-9 buyer_profile">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 pr-0">
                                <table>
                                    <tr>
                                        <td><?= __('First Name') ?></td>
                                        <th style="padding:10px 10px;"><?= h($userProfile->first_name) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('Last Name') ?></td>
                                        <th style="padding:10px 10px;"><?= h($userProfile->last_name) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('Address') ?></td>
                                        <th style="padding:10px 10px;"><?= h($userProfile->address) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('City') ?></td>
                                        <th><?= h($userProfile->city) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('Pincode') ?></td>
                                        <th><?= h($userProfile->pincode) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('State') ?></td>
                                        <th><?= h($userProfile->state) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('Country') ?></td>
                                        <th><?= h($userProfile->country) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('Pan No') ?></td>
                                        <th><?= h($userProfile->pan_no) ?></th>
                                    </tr>
                                    <tr>
                                        <td><?= __('Category') ?></td>
                                        <th><?= h($userProfile->category->name ?? 'No category') ?></th>
                                    </tr>
                                </table>

                                <!-- Category Textbox -->
                                <!-- <div class="mt-4">
                                    <?= $this->Form->create(null, ['type' => 'post']) ?>
                                    <?= $this->Form->control('category', [
                                        'type' => 'text',
                                        'label' => __('Category'),
                                        'value' => h($userProfile->category), // Display existing category if available
                                        'placeholder' => __('Enter category')
                                    ]) ?>
                                    
                                    <?= $this->Form->end() ?>
                                </div> -->

                                <div class="mt-4">
                                    <?= $this->Html->link(__('Edit Profile'), ['controller' => 'UsersProfiles', 'action' => 'edit', $userProfile->id], ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
