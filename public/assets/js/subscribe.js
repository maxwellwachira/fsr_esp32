function newsletter(){
  var email = $("#news_email").val();
  if(!email){
    $('#news_op').html('<hr><div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Please enter your Email Address</div>'); 
  }else{
    $('#news_op').html('');
    $.ajax({  
        url:"/subscribe",  
        method:"POST",  
        data:{
          email:email,
        },
        dataType: 'text', 
        success:function(data)  
        { 
           console.log(data);
           var response = JSON.parse(data);
           if (response.message !== 'success') {
              if(response.message == 'exists'){
                 $('#news_op').html('<hr><div class="alert alert-primary animated bounce" role="alert"><i class="fa fa-check animated swing infinite"></i> User Exists in News letter list</div>');
                
              }
              else{
               $('#news_op').html('<hr><div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> ' + response.message +'</div>');
                 
                }
        }else{
           $('#news_op').html('<hr><div class="alert alert-success animated bounce" role="alert"><i class="fa fa-check animated swing infinite"></i> ' + response.message +'</div>');
            $("#news_email").val('');
        }
      },
      error: function (jqXhr, textStatus, errorThrown) {
            
            $('#news_op').html('<hr><div class="alert alert-danger animated bounce" role="alert"><i class="fa fa-warning animated swing infinite"></i> Contact system Admin. System error</div>');
            console.log(jqXhr + " || " + textStatus + " || " + errorThrown);
        } 
  });
}
}

$(document).ready(function() {
  $('#newsletter_button').click(function(){
    newsletter();
    return false;
  });
});