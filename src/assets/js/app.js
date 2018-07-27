import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

$(document).foundation();

$('.btn-cta').click(function () {
	 $('#cta_modal, #cta_overlay').addClass('show');
});
$('.menu-contact>a').click(function () {
	 $('#cta_modal, #cta_overlay').addClass('show');
});
$('.cta-close').click(function () {
	$('#cta_modal, #cta_overlay').removeClass('show');
});

var a = 0;
$(window).scroll(function() {
	var oTop = $('#counter').offset().top - window.innerHeight;
	if (a == 0 && $(window).scrollTop() > oTop) {
		$('.about-number').each(function() {
			var $this = $(this),
				countTo = $this.attr('data-count');
			$({
				countNum: $this.text()
			}).animate({
					countNum: countTo
				}, {
					duration: 2000,
					easing: 'swing',
					step: function() {
						$this.text(Math.floor(this.countNum));
					},
					complete: function() {
						$this.text(this.countNum);
					}
				});
		}); a = 1;
	}
});



// porfolio
/*
var $btn_filter = $('.partner-filter .filter-item');
$btn_filter.click(function(e) {
	e.preventDefault();
	var $category = $(this).data('category');
	var $portfolioItems = $('.partners-container .partners-art');
	$btn_filter.removeClass('active');
	$(this).addClass('active');
	$portfolioItems.hide();
	$('.partners-container .partners-art' + '.' + $category).show();
	if($category == 'all'){
		$portfolioItems.show();
	}
});

*/

	
	/**
	 * Retrieve posts
	 */
	function get_posts($params) {
		
		var $container = $('#container-async'),
		$content   = $container.find('.ajax-content'),
		$status    = $container.find('.status');
		
		//$status.text('Loading posts ...');
		
		$.ajax({
			url: bobz.ajax_url,
			data: {
				action: 'do_filter_posts',
				nonce: bobz.nonce,
				params: $params
			},
			type: 'post',
			dataType: 'json',
			success: function(data, textStatus, XMLHttpRequest) {
				
				if (data.status === 200) {
					$content.html(data.content);
				}
				else if (data.status === 201) {
					$content.html(data.message);
				}
				else {
					$status.html(data.message);
				}
			},
			error: function(MLHttpRequest, textStatus, errorThrown) {
				
				$status.html(textStatus);
				
				/*console.log(MLHttpRequest);
				 console.log(textStatus);
				 console.log(errorThrown);*/
			},
			complete: function(data, textStatus) {
				
				var msg = textStatus;
				
				if (textStatus === 'success') {
					msg = data.responseJSON.found;
				}
				
				$status.text('Posts found: ' + msg);
				
				/*console.log(data);
				 console.log(textStatus);*/
			}
		});
	}
	
	/**
	 * Bind get_posts to tag cloud and navigation
	 */
	$('#container-async').on('click', 'a[data-filter], .pagination a', function(event) {
		if(event.preventDefault) { event.preventDefault(); }
		
		var $this = $(this);
		
		/**
		 * Set filter active
		 */
		if ($this.data('filter')) {
			$this.closest('ul').find('.active').removeClass('active');
			$this.parent('li').addClass('active');
			var $page = $this.data('page');
		}
		else {
			/**
			 * Pagination
			 */
			$page = parseInt($this.attr('href').replace(/\D/g,''));
			$this = $('.partner-filter .active a');
		}
		var $params    = {
			'page' : $page,
			'tax'  : $this.data('filter'),
			'term' : $this.data('term'),
			'qty'  : $this.closest('#container-async').data('paged'),
		};
		
		// Run query
		get_posts($params);
	});
	
	$('a[data-term="all-terms"]').trigger('click');

