$(document).ready(function() {
	let addToCartId=$("#addToCart")
	let addToCartClass=$(".addToCart")
	let remove=$(".pro-remove")
	let button=$(".qtybtn")
	let qty=$(".qty")
	let coupon = $("#coupon")
	let like= $("#like")
	let shipping= $("[name='shipping_id']")


	//create modal ajax
	$("#modal").iziModal({
		// title: '',
		// subtitle: '',
		// headerColor: '#88A0B9',
		// background: null,
		// theme: '',  // light
		// icon: null,
		// iconText: null,
		// iconColor: '',
		// rtl: false,
		width: 700,
		height:300,
		// top: null,
		// bottom: null,
		// borderBottom: true,
		// padding: 0,
		// radius: 3,
		// zindex: 999,
		// iframe: false,
		// iframeHeight: 400,
		// iframeURL: null,
		// focusInput: true,
		// group: '',
		// loop: false,
		// arrowKeys: true,
		// navigateCaption: true,
		// navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
		// history: false,
		// restoreDefaultContent: false,
		// autoOpen: 0, // Boolean, Number
		// bodyOverflow: false,
		// fullscreen: false,
		// openFullscreen: false,
		// closeOnEscape: true,
		// closeButton: true,
		appendTo: '#abc', // or false
		// appendToOverlay: 'body', // or false
		// overlay: true,
		// overlayClose: true,
		// overlayColor: 'rgba(0, 0, 0, 0.4)',
		// timeout: false,
		// timeoutProgressbar: false,
		// pauseOnHover: false,
		// timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
		// transitionIn: 'comingIn',
		// transitionOut: 'comingOut',
		// transitionInOverlay: 'fadeIn',
		// transitionOutOverlay: 'fadeOut',
		// onFullscreen: function(){},
		onResize: function(){
			$(".iziModal-content").css("max-height","400");
		},
		onOpening: function(modal){




		},
		onOpened: function(){
			// Instantiate EasyZoom instances
			var $easyzoom = $('.easyzoom').easyZoom();

// Setup thumbnails example
			var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
			$('.pro-qty').prepend('<span class="dec qtybtn"><i class="ti-minus"></i></span>');
			$('.pro-qty').append('<span class="inc qtybtn"><i class="ti-plus"></i></span>');
			$('.qtybtn').on('click', function() {
				var $button = $(this);
				var oldValue = $button.parent().find('input').val();

				if ($button.hasClass('inc')) {
					var newVal = parseFloat(oldValue) + 1;
				} else {
					// Don't allow decrementing below zero
					if (oldValue > 0) {
						var newVal = parseFloat(oldValue) - 1;
					} else {
						newVal = 0;
					}
				}
				$button.parent().find('input').val(newVal);
			});
			$('.pro-thumb-img').on('click', 'a', function(e) {
				var $this = $(this);

				e.preventDefault();
				console.log($this);


				// Use EasyZoom's `swap` method
				api1.swap($this.data('standard'), $this.attr('href'));
			})
			$(".change-color").click(function(){

				$(this).siblings().removeClass('pick-color')
				$(this).addClass('pick-color')
				$val=$(this).data('field')
				num=$(this).data('name')
				$this=$("#pro-thumb-img li:eq("+num+") a");
				// console.log($this);

				//thay doi mau sac
				let color=$(".pick-color").data('color');
				$("[name='color']").val(color)

				//pick hinh o slider
				var $easyzoom = $('.easyzoom').easyZoom();
				var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
				api1.swap($this.data('standard'), $this.attr('href'));


				// alertify.log('Bạn vừa chọn màu '+$name);
				$('.price').text(format($val))
				$('[name="price"]').val($val)
				// console.log($val);


			})
			$("#addToCart").click(function (e) {


				$currentElement=$(this)

				let id=$(this).parent().prev().find("#cart_id").val()
				let url=$(this).parent().prev().find("#cart_url").val()
				let qty=$(this).parent().prev().find("#cart_qty").val()
				let price=$('[name="price"]').val();
				let color=$('[name="color"]').val();
				let image=$(".pro-large-img a").attr('href');

				let data={id,qty,url,price,image,color}
				callAjax($currentElement, url,'add',data);
				e.preventDefault()

			});
			/*var url = "/assets/js/my-js.js";
			$.getScript(url);*/

		},
		// onClosing: function(){},
		onClosed: function(){
		},
		// afterRender: function(){}
	});

	$(".trigger").on('click', function (event) {
		event.preventDefault();
		id=$(this).attr('href')

		$.get(modal.replace(1, id), function(data) {
			$("#modal .iziModal-content").html(data);
			$('.pro-thumb-img').slick({
				arrows: true,
				dots: false,
				autoplay: true,
				infinite: true,
				slidesToShow: 4,
				prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
				responsive: [
					{
						breakpoint: 1199,
						settings: {
							slidesToShow: 3,
						}
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 4,
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 4,
						}
					},
					{
						breakpoint: 479,
						settings: {
							slidesToShow: 3,
						}
					}
				]
			});




			// modal.stopLoading();
		});
		$('#modal').iziModal('open');
	});


	//lay mau mac dinh
	let color=$(".pick-color").data('color');
	$("[name='color']").val(color)

	//thay doi gia
	$(".change-color").click(function(){

		$(this).siblings().removeClass('pick-color')
		$(this).addClass('pick-color')
		$val=$(this).data('field')
		num=$(this).data('name')
		$this=$("#pro-thumb-img li:eq("+num+") a");
		// console.log($this);

		//thay doi mau sac
		let color=$(".pick-color").data('color');
		$("[name='color']").val(color)

		//pick hinh o slider
		var $easyzoom = $('.easyzoom').easyZoom();
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
		api1.swap($this.data('standard'), $this.attr('href'));


		// alertify.log('Bạn vừa chọn màu '+$name);
		$('.price').text(format($val))
		$('[name="price"]').val($val)
	    // console.log($val);
	    
	    
	})
	//chon so phan tu phan trang o category product
	$(".nice-selects").change(function(){
		val=$(this).val()

		var pathname	= location.pathname; // http://fashion.test + pathname +search
		let params 		= ['price_min','price_max','order','search'];
		
		console.log(location);
		
		
		let searchParams= new URLSearchParams(location.search);	// search
		

		let link		= "";
		$.each( params, function( key, param ) { // filter_status
			if (searchParams.has(param) ) {
				link += param + "=" + searchParams.get(param) + "&" // filter_status=active
			}
		});
		console.log(link);
		

		lo = pathname + "?" + link + 'show='+val
		location.href=lo
		

	    
	})
	$(".nice-selects2").change(function(){
		val=$(this).val()

		var pathname	= location.pathname; // http://fashion.test + pathname +search
		let params 		= ['price_min','price_max','show','search'];

		console.log(location);


		let searchParams= new URLSearchParams(location.search);	// search


		let link		= "";
		$.each( params, function( key, param ) { // filter_status
			if (searchParams.has(param) ) {
				link += param + "=" + searchParams.get(param) + "&" // filter_status=active
			}
		});
		console.log(link);


		lo = pathname + "?" + link + 'order='+val
		location.href=lo



	})

	//wishlist
	$(".wishlist").click(function(e){
		id=$(this).parent().find('.cart_id').val();
		// confirm dialog
		url=$(".addWishList").val();
		let data={id,url}
		// console.log(data);
		
		e.preventDefault()
		
		callAjax($(this), url,'wishlist',data);
	})

	
	//submit subscribe
	function validateEmail(email)
	{
		var re = /\S+@\S+\.\S+/;
		return re.test(email);
	}
	$("#mc-submit").click(function(e){
		url=$("#subscribe_url").val();
		email=$("#mc-email").val();
		if(validateEmail(email)){
			let data={email,url}
			console.log(data);

			e.preventDefault()
			callAjax($(this), url,'subscribe',data);

		}else{
			alertify.alert("Vui lòng nhập đúng định dạng email");

		}




	})

	//thay doi thong tin khach hang
	$("#open_pass").change(function(){
		if($('#open_pass').is(":checked"))
			$("#box").show();
		else
			$("#box").hide();
	})



	//thay doi gia ship
	shipping.change(function(e){
	    url=$("#url").val();
	    id=$(this).val();
		let data={id,url}


		e.preventDefault()


		callAjax($(this), url,'shipping',data);
	})


	//rating
	$(".my-rating-4").starRating({
		totalStars: 5,
		starShape: 'rounded',
		starSize: 20,
		emptyColor: 'lightgray',
		hoverColor: 'salmon',
		activeColor: 'crimson',
		useGradient: false,
		readOnly: true
	});
	$(".my-rating-3").starRating({
		totalStars: 5,
		starShape: 'rounded',
		starSize: 20,
		emptyColor: 'lightgray',
		hoverColor: 'crimson',
		activeColor: 'crimson',
		useGradient: false,
		callback: function(currentRating, $el){
			$score=$(".my-rating-3").starRating('getRating')
			$("[name='score']").val($score)
			console.log($score);

		}
	});
	// add coupon
	coupon.click(function (e) {
		let code=$(this).prev().val()
		let url=$(this).next().val()

		let data={code:code,url:url}
		console.log(data);


		e.preventDefault()


		callAjax($(this), url,'coupon',data);

	});
	// like article
	like.click(function (e) {
		let url=$(this).attr('href');
		console.log(url);


		e.preventDefault()


		callAjax($(this), url,'like');

	});
	// add to cart for trang chi tiet san pham
	addToCartId.click(function (e) {


		$currentElement=$(this)

		let id=$(this).parent().prev().find("#cart_id").val()
		let url=$(this).parent().prev().find("#cart_url").val()
		let qty=$(this).parent().prev().find("#cart_qty").val()
		let price=$('[name="price"]').val();
		let color=$('[name="color"]').val();
		let image=$(".pro-large-img a").attr('href');

		let data={id,qty,url,price,image,color}
		console.log(data);



		callAjax($currentElement, url,'add',data);
		e.preventDefault()

	});

	//remove san pham trong gio hang
	remove.click(function (e) {
		$currentElement=$(this)
		$(".discount").text('')

		let rowId=$(this).next($(".rowId")).val()

		$(this).parent().remove();
		let url=$(this).prev().prev($(".url")).val()

		let data={rowId:rowId}
		callAjax($currentElement, url,'',data);
		e.preventDefault()


	});

	//bam tru cong san pham

	button.click(function (e) {
		let qty=$(this).parents().eq(2).find(".qty").val()
        $(".discount").text('')

		let rowId=$(this).parents().eq(2).find(".rowId").val()
		let price=$(this).parents().eq(2).find(".price").val()
		let url=$(this).parents().eq(2).find(".url-update").val()
		$currentElement=$(this).parents().eq(2).find(".subtotal")

		let data={qty:qty,rowId:rowId,price:price}
		console.log(data);

		callAjax($currentElement, url,'',data);
		if(qty==0){
			console.log($(this).parent().parent().parent().remove());
			
			// $(this).parent().parent().parent().hide();
		}
		e.preventDefault()


	});
	//thay doi so luong san pham
	qty.change(function (e) {
		let qty=$(this).parents().eq(2).find(".qty").val()
		let rowId=$(this).parents().eq(2).find(".rowId").val()
		let price=$(this).parents().eq(2).find(".price").val()
		let url=$(this).parents().eq(2).find(".url-update").val()
		$currentElement=$(this).parents().eq(2).find(".subtotal")

		let data={qty:qty,rowId:rowId,price:price}
		console.log(data);

		callAjax($currentElement, url,'',data);
		e.preventDefault()


	});



});



