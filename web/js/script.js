$(function(){
    
    $(".halls .scroll_block").jScrollPane();

    $(".status_update").click(function(){
        statusUpdate($(this).attr('data-status'), $(this).data('id'));
    });
   
});

function statusUpdate(status, id){
    
    var elem = $("#elem_" + id);
    
    $.ajax({
        url: "/order/status_update",
        data: {
            status: status,
            id: id
        }
    }).success(function(data){
        
        var result = JSON.parse(data);
        if(result.status === "working"){
            elem.removeClass("status_new").addClass("status_working");
            
            var html = '<div class="name">Заказ принял:</div><div>' + result.hookah_man + '</div>';
            var link = elem.find(".status_update");
            
            link.removeClass("btn-danger").addClass("btn-success");
            link.before(html);
            link.attr("data-status", "working");
            link.text("закрыть");
            
        } else if (result.status === "closed"){
            elem.fadeOut(300, function(){
                elem.remove();
            });
        }
    });
}