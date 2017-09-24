$(document).ready(function() {

  $.each($(".validate_credit"), function(){     
    var maximum_id = $(this).data("maximum");
    var max = $("input[name='"+maximum_id+"']").val();
});

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

function update_targets(data_attr){
   var total = 0;
    var i = 0;
  $("[data-qids = '"+data_attr+"']").each(function() {
    var n = $(this).attr('name');
    var v = $("[data-maximum = '"+n+"']").val();
      if($.isNumeric($(this).val()) && $.isNumeric(v)){
        i+=1;
        total+=parseFloat($(this).val());
      }
   });
  var x = (total/i).toFixed(2);
  var clean = (isNaN(x))? '' : x;
   $("[data-target-sum = '"+data_attr+"']").val(clean);
}

function update_achiveds(){

}

//function update_sums(){}

$('.validate_target').on('change',function(){

    var this_value = (isNaN($(this).val()))? 0 : $(this).val();
    //update value
    $(this).val(this_value);

    //Adding to sum of values
    var data_attr = $(this).data('qids');
    var name = $(this).attr('name');
    var total = 0;
    var i = 0;
    $("[data-maximum = '"+name+"']").val('');

     $("[data-qids = '"+data_attr+"']").each(function() {
      var n = $(this).attr('name');
      var v = $("[data-maximum = '"+n+"']").val();
        if($.isNumeric($(this).val()) && $.isNumeric(v)){
          i+=1;
          total+=parseFloat($(this).val());
        }
     });

     var x = (total/i).toFixed(2);
    var clean = (isNaN(x))? '' : x;
     $("[data-target-sum = '"+data_attr+"']").val(clean);
  });

  $('.validate_credit').on('change',function(){

    var max_id = $(this).data('maximum');
    var max = $("input[name='"+max_id+"']").val();
    var clean = (isNaN($(this).val()))? 0 : $(this).val();
    $(this).val(clean);

    if($.isNumeric($(this).val()) && $(this).val()<=parseFloat(max)){
      $(this).val(parseFloat(clean));
      $(this).css('border-color', 'yellow');
    }else{
      $(this).css('border-color', 'red');
      $(this).val('');
    }
    //Adding to sum of values
    var data_attr = $(this).data('qids');
    var total = 0;
    var i = 0;
     $("[data-qids = '"+data_attr+"']").each(function() {
        if($.isNumeric($(this).val())){
          i+=1;
          total+=parseFloat($(this).val());
        }
     });

    var x = (total/i).toFixed(2);
    var clean = (isNaN(x))? '' : x;
     $("[data-sum = '"+data_attr+"']").val(clean);
     update_targets(data_attr+"_max");

  });

$('.future_max_5').on('change',function(){
    var score = parseFloat($('.total_bt').val());
    var exp_max_5 = parseFloat($('.exp_max_5').val());
    var sc = parseFloat($(this).val());
    if(parseFloat($(this).val())>5){
      $(this).css('border-color', 'red');
      $(this).val(5.00);
      sc = 5;
    }else{
      $(this).css('border-color', 'yellow');
    } 
    var total_score = score+exp_max_5+sc;
    var x = (total_score >=50) ? 50: total_score; 
    var clean = (isNaN(x))? '' : x;
    $('.total_score').val(clean);
  });


$('.exp_max_5').on('change',function(){
    var score = parseFloat($('.total_bt').val());
    var exp_max_5 = parseFloat($('.future_max_5').val());
    var sc = parseFloat($(this).val());
    if(parseFloat($(this).val())>5){
      $(this).css('border-color', 'red');
      $(this).val(5.00);
      sc = 5;
    }else{
      $(this).css('border-color', 'yellow');
    } 
    var total_score = score+exp_max_5+sc;
    var x = (total_score >=50) ? 50: total_score; 

    var clean = (isNaN(x))? '' : x;
    
    $('.total_score').val(clean);
  });


});