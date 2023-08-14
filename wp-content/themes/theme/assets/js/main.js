

/* SPINCREMENT */
!function(t){t.extend(t.easing,{spincrementEasing:function(t,a,e,n,r){return a===r?e+n:n*(-Math.pow(2,-10*a/r)+1)+e}}),t.fn.spincrement=function(a){function e(t,a){if(t=t.toFixed(a),a>0&&"."!==r.decimalPoint&&(t=t.replace(".",r.decimalPoint)),r.thousandSeparator)for(;o.test(t);)t=t.replace(o,"$1"+r.thousandSeparator+"$2");return t}var n={from:0,to:null,decimalPlaces:null,decimalPoint:".",thousandSeparator:",",duration:1e3,leeway:50,easing:"spincrementEasing",fade:!0,complete:null},r=t.extend(n,a),o=new RegExp(/^(-?[0-9]+)([0-9]{3})/);return this.each(function(){var a=t(this),n=r.from;a.attr("data-from")&&(n=parseFloat(a.attr("data-from")));var o;if(a.attr("data-to"))o=parseFloat(a.attr("data-to"));else if(null!==r.to)o=r.to;else{var i=t.inArray(r.thousandSeparator,["\\","^","$","*","+","?","."])>-1?"\\"+r.thousandSeparator:r.thousandSeparator,l=new RegExp(i,"g");o=parseFloat(a.text().replace(l,""))}var c=r.duration;r.leeway&&(c+=Math.round(r.duration*(2*Math.random()-1)*r.leeway/100));var s;if(a.attr("data-dp"))s=parseInt(a.attr("data-dp"),10);else if(null!==r.decimalPlaces)s=r.decimalPlaces;else{var d=a.text().indexOf(r.decimalPoint);s=d>-1?a.text().length-(d+1):0}a.css("counter",n),r.fade&&a.css("opacity",0),a.animate({counter:o,opacity:1},{easing:r.easing,duration:c,step:function(t){a.html(e(t*o,s))},complete:function(){a.css("counter",null),a.html(e(o,s)),r.complete&&r.complete(a)}})})}}(jQuery);
/* SPINCREMENT END */

