<?php foreach ($comments_data as $date => $cd) : ?>
    <!-- System Message -->
    <div class="text-center mb-4">
        <h6><?= date("d M, Y", strtotime($date)) ?>
        </h6>
    </div>
    <?php foreach ($cd as $comment) : ?>
        <?php if (strtolower($comment['message_from']) == 'buyer') : ?>
            <!-- Buyer Comment (Rashi Sawant) -->
            <div class="d-flex mb-4 justify-content-end">
                <div class="comment-bubble comment-bubble-sent mr-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong><?= $comment['buyer_name'] ?><small class="text-white-50 ml-2"></small></strong>
                        <small class="comment-time-sent"><?= $comment['message_time'] ?></small>
                    </div>
                    <p class="mb-1"><?= $comment['message'] ?></p>
                </div>
                <div class="comment-avatar avatar-buyer">
                    <i class="fe fe-user"></i>
                </div>
            </div>
        <?php endif; ?>
        <?php if (strtolower($comment['message_from']) == 'vendor') : ?>
            <!-- Vendor Comment -->
            <div class="d-flex mb-4">
                <div class="comment-avatar avatar-vendor mr-3">
                    <i class="fe fe-user"></i>
                </div>
                <div class="comment-bubble">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong><?= $comment['vendor_name'] ?> <small class="text-muted ml-2"></small></strong>
                        <small class="comment-time"><?= $comment['message_time'] ?></small>
                    </div>
                    <p class="mb-1"><?= $comment['message'] ?></p>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>