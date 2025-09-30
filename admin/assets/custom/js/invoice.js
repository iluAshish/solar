/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Invoice create init Js File
*/

var paymentSign = "";
//Array.from(document.getElementsByClassName("product-line-price")).forEach(function (item) {
	//item.value = paymentSign +"0.00"
//});
function otherPayment() {
	var paymentType = document.getElementById("choices-payment-currency").value;
	paymentSign = paymentType;


	Array.from(document.getElementsByClassName("product-line-price")).forEach(function (item) {
			isUpdate = item.value.slice(1);
			//item.value = paymentSign + isUpdate;
		});

	//recalculateCart();
}


flatpickr(".date-field", {
	enableTime: false,
	dateFormat: "d-m-Y",
});

isData();

$(document).on("keyup", ".quantity", function (event) {
	// let min = $(this).attr("min");
	// let max = $(this).attr("max");
    var qty = $(this).val();
	// debugger;
    // if (qty < min || qty > max) {
    //     $(this).next(".qty_error").html("Please enter valid quantity");
    //     return false;
    // } else {
    //     $(this).next(".qty_error").html("");
    // }
    var rate = $(this).parent().prev().find('.rate').val();
    var amount = (qty * rate) ; 
    $(this).parent().next().find('.amount').val(amount);
     
});

$(document).on("keyup", ".rate", function (event) {
    var rate = $(this).val();
    var data_rate = $(this).data("rate");
    if (rate < data_rate) {
        $(this).next(".rate_error").html("Please enter valid rate");
        return false;
    } else {
        $(this).next(".rate_error").html("");
    }
    var qty = $(this).parent().next().find('.quantity').val();
    //alert(qty);
    var amount = (qty != 0) ? (qty * rate) : 0 ; 
    $(this).parent().next().next().find('.amount').val(amount);
     
});

function isData() {
	var plus = document.getElementsByClassName("plus"),
		minus = document.getElementsByClassName("minus");
    var discount = 0;
    var priceselection = '';    
	if (plus) {
		Array.from(plus).forEach(function (e) {
			e.onclick = function (event) {
				if (parseInt(e.previousElementSibling.value) < 10) {
				    event.target.previousElementSibling.value++;
					var itemAmount = e.parentElement.parentElement.nextElementSibling.nextElementSibling.querySelector(".rate").value;
                    var gst = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".gst").value;
                    if ($(".discount")[0]) {
    					discount = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".discount").value;
    					priceselection = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".product-line-price");
                    } else {
    					priceselection = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".product-line-price");
                    }
					var productQty = e.parentElement.querySelector(".product-quantity").value;
					console.log(discount);
					updateQuantity(productQty, itemAmount, priceselection,gst,discount);
				}
			};
		});

	}

	if (minus) {
		Array.from(minus).forEach(function (e) {
			e.onclick = function (event) {
				if (parseInt(e.nextElementSibling.value) > 1) {
					event.target.nextElementSibling.value--;
					var itemAmount = e.parentElement.parentElement.nextElementSibling.nextElementSibling.querySelector(".rate").value;
                    var gst = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".gst").value;
                    if ($(".discount")[0]) {
					    discount = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".discount").value;
					    priceselection = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".amount");
                    } else {
                        priceselection = e.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.querySelector(".amount");
                    }
					// var productQty = 1;
					var productQty = e.parentElement.querySelector(".product-quantity").value;
					console.log(productQty);
					updateQuantity(productQty, itemAmount, priceselection,gst,discount);
				}
			};
		});
	}
}

var count = 1;

