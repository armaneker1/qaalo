<div class="left">
    <ul class="timeline">
        <?php
        foreach ($this->timeline as $eventData) {
            $event = json_decode($eventData[0]);
            $date = $eventData[1];
            ?>
            <li>
                <?php if ($event->type == "topic.create") { ?>

                    <a class="title" href="/l/<?= $event->url ?>"><?= $event->title ?></a>
                    <div class="topicInfo">A new list created about <?= Tool::getCategories($event->categories) ?> <?= Tool::getFriendlyDate($date)?></div>

                <?php } else if ($event->type == "item.add") { ?>
                    <div class="circle">&#9679;<div>+</div></div>
                    <div class="itemContainer"><a href="/l/<?= $event->url ?>"><?= $event->item ?></a></div>
                    <div class="itemInfo">
                        <?= $event->username ?> added a new item to '<a href="/l/<?= $event->url ?>"><?= $event->title ?></a>' <?= Tool::getFriendlyDate($date)?>
                    </div>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="right">
    <h3>Welcome to Qaalo</h3>
    Qaalo is a collaborative social tool where you can create lists with your close network and follow lists matching your interests
</div>