$(function() {
	$("input[data-preview]").change(function() {
		var input = $(this);
		var oFReader = new FileReader();
		oFReader.readAsDataURL(this.files[0]);
		oFReader.onload	= function(oFREvent) {
			$(input.data('preview')).attr('src', oFREvent.target.result);
		};
	});
})