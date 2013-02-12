<div class="left">
    <ul class="timeline">
        <?php
        foreach ($this->topics as $topicData) {
            $topic = json_decode($topicData[0]);
            $date = $topicData[1];
            ?>
            <li>
                <a class="title" href="/l/<?= $topic->url ?>"><?= $topic->title ?></a>
                <div class="topicInfo">A new list created about <?= Tool::getCategories($topic->categories) ?> <?= Tool::getFriendlyDate($date) ?></div>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="right">
    <h3><?= $this->category->getName() ?></h3>
    Latest popular lists about <?= $this->category->getName() ?>
</div>