function new_link_Q() {
    count = document.getElementById("row-count").value;
    document.getElementById("row-count").remove();
	count++;
	var tr1 = document.createElement("tr");
	tr1.id = count;
	tr1.className = "product";

	var delLink =
		"<tr>" +
		'<input type="hidden" id="row-count" class="row-count" value="'+count+'">' +
		'<th scope="row" class="product-id">' +
		count +
		"</th>" +
		'<td class="text-start">' +
		'<select id="productName-' + count + '" class="form-select product" name="product_name[]">'+
        '<option value="" selected="selected">Select Product</option>'+
        '</select>'+
		"</td>" + 
		"<td>" +
		'<input type="email" class="form-control mb-2 mb-md-0" placeholder="Enter rate" />' +
		"</div>" +
		"</td>" +
		"<td>" +
		'<input type="email" class="form-control mb-2 mb-md-0" placeholder="Enter rate" />' +
		"</td>" +
		//"<td>" +
		//'<input class="form-control bg-light border-0 product-price net-rate" type="number" id="net-rate-' + count + '" step="0.01" placeholder="0.00" name="net_rate[]" onblur="amountKeyup()">' +
		//"</td>" +
		
		"<td>" +
		'<input type="email" class="form-control mb-2 mb-md-0" placeholder="Enter rate" />' +
		"</td>" +		
		
		'<td class="product-removal">' +
		'<a class="btn btn-success">Delete</a>' +
		"</td>" +
		"</tr>";
    
	tr1.innerHTML = document.getElementById("newForm").innerHTML + delLink;
	document.getElementById("newlink").appendChild(tr1);
	for (var key in Products) {
        $('#productName-'+count).append('<option value="' + key + '">' + Products[key] + "</option>");
	    
	}

    $('.js-example-basic-single').select2();
	
	var genericExamples = document.querySelectorAll("[data-trigger]");
	Array.from(genericExamples).forEach(function (genericExamp) {
		var element = genericExamp;
		new Choices(element, {
			placeholderValue: "This is a placeholder set in the config",
			searchPlaceholderValue: "This is a search placeholder",
		});
	});

	isData();
	remove();
	amountKeyup();
	resetRow();
}



function new_link() {
    count = document.getElementById("row-count").value;
    document.getElementById("row-count").remove();
	count++;
	var tr1 = document.createElement("tr");
	tr1.id = count;
	tr1.className = "product";

	var delLink =
		"<tr>" +
		'<input type="hidden" id="row-count" class="row-count" value="'+count+'">' +
		'<td style="padding-left:0px !important">' +
		'<input type="text" class="form-control mb-2 mb-md-0" placeholder="Enter size" name="size[]" id="size-' + count + '" />' +
		"</div>" +
		"</td>" +
		"<td>" +
		'<input type="text" class="form-control mb-2 mb-md-0" placeholder="Enter price" name="price[]" id="price-' + count + '"/>' +
		"</td>" +
		//"<td>" +
		//'<input class="form-control bg-light border-0 product-price net-rate" type="number" id="net-rate-' + count + '" step="0.01" placeholder="0.00" name="net_rate[]" onblur="amountKeyup()">' +
		//"</td>" +
		
		'<td style="padding-right:0px !important">' +
		'<input type="text" class="form-control mb-2 mb-md-0" placeholder="Enter specification" id="specification-' + count + '" name="specification[]" />' +
		"</td>" +		
		
		'<td class="product-removal">' +
		'<a class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>' +
		"</td>" +
		"</tr>";
    
	tr1.innerHTML = document.getElementById("newForm").innerHTML + delLink;
	document.getElementById("newlink").appendChild(tr1);
}
/* Set rates + misc */
var taxRate = 0.125;
var shippingRate = 65.0;
var discountRate = 0.15;

function remove() {
	Array.from(document.querySelectorAll(".product-removal a")).forEach(function (el) {
		el.addEventListener("click", function (e) {
			removeItem(e);
			resetRow();
		});
	});
}

function resetRow() {

	Array.from(document.getElementById("newlink").querySelectorAll("tr")).forEach(function (subItem, index) {
		var incid = index + 1;
		//subItem.querySelector('.product-id').innerHTML = incid;

	});
}

