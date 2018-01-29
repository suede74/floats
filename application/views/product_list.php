<div class="container product-container">
    <!--<p class="crumbs">-->
    <!--    <a class="back-index" href="/."></a>-->
    <!--    <span>></span>トウリング一覧-->
    <!--</p>-->
	<p>篩選條件</p>
    <div class="row">
        <ul class="product-ul col-lg-3 col-sm-12">
            <?php if (!empty($colors)): ?>
            <li <?= (!empty($get['color']))? 'class="active"' : '' ?>><?=$this->lang->line('pl_color')?>                
                <ul>
                    <?php foreach ($colors as $color): ?>
                        <li><a href="<?=base_url('product/'.$category.'?color='.$color)?>">-<?=$color?></a></li>
                    <?php endforeach; ?>                        
                </ul>                
            </li>
            <?php endif; ?>

            <li <?= (!empty($get['price']))? 'class="active"' : '' ?>><?=$this->lang->line('pl_price')?>
                <ul>     
                    <?php foreach ($price_rang as $v => $name) : ?>
                        <?php if (in_array($v, $prices)) : ?>
                        <li><a href="<?=base_url('product/'.$category.'?price=' . $v)?>">-<?= $name ?></a></li>
                        <?php endif;?>
                    <?php endforeach; ?>               
                    <!-- <li><a href="<?=base_url('product/'.$category.'?price=1')?>">-1000以下</a></li>
                    <li><a href="<?=base_url('product/'.$category.'?price=2')?>">-1000~2000</a></li>
                    <li><a href="<?=base_url('product/'.$category.'?price=3')?>">-2001~3000</a></li>
                    <li><a href="<?=base_url('product/'.$category.'?price=4')?>">-3001~4000</a></li>
                    <li><a href="<?=base_url('product/'.$category.'?price=5')?>">-4001~5000</a></li>
                    <li><a href="<?=base_url('product/'.$category.'?price=6')?>">-5001以上</a></li> -->
                </ul>
            </li>

            <li <?= (!empty($get['situation']))? 'class="active"' : '' ?>><?=$this->lang->line('pl_situation')?>
                <?php if (!empty($scenarios)): ?>
                <ul>
                    <?php foreach ($scenarios as $scenario): ?>
                        <li><a href="<?=base_url('product/'.$category.'?scenario='.$scenario)?>">-<?=$scenario?></a></li>
                    <?php endforeach; ?>                        
                </ul>
                <?php endif; ?>
            </li>

            <li <?= (!empty($get['material']))? 'class="active"' : '' ?>><?=$this->lang->line('pl_material')?>
                <!-- 次選單 -->
                <?php if (!empty($materials)): ?>
                <ul>
                    <?php foreach ($materials as $material): ?>
                        <li><a href="<?=base_url('product/'.$category.'?material='.$material)?>">-<?=$material?></a></li>
                    <?php endforeach; ?>                        
                </ul>
                <?php endif; ?>
            </li>

            <li <?= (!empty($get['size']))? 'class="active"' : '' ?>><?=$this->lang->line('pl_size')?>
                <?php if (!empty($sizes)): ?>
                <ul>
                    <?php foreach ($sizes as $size): ?>
                        <li><a href="<?=base_url('product/')?>">-<?=$size?></a></li>
                    <?php endforeach; ?>                        
                </ul>
                <?php endif; ?>
            </li>
            
        </ul>
        <div class="masonry col-lg-9 col-sm-12">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $key => $product): ?>
                    <?php if ($key == 0): ?>
                        <a class="item" href="<?=base_url('product/detail/'.$product['pm_id'])?>">
                            <div class="item__content" style="background-image: url('/public/upload/product/<?=$product['pm_image_01']?>');"></div>
                        </a>
                    <?php else: ?>
                        <a class="item" href="<?=base_url('product/detail/'.$product['pm_id'])?>">
                            <div class="item__content item__content--small" style="background-image: url('/public/upload/product/<?=$product['pm_image_01']?>');"></div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
                        
            <p style="clear: both;"></p>
            
        </div>
    </div>
</div>