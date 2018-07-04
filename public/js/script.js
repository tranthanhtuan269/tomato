$('select[name=target_language]').change(function(){
	$('select[name=source_language2]').val($(this).val());
})