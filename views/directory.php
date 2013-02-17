<div class="mainSub">
    <h3>Lists</h3>
    <div class="letters">
        <a href="/base.directory/lists/a">A</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/b">B</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/c">C</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/d">D</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/e">E</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/f">F</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/g">G</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/h">H</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/i">I</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/j">J</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/k">K</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/l">L</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/m">M</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/n">N</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/o">O</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/p">P</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/q">Q</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/r">R</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/s">S</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/t">T</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/u">U</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/v">V</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/w">W</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/x">X</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/y">Y</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/z">Z</a><span class="bullet"> • </span>
        <a href="/base.directory/lists/A">#</a>
    </div>
    <br>
    <h3>Categories</h3>
    <a href="/base.directory/category/a">A</a><span class="bullet"> • </span>
    <a href="/base.directory/category/b">B</a><span class="bullet"> • </span>
    <a href="/base.directory/category/c">C</a><span class="bullet"> • </span>
    <a href="/base.directory/category/d">D</a><span class="bullet"> • </span>
    <a href="/base.directory/category/e">E</a><span class="bullet"> • </span>
    <a href="/base.directory/category/f">F</a><span class="bullet"> • </span>
    <a href="/base.directory/category/g">G</a><span class="bullet"> • </span>
    <a href="/base.directory/category/h">H</a><span class="bullet"> • </span>
    <a href="/base.directory/category/i">I</a><span class="bullet"> • </span>
    <a href="/base.directory/category/j">J</a><span class="bullet"> • </span>
    <a href="/base.directory/category/k">K</a><span class="bullet"> • </span>
    <a href="/base.directory/category/l">L</a><span class="bullet"> • </span>
    <a href="/base.directory/category/m">M</a><span class="bullet"> • </span>
    <a href="/base.directory/category/n">N</a><span class="bullet"> • </span>
    <a href="/base.directory/category/o">O</a><span class="bullet"> • </span>
    <a href="/base.directory/category/p">P</a><span class="bullet"> • </span>
    <a href="/base.directory/category/q">Q</a><span class="bullet"> • </span>
    <a href="/base.directory/category/r">R</a><span class="bullet"> • </span>
    <a href="/base.directory/category/s">S</a><span class="bullet"> • </span>
    <a href="/base.directory/category/t">T</a><span class="bullet"> • </span>
    <a href="/base.directory/category/u">U</a><span class="bullet"> • </span>
    <a href="/base.directory/category/v">V</a><span class="bullet"> • </span>
    <a href="/base.directory/category/w">W</a><span class="bullet"> • </span>
    <a href="/base.directory/category/x">X</a><span class="bullet"> • </span>
    <a href="/base.directory/category/y">Y</a><span class="bullet"> • </span>
    <a href="/base.directory/category/z">Z</a><span class="bullet"> • </span>
    <a href="/base.directory/category/A">#</a>

    <?php if ($this->topics) { ?> 
        <br/><br/><hr/>
        <?php foreach ($this->topics as $topic) { ?>
            <a href="/l/<?= $topic->getUrl() ?>"><?= $topic->getTitle(); ?></a><br>
        <?php } ?>
    <?php } else if ($this->categories) { ?> 
        <br/><br/><hr/>
        <?php foreach ($this->categories as $category) { ?>
            <a href="/c/<?= $category->getUrl() ?>"><?= $category->getName(); ?></a><br>
        <?php } ?>    

    <?php } ?>
</div>