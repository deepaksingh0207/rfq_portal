<?php foreach ($comments_data as $date => $cd) : ?>
    <!-- System Message -->
    <div class="chat-divider">
        <span><i class="far fa-clock mr-1"></i><?= date("d M, Y", strtotime($date)) ?></span>
    </div>

    <?php foreach ($cd as $comment) : ?>
        <?php if (strtolower($comment['message_from']) == 'buyer') : ?>
            <!-- Received Message (Buyer) -->
            <div class="message received">
                <div class="user-avatar buyer-avatar"><?= $comment['buyer_name'][0] ?></div>
                <div class="message-content">
                    <div class="message-bubble">
                        <strong><?= $comment['buyer_name'] ?>(Buyer)</strong>
                        <p class="mb-1 mt-1"><?= $comment['message'] ?></p>
                        <div class="message-meta">
                            <?= $comment['message_time'] ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (strtolower($comment['message_from']) == 'vendor') : ?>
            <!-- Sent Message (Vendor) -->
            <div class="message sent">
                <div class="message-content">
                    <div class="message-bubble">
                        <strong>You (Vendor)</strong>
                        <p class="mb-1 mt-1"><?= $comment['message'] ?></p>
                        <div class="message-meta">
                            <?= $comment['message_time'] ?>
                        </div>
                    </div>
                </div>
                <div class="user-avatar"><?= $comment['vendor_name'][0] ?></div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endforeach; ?>