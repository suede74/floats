<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    private $uploadPath;
    private $excelColumnMapping;
    private $notRequireColumn;

    public function __construct()
    {
        parent::__construct();
        //excel欄位對照
        $this->excelColumnMapping = array(
            '0'  => 'pm_category', //品項
            '1'  => 'pm_name_tw', //中文品名
            '2'  => 'pm_name_en', //英文品名
            '3'  => 'pm_description_short', //商品簡述
            '4'  => 'pm_model_no', //商品型號
            '5'  => 'pm_bar_code', //條碼
            '6'  => 'pm_material_description', //材質
            '7'  => 'pm_package', //包裝
            '8'  => 'pm_description_full', //商品說明
            '9'  => 'pm_image_01', //產品照1
            '10' => 'pm_image_02', //產品照2
            '11' => 'pm_image_03', //產品照3
            '12' => 'pm_image_04', //產品照4
            '13' => 'pm_image_05', //產品照5
            '14' => 'pm_image_06', //產品照6
            '15' => 'pm_color_01', //顏色1
            '16' => 'pm_color_02', //顏色2
            '17' => 'pm_color_03', //顏色3
            '18' => 'pm_price', //價格
            '19' => 'pm_use_scenario_01', //使用情境1
            '20' => 'pm_use_scenario_02', //使用情境2
            '21' => 'pm_use_scenario_03', //使用情境3
            '22' => 'pm_material_01', //材質1
            '23' => 'pm_material_02', //材質2
            '24' => 'pm_style', //特色風格
            '25' => 'pm_size', //大小
            '26' => 'pm_inventory', //數量
            '27' => 'pm_status', //狀態
        );

        $this->notRequireColumn = array(            
            'pm_image_02',
            'pm_image_03',
            'pm_image_04',
            'pm_image_05',
            'pm_image_06',
            'pm_color_02',
            'pm_color_03',
            'pm_use_scenario_02',
            'pm_use_scenario_03',
            'pm_material_02',
            //
            'pm_description_short',
            'pm_bar_code',
            'pm_material_description',
            'pm_package',
            'pm_description_full',
            'pm_color_01',
            'pm_use_scenario_01',
            'pm_material_01',
            'pm_style',
            'pm_size',
            'pm_inventory',
            'pm_status',
        );

        $this->load->model('product_main_model');

        $this->load->library('uploadfile');

        $this->uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/public/upload/';
    }

    public function index()
    {
        $this->data["title"] = '商品管理';

        $this->load->library('pagination');

        $get         = $this->input->get(null, true);
        $get['page'] = ($this->input->get('page') != '') ? $this->input->get('page') : 1;

        $per_page             = PER_PAGE;
        $config['base_url']   = base_url($this->folder . '/' . $this->ctl . '/' . $this->method);
        $config['total_rows'] = $this->product_main_model->countListByQuery($get);
        $config['per_page']   = $per_page;

        $limit = array(($get['page'] - 1) * $per_page, $per_page);

        // 分頁
        $this->pagination->initialize($config);
        $this->data['pages'] = $this->pagination->create_links();
        $this->data['lists'] = $this->product_main_model->getListByQuery($get, $limit);

        // status
        $this->data['status'] = $this->config->item('status', 'website_config');

        $js = array(
//                 'assets/apps/scripts/admin/news_list',
        );
        $this->setJS($js);

        $this->render('admin/product_list_view', $this->data);
    }

    public function add()
    {
        $this->data["title"] = '新增商品';

        $js = array(
            'assets/global/plugins/jquery-validation/js/jquery.validate.min',
            // 'assets/global/plugins/ckeditor/ckeditor',
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/apps/scripts/admin/product',
        );
        $this->setJS($js);

        $css = array(
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
        );
        $this->setCSS($css);

        $this->render('admin/product_detail_view', $this->data);
    }

    public function add_product()
    {
        $fields = array(
            'pm_category',
            'pm_name_tw',
            'pm_name_en',
            'pm_description_short',
            'pm_model_no',
            'pm_bar_code',
            'pm_material_description',
            'pm_package',
            'pm_description_full',
            'pm_color_01',
            'pm_color_02',
            'pm_color_03',
            'pm_price',
            'pm_use_scenario_01',
            'pm_use_scenario_02',
            'pm_use_scenario_03',
            'pm_material_01',
            'pm_material_02',
            'pm_style',
            'pm_size',
            'pm_inventory',
            'pm_status',
        );

        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();

        // file upload
        $config['upload_path']   = $this->uploadPath . 'product/';
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $this->uploadfile->_init($config);
        $fileData = $this->uploadfile->multiUpload();
        if ($result === true && $fileData['success'] == true) {
            //商品圖
            if (!empty($fileData['data']) && count($fileData['data']) > 0) {
                foreach ($fileData['data'] as $field => $file) {
                    $this->data['post'][$field] = $file['file_name'];
                }
            }
            $this->data['post']['pm_created'] = date('Y-m-d H:i:s');
            if ($id = $this->product_main_model->insert($this->data['post'])) {
                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '新增成功';
            } else {
                $this->response['MessageTitle'] = '失敗';
                $this->response['Message']      = '新增失敗，資料庫錯誤';
            }
        } else {
            $this->response['MessageTitle'] = '新增失敗';
            if ($fileData['success'] == false) {
                $this->response['Message'] = '請選擇檔案上傳';
            } else {
                $this->response['Message'] = $result;
            }
        }

        $this->ajax_output();
    }

    public function import()
    {
        $this->data["title"] = '匯入商品';

        $js = array(
            'assets/global/plugins/jquery-validation/js/jquery.validate.min',
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/apps/scripts/admin/product_import',
        );
        $this->setJS($js);

        $css = array(
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
        );
        $this->setCSS($css);

        $this->render('admin/product_import_view', $this->data);
    }

    public function uploadimage()
    {
        $this->data["title"] = '上傳ZIP商品圖';

        $js = array(
            'assets/global/plugins/jquery-validation/js/jquery.validate.min',
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            'assets/apps/scripts/admin/product_upload_image',
        );
        $this->setJS($js);

        $css = array(
            'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
        );
        $this->setCSS($css);

        $this->render('admin/product_upload_image_view', $this->data);
    }

    public function import_product()
    {
        $filePath = $this->uploadPath . 'files/';
        $config['upload_path']   = $filePath;
        $config['allowed_types'] = 'xlsx|xls';
        $this->uploadfile->_init($config);
        $fileData = $this->uploadfile->upload('product_file');

        $insertNum = 0;
        $updateNum = 0;
        $errorNum  = 0;
        $errorModelNo = array();
        if ($fileData['success'] == true) {
            $this->load->library('phpexcel/Classes/PHPExcel');
            // include APPPATH . 'libraries/phpexcel/Classes/PHPExcel.php';
            //設定要被讀取的檔案
            $file = $filePath . $fileData['data']['file_name'];
            try {
                $objPHPExcel = PHPExcel_IOFactory::load($file);

                // $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                //列印每一行的資料
                // foreach($sheetData as $key => $col)
                // {
                //     echo "行{$key}: ";
                //     foreach ($col as $colkey => $colvalue) {
                //         echo "{$colvalue}, ";
                //     }
                //     echo "<br/>";
                // }

                $sheet      = $objPHPExcel->getSheet(0); // 讀取第一個工作表(編號從 0 開始)
                $highestRow = $sheet->getHighestRow(); // 取得總列數            
                // 一次讀取一列
                $maxColumn = 28;
                for ($row = 2; $row <= $highestRow; $row++) {
                    $insertData = array();
                    for ($column = 0; $column < $maxColumn; $column++) {
                        //26 個欄位
                        $val                                            = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                        $insertData[$this->excelColumnMapping[$column]] = $val;
                        if ($this->excelColumnMapping[$column] == 'pm_status' && empty($val)) {
                            $insertData[$this->excelColumnMapping[$column]] = 3;
                        }
                        if (!in_array($this->excelColumnMapping[$column], $this->notRequireColumn) && (empty($val) || $val == '')){                            
                            array_push($errorModelNo, $sheet->getCellByColumnAndRow(4, $row)->getValue());
                            break;
                        }
                    }

                    
                    if (isset($insertData['pm_model_no']) && !in_array($insertData['pm_model_no'], $errorModelNo)){
                        // 檢查商品型號若存在就更新
                        $productWhere = array('pm_model_no' => $insertData['pm_model_no']);
                        $product      = $this->product_main_model->getByParam(false, $productWhere);
                        if ($product) {
                            $this->product_main_model->update($insertData, $productWhere);
                            $updateNum++;
                        } else {
                            $pm_id = $this->product_main_model->insert($insertData);
                            if ($pm_id) {
                                $insertNum++;
                            } else {
                                if (!in_array($insertData['pm_model_no'], $this->notRequireColumn) && (empty($val) || $val == '')){
                                    array_push($errorModelNo, $insertData['pm_model_no']);
                                    break;
                                }
                                $errorNum++;
                            }
                        }
                    } else {
                        $errorNum++;
                    }                    
                }
            } catch (Exception $e) {
                $this->response['Message'] = '錯誤的Excel檔案格式';
                // die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            unlink($filePath . $fileData['data']['file_name']);

            $message = '匯入商品成功<br>';
            $message .= '總筆數：' . ($highestRow - 1) . '<br>';
            $message .= '新增筆數：' . $insertNum . '<br>';
            $message .= '更新筆數：' . $updateNum . '<br>';
            $message .= '失敗筆數：' . $errorNum . '<br>';
            $message .= join(',', $errorModelNo);

            $this->response['Status']  = true;
            $this->response['Message'] = $message;

        } else {
            $this->response['Message'] = $fileData['errorMsg'];
        }

        $this->response['insertNum'] = $insertNum;
        $this->response['updateNum'] = $updateNum;
        $this->response['errorNum']  = $errorNum;

        $this->ajax_output();
    }

    public function detail($id)
    {
        $this->data["title"] = '修改商品';
        if ($id) {
            $where = array(
                'pm_id' => $id,
            );
            $this->data['product'] = $this->product_main_model->getByParam(false, $where);

            if (empty($this->data['product'])) {
                // no member, show error
                $message = array(
                    'form_title'      => '錯誤',
                    'portlet_caption' => '錯誤',
                    'form_message'    => '查無商品資料',
                    'url'             => '/admin/product',
                    'link_name'       => '返回商品管理',
                );

                $this->session->set_flashdata('flash_message', $message);
                redirect('admin/message');
            }
            $js = array(
                'assets/global/plugins/jquery-validation/js/jquery.validate.min',
                // 'assets/global/plugins/ckeditor/ckeditor',
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
                'assets/apps/scripts/admin/product',
            );
            $this->setJS($js);

            $css = array(
                'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            );
            $this->setCSS($css);

            $this->render('admin/product_detail_view', $this->data);
        } else {
            redirect('admin/product');
        }
    }

    public function update_product()
    {
        $fields = array(
            'pm_category',
            'pm_name_tw',
            'pm_name_en',
            'pm_description_short',
            'pm_model_no',
            'pm_bar_code',
            'pm_material_description',
            'pm_package',
            'pm_description_full',
            'pm_color_01',
            'pm_color_02',
            'pm_color_03',
            'pm_price',
            'pm_use_scenario_01',
            'pm_use_scenario_02',
            'pm_use_scenario_03',
            'pm_material_01',
            'pm_material_02',
            'pm_style',
            'pm_size',
            'pm_inventory',
            'pm_status',
        );

        $this->data['post'] = $this->input->post($fields, true);
        $result             = $this->form_check();
        $where              = array('pm_id' => $this->input->post('pm_id'));
        $item               = $this->product_main_model->getByParam(false, $where);
        if ($result === true && !empty($item)) {
            // file upload
            $config['upload_path']   = $this->uploadPath . 'product/';
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $this->uploadfile->_init($config);
            $fileData = $this->uploadfile->multiUpload();

            if (!empty($fileData['data']) && count($fileData['data']) > 0) {
                foreach ($fileData['data'] as $field => $file) {
                    $this->data['post'][$field] = $file['file_name'];
                }
            }

            if ($this->product_main_model->update($this->data['post'], $where)) {
                $this->response['Status']       = true;
                $this->response['MessageTitle'] = '成功';
                $this->response['Message']      = '修改成功<br>' . $fileData['errorMsg'];
            } else {
                $this->response['MessageTitle'] = '失敗';
                $this->response['Message']      = '修改失敗，資料庫錯誤';
            }
        } else {
            $this->response['MessageTitle'] = '修改失敗';
            $this->response['Message']      = $result;
        }

        $this->ajax_output();
    }

    public function imageupload()
    {
        $config['upload_path']   = $this->uploadPath . 'product/';
        $config['allowed_types'] = 'zip';
        $this->uploadfile->_init($config);
        $fileData = $this->uploadfile->upload('image_file');

        if (!empty($fileData['data']) && $fileData['data']) {
            $zip = new ZipArchive;
            if ($zip->open($this->uploadPath . 'product/' . $fileData['data']['file_name']) === true) {
                $zip->extractTo($this->uploadPath . 'product/');

                // if ($zip->open($this->uploadPath . 'product/' . $fileData['data']['file_name']) === true) {
                //     for($i = 0; $i < $zip->numFiles; $i++) {
                //         $filename = $zip->getNameIndex($i);
                //         $fileinfo = pathinfo($filename);
                //         copy("zip://".$this->uploadPath . 'product/' . $fileData['data']['file_name']."#".$filename, $this->uploadPath . 'product/' . $fileinfo['basename']);
                //     }                   
                //     $zip->close();                   
                // }

                $zip->close();
                unlink($this->uploadPath . 'product/' . $fileData['data']['file_name']);
                $this->response['Status']  = true;
                $this->response['Message'] = '上傳成功';
            } else {
                $this->response['Message'] = $fileData['errorMsg'];
            }    
        } else {
            $this->response['MessageTitle'] = '失敗';
            if ($fileData['success'] == false) {
                $this->response['Message'] = '請選擇檔案上傳';
            } else {
                $this->response['Message'] = $result;
            }
        }

        // $this->response['insertNum'] = $insertNum;
        // $this->response['updateNum'] = $updateNum;
        // $this->response['errorNum']  = $errorNum;

        $this->ajax_output();
    }

    public function ajax_search()
    {
        $get = $this->input->get();

        $this->response['data'] = $this->product_main_model->search($get);

        $this->ajax_output();
    }

    private function removeFolder($basePath, $folder)
    {
        if (is_dir($basePath . '/' . $folder)) {
            $folderDatas = scandir($basePath . '/' . $folder);
            if (count($folderDatas) > 2) {
                foreach ($folderDatas as $fd) {
                    if ($fd != '.' && $fd != '..') {
                        if (is_dir($basePath . '/' . $folder . '/' . $fd)) {
                            $this->removeFolder($basePath . '/' . $folder, $fd);
                        } else if (is_file($basePath . '/' . $fd)) {
                            unlink($basePath . '/' . $fd);
                        }
                    }
                }
            }
            rmdir($basePath . '/' . $folder);
        }
    }

    /**
     * 表單檢查
     * @return [type] [description]
     */
    private function form_check()
    {
        $this->load->library('form_validation');

        // 2017-06-19修改檢查欄位，只要下面設為必填
        // pm_category => 品項
        // pm_name_tw => 中文品名
        // pm_name_en => 英文品名
        // pm_description_short => 產品簡述
        // pm_model_no => 產品型號
        // pm_material_description => 材質
        
        $this->form_validation->set_rules('pm_category', '品項', 'required|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('pm_name_tw', '中文品名', 'required|min_length[2]|max_length[255]');
        $this->form_validation->set_rules('pm_name_en', '英文品名', 'required|min_length[2]|max_length[255]');
        // $this->form_validation->set_rules('pm_description_short', '商品簡述', 'required');
        $this->form_validation->set_rules(
            'pm_model_no', '商品型號',
            array(
                'trim',
                'required',                
                array(
                    'model_no_exist',
                    function ($value) {
                        $where = array('pm_model_no' => $value);
                        if ($pm_id = $this->input->post('pm_id')){
                            $where['pm_id !='] = $pm_id;
                        }
                        $isExist = $this->product_main_model->existModelNo($where);
                        return ($isExist === true) ? false : true;
                    },
                )                    
            )
        );
        // $this->form_validation->set_rules('pm_bar_code', '條碼', 'required');
        $this->form_validation->set_rules('pm_material_description', '材質', 'required');
        // $this->form_validation->set_rules('pm_package', '包裝', 'required');
        // $this->form_validation->set_rules('pm_description_full', '產品說明', 'required');
        // $this->form_validation->set_rules('pm_color_01', '顏色1', 'required');
        // $this->form_validation->set_rules('pm_price', '價格', 'required|numeric');
        // $this->form_validation->set_rules('pm_use_scenario_01', '使用情境1', 'required');
        // $this->form_validation->set_rules('pm_material_01', '材質1', 'required');
        // $this->form_validation->set_rules('pm_style', '特色風格', 'required');
        // $this->form_validation->set_rules('pm_size', '大小', 'required');
        // $this->form_validation->set_rules('pm_inventory', '可賣數量', 'required|numeric');
        // $this->form_validation->set_rules('pm_status', '狀態', 'required|numeric');

        // set errorw message
        $this->form_validation->set_message('required', '請輸入 {field}');
        $this->form_validation->set_message('min_length', '{field} 最少需要輸入 {param} 字元');
        $this->form_validation->set_message('max_length', '{field} 最多只能輸入 {param} 字元');
        $this->form_validation->set_message('numeric', '{field}只能輸入數字');
        $this->form_validation->set_message('model_no_exist', '此商品型號已存在');

        // validate
        if ($this->form_validation->run() == false) {
            $errors = strip_tags(validation_errors());
            $errors = str_replace("\n", '<br>', $errors);
            return $errors;
        } else {
            return true;
        }
    }

}
