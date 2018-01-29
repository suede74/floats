<div class="col-md-12 portlet">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>資料查詢</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <!-- <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a> -->
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>                
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal">
                <div class="form-body">
                    <div class="form-group">
                    	
                        <label class="col-md-2 control-label">品項</label>
                        <div class="col-md-2">
                            <input type="text" name="pm_category" class="form-control" placeholder="品項">
                        </div>

                        <label class="col-md-2 control-label">中文品名</label>
                        <div class="col-md-2">
                            <input type="text" name="pm_name_tw" class="form-control" placeholder="中文品名">
                        </div>

                        <label class="col-md-2 control-label">商品型號</label>
                        <div class="col-md-2">
                            <input type="text" name="pm_model_no" class="form-control" placeholder="商品型號">
                        </div>
                                                                                   
                    </div>                                
                </div>
                <div class="form-actions right">
                    <button type="submit" class="btn green">查詢</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="col-md-12 portlet light">        
    <div class="portlet light portlet-fit ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-institution"></i>商品列表</div>
            <!-- <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div> -->
            <div class="actions">
                <a class="dt-button buttons-print btn dark btn-outline" tabindex="0" href="<?=base_url($folder.'/'.$ctl.'/uploadimage')?>">
                    <span>上傳zip商品圖</span>
                </a>
            	<a class="dt-button buttons-print btn dark btn-outline" tabindex="0" href="<?=base_url($folder.'/'.$ctl.'/import')?>">
                    <span>匯入商品</span>
                </a>
                <a class="dt-button buttons-print btn dark btn-outline" tabindex="0" href="<?=base_url($folder.'/'.$ctl.'/add')?>">
                    <span>新增商品</span>
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="dataTables_wrapper no-footer">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>中文品名</th>
                                <th>商品型號</th>
                                <th>價格</th>
                                <th>數量</th>
                                <th>狀態</th>                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($lists)): ?>
                                <?php foreach ($lists as $list): ?>
                                <tr>
                                    <td class="highlight"><?=$list['pm_id']?></td>
                                    <td><?=$list['pm_name_tw']?></td>
                                    <td><?=$list['pm_model_no']?></td>
                                    <td class="hidden-xs"><?=$list['pm_price']?></td>
                                    <td><?=$list['pm_inventory']?></td>
                                    <td><?=(isset($status[$list['pm_status']]))? $status[$list['pm_status']] : ''?></td>                                                                      
                                    <td class="text-center">
                                        <a href="<?=base_url($folder.'/'.$ctl.'/detail/'.$list['pm_id'])?>" class="btn btn-outline btn-circle btn-sm blue">
                                            <i class="fa fa-edit">查看/編輯</i></a>                                        
                                        <!-- <a href="#" class="trash_data btn btn-outline btn-circle btn-sm red" data-id="<?=$list['n_id']?>">
                                            <i class="fa fa-trash">刪除</i></a> -->                                        
                                    </td>
                                </tr>
                                <?php endforeach; ?>                           
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-5 col-sm-5">
                        <div class="dataTables_info" id="sample_editable_1_info" role="status" aria-live="polite"></div>
                    </div>
                    <div class="col-md-7 col-sm-7">
                        <div class="dataTables_paginate paging_bootstrap_number" id="sample_editable_1_paginate">
                            <ul class="pagination" style="visibility: visible;">
                                <?=(!empty($pages))? $pages : ''?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>