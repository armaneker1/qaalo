<div class="left" style="padding-top:0px;">
    <?php if (!$this->isLoggedIn()) { ?>
        <div class="welcome"><h2>Welcome to Qaalo</h2>
            Qaalo is a collaborative social tool where you can create lists with your close network and follow lists matching your interests.<br><br>
            <a onclick="showRegisterForm();return false;" href="/base.register" style="font-weight: bold;">Click here to register</a> for free now
        </div>
    <?php } else { ?>
        <div class="miniTopicForm">
            <form  id="topicForm" method="post" action="/base.create/create">
                <textarea onfocus="$('#topicFormDetails').show('fast');" id="title" class="autogrow topicTitle default" autocomplete="off" placeholder="Type a topic to create a new list" charlength="60" name="title" cols="55" rows="1"></textarea>
                <div id="topicFormDetails" >
                    <div class="list">
                        <div class="itemBar">
                            <div class="itemsHeader">
                                <ul id="itemInputList" class="items itemsInput">
                                    <li id="item0">
                                        <div class="circle">1</div>
                                        <div class="itemContainer">
                                            <textarea type="text" placeholder="Enter first item here" name="itemText[]" charlength="60" autocomplete="off" class="itemInput default autogrow" rows="1"></textarea>
                                        </div>
                                    </li>
                                </ul>
                                <div class="description" style="margin-top: 8px;">Press <b>Enter</b> to add new items</div>
                            </div>
                        </div>
                    </div>
                    <input type="text" id="categories" name="categories" />
                    <div class="description" style="margin: 8px 0 0 0;">Add categories to your list</div>
                    <button type="submit">Next ➜</button>
                </div>
            </form>

        </div>
    <?php } ?>

    <?php if ($this->isLoggedIn() && count($this->timeline) == 0) { ?>
        <h3>Now, it is a good time to follow some categories.</h3>
        When you follow a category, all lists created with that category will appear here. Type in some categories now like fashion, cars, travel etc.:
        <div class="addCategoryForm" style="display: block;">
            <form action="<?php echo $this->getAction("addCategory"); ?>" method="post">
                <div style="float:left;">
                    <input type="text" id="categoryList" name="categories" />
                </div>
                <div style="float:left; margin-top:2px; padding:10px"><button style="padding:9px;">Continue ➜</button>
                </div>
                <div style="clear: both;"></div>
            </form>
        </div>
        <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.tokeninput.js" ></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#categoryList").tokenInput("/back.category/search");
                            
    <?php
    if ($this->categories != "") {
        foreach ($this->categories as $cat) {
            ?>
                            $("#categories").tokenInput("add", {"id": "<?= $cat["name"] ?>", "name": "<?= $cat["value"] ?>"});
        <?php
        }
    }
    ?>   
        });
        </script>
        <?php } ?>
    <ul class="timeline">
        <?php
        foreach ($this->timeline as $eventData) {
            $event = json_decode($eventData[0]);
            $date = $eventData[1];
            if ($event->title == "En iyi klarnet sololar") {
                continue;
            }
            ?>
            <li>
    <?php if ($event->type == "topic.create") { ?>

                    <a class="title" href="/l/<?= $event->url ?>"><?= $event->title ?></a>
                    <div class="topicInfo">A new list created about <?= Tool::getCategories($event->categories) ?> <?= Tool::getFriendlyDate($date) ?></div>

    <?php } else if ($event->type == "item.add") { ?>
                    <div style="margin-top:14px;">
                        <div class="circle">+</div>
                        <div class="itemContainer"><a href="/l/<?= $event->url ?>"><?= Tool::renderItem($event->item) ?></a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="itemInfo">
                    <?= $event->username ?> added a new item to '<a href="/l/<?= $event->url ?>"><?= $event->title ?></a>' <?= Tool::getFriendlyDate($date) ?>
                    </div>

            <?php } ?>
            </li>
<?php } ?>
    </ul>
</div>
<div class="right">
    <h3>Trending categories</h3>
    <ul class="categoryList clearfix">
        <?php foreach ($this->trendingCategories as $category) { ?>
            <li><a href="/c/<?= $category->getUrl() ?>"><?= $category->getName() ?></a><div categoryTitle="<?= $category->getName(); ?>" categoryID="<?= $category->getID(); ?>" class="categoryItem <?= $category->isFollowed ? "unfollow" : "follow"; ?>"><?= $category->isFollowed ? "-" : "+"; ?></div></li>
<?php } ?>
    </ul>
    <hr/>
    <h3>Welcome to Qaalo</h3>
    Qaalo is a collaborative social tool where you can create lists with your close network and follow lists matching your interests. <a onclick="showHelp();" href="#help">How?</a>
</div>