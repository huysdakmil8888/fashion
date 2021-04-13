$(document).ready(function() {
	let addToCartId=$("#addToCart")
	let addToCartClass=$(".addToCart")
	let remove=$(".pro-remove")
	let button=$(".qtybtn")
	let qty=$(".qty")
	let coupon = $("#coupon")
	let like= $("#like")
	let shipping= $("[name='shipping_id']")


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
			$("[name='rating']").val($score)
			console.log($score);

		}
	});
	// add to cart
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

		let data={id,qty,url}
		console.log(data);


		callAjax($currentElement, url,'add',data);
		e.preventDefault()

	});
	// add to cart cho cac item con
	addToCartClass.click(function (e) {


		$currentElement=$(this)

		let id=$(this).parent().find(".cart_id").val()
		let url=$(this).parent().find(".cart_url").val()
		let qty=$(this).parent().find(".cart_qty").val()

		let data={id,qty,url}
		console.log(data);


		callAjax($currentElement, url,'add',data);
		e.preventDefault()

	});
	//remove san pham trong gio hang
	remove.click(function (e) {
		$currentElement=$(this)

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

		let rowId=$(this).parents().eq(2).find(".rowId").val()
		let price=$(this).parents().eq(2).find(".price").val()
		let url=$(this).parents().eq(2).find(".url-update").val()
		$currentElement=$(this).parents().eq(2).find(".subtotal")

		let data={qty:qty,rowId:rowId,price:price}
		console.log(data);

		callAjax($currentElement, url,'',data);
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

			if (result) {

				switch (type) {
					case 'shipping':
						//thay doi gia ship
						console.log(result);
						$(".fee").html("<span class='color-blue'>+"+format(result.fee)+"</span>")
						$(".total").html("<span class='color-blue'>"+format(result.total)+"</span>")
						$("[name='amount']").val(result.total) //tong gia tien

						showNotify('bạn đã chọn : '+result.method,'log');

					break;
					case 'coupon':
						if(result.message.message==0){
							showNotify( 'Coupon không tồn tại hoặc đã hết hạn sử dụng','error');

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

