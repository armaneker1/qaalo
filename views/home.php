<div class="mainSub">
    Welcome, <a href="/base.create">create a new list?</a> or check out some lists:
    <br/>
    <?php foreach ($this->topics as $topic) { ?>

        <br/><a href="/l/<?= $topic->getUrl() ?>"><?= $topic->getTitle() ?></a>

    <?php } ?>
</div>