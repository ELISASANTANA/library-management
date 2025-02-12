$(function() {

	$('.alert').each(function() {
		//$(this).removeWithAnimation();
	});
	
	$('body').on('click', '.alert .btn-close-alert', function() {
		$(this).closest('.alert').removeWithAnimation();
	});

});
 
$.fn.xAlert = function(type, text, list, icon) {

	var defaultIcons = {
		danger: 'fas fa-exclamation-circle',
		success: 'fas fa-check-circle',
		default: 'fas fa-information-circle',
	}

	list = list || [];
	icon = icon || (defaultIcons[type] || defaultIcons.default);

	var html = 
	`<div class="alert alert-${type} animate__animated animate__fadeIn" role="alert">
		<i class="icon ${icon}"></i>
		<div class="message">
			<span>${text}</span>
		</div>
		<button type="button" class="btn btn-icon btn-close-alert">
			<i class="far fa-close"></i>
		</button>
	</div>`;

	var $alert = $(html);

	if (list.length > 0) {

		$alert.find('.message').append('<ul></ul>');

		list.forEach(function(item) {
			$alert.find('.message ul').append(`<li>${item}</li>`);
		});
	}

	$(this).find('.alert').remove(); // Garante que apenas um alert exista no elemento pai
	$(this).prepend($alert);

	var closeTimeout = type == 'danger' ? 8 : 5;

	// Remover automaticamente o alerta após alguns segundos
	setTimeout(function() {
		$alert.removeWithAnimation();
	}, closeTimeout * 1000);

}
 