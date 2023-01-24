<div class="span10">
    <article>
        <h1><?=$topic->title?></h1>
        <div>
            <div><?=kdate($topic->created)?></div>
            <?=auto_link($topic->description)?>
        </div>
    </article>
    <div>
        <a href="/topic/add" class="btn">추가</a>
    </div>
</div>