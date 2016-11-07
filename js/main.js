$(document).ready(function() {

	$('.fancybox').fancybox({
		padding: 0,
		scrolling: 'auto',
		helpers : {
	        overlay : {
	            css : {
	                'background' : 'rgba(0, 0, 0, 0.80)'
	            }
	        }
    	},
 	   	tpl: {
			closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"><i class="fa fa-remove"></i></a>',
			next     : '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span><i class="fa fa-arrow-right"></i></span></a>',
			prev     : '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span><i class="fa fa-arrow-left"></i></span></a>'
		}
	});

	$('a[rel*=leanModal]').leanModal({ top : 200, overlay : 0.4, closeButton: '.modal_close' });

	// $('video,audio').mediaelementplayer();

});

function rotateMedium(medium, degree)
{
	$.get('ajax.php?action=rotateMedium&medium=' + medium + '&degree=' + degree, function(data) {
		$('#sys_message_overlay .message').html('Medium ' + medium + ' successfully rotated.');
		$('#sys_message_overlay').fadeIn('fast').delay(2000).fadeOut('fast', function(){
			location.reload();
		});
	});
}

function deleteMedium(medium, mediumId)
{
	$.get('ajax.php?action=deleteMedium&medium=' + medium, function(data) {
		$('#sys_message_overlay .message').html('Medium ' + medium + ' successfully deleted.');
		$('#sys_message_overlay').fadeIn('fast').delay(2000).fadeOut('fast');
		$('#' + mediumId).fadeOut('fast').remove();
	});
}

function importMedia()
{
	$.get('ajax.php?action=importMedia', function(data) {
		$('#sys_message_overlay .message').html(data);
		$('#sys_message_overlay').fadeIn('fast').delay(2000).fadeOut('fast', function(){
			location.reload();
		});
	});
}