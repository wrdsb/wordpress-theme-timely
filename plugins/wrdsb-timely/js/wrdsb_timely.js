jQuery(function($) {
	//Adds inactive state to the past calendar days
	var $timely_container = $('#ai1ec-container');
	if ($('.ai1ec-contact').length) {
		$('body').addClass('hide-content');
	}
	if ($timely_container.length) {
		$timely_container.after('<img class="ajax-loader" src="' + wp.ajax_img_src + '">');
		function responsiveView() {
			var currentURL = window.location.href;
			if ($(window).width() < 500) {
				if (currentURL.indexOf('action~agenda') == -1) {
					window.location = $('#ai1ec-view-agenda').attr('href');
				}

				else {
					$('.ajax-loader').fadeOut();
					$('#ai1ec-container').slideDown();
				}
			}
			else {
				if (currentURL.indexOf('action~month') == -1) {
					window.location = $('#ai1ec-view-month').attr('href');
				}

				else {
					$('.ajax-loader').fadeOut();
					$('#ai1ec-container').slideDown();
				}
			}
		}

		responsiveView();

		$(window).on('resize', function() {
			$('#ai1ec-container').slideUp();
			$('.ajax-loader').fadeIn();
			responsiveView();
		});

		$('.ai1ec-agenda-view .ai1ec-event-header').click(function(e) {
			e.preventDefault();
			e.stopPropagation();
			window.location = $(this).siblings('.ai1ec-event-summary').find('.ai1ec-read-more').attr('href');
		});

		$timely_container.find('.ai1ec-week td').not('.ai1ec-empty').each(function() {
			if ($(this).hasClass('ai1ec-today')) {
				return false;
			}
			$(this).addClass('inactive');

		});
		$timely_container.on('click', 'a.ai1ec-category', function() {
			setTimeout(function() {
				filter_cats();
			}, 1500);

		});

		filter_cats();


		function filter_cats() {
			$('.ai1ec-category-filter .ai1ec-dropdown-menu div').each(function() {
				if ($(this).find('a').html().indexOf('Grade 7') > -1 || $(this).find('a').html().indexOf('Grade 8') > -1 || $(this).find('a').html().indexOf('Grade 7 & 8') > -1 || $(this).find('a').html().indexOf('Highschool') > -1) {

				} else {
					$(this).remove();
				}

			});
		}
		$('.ai1ec-day').each(function() {
			var $popup = $(this).find('.ai1ec-popover-content');
			var bg_color = $('.ai1ec-event').css('color');

			$popup.css({'background-color': bg_color});
		})
		$timely_container.append('<div class="calendar-legend"></div>').children('.calendar-legend').html($('.ai1ec-filters .ai1ec-dropdown-menu').html());

	}

});