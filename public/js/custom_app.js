$(document).ready(function() {

  $.each($("input[name='factors[]']"), function(){     
    var target_bix_id = $(this).data("targetid")
    if(! this.checked){
      $('#'+target_bix_id).attr("disabled", "disabled");
    }
  });

  $("input[name='factors[]']").change(function(){
    var target_bix_id = $(this).data("targetid")
    if(! this.checked){
      $('#'+target_bix_id).attr("disabled", "disabled");
    }else{
      $('#'+target_bix_id).removeAttr("disabled");
    }
  });

  $(".onchenageTrigger").change(function(){
    var url = $(this).find(':selected').data('url')
    window.location.href = url; 
  });


  $('.validate_credit').on('change',function(){
    var max = $(this).data('target');
    if($(this).val()>parseInt(max)){
      $(this).css('border-color', 'red');
      $(this).val(parseInt(max));
    }else if($(this).val()==parseInt(max)){
      $(this).css('border-color', 'green');
    }else{
      $(this).css('border-color', 'yellow');
    }
  });


});