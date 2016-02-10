<?php
$currentPage = $page;
$lastPage = ceil($count/$limit);

function getPageUrl($page) {
    $params = array();
    if (isset($_SERVER['QUERY_STRING'])) {
        parse_str($_SERVER['QUERY_STRING'], $params);
    }
    $params['p'] = $page;

    return "?" . http_build_query($params);
}
?>

<ul class = "pagination">
    <?php if($currentPage != 1): ?>
        <li><a href="<?=getPageUrl(1)?>">&laquo;</a></li>
    <?php endif; ?>

    <?php for($i=1; $i<=$lastPage; $i++): ?>
        <li<?php if($i==$currentPage) echo ' class="active"';?>><a href = "<?=getPageUrl($i)?>"><?=$i?></a></li>
    <?php endfor; ?>

    <?php if($currentPage != $lastPage): ?>
        <li><a href = "<?=getPageUrl($lastPage)?>">&raquo;</a></li>
    <?php endif; ?>
</ul>