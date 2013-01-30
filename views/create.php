<div class="mainSub">
    <script type="text/javascript" src="<?php echo __WEBROOT__ ?>inc/jquery.autosize-min.js" ></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function()
        {
            $('.autogrow').autosize();  
        
        });
    </script>


    And your list is about:
    <form action="<?php echo $this->getAction("create"); ?>" method="post">
        <input type="hidden" name="title" value="<?php echo $this->title ?>"/>
        <p>
            <textarea id="title" class="autogrow topicTitle default" autocomplete="off" placeholder="Enter title here" maxlength="60" name="title" cols="55" rows="1"><?php echo $this->title ?></textarea>
        </p>
        <ol id="itemInputList" class="itemInputList">
            <li id="item0" name="itemText" class="itemInputLI">
                <textarea type="text" placeholder="Enter first item here" name="itemText[]" maxlength="120" autocomplete="off" class="itemInput default autogrow" rows="1"></textarea>
            </li>
        </ol>
        <span class="description">Press <b>Enter</b> to add new items</span>
        <p><button type="submit">Next ➜</button></p>
    </form>
</div>