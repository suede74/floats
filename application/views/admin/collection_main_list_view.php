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
                    	
                        <label class="col-md-2 control-label">集合名稱</label>
                        <div class="col-md-2">
                            <input type="text" name="cm_title" class="form-control" placeholder="集合名稱">
                        </div>

                        <!-- <label class="col-md-2 control-label">商品型號</label>
                        <div class="col-md-2">
                            <input type="text" name="pm_model_no" class="form-control" placeholder="商品型號">
                        </div> -->
                                                                                   
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
                <i class="fa fa-institution"></i>主集合列表</div>
            <!-- <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div> -->
            <div class="actions">
                <a class="dt-button buttons-print btn dark btn-outline" tabindex="0" href="<?=base_url($folder.'/'.$ctl.'/add')?>">
                    <span>新增主集合</span>
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
                                <th>名稱</th>
                                <th>狀態</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($lists)): ?>
                                <?php foreach ($lists as $list): ?>
                                <tr>
                                    <td class="highlight"><?=$list['cm_id']?></td>
                                    <td><?=$list['cm_title']?></td>
                                    <td><?=(isset($status[$list['cm_status']]))? $status[$list['cm_status']] : ''?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url($folder.'/'.$ctl.'/detail/'.$list['cm_id'])?>" class="btn btn-outline btn-circle btn-sm blue">
                                            <i class="fa fa-edit">查看/編輯</i></a>                                        
                                        <a href="<?=base_url('admin/collection/index/' . $list['cm_id'])?>" class="btn btn-outline btn-circle btn-sm green">
                                            <i class="fa fa-edit">子集合管理</i></a>                                        
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