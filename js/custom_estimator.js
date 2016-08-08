/*--------------------------------------------------------------------------*
 * Copyright (C) 2016 Brand Labs LLC
 *--------------------------------------------------------------------------*/
//Collapse panel handling
var group = jQuery('.estimator-container');
jQuery('.tab-click').click(function(){
  jQuery('.equipment-outer').removeClass('active');
  group.find('.collapse.in').collapse('hide');
  jQuery(this).parent().toggleClass('active');
});
/* -------------------------------------- *\
    New form handler
\* -------------------------------------- */
jQuery(document).on('change', '.select-series', function(e){
  e.preventDefault();

  var series = jQuery(this).val();
  jQuery('.loading').show();
  jQuery('.select-model-dropdown').load(templateUrl + "/page-estimator-model.php?series=" + series, function(){
    jQuery('.loading').hide();
  });
  jQuery(this).parent().find('.select-model-dropdown').css('display', 'block');
  
}); //end on change function


function modelSelect(v){
  jQuery('#page_2, .estimator-container').toggle();
  // Ajax for loading page_2 
  jQuery('.estimator-app').load(templateUrl + "/page-estimator2.php?p=" + v, function(){
    jQuery('div.wpcf7 > form').wpcf7InitForm(); 
  }); 
} //end modelSelect


jQuery(document).on('change', '.select-model', function() {
    var v = jQuery(this).val();
    modelSelect(v);
}); //end on change function

  // Back and continue handling
  jQuery('.estimator-app').on('click', '.estimator_form_btn_next', function(){
    var backBtn     = jQuery('.estimator_form_btn_back');
    var continueBtn = jQuery('.estimator_form_btn_next');
    var firstPage   = jQuery('#contact-first-page');
    var lastPage    = jQuery('#contact-last-page');
    
    if(firstPage.is(":visible")){
      firstPage.toggle();
      lastPage.toggle();
    }
  }); //end continue
  // Go back
  jQuery('.estimator-app').on('click', '.estimator_form_btn_back', function(){
    var backBtn     = jQuery('.estimator_form_btn_back');
    var continueBtn = jQuery('.estimator_form_btn_next');
    var firstPage   = jQuery('#contact-first-page');
    var lastPage    = jQuery('#contact-last-page');
    
    if(lastPage.is(":visible")){
      firstPage.toggle();
      lastPage.toggle();
    }else{
      jQuery.ajax({
       type   : "POST",
       // data: v,
       success: function(){
                   jQuery('.estimator-app').load(templateUrl + "/estimator-initial.php");
                }
      });
    }
    
  }); //end continue
  