function addFn(id) {
    const divEle = document.getElementById("inputFields"+id);
    const wrapper = document.createElement("div");
    const iFeild = document.createElement("input");
    iFeild.setAttribute("type", "text");
    iFeild.setAttribute("id","search_member_id"+id)
    iFeild.setAttribute("name","search_member_id"+id)
    iFeild.setAttribute("placeholder", "Enter value");
    iFeild.classList.add("input-field");

    wrapper.appendChild(iFeild);
    divEle.appendChild(wrapper);

    document.getElementById(id).addEventListener('click', function(event) {
// Disable the button to prevent further clicks
event.target.disabled = true;
    });
    $(document).ready(function(){
 $('#search_member_id'+id).on('keyup',function(){
     var query= $(this).val();
     $.ajax({
        url:"searchuser",
        type:"GET",
        data:{'search':query},
        success:function(data){
            $('#search_list'+id).html(data);
        }
 });
 //end of ajax call
});
});

    }