function showNotify(message, type = 'success') {
	if(type=='success'){
		alertify.success(message);
	}else if(type=='error'){
		alertify.error(message);
	}else{
		alertify.log(message);

	}

}

function format(num){
	return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'vnd' }).format(num)
}

function callAjax(element, url, type,data='') {
	let cart_count= $("#cart_count")
	let cart_total= $("#cart_total")
	let subTotal= $("#subTotal")
	let total= $(".total")
	data={'data':data}




	$.ajax({
		url: url,
		type: "GET",
		data:data,
		dataType: "json",
		success: function (result) {
			console.log(result);

			if (result) {

				switch (type) {
					case 'subscribe':
						//thay doi thong tin customer
						if(result.message==0){
							alertify.alert("email đã được đăng ký,vui lòng nhập email khác");
						}else{
							alertify.alert("Bạn đã đăng kí subcribe trang web của chúng tôi");
						}



						break;
					case 'customer':
						//thay doi thong tin customer

						showNotify('');

						break;
					case 'wishlist':
						//thay doi thong tin customer

						if(result.message==0){
							alertify.error("sản phẩm đã tồn tại trong danh mục ưa thích");
						}else{
							alertify.success("bạn vừa thêm vào danh mục ưa thích");
							$("#get_wishlist_num").text(result.count)
						}

						break;
					case 'shipping':
						//thay doi gia ship
						console.log(result);
						$(".fee").html("<span class='color-red'>+"+format(result.fee)+"</span>")
						$(".total").html("<span class='color-red'>"+format(result.total)+"</span>")
						$("[name='amount']").val(result.total) //tong gia tien

						showNotify('bạn đã chọn : '+result.method,'log');

					break;
					case 'coupon':
						if(result.message.message==0){
							showNotify( 'Coupon không tồn tại hoặc đã hết hạn sử dụng','error');
							$(".discount").text("")

						}else{
							showNotify('Coupon hợp lệ');
							console.log(result.message.type);

							if(result.message.type=='percent'){
								$(".discount").text("-"+result.message.amount+'%')
							}else{
								$(".discount").text("-"+format(result.message.discount))
							}
						}
						total.text(format(result.total))


						break;
					case 'add':
						//add to cart
						cart_count.text(result.count)
						cart_total.text("("+format(result.subTotal)+")")
						showNotify( result.message);

						break;

					case 'like':
						element.parent().next().text(result.like+ " likes")
						element.parent().remove();
						break;
					default :
						//update cart,delete cart
						cart_count.text(result.count)
						cart_total.text("("+format(result.subTotal)+")")
						subTotal.text(format(result.subTotal))
						total.text(format(result.total))
						element.text(format(result.subEach))

						if(result.subTotal==0){
							window.location.href = window.location.origin;
							showNotify("Bạn đã xóa hết giỏ hàng của bạn");

						}
						showNotify(result.message);



						break;

				}
			} else {

			}
		},
	});
}

