<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i>
						<span class="caption-subject font-blue-madison bold uppercase">匯入商品資料</span>
					</div>
				</div>
				<div class="portlet-body form">

					<form id="data-form" class="form-horizontal"
						enctype="multipart/form-data" role="form" method="post">						
						<div class="form-body">							
							<div class="form-group">
                                <label class="control-label col-md-3">商品Excel</label>
                                <div class="col-md-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="input-group input-large">
                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new"> Select file </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="product_file"> </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>							
							
							<!-- <div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">庫存量：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="number" placeholder="庫存量" class="form-control" name="im_inventory" value="<?=(isset($item["im_inventory"])? $item["im_inventory"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">狀態：</div>
									<div class="col-md-10">
										<select class="form-control" name="im_status">
											<option value="">請選擇</option>
											<?php if (!empty($website['status'])): ?>
												<?php foreach ($website['status'] as $status=>$status_title): ?>
													<option value="<?=$status?>" <?=(isset($item['im_status']) && $item['im_status'] == $status)? 'selected' : ''?>><?=$status_title?></option>
												<?php endforeach; ?>
											<?php endif;?>											
										</select>
									</div>
								</div>
							</div> -->
														
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回商品列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">匯入商品</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>