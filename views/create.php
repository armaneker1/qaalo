<div class="mainSub">
    <form id="topicForm" action="<?php echo $this->getAction("create"); ?>" method="post">
        <input type="hidden" name="title" value="<?php echo $this->title ?>"/>
        <p>
            <textarea id="title" class="autogrow topicTitle default" autocomplete="off" placeholder="Enter title here" charlength="60" name="title" cols="55" rows="1"><?php echo $this->title ?></textarea>
        </p>
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

    </form>
