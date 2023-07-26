$(function (){
    $.ajaxSetup({
        headers : {'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')}
    })

    $(function(){
        $('#daerah').on('change', function(){
            let id_loc = $('#daerah').val()
            console.log(id_loc)
            $.ajax({
                type: 'POST',
                url : '/filter',
                data : {id_loc:id_loc},
                caches : false,

                success: function(msg){
                    $('#filter').html(msg)
                    console.log(msg)
                },
                error: function(xhr, textStatus, error) {
                    console.log('ajax error');
                    console.log(xhr);
                }
                
            })
        })

        
    })

})