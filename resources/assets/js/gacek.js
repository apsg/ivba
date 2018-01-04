$(document).ready(function(){

	$(document).on('click', '.confirm', function(e){
		if(!confirm('Czy na pewno?')){
			e.preventDefault();
		}
	});
	

    $(document).on('change', '.editable', function(e){

        var data = {
            model:  $(this).data('model'),
            field:  $(this).data('col'),
            id:     $(this).data('id'),
            value:  $(this).val(),
            _token: $('meta[name=csrf-token]').attr('content')
        }

        var input = $(this);

        $.post( window.baseUrl+'/admin/update_editable', data).done(function(r){
            console.log(r);

            input.css({border: '1px solid green'});
        });

    });

});


function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}