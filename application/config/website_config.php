<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * --------------------------------
 * 網站設定
 * --------------------------------
 */
$config['ver']  = '1.00';
$config['meta'] = array(
    'title'       => '管理系統',
    'description' => '管理系統',
    'author'      => '',
);

$config['menu'] = array(
    'admin'    => array(
        'title'      => '管理者管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/admin',
    ),
    'slide' => array(
        'title'      => '首頁輪播管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/slide',
    ),
    'block'    => array(
        'title'      => '首頁區塊管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/block',
    ),
    'news'     => array(
        'title'      => '最新消息管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/news',
    ),
    'store'    => array(
        'title'      => '商店管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/store',
    ),
    //     'user'     => array(
    //         'title'      => '會員管理',
    //         'icon_class' => 'icon-home',
    //         'link'       => '/admin/user',
    //     ),
    'collectionmain' => array(
        'title'      => '集合管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/collectionmain',
    ),
    'product'  => array(
        'title'      => '商品管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/product',
    ),
//     'discount' => array(
    //         'title'      => '折扣管理',
    //         'icon_class' => 'icon-home',
    //         'link'       => '/admin/discount',
    //     ),
    //     'order' => array(
    //         'title'      => '訂單管理',
    //         'icon_class' => 'icon-home',
    //         'link'       => '/admin/order',
    //     ),
    'system'   => array(
        'title'      => '系統變數管理',
        'icon_class' => 'icon-home',
        'link'       => '/admin/systemvariable',
    ),
);

$config['cs_email'] = array(
    'email' => 'cs@floats.com.tw',
    'name'  => '客服',
);

$config['notify_email'] = array(
    'email' => 'notify@floats.com.tw',
    'name'  => '通知',
);

$config['aes_encrypt'] = array(
    'key' => 'sZhMBJG3pAKjNVD0CYy8IewbPiFW5drT',
    'iv'  => 'byVErneB91R5Z63t',
);

/**
 * --------------------------------
 * 全域設定
 * --------------------------------
 */
// 語系
$config['lang'] = array(
    '1' => '繁中',
    '2' => '日文',
    '3' => '英文',
);
// admin狀態
$config['admin_status'] = array(
    '2' => '停用',
    '1' => '啟用',
    '3' => '刪除',
);
// 商品狀態
$config['status'] = array(
    '1' => '上架',
    '2' => '下架',
    '3' => '暫時販售',
);
// 一般狀態
$config['common_status'] = array(
    '1' => '啟用',
    '2' => '停用',
);
// 連結類型
$config['link_types'] = array(
    '_blank' => '另開新頁',
    '_self'  => '目前頁面打開',
);

// 價格區間
$config['price_rang'] = array(
    '1' => '1000以下',
    '2' => '1000~2000',
    '3' => '2001~3000',
    '4' => '3001~4000',
    '5' => '4001~5000',
    '6' => '5001以上',
);

// site config
$config['company'] = array(
    'name'        => '',
    'since'       => '2016',
    'office_tele' => '02-123-4567',
    'office_fax'  => '02-123-4567',
);

$config['title_separator'] = ' - ';
