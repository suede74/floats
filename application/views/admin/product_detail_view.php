<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i> <span
							class="caption-subject font-blue-madison bold uppercase">商品資料</span>
					</div>
				</div>
				<div class="portlet-body form">

					<form id="data-form" class="form-horizontal"
						enctype="multipart/form-data" role="form" method="post">
						<input type="hidden" name="pm_id" value="<?=(isset($product['pm_id']))? $product['pm_id'] : 0?>" />
						<div class="form-body">							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">品項：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="品項，ex:Toe Ring" class="form-control" name="pm_category" value="<?=(isset($product["pm_category"])? $product["pm_category"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">中文品名：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="中文品名" class="form-control" name="pm_name_tw" value="<?=(isset($product["pm_name_tw"])? $product["pm_name_tw"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">英文品名：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="英文品名" class="form-control" name="pm_name_en" value="<?=(isset($product["pm_name_en"])? $product["pm_name_en"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">商品簡述：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="商品簡述" class="form-control" name="pm_description_short" value="<?=(isset($product["pm_description_short"])? $product["pm_description_short"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">商品型號：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="商品型號" class="form-control" name="pm_model_no" value="<?=(isset($product["pm_model_no"])? $product["pm_model_no"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">條碼：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="條碼" class="form-control" name="pm_bar_code" value="<?=(isset($product["pm_bar_code"])? $product["pm_bar_code"] : "") ?>" />											
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">材質：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<textarea class="form-control" name="pm_material_description" rows="5"><?=(isset($product['pm_material_description']))? $product['pm_material_description'] : ''?></textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">包裝：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="包裝" class="form-control" name="pm_package" value="<?=(isset($product["pm_package"])? $product["pm_package"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">商品說明：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<textarea class="form-control" name="pm_description_full" rows="5"><?=(isset($product['pm_description_full']))? $product['pm_description_full'] : ''?></textarea>
										</div>
									</div>
								</div>
							</div>
							
							<?php for ($i = 1; $i < 7; $i++): ?>
								<div class="form-group ">
	                                <label class="control-label col-md-2">產品照<?=$i?>：</label>
	                                <div class="col-md-10">                                  
	                                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
	                                        	<?php if (isset($product['pm_image_0'.$i])): ?>
	                                        		<img src="/public/upload/product/<?=$product['pm_image_0'.$i]?>" alt="" />
	                                        	<?php endif; ?>
	                                        </div>
	                                        <div>
	                                            <span class="btn btn-default btn-file"><span class="fileinput-new">選擇圖片</span><span class="fileinput-exists">更換圖片</span>
	                                            <input type="file" name="pm_image_0<?=$i?>"></span>
	                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除圖片</a>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                        	<?php endfor; ?>
                            
                            <div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">顏色1：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="顏色1" class="form-control" name="pm_color_01" value="<?=(isset($product["pm_color_01"])? $product["pm_color_01"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">顏色2：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="顏色2" class="form-control" name="pm_color_02" value="<?=(isset($product["pm_color_02"])? $product["pm_color_02"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">顏色3：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="顏色3" class="form-control" name="pm_color_03" value="<?=(isset($product["pm_color_03"])? $product["pm_color_03"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">售價：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="number" placeholder="售價" class="form-control" name="pm_price" value="<?=(isset($product["pm_price"])? $product["pm_price"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>		

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">使用情境1：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="使用情境1" class="form-control" name="pm_use_scenario_01" value="<?=(isset($product["pm_use_scenario_01"])? $product["pm_use_scenario_01"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">使用情境2：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="使用情境2" class="form-control" name="pm_use_scenario_02" value="<?=(isset($product["pm_use_scenario_02"])? $product["pm_use_scenario_02"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">使用情境3：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="使用情境3" class="form-control" name="pm_use_scenario_03" value="<?=(isset($product["pm_use_scenario_03"])? $product["pm_use_scenario_03"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">材質1：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="材質1" class="form-control" name="pm_material_01" value="<?=(isset($product["pm_material_01"])? $product["pm_material_01"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">材質2：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="材質2" class="form-control" name="pm_material_02" value="<?=(isset($product["pm_material_02"])? $product["pm_material_02"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">特色風格：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="特色風格" class="form-control" name="pm_style" value="<?=(isset($product["pm_style"])? $product["pm_style"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">大小：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="text" placeholder="大小" class="form-control" name="pm_size" value="<?=(isset($product["pm_size"])? $product["pm_size"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">可賣數量：</div>
									<div class="col-md-10">
										<div class="input-icon right">
											<input type="number" placeholder="可賣數量" class="form-control" name="pm_inventory" value="<?=(isset($product["pm_inventory"])? $product["pm_inventory"] : "") ?>" />
										</div>
									</div>
								</div>
							</div>
																										
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">狀態：</div>
									<div class="col-md-10">
										<select class="form-control" name="pm_status">
											<option value="">請選擇</option>
											<?php if (!empty($website['status'])): ?>
												<?php foreach ($website['status'] as $status=>$status_title): ?>
													<option value="<?=$status?>" <?=(isset($product['pm_status']) && $product['pm_status'] == $status)? 'selected' : ''?>><?=$status_title?></option>
												<?php endforeach; ?>
											<?php endif;?>											
										</select>
									</div>
								</div>
							</div>
							
							<!-- 
							<div class="form-group">
								<div class="col-md-12">
									<div class="control-label col-md-2">內容：</div>
									<div class="col-md-10">
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-icon right">
													<textarea name="n_body"
														class="form-control todo-taskbody-taskdesc" rows="8"
														placeholder="內容"><?=(isset($news["n_body"])? $news["n_body"] : "") ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 -->							
							
						</div>
						<div class="form-actions right">
							<a href="<?=base_url($folder.'/'.$ctl)?>" class="btn btn-default"> 返回商品列表 </a>
							<button class="btn green" id="data-form-btn" type="submit">儲存修改</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>