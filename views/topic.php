<div class="clearfix">

    <div class="left">

        <?php if ($this->isInvited) { ?>
            <div class="info">You are invited to contribute to this list. Feel free to add items.</div>
        <?php } ?>

        <div class="list">
            <h2><?= $this->topic->getTitle(); ?></h2>
            <div class="itemBar">
                <div class="itemsHeader">
                    <ul class="items">
                        <?php
                        $a = 0;
                        foreach ($this->items as $item) {
                            ?>
                            <li id="existingItem<?= $a ?>" <?php echo (!$this->isWriter && $a >= 10 ? "class=\"hiddenItem\"" : ""); ?>>
                                <div class="circle<?php echo ($a >= 10 ? " low" : ""); ?>"><?= $a + 1 ?></div>
                                <div class="itemContainer">
                                    <?php echo Tool::renderItem($item->getText()); ?>
                                    <?php if ($this->isLoggedIn()) { ?>
                                        <div class = "icons">
                                            <a id="voteUp<?= $item->getID(); ?>" href="javascript:vote(<?= $item->getID(); ?>,1)" class = "icon voteUp <?= $item->vote == 1 ? "voted" : "" ?>"></a>
                                            <div id = "votes<?= $item->getID(); ?>" class="voteCounter voteCounter<?= $item->getVoteUp() >= $item->getVoteDown() ? "Up" : "Down" ?>"><?= ($item->getVoteUp() >= $item->getVoteDown() ? "" : "-") . "" . abs($item->getVoteUp() - $item->getVoteDown()) ?></div>
                                            <a id="voteDown<?= $item->getID(); ?>" href="javascript:vote(<?= $item->getID(); ?>,-1)" class = "icon <?= $item->vote == -1 ? "voted" : "" ?> voteDown"></a>
                                        </div>
                                    <?php } else { ?>
                                        <div id = "votes<?= $item->getID(); ?>" class="voteCounter voteCounter<?= $item->getVoteUp() >= $item->getVoteDown() ? "Up" : "Down" ?>">(<?= ($item->getVoteUp() >= $item->getVoteDown() ? "" : "-") . "" . abs($item->getVoteUp() - $item->getVoteDown()) ?>)</div>
                                    <?php } ?>
                                </div>
                                <div style="clear:both"></div>
                            </li>
                            <?php
                            $a++;
                            if ($a >= 10) {
                                //break;
                            }
                        }
                        ?>
                    </ul>

                    <?php if ($this->isWriter || $this->isInvited) { ?>
                        <form action="<?php echo $this->getAction("add"); ?>" method="post">
                            <input type="hidden" name="topicID" value="<?php echo $this->topic->getID() ?>"/>
                            <ul start="<?= $a + 1 ?>" id="itemInputList" class="items itemsInput">
                                <li id="item0" name="itemText">
                                    <div class="circle"><?= $a + 1; ?></div>
                                    <div class="itemContainer">
                                        <textarea type="text" onfocus="$('#addForm').show('fast')" placeholder="You have something to add?" charlength="60" name="itemText[]" class="itemInput default autogrow" rows="1"></textarea>
                                    </div>
                                </li>
                            </ul>
                            <div id="addForm" style="display: none;">
                                <span class="description">Press <b>Enter</b> to add new items</span>
                                <?php if (!$this->isLoggedIn() && $this->isInvited) { ?>
                                <button style="margin-left: 20px;" onclick="showRegisterForm();return false;">Add ➜</button>
                                <?php } else { ?>
                                <button style="margin-left: 20px;" type="submit">Add ➜</button>
                                <?php } ?>
                            </div>
                        </form>
                        <script type="text/javascript">$initialItemIndis=<?= $a; ?>; $itemIndis = <?= $a; ?>;$topicID=<?= $this->topic->getID()?>;$inviteCode='<?= $this->inviteCode?>'</script>
                    <?php } ?>
                </div>
            </div>
            <?php if (!$this->isWriter && count($this->items) > 10) { ?>
                <div class="showAll"><a href="javascript:showAll();">⬇ show all ⬇</a></div>
            <?php } ?>
        </div>
    </div>
    <div class="right">

        <?php
        $a = count($this->writers);
        foreach ($this->writers as $writer) {
            $show = "<img class='tinyPhoto' src='" . $writer[1] . "'><a href='javascript:showUser(". $writer[2] .")'>" . $writer[0] . "</a>";
            $a--;

            if ($a == count($this->writers) - 1) {
                if (count($this->writers) > 1) {
                    echo "<b>" . $show . "</b> is listing with ";
                } else {
                    echo "<b>" . $show . "</b> is listing";
                }
            } else {
                echo $show . ( $a > 0 ? ", " : "" );
            }
        }
        ?>
        <?php if ($this->isWriter) { ?>
            <?php echo count($this->writers) == 1 ? "with " : "and "; ?><button id="addListers" onclick="showInviteForm();" class="thin">add ➜</button>
            <div class="inviteForm">
                <hr/>
                <div class="tweetInvite">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://qaalo.com/l/<?= $this->topic->getUrl(); ?>/invitecode/<?= $this->topic->getInviteCode(); ?>" data-lang="en" data-text="Join me with creating <?= htmlspecialchars($this->topic->getTitle()); ?> list" data-count="none" data-via="theqaalo">Invite Followers</a><span class="desc">to invite your friends</span>
                </div>
                <form action="<?php echo $this->getAction("invite"); ?>" method="post">
                    <input type="hidden" name="topicID" value="<?php echo $this->topic->getID() ?>"/>
                    <input name="emails" placeholder="or type emails to invite">
                    <button type="submit" class="small">invite</button>
                </form>
                <div class="shareLink">
                    or share this link: <input onclick="$(this).select();" name="emails" readonly="" value="http://qaalo.com/l/<?= $this->topic->getUrl(); ?>/invitecode/<?= $this->topic->getInviteCode(); ?>">
                </div>
            </div>
        <? } ?>
        <hr/>
        <ul class="categoryList clearfix">
            <?php foreach ($this->categories as $category) { ?>
                <li><a href="/c/<?= $category->getUrl() ?>"><?= $category->getName() ?></a><div categoryTitle="<?= $category->getName(); ?>" categoryID="<?= $category->getID(); ?>" class="categoryItem <?= $category->isFollowed ? "unfollow" : "follow"; ?>"><?= $category->isFollowed ? "-" : "+"; ?></div></li>
            <?php } ?>
        </ul>
        <hr/>

        <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://qaalo.com/l/<?= $this->topic->getUrl() ?>" data-text="Check out this list: <?= htmlspecialchars($this->topic->getTitle()); ?>" data-via="theqaalo">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/tr_TR/all.js#xfbml=1&appId=318546488256998";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="http://qaalo.com/l/<?= $this->topic->getUrl() ?>" data-send="false" data-layout="button_count" data-width="250" data-show-faces="false"></div>
    </div>

</div>