/* CUSTOM */
$(document).ready(function() {

	/* Код отвечает за запись в куки названия раздела или блока или страницы,
	 чтобы потом передать в аналитику dataLayer в детальной странице купона (сам код находится в detail-products.js)
	 */
	$('a#click_products').click(function() {
		let a = $(this).parents('#item_list_name').attr('item_list_name');
		document.cookie = `item_list_name=`+ a +`;path=/; max-age=360000`;

	})
	/* Конец */

	/* Код отвечает за запись в куки названия раздела или блока или страницы,
         чтобы потом передать в аналитику dataLayer в детальной странице купона (сам код находится в detail-products.js)
         */
	$('a#data_analitics').click(function(e) {
		// e.preventDefault();
		// console.log(true);
		let data_block = $(this).parent().find('.data_analitics_click');
		dataLayer.push({
			event: 'begin_checkout', /// не изменяется,
			ecommerce: {
				currency: 'IDR',  /// Indian Rupee, постоянная величина
				value: data_block.attr('new-price'), /// передаем стоимость продукта
				items: [
					{
						item_id: data_block.attr('item_id'), //// передаем идентификатор продукта, если имеется;
						item_name: data_block.attr('item_name'), //// передаем название продукта
						affiliation: data_block.attr('affiliation'), /// передаем название кампании-партнера: Amazon, Ekaro, ExtraPet
						item_brand: data_block.attr('item_brand'), /// передаем магазины продуктов: Amazon, Boat и др.
						item_category: data_block.attr('item_category'), /// передаем категорию продуктов: Fashion, Travel, Pets и др.
						item_list_name: data_block.attr('item_list_name'), /// передаем значение того как пользователь нашел продукт: Categories, Shops, Coupons, Daily Tops
						price: data_block.attr('price'), /// передаем стоимость продукта
						quantity: 1 /// передаем количество; в нашем случае всегда равна 1
					}
				]
			}
		});

	})
	/* Конец */



	$('header .header__search form#searchformheader').submit(function(e){
		e.preventDefault()
		e.stopPropagation()
		const formData = new FormData(e.target)
		$('header .header__search .header__search_spinner').html('<div id="preloader"><div id="loader"></div></div>');
		$('span.action__search, .action__search__img').hide();
		setTimeout(()=>{
			window.location.href = '/?s=' + formData.get('s')
		},400)

	})



	/* preloader */
	setTimeout(() => {
		$('.preloader').animate({
			opacity: 0
		}, 200, function() {
			$('.preloader').remove();
		});
	},100)
	/* preloader END */


	setTimeout(() => {
		$('body').animate({
			opacity: 1
		}, 300)
	},500)


	$('.header .header__search #search').on('keyup',function(){
		var $this = $(this),
			val = $this.val();

		if(val.length >= 1){
			$('.header .header__search-form').addClass('active');
		}else {
			$('.header .header__search-form').removeClass('active');
		}
	});

	var width = $(window).width();
	$(function(){
		$(".success").delay(3000).slideUp(300);
	});

	if( width < 768 ) {
		$(".action__search").click(function(e) {
			e.preventDefault();
			$("body").removeAttr("class");
			$("body").addClass("open__search");
		});

		$(".header__back").click(function(e) {
			e.preventDefault();
			$("body").removeAttr("class");
		});

		$(".action__cat").click(function(e) {
			e.preventDefault();
			$("body").toggleClass("open__cat");
			$("body").toggleClass("open__back");
		});
	} else {
		$(".header__nav-cat a").click(function(e) {
			e.preventDefault();
			$("body").toggleClass("open__cat");
		});

		$(document).mouseup( function(e) {
			if( $("body").hasClass("open__notify") && ($(".notify__content").is(e.target) || $(".notify__content").has(e.target).length === 0) ) {
				$("body").removeClass("open__notify");
			}
			if( $("body").hasClass("open__user") && ($(".header__user-menu").is(e.target) || $(".header__user-menu").has(e.target).length === 0) ) {
				$("body").removeClass("open__user");
			}
			if( $("body").hasClass("open__cat") && ($("nav").is(e.target) || $("nav").has(e.target).length === 0) ) {
				$("body").removeClass("open__cat");
			}
		});

	}



	$(".action__openuser").click(function(e) {
		e.preventDefault();
		$("body").toggleClass("open__user open__back");
		// $("body").toggleClass("open__back");
	});



	$(".action__notify").click(function(e) {
		e.preventDefault();
		$("body").toggleClass("open__notify");
		$("body").toggleClass("open__back");
	});



	$(".tabs__active a").click(function(e) {
		e.preventDefault();
		$(this).closest(".tabs").toggleClass("open");
	});



	$(".tabs-js ul li").click(function(e) {
		e.preventDefault();
		var tab = $(this).data('tab');
		if( tab ) {
			var name = $(this).find("a").text();
			if( name != '' ) {
				$(this).closest(".tabs-js").find(".tabs__active a").html(name);
			}
			$(this).addClass('active').siblings().removeClass('active');
			$(".tab-content").removeClass('active');
			$(".tab-content_push").removeClass('active');
			$("#" + tab).addClass('active');
			$(".tabs-js").removeClass('open');
		}
	});

	var timeSearch;

	// $("#search").on( 'keyup', function () {
	// 	clearTimeout( timeSearch );
	// 	timeSearch = setTimeout( function() {
	// 		var value = $("#search").val();
	// 		if( value != '' ) {
	// 			var data = "s=" + value + "&nonce_code=" + dcajax.nonce + "&action=dc_search";
	// 			$.ajax({
	// 				url: dcajax.url,
	// 				method: 'POST',
	// 				data: data,
	// 				dataType: 'json',
	// 				success: function(response) {
	// 					if( response.success ) {
	// 						var html = '';
	// 						$.each(response.posts, function(i, v) {
	// 							html += '<div class="header__search-item">';
	// 							html += '<div class="header__search-image"><img src="'+v.image+'" alt="'+v.title+'"></div>';
	// 							html += '<div class="header__search-link"><a href="'+v.link+'">'+v.title+'</a></div>';
	// 							html += '</div>';
	// 						});
	// 						$(".header__search-list").html(html);
	// 						$(".header__search-title").html('Results');
	// 					} else {
	// 						$(".header__search-list").html('');
	// 						$(".header__search-title").html('Nothing was found');
	// 					}
	// 					$(".header__search-result").show();
	// 				}
	// 			});
	// 		}
	// 	}, 800 );
	// });
	// $("#search").on( 'keydown', function () {
	// 	clearTimeout( timeSearch );
	// });

	// Когда вы нажимаете не по фильтру, срабатывает эта функция, которая закрывает фильтр
	$("body").mouseup( function(e){ // событие клика по веб-документу
		var div = $( ".header__search" ); // тут указываем ID элемента
		if ( !div.is(e.target) // если клик был не по нашему блоку
			&& div.has(e.target).length === 0 ) { // и не по его дочерним элементам
			$('.header__search-result').hide();
		}

	});

	$(".action_like").click(function(e) {
		e.preventDefault();
		var id = $(this).data('id'),
			obj = $(this).closest(".comment__bottom").find(".comment__like");
		if( id ) {
			var data = "nonce_code=" + dcajax.nonce + "&action=dc_like&id=" + id;
			$.ajax({
				url: dcajax.url,
				method: 'POST',
				data: data,
				dataType: 'json',
				success: function(response) {
					if( response.success ) {
						obj.addClass('active');
						obj.find('span').html(response.value);
					} else {
						if( response.message ) {
							alertDc(response.message);
						}
					}
				}
			});
		}
	});
	$(".action_fav").click(function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		if( id ) {
			var data = "nonce_code=" + dcajax.nonce + "&action=dc_fav&id=" + id;
			$.ajax({
				url: dcajax.url,
				method: 'POST',
				data: data,
				dataType: 'json',
				success: function(response) {
					if( response.message ) {
						alertDcAuthorization(response.message);
					}
				}
			});
		}
	});
	$(".product__rating-min").click(function(e) {
		e.preventDefault();
		var id = $(this).parent().data('id'),
			obj = $(this).parent().find('span');
		if( id ) {
			var data = "nonce_code=" + dcajax.nonce + "&action=dc_rating&type=minus&id=" + id;
			$.ajax({
				url: dcajax.url,
				method: 'POST',
				data: data,
				dataType: 'json',
				success: function(response) {
					if( response.success ) {
						obj.html(response.value);
					}
					if( response.message ) {
						alertDcAuthorization(response.message);
					}
				}
			});
		}
	});
	$(".product__rating-plus").click(function(e) {
		e.preventDefault();
		var id = $(this).parent().data('id'),
			obj = $(this).parent().find('span');
		if( id ) {
			var data = "nonce_code=" + dcajax.nonce + "&action=dc_rating&type=plus&id=" + id;
			$.ajax({
				url: dcajax.url,
				method: 'POST',
				data: data,
				dataType: 'json',
				success: function(response) {
					if( response.success ) {
						obj.html(response.value);
					}
					if( response.message ) {
						alertDcAuthorization(response.message);
					}
				}
			});
		}
	});

	$("#reg-form").submit(function(e) {
		e.preventDefault();
		var form = $(this).serialize();
		var data = form + "&nonce_code=" + dcajax.nonce + "&action=dc_reg";
		$.ajax({
			url: dcajax.url,
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function(response) {
				if( response.success ) {
					if( response.message ) {
						alertDc(response.message);
					}
					//window.dataLayer код для аналитики по успешному прохождению регистрации
					window.dataLayer = window.dataLayer || [];
					window.dataLayer.push({
						'event': 'sign_up_success'
					});
					//КОНЕЦ
					setTimeout( function() {
						window.location.href = "/personal";
					}, 3000);
				} else {
					if( response.message ) {
						alertDc(response.message);
					}
				}
			}
		});
		return false;
	});

	$('.changer').on('click', function(e) {
		e.preventDefault();
		$('.all_products').toggleClass('all_products_active');
	});

 	$("#login-form").submit(function(e) {
		e.preventDefault();
		var form = $(this).serialize();
		var data = form + "&nonce_code=" + dcajax.nonce + "&action=dc_login";
		$.ajax({
			url: dcajax.url,
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function(response) {
				if( response.success ) {
					//window.dataLayer код для аналитики по успешному прохождению авторизации
					window.dataLayer = window.dataLayer || [];
					window.dataLayer.push({
						'event': 'log_in_success',
					});
					//КОНЕЦ
					setTimeout( function() {
						window.location.href = "/personal";
					}, 3000);
				} else {
					if( response.message ) {
						alertDc(response.message);
					}
				}
			}
		});
		return false;
	});
	$("#personal-save").submit(function(e) {
		e.preventDefault();
		var form = $(this).serialize();
		var data = form + "&nonce_code=" + dcajax.nonce + "&action=dc_personal";
		$.ajax({
			url: dcajax.url,
			method: 'POST',
			data: data,
			dataType: 'json',
			success: function(response) {
				if( response.success ) {
					setTimeout( function() {
						window.location.href = "/personal";
					}, 3000);
				} else {
					if( response.message ) {
						alertDc(response.message);
					}
				}
			}
		});
		return false;

	});


	$("#supprt_list_elem").click(function(e) {
		e.preventDefault();
		if( $(this).hasClass("open") ) {
				$(this).removeClass("open");
			}
		else {
			$(this).addClass("open");
		}
	});
	
	$("#supprt_list_elem_2").click(function(e) {
		e.preventDefault();
		if( $(this).hasClass("open") ) {
				$(this).removeClass("open");
			}
		else {
			$(this).addClass("open");
		}
	});
	
	$("#supprt_list_elem_3").click(function(e) {
		e.preventDefault();
		if( $(this).hasClass("open") ) {
				$(this).removeClass("open");
			}
		else {
			$(this).addClass("open");
		}
	});
	
	$("#supprt_list_elem_4").click(function(e) {
		e.preventDefault();
		if( $(this).hasClass("open") ) {
				$(this).removeClass("open");
			}
		else {
			$(this).addClass("open");
		}
	});
	
	$("#supprt_list_elem_5").click(function(e) {
		e.preventDefault();
		if( $(this).hasClass("open") ) {
				$(this).removeClass("open");
			}
		else {
			$(this).addClass("open");
		}
	});
	
	$("#supprt_list_elem_6").click(function(e) {
		e.preventDefault();
		if( $(this).hasClass("open") ) {
				$(this).removeClass("open");
			}
		else {
			$(this).addClass("open");
		}
	});

	$("#alert__close").click(function(e) {
		e.preventDefault();
		$("#alert").removeClass('open');
		$('#center_alert').removeClass('open');
	});
	
	$("#alert_promo__close").click(function(e) {
		e.preventDefault();
		$("#alert_promo").removeClass('open');
		$("#center_alert_promo").removeClass('open');
	});

	$("#alert_authorization__close").click(function(e) {
		e.preventDefault();
		$("#alert_authorization").removeClass('open');
		$("#center_alert_authorization").removeClass('open');
	});

	$(".action_copy").click(function(e) {
		e.preventDefault();
		var val = $(this).data('val');
		if( val ) {
			var $tmp = $("<textarea>");
			$("body").append($tmp);
			$tmp.val(val).select();
			document.execCommand("copy");
			$tmp.remove();
			alertDcPromo('Promo code was copied successfully!', this);
			//alert('Promo code was copied successfully!');
		}
	});

	
	$(".action_copy_single").click(function(e) {
		e.preventDefault();
		var val = $(this).data('val');
		if( val ) {
			var $tmp = $("<textarea>");
			$("body").append($tmp);
			$tmp.val(val).select();
			document.execCommand("copy");
			$tmp.remove();
			alertDcPromo('Promo code was copied successfully!', this);
			//alert('Promo code was copied successfully!');
		}
	});
    return false;

	if( $("#upload-files").length ) {
		$("html").on("dragover", function(e) {
			e.preventDefault();
			e.stopPropagation();
			$("#upload-files").addClass("hover");
		});

		$("html").on("drop", function(e) {
			e.preventDefault();
			e.stopPropagation();
			$("#upload-files").removeClass("hover");
		});

		$("#upload-files").on('drop', function (e) {
			e.stopPropagation();
			e.preventDefault();
			$("#upload-files").removeClass("hover");
			var f = e.originalEvent.dataTransfer.files;
			//var fd = new FormData();
			//fd.append('file', file[0]);
			console.log(file[0])
		});

		$("#upload-file").click(function(){
			$("#upload-files__input").click();
		});

		$("#upload-files__input").change(function(){
			var fd = new FormData();
			var files = $('#file')[0].files[0];
			fd.append('file',files);
			uploadData(fd);

		});

	}

});

function alertDc(message) {
	$("#alert__message").html(message);
	$("#alert").addClass('open');
	setTimeout( function() {
		$("#alert").removeClass('open');
	}, 10000);
}

function alertDcPromo(message, ths) {
	$(ths).html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M13.3307 4L5.9974 11.3333L2.66406 8" stroke="#ADADAD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>');
	setTimeout( function() {
		$(ths).html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"> <path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>');
	}, 2000);
}

function alertDcAuthorization(message) {
	if (message == 'Authorization required.') {
		$("#alert_authorization__message").html(message);
		$("#alert_authorization").addClass('open');
		$("#center_alert_authorization").addClass('open');
	}
	else {
		$("#alert__message").html(message);
		$("#alert").addClass('open');
		$("#center_alert").addClass('open');

		setTimeout( function() {
			$("#alert").removeClass('open');
			$("#center_alert").removeClass('open');
		}, 2000);
	}
}



