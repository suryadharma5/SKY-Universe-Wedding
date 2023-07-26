$(function (){
    $.ajaxSetup({
        headers : {'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')}
    })

    // let vaNum = $('#no').val();

    $(function(){
        $('#payment').on('change', function(){
            let bank = $('#payment').val()
            console.log(bank)
            $.ajax({
                type: 'POST',
                url : '/virtualAccount',
                data : {bank:bank},
                caches : false,

                success: function(data){
                    $('#no').val(data)
                },
                error: function(xhr, textStatus, error) {
                    console.log('ajax error');
                    console.log(xhr);
                }
                
            })
        })

        
    })

})