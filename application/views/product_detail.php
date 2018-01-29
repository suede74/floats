<div class="container product-container">
    <!--<p>トウリング一覧</p>-->
    <div class="row">
        <ul class="product-left row flex-column" id="product-list">
            <li class="active"><img src="/public/upload/product/<?=$product['pm_image_01']?>" alt="商品縮圖"></li>
            <?php if ($product['pm_image_02']): ?>
                <li><img src="/public/upload/product/<?=$product['pm_image_02']?>" alt="商品縮圖"></li>
            <?php endif; ?>
            <?php if ($product['pm_image_03']): ?>
                <li><img src="/public/upload/product/<?=$product['pm_image_03']?>" alt="商品縮圖"></li>
            <?php endif; ?>
            <?php if ($product['pm_image_04']): ?>
                <li><img src="/public/upload/product/<?=$product['pm_image_04']?>" alt="商品縮圖"></li>
            <?php endif; ?>
            <?php if ($product['pm_image_05']): ?>
                <li><img src="/public/upload/product/<?=$product['pm_image_05']?>" alt="商品縮圖"></li>
            <?php endif; ?>
            <?php if ($product['pm_image_06']): ?>
                <li><img src="/public/upload/product/<?=$product['pm_image_06']?>" alt="商品縮圖"></li>
            <?php endif; ?>
        </ul>
        <div class="product-center col-md-5 col-sm-10 col-xs-12" id="product-show">
            <img src="/public/upload/product/<?=$product['pm_image_01']?>" alt="商品圖">
        </div>
        <div class="product-right col-md-6 col-sm-12">
            <p class="product-title-des"><?=$product['pm_description_short']?></p>
            <h1 class="product-title"><?=$product['pm_name_tw']?></h1>
            <h3 class="product-title"><?=$product['pm_name_en']?></h3>
            <p class="row">
                <span class="col-md-4"><?=$this->lang->line('model_no')?></span>
                <span><?=$product['pm_model_no']?></span>
            </p>
            <p class="row">
                <span class="col-md-4"><?=$this->lang->line('price')?></span>
                <span>$<?=number_format($product['pm_price'])?></span>
            </p>
            <p class="row" hidden="ture">
                <span class="col-md-4"><?=$this->lang->line('quantity')?><input type="number"></span>
                <span class="span-num">/ <?=$this->lang->line('inventory')?> <?=$product['pm_inventory']?></span>
            </p>
            <p hidden="ture">
                <button><?=$this->lang->line('add_cart')?></button>
            </p>
            <p>
                <span><?=$this->lang->line('pd_size')?></span>
                <br>
                <span><?=$product['pm_size']?></span>
            </p>
            <!-- <p class="row">
                <span class="col-md-4"><?=$this->lang->line('pd_wdh')?></span>
                <span><?=$product['pm_material_01']?></span>
                <?php if ($product['pm_material_02']): ?>
                    <span><?=$product['pm_material_02']?></span>
                <?php endif; ?>
            </p> -->
            <p class="row">
                <span class="col-md-4"><?=$this->lang->line('material')?></span>
                <span><?=$product['pm_material_description']?></span>
            </p>
            <!-- <p class="row">
                <span class="col-md-4"><?=$this->lang->line('production_place')?></span>
                <span>aaa</span>
            </p>
            <p class="row">
                <span class="col-md-4"><?=$this->lang->line('memo')?></span>
                <span>aaa</span>
            </p> -->
        </div>
    </div> 
</div>