/* Recalculate cart */
function recalculateCart() {
	var subtotal = 0;

	Array.from(document.getElementsByClassName("product")).forEach(function (item) {
		Array.from(item.getElementsByClassName("product-line-price")).forEach(function (e) {
			if (e.value) {
				subtotal += parseFloat(e.value.slice(1));
			}
		});
	});

	/* Calculate totals */
	var tax = subtotal * taxRate;
	var discount = subtotal * discountRate;

	var shipping = subtotal > 0 ? shippingRate : 0;
	var total = subtotal + tax + shipping - discount;

	document.getElementById("cart-subtotal").value =
		paymentSign + subtotal.toFixed(2);
	document.getElementById("cart-tax").value = paymentSign + tax.toFixed(2);
	document.getElementById("cart-shipping").value =
		paymentSign + shipping.toFixed(2);
	document.getElementById("cart-total").value = paymentSign + total.toFixed(2);
	document.getElementById("cart-discount").value =
		paymentSign + discount.toFixed(2);
	document.getElementById("totalamountInput").value =
		paymentSign + total.toFixed(2);
	document.getElementById("amountTotalPay").value =
		paymentSign + total.toFixed(2);
}

function amountKeyup() {
    var discount = 0;    
    var priceselection = '';
	// var listArray = [];

	// listArray.push(document.getElementsByClassName('product-price'));
	Array.from(document.getElementsByClassName('product-price')).forEach(function (item) {
		item.addEventListener('keyup', function (e) {
			var gst = item.parentElement.nextElementSibling.querySelector('.gst').value;
            if ($(".discount")[0]){
                discount  = item.parentElement.nextElementSibling.nextElementSibling.querySelector('.discount').value;
			    priceselection = item.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.querySelector('.product-line-price');
            } else {
                var priceselection = item.parentElement.nextElementSibling.nextElementSibling.querySelector('.product-line-price');
            }
            console.log(gst);
			var amount = e.target.value;
			var itemQuntity = item.parentElement.parentElement.querySelector('.product-quantity').value;

			updateQuantity(amount, itemQuntity, priceselection,gst,discount);

		});
	});
}

//amountKeyup();
/* Update quantity */
function updateQuantity(amount, itemQuntity, priceselection, gst,discount) {
	var linePrice = amount * itemQuntity;
	if(discount != 0) {
	    linePrice = linePrice - ((linePrice * discount) / 100);
	}
	/* Update line price display and recalc cart totals */
	var gst_amt = (linePrice * gst) / 100;
	linePrice = linePrice + gst_amt;
	priceselection.value = paymentSign + linePrice.toFixed(2);

	//recalculateCart();

}

/* Remove item from cart */
function removeItem(removeButton) {
	removeButton.target.closest("tr").remove();
	recalculateCart();
}

//Choise Js
var genericExamples = document.querySelectorAll("[data-trigger]");
Array.from(genericExamples).forEach(function (genericExamp) {
	var element = genericExamp;
	new Choices(element, {
		placeholderValue: "This is a placeholder set in the config",
		searchPlaceholderValue: "This is a search placeholder",
	});
});

//Address
function billingFunction() {
	if (document.getElementById("same").checked) {
		document.getElementById("shippingName").value =
			document.getElementById("billingName").value;
		document.getElementById("shippingAddress").value =
			document.getElementById("billingAddress").value;
		document.getElementById("shippingPhoneno").value =
			document.getElementById("billingPhoneno").value;
		document.getElementById("shippingTaxno").value =
			document.getElementById("billingTaxno").value;
	} else {
		document.getElementById("shippingName").value = "";
		document.getElementById("shippingAddress").value = "";
		document.getElementById("shippingPhoneno").value = "";
		document.getElementById("shippingTaxno").value = "";
	}
}



let viewobj;
var invoices_list = localStorage.getItem("invoices-list");
var options = localStorage.getItem("option");
var invoice_no = localStorage.getItem("invoice_no");
var invoices = JSON.parse(invoices_list);

/*if (localStorage.getItem("invoice_no") === null && localStorage.getItem("option") === null) {
	viewobj = '';
	var value = "#VL" + Math.floor(11111111 + Math.random() * 99999999);
    document.getElementById("invoicenoInput").value = value;
} else {
    viewobj = invoices.find(o => o.invoice_no === invoice_no);
}*/

