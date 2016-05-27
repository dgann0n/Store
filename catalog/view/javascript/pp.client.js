/*!
* PitchPrint - v8.2.0 - Auto-compiled on 2016-05-23 - Copyright 2016 
* @author SynergicLabs
*/
var PPCLIENT=PPCLIENT||{};

!function(a){
	"use strict";
	
	if(!jQuery)throw new Error("jQuery required for PitchPrint!");
	var b=jQuery,c=a.PPCLIENT;
	c.vars||(c.vars={});
	var d,e=".single_add_to_cart_button,.quantity,.kad_add_to_cart,.addtocart,#add-to-cart,.add_to_cart,#add,#AddToCart,#product-add-to-cart,#add_to_cart";
	
	c.start=function(){
		switch(d||(d=c.vars),d.client){
			case"oc":
				c.ocSwapDetails(),
				b("#web2print_option_value").val(d.cValues);
			break;
			case"ps":
				"order"===d.pageName.substr(0,5)&&c.wrapStrings(),
				b("#customizationForm").parent().hide(),
				b("#header .shopping_cart a:first").hover(
					function(){
						(ajaxCart.nb_total_products>0||parseInt(b(".ajax_cart_quantity").html())>0)
						&&b("li[name=customization]").each(function(){
							var a=b(this);
							a.text().indexOf("%22")&&a.html(a.children()[0]).append(d.lang.design)})
					}
				)
		}				
	},
							
							
	c.loadLang=function(a){
		d||(d=c.vars),
		d.langCode&&"br"===d.langCode.toLowerCase()&&(d.langCode="pt-br"),
		b.ajax({
			type:"GET",
			dataType:"json",
			url:d.rscCdn+"lang/"+(d.langCode||"en").toLowerCase(),
			cache:!0,
			success:function(b){
				d.lang="function"==typeof d.functions.onLanguageLoaded?d.functions.onLanguageLoaded(b):b,
				c.syncLang(),
				a||c.initEditor()
			}
		})
	},
				
	c.syncLang=function(){
		b("[pp-data]").each(function(){
			"INPUT"==this.tagName.toUpperCase()?b(this).prop("value",
			d.lang[b(this).attr("pp-data")]):b(this).text(d.lang[b(this).attr("pp-data")])
		})
	},
	
	c.init=function(){
		if(!c.vars.initialized&&c.vars.appApiUrl){
			if(d=c.vars,"-1"!==d.designId&&"0"!==d.designId||(d.designId=""),
			d.isCategory=d.designId.length?"*"===d.designId[0]&&"edit"!==d.mode:!1,
			d.isCategory&&(d.autoShow=!1),
			d.designStack={},
			d.isInline=d.inline.length>0&&b(d.inline).length,
			d.thumbsSrc="oc"===d.client?"image/data/files/":"images/files/",
			
			c.createUiButtons(),
			
			d.projectId&&!isNaN(parseInt(d.previews))){
				for(var a=[],e=parseInt(d.previews),f=0;e>f;f++)
					a.push(d.projectId+"_"+(f+1)+".jpg");
				c.swapPreviews(a,d.rscBase+"images/previews/",!1),
				c.isValidPP(d.cValues)&&"edit"===d.mode&&(d.designId=JSON.parse(decodeURIComponent(d.cValues)).designId)
			}else"upload"===d.mode&&c.isValidPP(d.cValues)&&c.swapPreviews(JSON.parse(decodeURIComponent(d.cValues)).previews,"",!1);
				c.setBtnPref(),
				c.loadLang(),
				d.initialized=!0
		}
	},
	
	c.initEditor=function(){
		d.apiKey&&d.designId&&(
		c.designer=new W2P.designer({
			apiKey:d.apiKey,
			appApiUrl:d.appApiUrl,
			parentDiv:d.isInline?"#pp_inline_div":void 0,mode:d.mode,
			lang:d.lang,userId:d.userId,
			product:d.product,autoSave:d.autoSave,
			designDetails:d.designDetails,
			isDesign:!1,
			designId:d.isCategory?void 0:d.designId,
			designCat:d.isCategory?d.designId:void 0,
			projectId:d.projectId,
			rscBase:d.rscBase,
			autoInitialize:!d.isCategory,
			isUserproject:!1,
			isAdmin:!1,
			langCode:d.langCode,
			client:d.client,
			userData:d.userData,
			
			onReady:c.onReady,
			autoShow:false,
			onShown:c.onShown,
			onSave:c.onSave,
			onClose:c.onClose,
			onLibReady:c.onLibReady,
			onResourceLoaded:d.functions.onResourceLoaded,
			onSaveButtonClicked:d.functions.onSaveButtonClicked,
			onValidation:d.functions.onValidation||c.fetchDesigns,
			onValidationError:c.onValidationError,onCaUpdate:c.onCaUpdate}))},
			c.onValidationError=function(a){
				console.log(a),b("#pp_main_btn_sec").hide()
			},
			
		c.onClose=function(){
			return d.editorVisible=!1,
			"function"==typeof d.functions.onClose?d.functions.onClose():
			void("new"===d.mode?b("#pp_customize_design_btn").show():b("#pp_edit_design_btn").show())
		},
		
		c.onCaUpdate=function(a){
			if(a.values.length)
				if("function"==typeof d.functions.canvasAdjustment)d.functions.canvasAdjustment(a);
			else if(b('label:contains("ppCanvasAdjustment")').length||b("#ppcanvasadjustment").length){
				var c,e,f,g,h=b("#ppcanvasadjustment").length?"ppcanvasadjustment":b('label:contains("ppCanvasAdjustment")').attr("for"),i=b("#"+h);
				b("#"+h+" > option").each(
					function(){
						console.log(),
						c=this.text.split("(")[0].split(" ").join(""),a.isCustom&&c.indexOf("-")>0&&2===c.split("-").length?(g=parseFloat(a.values[0]),
						f=parseFloat(c.split("-")[0]),e=parseFloat(c.split("-")[1]),g>=f&&e>=g&&i.val(this.value).change()):c.indexOf("x")>0&&2===c.split("x").length&&a.values[0].toLowerCase()==c.toLowerCase()&&i.val(this.value).change()
					}
				)
			}
		},
						
		c.onSave=function(a){
			if("function"==typeof d.functions.onSave)
				return d.functions.onSave(a);
			d.mode="edit",d.projectSource=a.source,
			d.projectId=a.projectId,
			d.numPages=a.numPages,
			d.previews=a.previews,
			d.isCategory=!1,
			a.meta.records&&b("[name='quantity'],[name='qty']").val(a.meta.records).change().focus(),
			a.meta.ppCanvasAdjustment&&c.onCaUpdate(a.meta.ppCanvasAdjustment);
			var e=encodeURIComponent(
				JSON.stringify({
					projectId:a.projectId,
					numPages:a.numPages,
					meta:a.meta,
					userId:d.userId,
					product:d.product,
					type:"p",
					designTitle:a.source.title,
					designId:a.source.designId
				})
			);
			"sp"===d.client&&b("#_pitchprint").length?b("#_pitchprint").val(a.projectId):b("#_w2p_set_option,#web2print_option_value").length&&b("#_w2p_set_option,#web2print_option_value").val(e),
				
			c.saveSess({values:e}),
			setTimeout(
				function(){
					c.swapPreviews(a.previews,"",!1),
					d.isInline&&d.maintainImages&&c.collapseEditor()
				},
			2e3),
				
			c.setBtnPref(!0),
			d.dontCloseApp?c.designer.resume():c.designer.close(d.isInline),
			"function"==typeof d.functions.onAfterSave&&d.functions.onAfterSave(a)
		},
				
		c.collapseEditor=function(){
			b("#pp_inline_div").length&&TweenLite.to(
				b("#pp_inline_div"),.6,{
					height:0,ease:Power2.easeOut
				}
			)
		},
			
		c.saveSess=function(a){
			"ps"===d.client&&(a.ajax=!0),
			"sp"===d.client&&(a.productId=d.product.id,
			a.connectsid=d.connectsid),
			b.ajax({
				type:"POST",crossDomain:"sp"===d.client,
				url:c.getSavePath(d.product.id),
				data:a,success:function(b){
					(a.clear||"ps"===d.client)&&location.reload()
				},
				xhrFields:{
					withCredentials:"sp"===d.client}
				}
			)
		},
		
		c.onShown=function(){
			return d.editorShown=d.editorVisible=!0,
			"function"==typeof d.functions.onShown?d.functions.onShown():void b("#pp_customize_design_btn, #pp_edit_design_btn").hide()
		},
			
		c.onReady=function(){
			"edit"!==d.mode&&b("#pp_customize_design_btn").removeAttr("disabled").html(d.lang.custom_design)
		},
			
		c.editDesign=function(){
			d.editorShown?c.designer.resume():c.showDesigner(),
			c.expandEditor(),
			b("#pp_customize_design_btn, #pp_edit_design_btn").hide()
		},
		
		c.expandEditor=function(){
			b("#pp_inline_div").length&&(
			TweenLite.to(
				b("#pp_inline_div"),.4,{
					height:b(window).height()-150,ease:Power2.easeOut
			}),
			c.scrollInline())
		},
		
		c.scrollInline=function(){
				d.isInline&&b("html, body").animate({
					scrollTop:b("#pp_inline_div").offset().top-(d.ppScrollTop||10)
				},300)
		},
				
		c.createUiButtons=function(){
			"ps"===d.client&&b("#add_to_cart").parent().prepend('<div style="margin: 0px 20px;" id="pp_main_btn_sec"></div>'),
			"sp"===d.client&&b("#pp_main_btn_sec").html("");
			var a="sp"===d.client?"a":"button";if("oc"===d.client){
				var c=b('<div id="pp_main_btn_sec" class="form-group required"> <input type="hidden" id="web2print_option_value" name="option['+d.ppOptionId+']" value="" />');
				1===d.ocVersion?b("#button-cart").length?b("#button-cart").parent().prepend(c):b(".options").length&&b(".options").prepend(c):b("#pp_main_btn_sec").length||!b("#product").length&&!b("#button-cart").length||(b("#button-cart").length?b("#button-cart").parent().prepend(c):b(b("#product").children("h3")[0]).length?c.insertAfter(b(b("#product").children("h3")[0])):b("#product").prepend(c))}b("#pp_main_btn_sec").append('<select onchange="PPCLIENT.setSelectDesign()" id="pp_design_select" class="ppc-main-ui form-control"><option pp-data="pick_design" value="0"></option></select> '),b("#pp_main_btn_sec").append("<"+a+' id="pp_customize_design_btn" onclick="PPCLIENT.showDesigner()" class="ppc-main-ui btn btn-warning btn-block button" style="cursor:pointer" type="button" ></'+a+">"),b("#pp_main_btn_sec").append('<input id="pp_edit_design_btn" onclick="PPCLIENT.editDesign()" class="ppc-main-ui btn btn-success btn-block button" pp-data="edit_design" type="button" /> '),b("#pp_main_btn_sec").append('<input id="pp_clear_design_btn" onclick="PPCLIENT.clearDesign()" class="ppc-main-ui btn btn-default btn-block button" pp-data="start_over" type="button" /> '),b("#pp_main_btn_sec").append('<input id="pp_upload_btn" onclick="PPCLIENT.showUpload()" class="ppc-main-ui btn btn-default btn-block button" pp-data="upload_files" type="button" /> '),setTimeout(function(){b('label:contains("ppCanvasAdjustment")').length&&b('label:contains("ppCanvasAdjustment")').parent().hide(),b("#ppcanvasadjustment").length&&b("#ppcanvasadjustment").parent().parent().hide()},1e3)
		},
				
		c.setSelectDesign=function(){if("0"!=b("#pp_design_select").val()){d.defaultImages||d.maintainImages||(d.defaultImages=b(".images").children().detach()),c.swapPreviews(b("#pp_design_select").val(),d.rscBase+"images/designs/",!0),b("#pp_customize_design_btn").show().attr("disabled","disabled");var a=d.designStack[b("#pp_design_select").val()];c.designer.getModel().c.designId=a.id,c.designer.getModel().c.mode="new",d.editorShown?(b.ajax({type:"POST",dataType:"json",crossDomain:!0,data:{connectsid:d.connectsid,designId:a.id},url:d.appApiUrl+"fetch-design",success:function(a){a.error?alert(d.lang.error_loading_design):c.designer.loadDesign(a.design),b.unblockUI()},xhrFields:{withCredentials:!0}}),c.showBusy()):c.designer.loadLib()!==!0&&(d.loadingCatLib=!0,c.showBusy())}else d.defaultImages&&!d.maintainImages&&b(".images").empty().append(d.defaultImages),d.defaultImages=void 0,b("#pp_customize_design_btn").hide()},c.onLibReady=function(){d.loadingCatLib&&(b.unblockUI(),d.loadingCatLib=!1,c.onReady())},c.clearDesign=function(){b("#pp_clear_design_btn").attr("disabled","disabled"),b("#pp_customize_design_btn").attr("disabled","disabled"),c.saveSess({clear:!0})},c.showDesigner=function(){d.isInline?(d.autoShow||c.expandEditor(),setTimeout(function(){c.designer.show()},1e3),b("#pp_customize_design_btn").hide()):c.designer.show()},c.setBtnPref=function(a){if("function"==typeof d.functions.customSetBtnPref)return d.functions.customSetBtnPref();if(d.hideCartButton&&"new"==d.mode?b(e).hide():b(e).show(),b(".ppc-main-ui").hide(),d.isInline){switch(d.client){case"wp":d.maintainImages||b(".single-product-main-image, .woocommerce-tabs").remove();break;case"oc":}a||(b("#pp_inline_div").length||b(d.inline).prepend('<div class="pp-inline-div" style="overflow:hidden" id="pp_inline_div"><img class="pp-inline-div-loader" src="'+d.rscCdn+'images/loaders/spinner.svg" ></div>'),d.autoShow?TweenLite.to(b("#pp_inline_div"),.6,{height:b(window).height()-150,ease:Power2.easeOut,onComplete:function(){c.scrollInline()}}):b("#pp_inline_div").height(0))}switch(d.mode){case"new":d.isCategory?b("#pp_design_select").show().attr("disabled","disabled"):d.isInline&&d.autoShow||!d.designId?b("#pp_customize_design_btn").hide():b("#pp_customize_design_btn").show().attr("disabled","disabled").html('<img src="'+d.rscCdn+'images/loaders/spinner.svg" style="width:24px; height:24px" height="24" >'),d.enableUpload?b("#pp_upload_btn").show():b("#pp_upload_btn").hide();break;case"edit":d.projectId&&(b("#pp_edit_design_btn").show(),b("#pp_clear_design_btn").show());break;case"upload":b("#pp_customize_design_btn").hide(),b("#pp_upload_btn").show().removeClass("btn-default").addClass("btn-success").attr("pp-data","files_ok"),b("#pp_clear_design_btn").show()}b(".pp-duplicate-design-btn").each(function(){var a=b(this);a.click(function(b){b.preventDefault(),a.removeClass("button").html('<img src="'+d.rscCdn+'images/loading.gif" style="width:20px; height:20px; box-shadow:none" >'),c.duplicateProject(a.attr("href"))})})},c.duplicateProject=function(a){if(isNaN(parseInt(a)))a=JSON.parse(decodeURIComponent(a));else{var e=d.designs[parseInt(a)];a={projectId:e.id,numPages:e.pages,meta:{},userId:d.userId,product:e.product,designId:e.designId,type:"p"}}var f=a.product.id;return b.ajax({type:"POST",dataType:"json",crossDomain:!0,url:d.appApiUrl+"clone-project",data:{values:1,projectId:a.projectId||a.projectID,connectsid:d.connectsid},success:function(d){d.error?console.log(new Error("Error duplicating project!")):(a.projectId=d.newId,a=encodeURIComponent(JSON.stringify(a)),b.ajax({type:"POST",url:c.getSavePath(f),data:{clone:!0,values:a},success:function(a){window.location=a.trim()}}))},xhrFields:{withCredentials:!0}}),b("#my_recent_des_div").length&&(b("#my_recent_des_div").children().hide(),b("#my_recent_des_div").prepend('<img style="width:40px" src="'+d.rscCdn+'images/loaders/spinner.svg" border="0" >')),!1},c.swapPreviews=function(a,c,e){if(!d.maintainPreviews){var f,g;if(e===!0){var h=d.designStack[a];if(!h)return;for(a=[],g=0;g<h.pages;g++)a.push(h.id+"_"+(g+1)+".jpg")}if("function"==typeof d.functions.customImageSwap)return d.functions.customImageSwap(a,c);switch(d.client){case"wp":if("function"==typeof b().magnificPopup){for(f='<a href="'+c+a[0]+'" itemprop="image" class="woocommerce-main-image zoom" title="'+d.product.name+'" rel="lightbox"><img width="456" src="'+c+a[0]+'" class="attachment-shop_single wp-post-image" title="'+d.product.name+'"></a>',b(".product_image, .images").last().html(f),f="",g=1;g<a.length;g++)f+='<a href="'+c+a[g]+"?rand="+Math.random()+'" class="zoom first" title="'+d.product.name+'" rel="lightbox"><img width="150" height="90" src="'+c+a[g]+"?rand="+Math.random()+'" class="attachment-shop_thumbnail" title="'+d.product.name+'"></a>';b(".thumbnails").html(f),b("a[rel^='lightbox']").magnificPopup({type:"image",gallery:{enabled:!0}}),b(".kad-light-gallery").each(function(){b(this).find('a[rel^="lightbox"]').magnificPopup({type:"image",gallery:{enabled:!0},image:{titleSrc:"title"}})})}else{for(f='<a href="'+c+a[0]+"?rand="+Math.random()+'" itemprop="image" class="woocommerce-main-image zoom" title="'+d.product.name+'" rel="prettyPhoto[product-gallery]"><img width="400" height="240" src="'+c+a[0]+"?rand="+Math.random()+'" class="attachment-shop_single wp-post-image" title="'+d.product.name+'"></a>',g=1;g<a.length;g++)f+=' <div class="thumbnails"><a href="'+c+a[g]+"?rand="+Math.random()+'" class="zoom first" title="'+d.product.name+'" rel="prettyPhoto[product-gallery]"><img width="150" height="90" src="'+c+a[g]+"?rand="+Math.random()+'" class="attachment-shop_thumbnail" title="'+d.product.name+'"></a></div>';b(".images").html(f),void 0!==b.prettyPhoto&&b("a[rel='prettyPhoto[product-gallery]']").prettyPhoto()}break;case"oc":if(b(".thumbnails,.image-container,.product-gallery").length&&b.magnificPopup){for(f='<li><a class="thumbnail product-image" rel="magnific" href="'+c+a[0]+'" title="'+d.product.name+'"><img src="'+c+a[0]+"?r="+Math.random()+'" ></a></li>',g=1;g<a.length;g++)f+=' <li class="image-additional image-thumb"><a rel="magnific" class="thumbnail" href="'+c+a[g]+"?r="+Math.random()+'" > <img src="'+c+a[g]+"?r="+Math.random()+'" ></a></li>';b(".thumbnails,.image-container,.product-gallery").html(f),b('a[rel="magnific"]').magnificPopup({type:"image",gallery:{enabled:!0}})}else if(b(".image").length&&b.colorbox){var i=b(".image").width()||300;for(b(".image").html('<a href="'+c+a[0]+"?r="+Math.random()+'" title="'+d.product.name+'" class="colorbox cboxElement"><img width="'+i+'" src="'+c+a[0]+"?r="+Math.random()+'" title="" alt="" id="image"></a>'),f="",g=1;g<a.length;g++)f+=' <a href="'+c+a[g]+"?r="+Math.random()+'" title="" class="colorbox cboxElement"><img width="76" src="'+c+a[g]+"?r="+Math.random()+'" title="" alt=""></a>';b(".image-additional").html(f),b(".zoomContainer").remove(),b(".colorbox").colorbox({rel:"colorbox"})}break;case"ps":b.fancybox&&setTimeout(function(){b(document).unbind("click.fb-start"),b(".fancybox").unbind("click.fb"),b(".fancybox_").unbind("click.fb"),b("#image-block,#image-block").html('<a rel="fb__" class="fancybox_" href="'+(c+a[0])+'"><img id="bigpic" itemprop="image" src="'+(c+a[0])+'" width="458"></a>'),b("#thumbs_list,#views_block").html("").append('<ul id="thumbs__" style="width: 297px;"></ul>');for(var d=1;d<a.length;d++)b("#thumbs__").append('<li><a rel="fb__" href="'+(c+a[d])+'" class="fancybox_"><img itemprop="image" src="'+(c+a[d])+'" width="80"></a></li>');b("#thumbs_list").parent().removeClass("hidden"),b(".fancybox_").fancybox(),b(".resetimg,.view_scroll_spacer").hide()},2e3);break;case"sp":setTimeout(function(){b(document).unbind("click.fb-start"),b(".image,.featured,.zoom,product-photo-container").unbind("click.fb").unbind("click"),b(".image,#product-photo-container,.product-left-column,.main-image,.product-photo-container,.featured,#image-block").first().html('<a rel="_imgs" id="placeholder" href="'+c+a[0]+'" class="fancybox_ zoom colorbox cboxElement"><img itemprop="image" src="'+c+a[0]+'" width="458"></a>'),b(".thumbs,.flex-control-thumbs,.more-view-wrapper").html("");for(var e=1;e<a.length;e++)b(".thumbs,.flex-control-thumbs,.more-view-wrapper,#views_block").append('<div rel="_imgs" class="fancybox_ image span2 colorbox cboxElement"><a href="'+c+a[e]+'" data-original-image="'+c+a[e]+'"><img src="'+c+a[e]+'" alt="'+d.product.name+'"></a></div>');"undefined"!=typeof b.fancybox?b(".fancybox_").fancybox():"undefined"!=typeof b.colorbox&&b(".colorbox").colorbox({rel:"_imgs"})},2e3)}}},c.processCatModules=function(a,d){if(a){var e=JSON.parse(a),f=!1,g=c.designer.getModel();return g.runtime.modules=e,b.each(e,function(a,b){switch(a){case"ds":g.c.designId=b["default"]||d[0].id,"Pick default design"!==g.c.designId&&"0"!==g.c.designId||(g.c.designId=d[0].id),c.designer.loadLib(),f=!0}}),f}},c.fetchDesigns=function(a){d.isCategory&&(a&&(d.server=a.server,d.connectsid=a.server.connectsid),b.ajax({type:"POST",dataType:"json",crossDomain:!0,data:{categoryId:d.designId.substr(1),connectsid:d.connectsid},url:d.appApiUrl+"fetch-cat-details",success:function(a){d.designStack={},a.error||(a.designs.forEach(function(a){b("#pp_design_select").append('<option value="'+a.id+'">'+a.title+"</option>"),d.designStack[a.id]=a}),c.designer&&(c.designer.getModel().c.designStack=d.designStack),c.processCatModules(a.modules,a.designs)?(b("#pp_design_select").change().hide(),d.autoShow||b("#pp_customize_design_btn").show()):b("#pp_design_select").removeAttr("disabled").change())},xhrFields:{withCredentials:!0}}))},c.validate=function(a){d||(d=c.vars),b.ajax({type:"POST",dataType:"json",cache:!1,crossDomain:!0,url:d.appApiUrl+"validate",data:{userId:d.userId,apiKey:d.apiKey,tempProject:localStorage.getItem("pitchPrintTempSave")},success:function(b){b.error?console.log("Invalid APIKey"):(d.connectsid=b.server.urlToken,localStorage.removeItem("pitchPrintTempSave"),"function"==typeof a&&a())},xhrFields:{withCredentials:!0},error:function(a,b,c){console.log("03","Error validating apiKey")}})},c.ublockUploader=function(){d.editorVisible?W2P.MODEL.runtime.ui.pack.unblock():b.unblockUI()},c.showUpload=function(a){function e(){for(var a,e=[],f=[],g=0;g<d.uploadStack.length;g++)d.uploadStack[g].thumbnailUrl||(d.uploadStack[g].thumbnailUrl=(d.pluginRoot||"")+d.thumbsSrc+d.uploadStack[g].url.split(".").pop().toLowerCase()+".png"),e.push(d.uploadStack[g].thumbnailUrl),f.push(d.uploadStack[g].url);d.mode="upload","sp"===d.client&&(a="u_"+d.uniqueId);var h=encodeURIComponent(JSON.stringify({projectId:a,files:f,previews:e,meta:{},userId:d.userId,product:d.product,type:"u"}));"sp"===d.client&&b("#_pitchprint").length?b("#_pitchprint").val(a):b("#_w2p_set_option,#web2print_option_value").length&&b("#_w2p_set_option,#web2print_option_value").val(h),c.saveSess({values:h,isUpload:!0,projectId:a,productId:d.product.id}),c.swapPreviews(e,"",!1),c.setBtnPref(!0)}var f={message:'<div id="upldpopup" style="position:relative" class="ppc-upload-panel"><div class="ppc-upload-title"><span>'+d.lang.upload_your_files+'</span></div><div style="padding-top:10px;"><div class="ppc-upload-top-btn" ><div style="padding: 10px; text-transform: uppercase;">'+d.lang.add_files+'</div> <input class="ppc-upload-input" id="fileuploadbtn" type="file" name="files[]" multiple=""></div><div class="ppc-upload-stack" id="pp_upld_file_stck"></div> <div style=""><input type="button" onclick="PPCLIENT.plsUpload(true)" style="opacity:0.3" id="upldbtn" value="&#10003; '+d.lang.submit_tip+'" /> &nbsp;&nbsp; <input type="button" onclick="jQuery(\'#fileuploadbtn\').fileupload(\'destroy\'); PPCLIENT.ublockUploader()" value="&#x02717; '+d.lang.button_label_cancel+'" /></div></div>',css:{padding:"0",margin:"0",width:"100%",left:"0",right:"0",top:"0",bottom:"0",textAlign:"center",background:"rgba(0,0,0,0.7)",border:"none",cursor:"default"},overlayCSS:{cursor:"default",opacity:.5},baseZ:9999999};d.editorVisible?W2P.MODEL.runtime.ui.pack.block(f):b.blockUI(f),d.idx=0,d.uploadStack=[],d.uploadArr=[];var g=b("#pp_upld_file_stck"),h=b('<img src="'+d.rscBase+'images/cross.png" style=" cursor:pointer; left: 10px;top: 10px; position: absolute;" width="16" height="16" >').on("click",function(){var a=b(this).data();a.context.remove(),a.abort(),d.uploadArr[a.idx]=null,a=null,c.checkUploads()});b("#fileuploadbtn").fileupload({url:d.uploadUrl,dataType:"json",autoUpload:!1,dropZone:g,pasteZone:null,singleFileUploads:!0,sequentialUploads:!0,maxFileSize:5e7,disableImageResize:/Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),previewMaxWidth:175,previewMaxHeight:175,previewCrop:!0,formData:{convert:!0}}).on("fileuploadadd",function(a,c){c.context=b('<div style="width: 186px; height:210px; background-color: #ccc;margin: 10px;border-radius: 3px; position:relative; overflow:hidden; padding: 5px;font-size: 12px;" ><div style="font-size:10px; overflow:hidden">'+c.files[0].name+"</div></div>").prependTo(b("#pp_upld_file_stck"))}).on("fileuploadprocessalways",function(a,e){var f=e.files[e.index],g=b(e.context);e.files.error?b(e.context).remove():(f.preview?g.prepend(f.preview):g.prepend(b('<img src="'+(d.pluginRoot||"")+d.thumbsSrc+f.name.split(".").pop().toLowerCase()+'.png" width="175" height="175" />')),e.idx=d.idx,b(e.context).append(h.clone(!0).data(e)),d.uploadArr.push(e),d.idx++,c.checkUploads())}).on("fileuploaddone",function(f,g){b.each(g.result.files,function(f,g){g.url?(d.uploadStack.push(g),d.uploadArr.length>0?c.plsUpload():(b.unblockUI(),"function"==typeof a?a():e())):g.error&&(alert(d.lang.upload_error),b.unblockUI())})}).on("fileuploadprogressall",function(a,c){b("#pp-upload-prgs").circleProgress("value",c.loaded/c.total)}).on("fileuploadfail",function(a,c){alert(d.lang.upload_error),b.unblockUI()}),g&&g.on("dragleave",function(a){b(a.target).css("background-color","#ddd")}).on("dragenter",function(a){b(a.target).css("background-color","#BFBFBF")}).on("drop",function(a){b(a.target).css("background-color","#ddd")}),"sp"!==d.client||d.uniqueId||b.ajax({type:"GET",dataType:"json",url:d.randUrl,success:function(a){d.uniqueId=a.key}})},c.plsUpload=function(a){if(a===!0&&(d.editorVisible?(b("#upldpopup").css("opacity",0).appendTo(W2P.MODEL.runtime.ui.pack),W2P.MODEL.runtime.ui.pack.unblock(),c.designer.showModal("Uploading your Files..")):(b("#w2p_upld_file_stck").css("opacity",.3),b("#upldpopup").children().css("opacity",0),b("#upldpopup").append('<div style="padding: 20px;background-color: rgb(77, 74, 74);border-radius: 5px;position: absolute;top: 50%;left: 50%;margin-left: -60px;"><div style="float:left" id="pp-upload-prgs" width="80" height="80" ><span style="color: white;float: left;margin-left: -58px;margin-top: 35px;width: 40px;text-align: center;" id="upldprogress"></span></div>'),b("#upldpopup").css("background-color","rgba(0,0,0,0)"),b("#pp-upload-prgs").circleProgress({value:0,size:80,thickness:10,fill:{color:"#EEEEEE"}}))),c.checkUploads())for(var e=d.uploadArr.length,f=0;e>f;f++){var g=d.uploadArr.pop();if(g)return void g.submit()}},c.checkUploads=function(){for(var a=0;a<d.uploadArr.length;a++)if(null!==d.uploadArr[a])return b("#upldbtn").css("opacity",1).prop("disabled",!1),!0;return b("#upldbtn").css("opacity",.3).prop("disabled",!0),!1},c.getSavePath=function(a){switch(d.client){case"wp":return d.pluginRoot+"app/saveproject.php?productId="+a;case"oc":return(d.self||"index.php?route=product/product&product_id="+a)+"&productId="+a;case"ps":return window.location;case"sp":return d.appApiUrl+"sp-save-session"}},c.isValidPP=function(a){if(!a||""===a)return!1;try{var b=JSON.parse(decodeURIComponent(a));return!(!b.type||!b.product)}catch(c){return!1}return!0},c.showBusy=function(){b.blockUI({message:'<div style="width:40px; height:40px; position: absolute; top:50%; left: 50%; margin-top: -20px" ><img width="64" src="'+d.rscCdn+'images/loaders/spinner.svg" ></div>',css:{padding:"0",margin:"0",width:"100%",left:"0",right:"0",top:"0",bottom:"0",textAlign:"center",background:"rgba(0,0,0,0)",border:"none",cursor:"default"},overlayCSS:{cursor:"default",opacity:.5},baseZ:9999999})},c.ocSwapDetails=function(){b("span[pp-value]").each(function(){var a=b(this);if(""!==a.attr("pp-value").trim()){var c,e,f,g=a.attr("pp-value").trim();g=JSON.parse(decodeURIComponent(g));var h="p"===g.type?"custom_design":"uploaded_files";a.attr("pp-image")?(c=a.attr("pp-image").trim(),e="p"===g.type?d.rscBase+"images/previews/"+g.projectId+"_1.jpg":g.previews[0],b(a.closest("table").find("img[src='"+c+"']")[0]).attr("src",e).css("width","90px"),f=a.parent().html('<span pp-data="'+h+'" >'+(d.lang?d.lang[h]:"")+'</span>: &nbsp;&nbsp; <img style="width:14px; height:14px" src="'+d.rscCdn+'images/ok.png" border="0" >')):(f=a.parent().html('<span pp-data="'+h+'" >'+(d.lang?d.lang[h]:"")+'</span>: &nbsp;&nbsp; <img style="width:14px; height:14px" src="'+d.rscCdn+'images/ok.png" border="0" >'),f.html('<img style="margin-top:5px; border: 1px #eee solid;" src="'+d.rscBase+"images/previews/"+g.projectId+'_1.jpg" width="100" >'))}})},c.deleteProject=function(a){return confirm(d.lang.delete_message)&&(b("#my_recent_des_div").html('<img src="'+d.rscCdn+'images/loaders/spinner.svg" >'),b.ajax({type:"POST",dataType:"json",crossDomain:!0,data:{projectId:a,connectsid:d.connectsid},url:d.appApiUrl+"delete-project",success:function(){c.fetchUserProjects()},xhrFields:{withCredentials:!0}})),!1},c.viewDesign=function(a){if(d.designs){if(d.designs[a]){for(var c=[],e=0;e<d.designs[a].pages;e++)c.push(d.rscBase+"images/previews/"+d.designs[a].id+"_"+(e+1)+".jpg");b.prettyPhoto?b.prettyPhoto.open(c):b.magnificPopup?(c.forEach(function(a,b){c[b]={src:a}}),b.magnificPopup.open({items:c,type:"image",gallery:{enabled:!0}})):b.colorbox&&(b("body").append('<div id="pp_cb_div" style="display:none"></div>'),c.forEach(function(a){b("#pp_cb_div").append('<a href="'+a+'" rel="pp-cb-rel" class="pp-cb-rel" ></a>')}),b("a.pp-cb-rel").colorbox({open:!0,rel:"pp-cb-rel",onClosed:function(){b("#pp_cb_div").remove()}}))}return!1}},c.wrapStrings=function(){var a,e,f;b("li").each(function(){if(b(this).html().indexOf("@PP@")>-1||b(this).html().indexOf("%7B%22")>-1&&b(this).html().indexOf("%22%7D")>-1){f="<div>",e=[];var g=decodeURIComponent(b(this).html().split(":").pop().trim());if(c.isValidPP(g)){if(a=JSON.parse(g),"p"===a.type&&a.numPages)for(var h=0;h<a.numPages;h++)f+='<a style="margin:5px; border:1px solid #ccc; padding:5px; display: inline-block;"><img src="'+d.rscBase+"images/previews/"+a.projectId+"_"+(h+1)+'.jpg" width="100" ></a>';else a.previews.forEach(function(a){f+='<a style="margin:5px; border:1px solid #ccc; padding:5px; display: inline-block;"><img src="'+a+'" width="100" ></a>'});b(this).html(f+"</div>")}}})},c.fetchUserProjects=c.fetchUserDesigns=function(){if(b("#pp_mydesigns_div").length||b("#pp-mydesigns-div").length){c.loadLang();var a=b("#pp_mydesigns_div");a.length||(a=b("#pp-mydesigns-div")),b("#my_recent_des_div").length||a.append('<div><h2 pp-data="text_my_recent"></h2><div id="my_recent_des_div"></div></div>'),b.ajax({type:"POST",dataType:"json",crossDomain:!0,data:{connectsid:d.connectsid},url:d.appApiUrl+"fetch-recent",success:function(a){if("function"==typeof d.functions.myRecentDesigns)return d.functions.myRecentDesigns(a);a.reverse(),d.designs=a;var c="";if(0===a.length)c=d.lang.sorry_no_project;else{c+='<table class="shop_table my_account_orders table table-bordered table-hover"><tbody>';for(var e=0;e<a.length;e++)c+='<tr class="order"><td style="text-align: center;"><img src="'+d.rscBase+"images/previews/"+a[e].id+'_1.jpg" width="90" ></td><td  style="text-align: center;" width="180" title="Modified '+a[e].lastModified+'">'+(a[e].product.name||a[e].product.title)+'</td><td style="text-align: center;"><a class="button btn btn-success" onclick="return PPCLIENT.duplicateProject('+e+')" href=""><span pp-data="duplicate_design_for_reorder">'+(d.lang?d.lang.duplicate_design_for_reorder:"")+'</a></td><td style="text-align: center;"><a class="button btn btn-default" onclick="return PPCLIENT.viewDesign('+e+')" href=""><img src="'+d.rscCdn+'images/eye.png" border="0" ></a></td><td style="text-align: center;"><a class="button btn btn-default" onclick="return PPCLIENT.deleteProject(\''+a[e].id+'\')" href=""><img src="'+d.rscCdn+'images/cross.png" border="0" ></a></td></tr>';c+="</tbody></table>"}b("#my_recent_des_div").html(c)},xhrFields:{withCredentials:!0}})}},PPCLIENT.vars&&"sp"===PPCLIENT.vars.client&&PPCLIENT.init()}(this);