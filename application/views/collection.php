<div class="index-block container">
    <img class="index-banner" src="/public/upload/collection/<?=$collection['c_image']?>"></div>
</div>
<div class="container wrapper">
    <ul class="collection-block row">
    <?php if (isset($products) && count($products) > 0): ?>
        <?php foreach ($products as $key => $product): ?>            
        <li class="pull-left">
            <a href="<?=base_url('product/detail/'.$product['pm_id'])?>">
                <img src="/public/upload/product/<?=$product['pm_image_01']?>">
            </a>
        </li>
        <?php endforeach; ?>
    <?php endif; ?>        
    </ul>
    <p class="clear"></p>
    <div class="push"></div>
</div>