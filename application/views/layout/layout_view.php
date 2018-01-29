<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floats! Toering Specialty Brand「Float」官網 </title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/public/js/dist/css/main.css"/>
    <!-- <link rel="stylesheet/less" type="text/css" href="/public/less/all.less" media="all" /> -->
    <!-- <link rel="stylesheet" href="/public/less/bootstrap.css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/6.0.0/normalize.min.css" media="all" /> -->
    <!--<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />-->
</head>

<body style="margin: 0;">
    <nav class="main-menu_mobile">
        <ul>
            <li>
                <a href="<?=base_url('collection')?>">Collection</a>
                <?php if (!empty($collections)): ?>                
                <ul>                    
                    <?php foreach ($collections as $collection): ?>
                        <li><a href="<?=base_url('collection/'.$collection['c_id'])?>"><?=$collection['c_title']?></a></li>
                    <?php endforeach; ?>                    
                </ul>
                <?php endif; ?>
            </li>
            <li>
                <a href="<?=base_url('about')?>">About Toe Ring</a>
            </li>
            <li>
                <a href="<?=base_url('product/Floats! Toe Ring')?>">Floats Toe Ring</a>
            </li>
            <li>
                <a href="<?=base_url('product/Ring')?>">Ring</a>
            </li>
            <li>
                <a href="<?=base_url('product/Earring')?>">Earring</a>
            </li>
            <li>
                <a href="<?=base_url('product/Necklace')?>">Necklace</a>
            </li>
            <li>
                <a>Information</a>
            </li>
            <!-- <li>
                <a>shop</a>
            </li> -->
        </ul>
    </nav>
    <div>
        <header class="header-content">
            <a class="header-content__hamburger js_header-content__hamburger hidden-lg-up">
                <span></span>
            </a>
            <!--<div class="row justify-content-end">-->
            <!--    <ul class="header-content__ul hidden-md-down">-->
            <!--        <li><a>トウリングコーディネート</a></li>-->
            <!--        <li><a>トウリ</a></li>-->
            <!--        <li>-->
            <!--            <i class="fa fa-shopping-bag"></i>トウリ-->
            <!--            <span>0</span>    -->
            <!--        </li>-->
            <!--        <li><a>トウリ</a></li>-->
            <!--    </ul>-->
            <!--</div>-->
            <!--<a href="<?=base_url('/')?>">-->
            <!--    <div class="header-content__logo"></div>-->
            <!--</a>-->
        </header>
        <nav class="main-menu conatiner row hidden-md-down" style="background-color: #dcdedd;">
            <div class="table-responsive col-md-9 pull-left" style="display: inline-block;">
                <table class="table">
                    <tr>
                    	<td>
                    		<a style="padding-right: 36px;" href="<?=base_url('/')?>">
                    			<img style="width: 106px;" src="/public/images/img_logo.png">
                    		</a>
                    	</td>
                        <td>
                            <a href="<?=base_url('collection')?>">
                                <h5>Collection</h5>
<!--                                 <p><?=$this->lang->line('collection')?></p> -->
                            </a>
                            <?php if (!empty($collections)): ?>
                            <ul class="second-nav">
                                <?php foreach ($collections as $collection): ?>
                                    <li><a href="<?=base_url('collection/'.$collection['c_id'])?>"><?=$collection['c_title']?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?=base_url('about')?>">
                                <h5>Toe Ring</h5>
<!--                                 <p><?=$this->lang->line('about_toe_ring')?></p> -->
                            </a>
                        </td>
<!--                        <td>-->
<!--                            <a href="<?=base_url('product/Floats! Toe Ring')?>">-->
<!--                                <h5>Floats!Toering</h5>-->
<!--                                 <p><?=$this->lang->line('floats_toe_ring')?></p> -->
<!--                            </a>-->
<!--                        </td>-->
                        <td>
                            <a href="<?=base_url('product/Ring')?>">
                                <h5>Ring</h5>
<!--                                 <p><?=$this->lang->line('ring')?></p> -->
                            </a>
                        </td>
                        <td>
                            <a href="<?=base_url('product/Earring')?>">
                                <h5>Earring</h5>
<!--                                 <p><?=$this->lang->line('earring')?></p> -->
                            </a>
                        </td>
                        <td>
                            <a href="<?=base_url('product/Necklace')?>">
                                <h5>Necklace</h5>
<!--                                 <p><?=$this->lang->line('necklace')?></p> -->
                            </a>
                        </td>
                        <td>
                            <a>
                                <h5>shop</h5>
<!--                                 <p><?=$this->lang->line('information')?></p> -->
                            </a>
                        </td>
                        <!-- <td>
                            <a>
                                <h5>Shop</h5>
                                <p><?=$this->lang->line('shop')?></p>
                            </a>
                        </td> -->
                    </tr>
                </table>
                
            </div>
            <ul class="col-md-3 pull-right" style="margin: 10px 0;">
                <li>
                    <img src="/public/images/fb.svg" alt="">
                </li>
            </ul>
        </ul>
        </nav>
    </div>
    
    <?=$container_view?>
    
    <footer class="container">
        <ul class="row margin_center">
            <li class="col-md-2">
                <h4>Customer Support</h4>
                <p><a>常見問題</a></p>
                <!--<p><a>よくある質問</a></p>-->
                <!--<p><a>よくある質問</a></p>-->
                <!--<p><a>よくある質問</a></p>-->
            </li>
            <li class="col-md-2">
                <h4>Company</h4>
                <p><a>公司概要</a></p>
				<!--<p><a>会社概要</a></p>-->
            </li>
            <li class="col-md-2">
                <h4>Privacy Policy</h4>
                <p><a>使用規範</a></p>
            </li>
            <li class="col-md-2">
                <h4>Contact Us</h4>
                <p><a>聯絡我們</a></p>
            </li>
            <li class="col-md-2">
                <h4>Recruit</h4>
                <p><a>職缺訊息</a></p>
            </li>
        </ul>
        <p class="clear"></p>
    </footer>
    <p class="footer-copyright">©2017 Daija Taiwan Co.,Ltd.</p>
    <script src="/public/bower_components/jquery/dist/jquery.min.js" /></script>
    <script src="/public/bower_components/less/dist/less.min.js" /></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
        // 漢堡選單按鈕
        $('.js_header-content__hamburger, .js-side-header__close').click(function() {
            $(this).toggleClass('active');
            $('.main-menu_mobile').toggleClass('active');
            $('.container').toggleClass('active');
        });

        // 商品列表頁 - 開啟列表次選單
        var proListLi = $('.product-ul').find('li');
        	
        proListLi.on('click', function (e) {
        	
            if ($(this).hasClass('active')) {
            	
            	$(event.currentTarget).removeClass('active');
            } else {
            	
            	proListLi.removeClass('active');
            	$(event.currentTarget).addClass('active');
            }
            
        });

        // 商品詳細頁 - 商品列表點擊
        var proList = $('#product-list').find('li'),
            productShow = $('#product-show').find('img');
        proList.bind('click', function (e) {
            proList.removeClass('active');
            $(this).addClass('active');
            
            productShow.attr('src', $(this).find('img').attr('src'));
        });
        
        $('.index-block').carousel({
			interval: 2000
		});
    </script>                    
</body>

</html>