// Invoice Data Load On Form
if ((viewobj != '') && (options == "edit-invoice")) {
	
	document.getElementById("registrationNumber").value = viewobj.company_details.legal_registration_no;
	document.getElementById("companyEmail").value = viewobj.company_details.email;
	document.getElementById('companyWebsite').value = viewobj.company_details.website;
	new Cleave("#compnayContactno", {
		prefix: viewobj.company_details.contact_no,
		delimiters: ['(', ')', '-'],
		blocks: [0, 3, 3, 4]
	});
	document.getElementById("companyAddress").value = viewobj.company_details.address;
	document.getElementById("companyaddpostalcode").value = viewobj.company_details.zip_code;

	var preview = document.querySelectorAll(".user-profile-image");
    if (viewobj.img !== ''){
        preview.src = viewobj.img;
    }

	document.getElementById("invoicenoInput").value = "#VAL" + viewobj.invoice_no;
	document.getElementById("invoicenoInput").setAttribute('readonly',true);
	document.getElementById("date-field").value = viewobj.date;
	document.getElementById("choices-payment-status").value = viewobj.status;
	document.getElementById("totalamountInput").value = "$" + viewobj.order_summary.total_amount;

	document.getElementById("billingName").value = viewobj.billing_address.full_name;
	document.getElementById("billingAddress").value = viewobj.billing_address.address;
	new Cleave("#billingPhoneno", {
		prefix: viewobj.company_details.contact_no,
		delimiters: ['(', ')', '-'],
		blocks: [0, 3, 3, 4]
	});
	document.getElementById("billingTaxno").value = viewobj.billing_address.tax;

	document.getElementById("shippingName").value = viewobj.shipping_address.full_name;
	document.getElementById("shippingAddress").value = viewobj.shipping_address.address;
	new Cleave("#shippingPhoneno", {
		prefix: viewobj.company_details.contact_no,
		delimiters: ['(', ')', '-'],
		blocks: [0, 3, 3, 4]
	});

	document.getElementById("shippingTaxno").value = viewobj.billing_address.tax;

	var paroducts_list = viewobj.prducts;
	var counter = 1;
	do {
		counter++;
		if (paroducts_list.length > 1) {
            document.getElementById("add-item").click();
        }
	} while (paroducts_list.length - 1 >= counter);

	var counter_1 = 1;

	setTimeout(() => {
		Array.from(paroducts_list).forEach(function (element) {
			document.getElementById("productName-" + counter_1).value = element.product_name;
			document.getElementById("productDetails-" + counter_1).value = element.product_details;
			document.getElementById("productRate-" + counter_1).value = element.rates;
			document.getElementById("product-qty-" + counter_1).value = element.quantity;
			document.getElementById("productPrice-" + counter_1).value = "$" + ((element.rates) * (element.quantity));
			counter_1++;
		});
	}, 300);

	document.getElementById("cart-subtotal").value = "$" + viewobj.order_summary.sub_total;
	document.getElementById("cart-tax").value = "$" + viewobj.order_summary.estimated_tex;
	document.getElementById("cart-discount").value = "$" + viewobj.order_summary.discount;
	document.getElementById("cart-shipping").value = "$" + viewobj.order_summary.shipping_charge;
	document.getElementById("cart-total").value = "$" + viewobj.order_summary.total_amount;

	document.getElementById("choices-payment-type").value = viewobj.payment_details.payment_method;
	document.getElementById("cardholderName").value = viewobj.payment_details.card_holder_name;

	var cleave = new Cleave('#cardNumber', {
		prefix: viewobj.payment_details.card_number,
		delimiter: ' ',
		blocks: [4, 4, 4, 4],
		uppercase: true
	});
	document.getElementById("amountTotalPay").value =  viewobj.order_summary.total_amount;

	document.getElementById("exampleFormControlTextarea1").value = viewobj.notes;

}

