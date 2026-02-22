<section id="content">
    <div>
        <!-- RFQ List -->
        <div class="row my-3">
            <div class="col-12">
                <h2>RFQ List</h2>
            </div>
            <?php if (!empty($results)) : ?>
                <div class="col-12 p-0">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?= h('Image') ?></th>
                                        <th><?= h('Rfq No.') ?></th>
                                        <th><?= h('Category') ?></th>
                                        <th><?= h('Part Name') ?></th>
                                        <th><?= h('Make') ?></th>
                                        <th><?= h('UOM') ?></th>
                                        <th><?= h('Remark') ?></th>
                                        <th><?= h('Group Name') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results as $val) : ?>
                                        <tr>
                                            <td><img src="<?= $this->Url->build('/') . h($val['image']) ?>" width="25px" alt="RFQ Image"></td>
                                            <td><?= h($val['rfq_no']) ?></td>
                                            <td><?= h($val['category_name']) ?></td>
                                            <td><?= h($val['part_name']) ?></td>
                                            <td><?= h($val['make']) ?></td>
                                            <td><?= h($val['uom_code']) ?></td>
                                            <td><?= h($val['remarks']) ?></td>
                                            <td><?= h($val['group_name']) ?></td>
                                            <td class="actions"><a href="<?= $this->Url->build('/') ?>rfq-details/view/<?= h($val['id']) ?>" class="btn btn-info w-100 pale">View</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="col-12">
                    <h6>No RFQ data available</h6>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
