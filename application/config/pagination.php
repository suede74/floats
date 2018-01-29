<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Profiler Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Profiler
| data are displayed when the Profiler is enabled.
| Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/pagination.html
|
*/
$config['uri_segment'] = 4;
$config['num_links'] = 5;
$config['use_page_numbers'] = TRUE;
$config['page_query_string'] = TRUE;
$config['enable_query_strings'] = TRUE;
$config['reuse_query_string'] = TRUE;
$config['query_string_segment'] = 'page';
$config['prefix'] = '';
$config['suffix'] = '';
$config['use_global_url_suffix'] = FALSE;
$config['full_tag_open'] = '<li>';
$config['first_link'] = '<<';
$config['first_tag_open'] = '<li class="prev">';
$config['first_tag_close'] = '</li>';
$config['first_url'] = '';
$config['last_link'] = '>>';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
$config['next_link'] = '&gt;';
$config['next_tag_open'] = '<li class="next">';
$config['next_tag_close'] = '</li>';
$config['prev_link'] = '&lt;';
$config['prev_tag_open'] = '<li class="prev">';
$config['prev_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="active"><a>';
$config['cur_tag_close'] = '</li">';
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
// $config['display_pages'] = FALSE;
// $config['attributes'] = array('class' => 'myclass');
