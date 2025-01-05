
$(document).ready(function(){
    $('#search_member_id').on('keyup',function(){
        var query= $(this).val();
        $.ajax({
           url:"searchuser",
           type:"GET",
           data:{'search':query},
           success:function(data){
               $('#search_list').html(data);
           }
    });
    //end of ajax call
   });
   });
