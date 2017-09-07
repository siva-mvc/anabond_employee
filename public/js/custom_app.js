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

});