<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4">Attachment Viewer</h3>

            <div id="imageSlider" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                    <?php foreach ($files as $index => $file): ?>
                        <li data-target="#imageSlider" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
                    <?php endforeach; ?>
                </ol>

                <div class="carousel-inner shadow-sm rounded bg-dark">
                    <?php foreach ($files as $index => $file): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="d-flex align-items-center justify-content-center" style="height: 500px; overflow: hidden;">
                                <?= $this->Html->image('/' . $file, [
                                    'class' => 'd-block mw-100 mh-100',
                                    'alt' => 'Slide ' . ($index + 1)
                                ]) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>