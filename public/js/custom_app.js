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

$('.future_max_5').on('change',function(){
    var score = parseInt($('.total_bt').val());
    var exp_max_5 = parseInt($('.exp_max_5').val());
    var sc = parseInt($(this).val());
    if(parseInt($(this).val())>5){
      $(this).css('border-color', 'red');
      sc = 5;
    }else{
      $(this).css('border-color', 'yellow');
    } 
    var total_score = score+exp_max_5+sc;
    var x = (total_score >=50) ? 50: total_score; 
    $('.total_score').val(x);
  });


$('.exp_max_5').on('change',function(){
    var score = parseInt($('.total_bt').val());
    var exp_max_5 = parseInt($('.future_max_5').val());
    var sc = parseInt($(this).val());
    if(parseInt($(this).val())>5){
      $(this).css('border-color', 'red');
      sc = 5;
    }else{
      $(this).css('border-color', 'yellow');
    } 
    var total_score = score+exp_max_5+sc;
    var x = (total_score >=50) ? 50: total_score; 
    $('.total_score').val(x);
  });


});