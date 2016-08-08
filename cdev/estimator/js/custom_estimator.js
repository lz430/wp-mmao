/*--------------------------------------------------------------------------*
 * 
 * Copyright (C) 2013 Brand Labs LLC
 * 
 *--------------------------------------------------------------------------*/


//Tab handling
jQuery(document).ready(function() {
    
	// Articles Section Expansion
	jQuery( "#estimator_tabs" ).tabs({
	  selected: 0,
	  collapsible: false,
	  activate: function( event, ui ) {
	  	$(this).addClass('tab_activated');	  	
	  }
	});
	
	jQuery('.tabbed_content').removeClass('tabs_hidden');});

//Estimator form handler
var EstimatorFormHandler = {
	cfg : {
		settings : {
			devices : {
				desktop : 1,
				display : 2,
				laptop	: 3,
				iPad	: 4,
				iPhone	: 5
			},
						
			estimatorInformationURL	: '/cdev/estimator/ajax/selection-info.json.php',
			submissionHandlerURL : '/thank-you/',
			recyclesubmissionHandlerURL : '/recycle/',
			installationPath : '/cdev/estimator',
			photoPath : '//sellers.macofalltrades.com/2013/images',
			
			
			serialNumberFieldName : 'estimator_form_serial_number',
			emailFieldName		  : 'estimator_form_email_address',
			
			requiredFieldClassName : 'required_field',
			disabledClassName : 'sel_disabled'
			
		},
		selectors : {
			modelPhoto : '#est_model_thumb',
			modelTitle : '#est_model_title',
			modelPrice : '#est_model_price',
			zeroValModelTitle : '#est_model_title_zeroval',
			questionsRow : '#estimator_questions',
			deviceSelect : 'a[id^="est_"]',
			continueButtons : '.estimator_form_go a, .estimator_form_submit a, .est_form_submit a',
			formSubissionButton : '#estimator_form_submission',
			submissionForm : '#estimator_submission_form',
			zeroValSubmissionForm : '#estimator_submission_form_zeroval',
			submissionMessageTitle : '.form_sumbission_message_title',
			submissionMessageText : '.form_sumbission_message_text',
			uploaderDialogs : 'input[type="file"]',
			thankYouMessage : '#estimator_thankyou',
			zeroValThankYouMessage : '#estimator_thankyou_zeroval',
			selectBoxes	: '.estimator_form_select_box select'
			
		},
		templates : {
			modelPrice : 'Estimate: $#{Price}'
		},
		data : {
			desktop : null,
			display : null,
			laptop : null,
			iPad : null,
			iPhone : null,
			currentPage : 1
		}
	},
	
	init : function () {
		//Estimator
		if (window.location.href.toLowerCase().indexOf('thank-you') == -1) {
			var deviceSelectors = null;
			var continueButtons = null;
			
			//Get device select elements
			deviceSelectors = jQuery(EstimatorFormHandler.cfg.selectors.deviceSelect);
			continueButtons = jQuery(EstimatorFormHandler.cfg.selectors.continueButtons);
			uploaderDialogs = jQuery(EstimatorFormHandler.cfg.selectors.uploaderDialogs);
			
			//Verify we have selector icons and continue buttons to work with
			if (deviceSelectors != null && jQuery(deviceSelectors).length > 0
			&& continueButtons != null && jQuery(continueButtons).length > 0) {
				//Add listeners
				deviceSelectors.click(EstimatorFormHandler.deviceSelection);
				continueButtons.click(EstimatorFormHandler.changePage);
				uploaderDialogs.change(EstimatorFormHandler.uploadFileSelection);
				
			}
			
			$(EstimatorFormHandler.cfg.selectors.selectBoxes).customStyle();
		} else {
			//Thank you
			if (typeof ProcessedFormVars != "undefined") {
				var title = jQuery(EstimatorFormHandler.cfg.selectors.modelTitle);
				var photo = jQuery(EstimatorFormHandler.cfg.selectors.modelPhoto);
				var price = jQuery(EstimatorFormHandler.cfg.selectors.modelPrice);
				var titleVal = decodeURIComponent(ProcessedFormVars[title.attr('id')].replace(/\+/g, '%20'));
				var photoVal = decodeURIComponent(ProcessedFormVars[photo.attr('id')].replace(/\+/g, '%20'));
				var priceVal = decodeURIComponent(ProcessedFormVars[price.attr('id')].replace(/\+/g, '%20'));
				
				//Fill in
				title.html(titleVal);
				if (photoVal != '') {
					photo.attr({
						'src'	: photoVal,
						'title'	: titleVal.replace('"', '\"'),
						'alt'	: titleVal.replace('"', '\"')
					});
				}
				price.html(EstimatorFormHandler.cfg.templates.modelPrice.replace('#{Price}', parseFloat(priceVal).toFixed(2)));
				
				if (parseFloat(priceVal) === 0) {
					//Show recycle thank you
					jQuery(EstimatorFormHandler.cfg.selectors.thankYouMessage).hide();
					jQuery(EstimatorFormHandler.cfg.selectors.zeroValThankYouMessage).show();
				}
			}
		}
	},
	
	deviceSelection : function() {
		var section = this.id.split("_")[1];
				
		if (EstimatorFormHandler.cfg.data[section] === null) {
			var deviceType = EstimatorFormHandler.cfg.settings.devices[section];
			if (deviceType > 0) {
				EstimatorFormHandler.getModels(deviceType);
			}
		}
	},
	
	uploadFileSelection : function() {
		var element = jQuery(this);
		var nameParts = jQuery(element).attr('name').split("_");
		var fileNumber = nameParts.pop();
		var fileSelector = 'input[name="' + nameParts.join('_') + '_' + (parseInt(fileNumber) + 1) + '"]';
		
		if (element.val() != '' && element.val().search(/\.(tiff|jpg|png|gif|jpeg)$/i) < 0) {
			element.val('');
			element.next('span').html('<em>File format not supported. Please try again.</em>').show();
		} else {
			element.next('span').html('');
			
			//Show next if there is one
			jQuery(fileSelector).show();
		}
	},
	
	getModels : function (deviceType) {
			//Get models
			jQuery.ajax({
				url : EstimatorFormHandler.cfg.settings.estimatorInformationURL + "?deviceType=" + deviceType,
				complete: function(xhr, status) {
					var response = jQuery.parseJSON(xhr.responseText);
					var deviceType = this.url.match(/deviceType=(\d+)/i)[1];
					var deviceTypeName = null;
					
					//Get device type name
					jQuery.each(EstimatorFormHandler.cfg.settings.devices, function(key, val) {
						if (val == deviceType) {
							deviceTypeName = key;
						}
					});
															
					//Set Data
					EstimatorFormHandler.cfg.data[deviceTypeName] = response;
					
					//Build Select
					EstimatorFormHandler.populateSeries(deviceTypeName);
				}
			});
	},
	
	populateSeries : function (deviceTypeName) {
		var data = EstimatorFormHandler.cfg.data[deviceTypeName];
		var seriesSelect = jQuery('[name="' + deviceTypeName + '_series"]');
		var modelSelect = jQuery('[name="' + deviceTypeName + '_models"]')
		
		seriesSelect.html('<option selected="true" value="">Select Series</option>');
		jQuery.each(data, function(key, val) {
			seriesSelect.append('<option value="' + key + '">' + val.name + '</option>');
		});
		
		seriesSelect.removeAttr('disabled');
		seriesSelect.trigger('change');
		seriesSelect.parent().removeClass(EstimatorFormHandler.cfg.settings.disabledClassName);
		//Populate devices to choose from based on series select
		jQuery(seriesSelect).change(EstimatorFormHandler.populateDevices);
		jQuery(modelSelect).change(EstimatorFormHandler.modelSelection);
	},
	
	populateDevices : function () {
		var deviceTypeName = this.name.split("_")[0];
		var seriesID = jQuery(this).val();
		var data = EstimatorFormHandler.cfg.data[deviceTypeName];
		var modelSelect = jQuery('[name="' + deviceTypeName + '_models"]');
		var continueButton = jQuery(this).parents('form').find('a');
		
		//Disable models
		modelSelect.attr('disabled','disabled');
		modelSelect.parent().addClass(EstimatorFormHandler.cfg.settings.disabledClassName);
		//Fill in data
		if (data && seriesID > 0) {
			modelSelect.html('<option selected="true" value="">Select Model</option>');
			jQuery.each(data[seriesID].models, function(key, val) {
				modelSelect.append('<option value="' + val.deviceID + '">' + val.model + '</option>');
			});
			//Enable models
			modelSelect.removeAttr('disabled');
			modelSelect.parent().removeClass(EstimatorFormHandler.cfg.settings.disabledClassName);
			
			//change button image
			continueButton.find('img').attr('src', continueButton.find('img').attr('src').replace('-active', '-inactive'));
		}
		modelSelect.trigger('change');
	},
	
	modelSelection : function () {
		var deviceTypeName = this.name.split("_")[0];
		var continueButton = jQuery(this).parents('form').find('a');
		var series = jQuery('[name="' + deviceTypeName + '_series"]').val();
		var model = jQuery(this).val();
				
		//change button image
		continueButton.find('img').attr('src', continueButton.find('img').attr('src').replace('-active', '-inactive'));
		if (model != '' && model > 0) {
			//change button image
			continueButton.find('img').attr('src', continueButton.find('img').attr('src').replace('-inactive', '-active'));
			
			//Update page 2, page 5 title
			EstimatorFormHandler.updateSelectionInfoForm(deviceTypeName, series, model);
		}
	},
	
	changePage : function(event) {
		var page = parseInt(jQuery(this).attr('href').replace('#',''));
		
		//Handle first page
		if (page === 0) {
			page = EstimatorFormHandler.cfg.data.currentPage;
			EstimatorFormHandler.cfg.data.currentPage = 1;
		}
		
		//Toggle button image, prevent default if inactive
		if (EstimatorFormHandler.cfg.data.currentPage === 1) {
			var continueButton = jQuery(this).parents('form').find('a img');
			if (continueButton.attr('src').indexOf('-inactive') > 0) {
				event.preventDefault();
				return false;
			} else if (page === 1) {
				var modelSelector = jQuery(continueButton).parents('form').find('.models');
				modelSelector.trigger('change');
				page = EstimatorFormHandler.cfg.data.currentPage;
				EstimatorFormHandler.cfg.data.currentPage = 1;
			}
		}
		
		//Handle page 2
		if (EstimatorFormHandler.cfg.data.currentPage === 2) {
			if (page !== 1) {
				//Handle inner current page
				EstimatorFormHandler.cfg.data.currentPage = 3;
			}
		} 
		
		//Handle inner page 3
		if (EstimatorFormHandler.cfg.data.currentPage === 3) {
			if (page === 1) {
				EstimatorFormHandler.cfg.data.currentPage = 2;
			}
		}
		
		//Handle page 5
		if (EstimatorFormHandler.cfg.data.currentPage === 5) {
			if (page !== 1) {
				//handler inner current page
				EstimatorFormHandler.cfg.data.currentPage = 7;
			}
		}
		
		//Handle inner page 7
		if (EstimatorFormHandler.cfg.data.currentPage === 7) {
			if (page === 1) {
				EstimatorFormHandler.cfg.data.currentPage = 5;
			}
		}
	
		//Hide current page
		jQuery('#page_'+ EstimatorFormHandler.cfg.data.currentPage).hide();
		
		//Show new page
		jQuery('#page_'+ page).show();
		
		//Set new current page
		EstimatorFormHandler.cfg.data.currentPage = page;
		
		//Handle form submission
		if (page === 6 || page === 8) {
			EstimatorFormHandler.submitForm();
		}
		
		var pageScroll = $(window).scrollTop();
		
		var offset = $('div#est_wrapper').offset();
		if(offset.top < pageScroll){
			$("html, body").animate({ scrollTop: offset.top -50}, "fast");
		}
		event.preventDefault();
	},
	
	updateSelectionInfoForm : function(deviceTypeName, series, model) {
		var seriesData = EstimatorFormHandler.cfg.data[deviceTypeName][series];
		
		//Get data
		jQuery.each(seriesData.models, function(key, item) {
			if (item.deviceID != model) {
				return;
			} else {
				var titles = jQuery(EstimatorFormHandler.cfg.selectors.modelTitle + ", " + EstimatorFormHandler.cfg.selectors.zeroValModelTitle);
				var photo = jQuery(EstimatorFormHandler.cfg.selectors.modelPhoto);
				var price = jQuery(EstimatorFormHandler.cfg.selectors.modelPrice);
				var questions = jQuery(EstimatorFormHandler.cfg.selectors.questionsRow);
				
				//Fill in title info
				titles.html(item.model);
				
				//Page 2 or page 5?
				if (parseInt(item.price) > 0) {
					//Page 2, fill in other info
					photo.attr({
						'src'	: EstimatorFormHandler.cfg.settings.photoPath + item.photo,
						'title'	: item.model.replace('"', '\"'),
						'alt'	: item.model.replace('"', '\"')
					});
					price.html(EstimatorFormHandler.cfg.templates.modelPrice.replace('#{Price}', item.price.toFixed(2)));
					
					//Fill in questions
					
					
					//sellers.macofalltrades.com/2013
					questions.load(EstimatorFormHandler.cfg.settings.installationPath+'/ajax/' + deviceTypeName + '-questions.html');
					
					//Set new current page
					EstimatorFormHandler.cfg.data.currentPage = 2;
				} else {
					//Set new current page
					EstimatorFormHandler.cfg.data.currentPage = 5;
				}
			}
		});
	},
	
	submitForm : function() {
		var valid = true;
		var estimatorForm = null;
		var data = Array();
		var issuesList = Array();
		var fileNames = Array();
		var target = EstimatorFormHandler.cfg.settings.submissionHandlerURL;
		
		if (EstimatorFormHandler.cfg.data.currentPage === 6) {
			//Regular form submission
			estimatorForm = jQuery(EstimatorFormHandler.cfg.selectors.submissionForm);
		} else {
			//Recycle form submission
			estimatorForm = jQuery(EstimatorFormHandler.cfg.selectors.zeroValSubmissionForm)
			target = EstimatorFormHandler.cfg.settings.recyclesubmissionHandlerURL;
		}
		
		data = jQuery(estimatorForm).find('input, select, textarea');
		//Do Validation
		jQuery.each(data, function(key, item){
		    var element = jQuery(item);
		    
		    //Check required fields aren't blank'
		    if (element.hasClass(EstimatorFormHandler.cfg.settings.requiredFieldClassName)) {
		    	var val = element.val().toLowerCase();
		    	
		    	//Remove any previous jQuery added style
		    	element.css('border','');
		    	
		    	//Add border to outline missing required fields
		    	if (jQuery.trim(val) == '') {
		    		element.val('');
		    		issuesList.push('Missing required field! <span style="color:#FF0000">' + element.attr('name').replace('estimator_form_', '').replace(/_/g, ' ') + '</span>');
		    		element.css('border', '1px solid #FF0000');
		    		
		    		valid = false;
		    	}
		    	
		    	//Scrub serial number
		    	if (element.attr('name') == EstimatorFormHandler.cfg.settings.serialNumberFieldName) {
		    		//Caps
		    		val = val.toUpperCase();
		    		//Replace O with 0 
		    		val = val.replace(/O/, '0');
		    		//replace I with 1
		    		val = val.replace(/I/, '1');
		    		
		    		//Check length, not all letters, not all numbers
		    		if (val.length > 0 && (val.length < 11 || val.length > 12 || (/^\d+$/).test(val) || (/^[A-Z]+$/).test(val))) {
			    		issuesList.push('Invalid serial number! <span style="color:#FF0000">' + val + '</span>');
			    		element.css('border', '1px solid #FF0000');
			    		
		    			valid = false;
		    		} else {
		    			element.val(val);
		    		}
		    	}
		    }
		    if (element.attr('name') == EstimatorFormHandler.cfg.settings.emailFieldName && jQuery.trim(val) != '') {
		    	var emailPattern = /.*@.*\..*/;
		    	if(!emailPattern.test(val)){
		    		issuesList.push('Invalid <span style="color:#FF0000">email address</span>!');
			    	element.css('border', '1px solid #FF0000');
			    	valid = false;
		    	}
		    	
		    
		    }
		    
		    //Double check file extensions
		    if (element.attr('type') == 'file') {
		    	//scrub extensions
		    	var val = element.val().toLowerCase();
		    	if (val != '' && val.search(/\.(tiff|jpg|png|gif|jpeg)$/i) < 0) {
		    		issuesList.push('Invalid extension for file: "' + val + '"');
		    		
		    		valid = false;
		    	} else if ($.inArray(val,fileNames) < 0) {
		    		fileNames.push(val);
		    	} else {
		    		element.val('');
		    	}
		    }		    
		});
		
		
		//Finish		
		if (valid) {
			var title = jQuery(EstimatorFormHandler.cfg.selectors.modelTitle);
			var photo = jQuery(EstimatorFormHandler.cfg.selectors.modelPhoto);
			var price = jQuery(EstimatorFormHandler.cfg.selectors.modelPrice);
			
			//Add essentials, Submit
			estimatorForm.attr({
				method : 'POST',
				action : target
			});
			
			//Add selection
			estimatorForm.append('<input type="hidden" name="' + title.attr('id') + '" value="' + title.text() +'"/>');
			estimatorForm.append('<input type="hidden" name="' + photo.attr('id') + '" value="' + photo.attr('src') +'"/>');
			estimatorForm.append('<input type="hidden" name="' + price.attr('id') + '" value="' + parseFloat(price.text().replace(/[^\d\.,]/g, '')).toFixed(2) +'"/>');
			
			//Add wait message, hide action buttons
			jQuery(EstimatorFormHandler.cfg.selectors.submissionMessageTitle).html('<h2>Please Wait!</h2>');
			jQuery(EstimatorFormHandler.cfg.selectors.submissionMessageText).html('We are processing your submission.');
			estimatorForm.find(EstimatorFormHandler.cfg.selectors.continueButtons).hide();
			
			//Submit
			estimatorForm.submit();
		} else {
			//list issues
			jQuery(EstimatorFormHandler.cfg.selectors.submissionMessageTitle).html('<h2>Submission Error</h2>');
			jQuery(EstimatorFormHandler.cfg.selectors.submissionMessageText).html('The following issues prevented your submission from completion.<br/><ul><li>' 
			+ issuesList.join("</li><li>")+ '</li></ul>'
			+ '<p>Please press the back button to correct the inputs and try your submission again.</p>');
		}
	}
	
};

jQuery(document).ready(function() {
	EstimatorFormHandler.init();
});
