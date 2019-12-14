<div id="proofs" class="proofs">
</div>

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){

		setTimeout(function(){
			getProof();
		}, 10*1000)

	});

function getProof(){

	$.post('{{ url('/get_proofs') }}', {
		last_proof_id: getCookie('last_proof_id'),
		last_proof_at: getCookie('last_proof_at'),
		_token: '{{ csrf_token() }}'
	}).done(function(r){
		
		$("#proofs").append(r.html);
		$("#proofs").fadeIn(400);
		
		setCookie('last_proof_id', r.proof_id, 365);
		setCookie('last_proof_at', r.proof_at, 365);

		setTimeout(function(){ clearProofs(); }, 30000);
		setTimeout(function(){ getProof(); }, 600000);

	});

}

function clearProofs(){
	$("#proofs").fadeOut(400, function(){
		$("#proofs > *").remove();
	});
}


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

</script>
@endpush