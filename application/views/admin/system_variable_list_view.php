<div class="col-md-12 portlet">
	<!-- 
    <div class="portlet box green">
    	
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>資料查詢</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>                
            </div>
        </div>
        
        <div class="portlet-body form">
            <form class="form-horizontal">
                <div class="form-body">
                    <div class="form-group">
                    	<label class="col-md-1 control-label">語系</label>
                        <div class="col-md-2">
                            <select name="lang" class="form-control">
                                <option value="">請選擇</option>
                                <?php if (!empty($website['lang'])): ?>
									<?php foreach ($website['lang'] as $lang=>$lang_title): ?>
										<option value="<?=$lang?>"><?=$lang_title?></option>
									<?php endforeach; ?>
								<?php endif;?>
                            </select>
                        </div>                    	                                                                                   
                    </div>                                
                </div>
                <div class="form-actions right">
                    <button type="submit" class="btn green">查詢</button>
                </div>
            </form>
        </div>
         

    </div>
    -->
</div>

<div class="col-md-12 portlet light">        
    <div class="portlet light portlet-fit ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-institution"></i>系統變數列表</div>
            <!-- <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div> -->
            <!-- <div class="actions">
                <a class="dt-button buttons-print btn dark btn-outline" tabindex="0" href="<?=base_url($folder.'/'.$ctl.'/add')?>">
                    <span>新增最新消息</span>
                </a>
            </div> -->
        </div>
        <div class="portlet-body">
            <div class="dataTables_wrapper no-footer">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th>說明</th>
                                <th>值</th>                                                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($lists)): ?>
                                <?php foreach ($lists as $list): ?>
                                <tr>
                                    <td class="highlight"><?=$list['sv_title']?></td>
                                    <td><?=$list['sv_value']?></td>                                                                     
                                    <td class="text-center">
                                        <a href="<?=base_url($folder.'/'.$ctl.'/detail/'.$list['sv_id'])?>" class="btn btn-outline btn-circle btn-sm blue">
                                            <i class="fa fa-edit">查看/編輯</i></a>                                        
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