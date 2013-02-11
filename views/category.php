<div class="left">
    <ul class="timeline">
        <?php
        foreach ($this->topics as $topic) {
            ?>
            <li>
                <a class="title" href="/l/<?= $topic->getUrl() ?>"><?= $topic->getTitle() ?></a>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="right">
    <h3><?= $this->category->getName() ?></h3>
    Latest popular lists about <?= $this->category->getName() ?>
</div>