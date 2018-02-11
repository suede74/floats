<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-Hant-TW">
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

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar--main">
        <h1 class="title">floats</h1>
        <div class="navbar__logo-button container">
            <img class="order-2" width="106px" src="/public/images/img_logo.png" alt="floats">
            <button class="navbar-toggler order-1 js_header-content__hamburger">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="main-menu collapse navbar-collapse navbar-nav order-2">
                
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('about')?>">About Toe Ring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('product/Floats! Toe Ring')?>">Floats Toe Ring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('about')?>">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('collection')?>">Collection</a>
                    <?php if (!empty($collections)): ?>                
                    <ul>                    
                        <?php foreach ($collections as $collection): ?>
                            <li><a href="<?=base_url('collection/'.$collection['c_id'])?>"><?=$collection['c_title']?></a></li>
                        <?php endforeach; ?>                    
                    </ul>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('product/Ring')?>">Ring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('product/Earring')?>">Earring</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('product/Necklace')?>">Necklace</a>
                </li>
            </ul>
            <div class="order-3 d-none d-lg-block">
                <button class="cart float-left"></button>
                <button class="cart float-left"></button>
                <button class="cart float-left"></button>
                <button class="cart float-left"></button>
            </div>
            <!-- order 子元素會受 margin 影響斷行 -->
            <div class="order-3" style="padding-right: 20px;">
                <button class="cart float-left"></button>
            </div>
        </div>
        
    </nav>
    <nav class="navbar navbar-light" style="padding: 0">
        <ul class="main-menu__mobile navbar-collapse collapse navbar-nav">
            
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('about')?>">About Toe Ring</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('product/Floats! Toe Ring')?>">Floats Toe Ring</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('collection')?>">+ Collection</a>
                <?php if (!empty($collections)): ?>                
                <ul>                    
                    <?php foreach ($collections as $collection): ?>
                        <li><a href="<?=base_url('collection/'.$collection['c_id'])?>"><?=$collection['c_title']?></a></li>
                    <?php endforeach; ?>                    
                </ul>
                <?php endif; ?>
            </li>
            <li class="nav-item main-menu__mobile-dropdown">
                <!-- <a class="nav-link" href="<?=base_url('product/Ring')?>">+ Toe Ring -->
                <a class="nav-link">+ Toe Ring
                    <ul class="dropdown-menu main-menu__mobile-ul">
                        <li>• Color-色彩</li>
                        <li>• Material-材質</li>
                        <li>• Price-單價</li>
                    </ul>
                </a>
            </li>
            <li class="nav-item main-menu__mobile-dropdown">
                <a class="nav-link">+ Ring

                    <ul class="dropdown-menu main-menu__mobile-ul">
                        <li class="main-menu__mobile-dropdown-seconds">• Color-色彩
                            <ul class="main-menu__mobile-ul-seconds">
                                <li>1</li>
                                <li>2</li>
                            </ul>
        
                        </li>
                        <li>• Material-材質</li>
                        <li>• Price-單價</li>
                    </ul>
                </a>
                
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('product/Earring')?>">+ Earring</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('product/Necklace')?>">+ Necklace</a>
            </li>
        </ul>
    </nav>
    <?=$container_view?>
    
    <footer>
        <ul class="row margin_center container mx-auto">
            <li class="col-lg-2">
                <h4>Customer Support<span class="float-right d-md-none">x</span></h4>
                <p><a>關於腳戒</a></p>
                <p><a>常見問題解答</a></p>
                
            </li>
            <li class="col-lg-2">
                <h4>Company<span class="float-right d-md-none">x</span></h4>
                <p><a>品牌精神</a></p>
                <p><a>公司簡介</a></p>
				<p><a>人才招募</a></p>
            </li>
            <li class="col-lg-2">
                <h4>Guide<span class="float-right d-md-none">x</span></h4>
                <p><a>會員福利</a></p>
                <p><a>會員使用條款</a></p>
                <p><a>隱私政策</a></p>
            </li>
            <li class="col-lg-2">
                <h4>Contact Us<span class="float-right d-md-none">x</span></h4>
                <p><a>電郵至客服部門</a></p>
                <p><a>門市資訊</a></p>
                <p><a>訂閱最新東京時尚報導</a></p>
            </li>
            <li class="col-lg-2 d-none d-lg-block">
                <h4>Information<span class="float-right d-md-none">x</span></h4>
                <p><a>最新消息</a></p>
                <p><a>最新消息</a></p>
            </li>
            <li class="col-lg-2 d-none d-lg-block">
                <img class="footer-img" style="width: 100%; margin-top: 100px;" src="/public/images/img_footer.png">
            </li>
            <li class="col-md-12 d-block d-lg-none">
                <img src="/public/images/fb.svg" alt="">
                <img src="/public/images/fb.svg" alt="">
                <img src="/public/images/fb.svg" alt="">
            </li>
        </ul>
        <img class="footer-img d-block d-lg-none" src="/public/images/img_footer.png">
        <p class="clear"></p>
    </footer>
    <address class="footer-copyright">©2017 Daija Taiwan Co.,Ltd.</address>
    <script src="/public/bower_components/jquery/dist/jquery.min.js" /></script>
    <script src="/public/bower_components/less/dist/less.min.js" /></script>
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
        // 漢堡選單按鈕
        $('.js_header-content__hamburger, .js-side-header__close').click(function() {
            $(this).toggleClass('active');
            $('.main-menu__mobile').toggleClass('show');
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
        
        $('.index-block').carousel({ interval: 5000 });
    </script>
    <script defer src="/public/js/dist/main.bundle.js"></script>               
</body>

</html>