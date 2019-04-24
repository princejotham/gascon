function addToCart(sid) {
	var a_cart = '#a_cart' + sid
	a_cart = $(a_cart).val();
	var iid = '#iid' + sid
	iid = $(iid).val();
	var ip = '#ip' + sid
	ip = $(ip).val();
	var iex = '#iex' + sid
	iex = $(iex).val();
	var sidv = '#sid' + sid
	sidv = $(sidv).val();
	var iname = '#iname' + sid
	iname = $(iname).val();
	var item_qty = '#item_qty' + sid
	item_qty = $(item_qty).val();
	var SumQty = '#SumQty' + sid
	SumQty = $(SumQty).text();
	console.log(iid, ip, iex, sidv, iname, item_qty, SumQty);

	var qty = 0;
	qty = item_qty-SumQty;
	qty = qty*(-1);

	$.ajax({
		url: 'process/add.php',
		type: 'post',
		data: {
			iid:iid,
			ip:ip,
			iex:iex,
			sidv:sidv,
			iname:iname,
			item_qty:item_qty,
			a_cart:a_cart
		},
		success: function (data) {
			showItemCart();
			$('#item_qty'+sid).val(1);
			$('#SumQty'+sid).text(qty);
		},
		error:function(){
			console.log(error);
		}
	});
}

function showItemCart(){
	$.ajax({
		url: 'includes/item-cart.php',
		type: 'post',
		success: function (data) {
			$('#item-cart').html(data);
			showItemConfirmCart();
		},
		error: function(){
			console.log(error);
		}
	});
}

showItemCart();

function showItemConfirmCart(){
	$.ajax({
		url: 'includes/item-confirm-cart.php',
		type: 'post',
		success: function (data) {
			$('#item-confirm-cart').html(data);
			console.log('Update Confirm Cart');
		},
		error: function(){
			console.log(error);
		}
	});
}

$(document).on('click', '#amount_tendered', function(event) {
  event.preventDefault();
  $('#modalTran').modal('hide');
  $('#modal_amount_tendered').modal('show');
});