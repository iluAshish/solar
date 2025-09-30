toastr.options = {
  "closeButton": true,
  "debug": true,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toastr-top-right",
  "preventDuplicates": true,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
function get_updated_datatable() {
    $('#add_edit_form').slideUp(500, function () {
        $('#display_update_form').html('');
    });

    if ($(".dataTable_paginate li.active a").length > 0)
        $(".dataTable_paginate li.active a").trigger("click");
    else
        $(".dataTable th:eq(0)").trigger("click");
}
function createEditor( elementId, data ) {
    $('.ckeditor-classic').each(function(){
        var id = $(this).attr("id");
        ClassicEditor.create(document.querySelector( '#' + id ))
        .then(function (editor) {
            editor.ui.view.editable.element.style.height = '200px';
        })
        .catch(function (error) {
            console.error(error);
        });
    });    
}    


$(document).ready(function () {
    $("select.js-example-basic-single").select2();
    
    $(document).on("blur", ".greaterThan", function (event) {    
        var value = parseInt($(this).val());
        var minVal = parseInt($('.minVal').val());
        if(minVal > value){
            $('.greter-tooltip').html('Net rate shoulb be grater than rate');
            $('.greter-tooltip').show();
            return false;
        } else {
            $('.greter-tooltip').html('Please enter net rate');
            $('.greter-tooltip').hide();
        }
        return true;
    });

    
    if ($('.common_datatable').length > 0) {
        var add_button = 0;
        var add_button_title = 'Add New';
        if (typeof $('.common_datatable').attr('data-add-button') != "undefined") {
            add_button = 1;
        }
        var $url = BASE_URL+ $('.common_datatable').attr('data-control') + '/' + $('.common_datatable').attr('data-mathod');
        var oTable = $('.common_datatable').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sServerMethod": "POST",
            "sAjaxSource": $url,
            "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
            "sDom": "<'row'<'col-md-6'l <'toolbar'>><'col-md-6'f>r>t<'row'<'col-md-12'p i>>",
            "dom": 'Bfrtip',
            "buttons": '',
            "bLengthChange": false,
            "fnServerParams": function (aoData, fnCallback) {
                if ($('#status').length > 0) {
                    aoData.push({"name": "status", "value": $('#status').val()});
                }
                if ($('#kt_daterangepicker_1').length > 0) {
                    aoData.push({"name": "dates", "value": $('#kt_daterangepicker_1').val()});
                }
                if ($('#to_date').length > 0) {
                    aoData.push({"name": "to_date", "value": $('#to_date').val()});
                }
                if ($(".common_datatable_filter select.search_mq").length > 0) {
                    $(".common_datatable_filter select.search_mq").each(function (index) {
                        var f_id = $(this).attr('id');
                        var f_name = $(this).attr('name');
                        if (f_id !== "") {
                            if ($('.common_datatable_filter #' + f_id).length > 0) {
                                aoData.push({"name": f_name, "value": $('.common_datatable_filter #' + f_id).val()});
                            }
                        }
                    });
                }
                if ($(".common_datatable_filter input.search_mq").length > 0) {
                    $(".common_datatable_filter input.search_mq").each(function (index) {
                        var f_id = $(this).attr('id');
                        var f_name = $(this).attr('name');
                        if (f_id !== "") {
                            if ($('.common_datatable_filter #' + f_id).length > 0) {
                                aoData.push({"name": f_name, "value": $('.common_datatable_filter #' + f_id).val()});
                            }
                        }
                    });

                }


            },
            "fnInitComplete": function () {
                $('.tooltip-top a').tooltip();
                
                if (add_button == 1) {
                    var $controller = $('.common_datatable').attr('data-control');
                    $(".dataTables_wrapper .toolbar").html('<div class="table-tools-actions"><a class="btn btn-primary open_my_form_form" href="javascript:;" data-control="' + $controller + '">' + add_button_title + ' <i class="fa fa-plus"></i></a></div>');
                }
                $('.search_mq').on('change', function () {
                    oTable.fnDraw();
                });
            },
            "oLanguage": {"sLengthMenu": "_MENU_ ", "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"},
        });

    }


    $(document).on("click", ".btn.open_my_form_form", function (event) {
        
        var data_id = $(this).attr('data-id');
        var controller = $(this).attr('data-control');
        var $url = 'add';
        if (data_id > 0) {
            $url = 'edit/' + data_id;
        }
        $.ajax({
            type: 'POST',
            url: BASE_URL + controller + '/' + $url,
            async: false,
            data: 'pstdata=1',
            dataType: 'html',
            beforeSend: function () {
                $('#display_update_form').html('<div class="loader_wrapper"><div class="loader"></div></div>');
                $('#add_edit_form').show();
            },
            success: function (returnData) {
                
                setTimeout(function(){ 
                    $('#display_update_form').html(returnData);
                    $('#display_update_form select').select2();
                    createEditor( 'ckeditor-classic', 'test' );   
                    
                }, 500);
            },
            error: function (xhr, textStatus, errorThrown) {
                $('#add_edit_form').slideUp(500, function () {
                    $('#display_update_form').html('');
                });
                toastr.error("There was an unknown error that occurred. You will need to refresh the page to continue working.");
            },
            complete: function () {
            }
        });

        return false;

    });

    $(document).on("click", ".cancel_button", function (event) {
        $('#add_edit_form').slideUp(500, function () {
            $('#display_update_form').html('');
        });
        return false;
    });
    
    
    $(document).on("submit", "form.default_form", function (event) {
        var frm_id = $(this).parent().find('form').attr("id");
        var form = document.getElementById(frm_id);
		if (form.checkValidity() === false) {
		    form.classList.add('invalid-form');
			event.preventDefault();
			event.stopPropagation();
		}
		form.classList.add('was-validated');
		if ($("#"+frm_id  ).hasClass("invalid-form")) {
		    return false;
		}
        var fomr_id = $(this).attr('id');
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    toastr.success(returnData.message);
                    if(fomr_id == 'sector' || fomr_id == 'brand' || fomr_id == 'designation') {
                        $('#'+frm_id).trigger("reset");
                        $("#add_"+fomr_id+"_model").modal('hide');
                         setTimeout(function () {
                            update_dropdown(fomr_id);
                        }, 500);
                    }else{
                        get_updated_datatable();
                    }
                    //get_updated_datatable();
                } else {
                    var error_html = '';
                    if (typeof returnData.error != "undefined") {
                        $.each(returnData.error, function (idx, topic) {
                            error_html += '<li>' + topic + '</li>';
                        });
                    }
                    if (error_html != '') {
                        toastr.error(error_html);
                    } else {
                        toastr.error(returnData.message);
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });

    $(document).on("click", ".btn.delete_btn", function (event) {
        $('a.remove_clicked').removeClass('remove_clicked')
        $(this).addClass('remove_clicked');
        var $ts = $(this);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
            cancelButtonClass: 'btn btn-danger w-xs mt-2',
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function (result) {
            if (result.value) {

                    var data_id = $ts.attr('data-id');
                    var method = $ts.attr('data-method');
                    var table = $ts.attr('data-table');
                    var column = $ts.attr('data-column');
                    var $url = 'remove/' + method;
                    $.ajax({
                        type: 'POST',
                        url: $url,
                        async: false,
                        data: {id: data_id,table : table, where : column},
                        dataType: 'json',
                        beforeSend: function () {
                            $('.dataTables_processing').css('visibility', 'visible');
                        },
                        success: function (returnData) {
                            if (returnData.status == 'ok') {
                                toastr.success(returnData.message);
                                $ts.closest("tr").remove();
                                get_updated_datatable();
                            } else {
                                toastr.error(returnData.message);
                            }
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
                        },
                        complete: function () {
                            $('.dataTables_processing').css('visibility', 'hidden');

                        }
                    });

                }
            });
        return false;
    });


    function init_product_detail_datatable(){
        if ($('.product_detail_datatable').length > 0) {
            $('.product_detail_datatable').dataTable().fnDestroy();
            var add_button = 0;
            var add_button_title = 'Add New';
            if (typeof $('.product_detail_datatable').attr('data-add-button') != "undefined") {
                add_button = 1;
            }
            var $url = $('.product_detail_datatable').attr('data-control') + '/' + $('.product_detail_datatable').attr('data-mathod');
            var oTable_sub = $('.product_detail_datatable').dataTable({
                "bProcessing": true,
                "bServerSide": true,
                "sServerMethod": "POST",
                "sAjaxSource": $url,
                "sDom": "<'row'<'col-md-6'l <'toolbar'>><'col-md-6'f>r>t<'row'<'col-md-12'p i>>",
                "bLengthChange": false,
                "bAutoWidth": false,
                "fnServerParams": function (aoData, fnCallback) {
                if ($('#ProductID').length > 0) {
                        aoData.push(  {"name": "ProductID", "value":  $('#ProductID').val() } );
                    }
                },
                "fnInitComplete": function () {
                    $('.tooltip-top a').tooltip();
                    $('select').select2({
                        minimumResultsForSearch: -1
                    });
                    if (add_button == 1) {
                        var $controller = $('.product_detail_datatable').attr('data-control');
                    }
                    $('.search_mq').on('change', function () {
                        oTable_sub.fnDraw();
                    });
                },
                "oLanguage": {"sLengthMenu": "_MENU_ ", "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"},
            });
        }
    }
    
    $(document).on("click", "#send_otp", function (event) {
        var aadhar_number = $('#aadhar_number').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'franchisee/send_aadhar_otp',
            data: {aadhar_number : aadhar_number},
            dataType: 'json',
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('#send_otp').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    toastr.success(returnData.message);
                    $('#ref_id').val(returnData.ref_id);
                } else {
                    var error_html = '';
                    if (typeof returnData.error != "undefined") {
                        $.each(returnData.error, function (idx, topic) {
                            error_html += '<li>' + topic + '</li>';
                        });
                    }
                    if (error_html != '') {
                        toastr.error(error_html);
                    } else {
                        toastr.error(returnData.message);
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });


    $(document).on("submit", "form.verification_form", function (event) {
        var formData = new FormData($(this)[0]);
        var form_id = $(this).attr('id'); 
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    $('#'+form_id).trigger("reset");
                    $("#"+form_id+"_modal").modal('hide');
                    toastr.success(returnData.message);
                } else {
                    var error_html = '';
                    if (typeof returnData.error != "undefined") {
                        $.each(returnData.error, function (idx, topic) {
                            error_html += '<li>' + topic + '</li>';
                        });
                    }
                    if (error_html != '') {
                        toastr.error(error_html);
                    } else {
                        toastr.error(returnData.message);
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });

    $(document).on("click", ".show_person_data", function (event) {
        var $ts = $(this);
        var data_id = $ts.attr('data-id');
        $.ajax({
            type: 'POST',
            url: BASE_URL+'company/get_persons_data',
            data: {companyID: data_id},
            dataType: 'html',
            beforeSend: function () {
                $('#product-data').html('');
                //$('#product_details .model_content_area').html('');
            },
            success: function (returnData) {

                $('#product-data').html(returnData);
                $("#product_details").modal('show');
            },
            error: function (xhr, textStatus, errorThrown) {
            },
            complete: function () {

            }
        });

        return false;

    });

    $(document).on("click", ".show_price_data", function (event) {
        var $ts = $(this);
        var data_id = $ts.attr('data-id');
        $.ajax({
            type: 'POST',
            url: BASE_URL+'projects/get_price_data',
            data: {ProjectID: data_id},
            dataType: 'html',
            beforeSend: function () {
                $('#product-data').html('');
                //$('#product_details .model_content_area').html('');
            },
            success: function (returnData) {

                $('#price-data').html(returnData);
                $("#price_details").modal('show');
            },
            error: function (xhr, textStatus, errorThrown) {
            },
            complete: function () {

            }
        });

        return false;

    });

    $(document).on("click", ".open_master_popup", function (event) {
        event.preventDefault();
        var controller = $(this).attr('data-control');
        $("#add_"+controller+"_model").modal('show');
    });

    $(document).on("click", ".show_product_data", function (event) {
        var $ts = $(this);
        var data_id = $ts.attr('data-id');
        $.ajax({
            type: 'POST',
            url: BASE_URL+'product/get_product_data',
            data: {productID: data_id},
            dataType: 'html',
            beforeSend: function () {
                $('#product-data').html('');
                //$('#product_details .model_content_area').html('');
            },
            success: function (returnData) {

                $('#product-data').html(returnData);
                $("#product_details").modal('show');
            },
            error: function (xhr, textStatus, errorThrown) {
            },
            complete: function () {

            }
        });

        return false;

    });


     var max_fields = 50;
    var wrapper = $(".scoringform");
    var add_buttons = $("#add_field_button12");
   // alert(add_buttons);
    var b = 0;
    $(document).on("click", "#add_field_button12", function (e) {
   //    $(add_buttons).click(function(e) {
        e.preventDefault();
        if (b < max_fields) {
            b++;
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'product/add_row',
                async: false,
                data: 'no='+b,
                dataType: 'html',
                beforeSend: function () {

                },
                success: function (returnData) {
                    $('.scoringform').append(returnData);
                    if($('.input_fields_wrap123').length){
                        $('.input_fields_wrap123').append(returnData);
                    }
                        $("select.select2").select2(); 
                },
                error: function (xhr, textStatus, errorThrown) {

                    toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
                },
                complete: function () {
                }
            });
                return false;
            }  
    });
    $(document).on("click", ".remove_field1", function(e) {
        e.preventDefault();
        $(this).parent().parent().parent('.input_btn').remove();
        // b--;
    })

    $(document).on("click", ".remove_series", function (event) {
            var data_id = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'product' + '/' + 'remove_series',
                async: false,
                data: 'series_id='+data_id,
                dataType: 'josn',
                beforeSend: function () {
                    
                },
                success: function (returnData) {
                    $(this).closest('div').remove();
                    b--;
                },
                error: function (xhr, textStatus, errorThrown) {
                   
                },
                complete: function () {
                }
            });
        return false;
    });


    $(document).on("change", ".select-change", function (event) {
        var controll = $(this).attr('data-control');
        var name = $(this).attr('data-name');
        $("#"+name+"_id").html('<option value="">Select '+name+'</option>');
        var id = $(this).val();
        var this_e = $(this);
        $.ajax({
            type: 'POST',
            url: BASE_URL + controll + '/get_'+name,
            data: {id: id},
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    $.each(returnData.data, function (idx, topic) {
                        if(controll == 'projects') {
                            this_e.parent().next().find('.size-ranges').append('<option value="' + idx + '">' + topic + '</option>');
                        } else {
                            $("#"+name+"_id").append('<option value="' + idx + '">' + topic + '</option>');
                        }
                    });
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;
    });
    

    $(document).on("change", ".size-ranges", function (event) {
        var controll = $(this).attr('data-control');
        console.log(controll);
        debugger;
        var name = $(this).attr('data-name');
        var id = $(this).val();
        var this_e = $(this);
        $.ajax({
            type: 'POST',
            url: BASE_URL + controll + '/get_size_price',
            data: {id: id},
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    this_e.parent().next().find('.rate').val(returnData.price);
                    this_e.parent().next().find('.rate').attr("data-rate",returnData.price);
                    this_e.parent().next().next().find('.quantity').prop('min',returnData.from_size);
                    this_e.parent().next().next().find('.quantity').prop('max',returnData.to_size);
                    
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;
    });

    $(document).on("change", ".product", function (event) {
        var ProductID = $(this).val();
        var element = $(this);

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'products/getdata',
            data: {ProductID: ProductID},
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    var qty = element.parent().next().find('.quantity').val();
                    element.parent().next().next().find('.rate').val(returnData.data.price);
                    element.parent().next().next().find('.rate').attr("data-rate",returnData.data.price);
                    element.parent().next().next().next().find('.amount').val((returnData.data.price * qty));
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;
    });
    
    $(document).on("change", ".generate-code", function (event) {
        var Role = $(this).val();
        var element = $(this);

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'user/generateCode',
            data: {Role: Role},
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    $('#rate').val(returnData.user_code);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;
    });

    $(document).on("click", ".payment-btn", function (event) {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'quotation/getQuotationData',
            data: {id: id},
            dataType: 'json',
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    $('#pf_order_id').val(returnData.quote_data.id);
                    $('#pf_total_amount').val(returnData.quote_data.pending_amount);
                    $('#pf_amount').val(returnData.quote_data.pending_amount);
                    $("#payment_modal").modal('show');
                } else {
                    toastr.error(returnData.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;

    });

    $(document).on("click", "#calculate-emi-btn", function (event) {
        var amount = $('#amount').val();
        var rate = $('#rate').val();
        var tenture = $('#tenture').val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'user/getEmiAmount',
            data: {amount: amount,rate:rate,tenture:tenture},
            dataType: 'json',
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    $('#emi_amount').val(returnData.emi_amount);
                } else {
                    toastr.error(returnData.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;

    });

    $(document).on("change", ".quotation_id", function (event) {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'quotation/getQuotationData',
            data: {id: id},
            dataType: 'json',
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    $('#pending_amount').val(returnData.quote_data.pending_amount);
                } else {
                    toastr.error(returnData.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;

    });

    $(document).on("submit", "form.payment_form", function (event) {
        var formData = new FormData($(this)[0]);
        var form_id = $(this).attr('id'); 
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    $("#payment_modal").modal('hide');
                    const paymentSessionId = returnData.session_id; // PHP variable with payment session ID
                    const cf = new Cashfree(paymentSessionId);
                    cf.redirect();
                } else {
                    toastr.error(returnData.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });

        return false;

    });

    $(document).on("click", ".withdraw-btn", function (event) {
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'wallet/getAvailableAmount',
            data: {id: id},
            dataType: 'json',
            beforeSend: function () {
                $('.alert.alert-danger').slideUp(500).remove();
                $('input[type="submit"]').val('Please wait..!').attr('disabled', 'disabled');
            },
            success: function (returnData) {

                if (returnData.status == "ok") {
                    $('#wallet_amount').val(returnData.data.wallet_amount);
                    $("#withdraw_modal").modal('show');
                } else {
                    toastr.error(returnData.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                toastr.error('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;

    });
    
    function update_dropdown(name) {
        if(name == 'designation') {
            $(".designation").html('<option value="">Select '+name+'</option>');
        }
        $("#"+name+"_id").html('<option value="">Select '+name+'</option>');
        $.ajax({
            type: 'POST',
            url: BASE_URL+'sector/get_details',
            data: {name: name},
            dataType: 'json',
            success: function (returnData) {
                if (returnData.status == "ok") {
                    $.each(returnData.data, function (idx, topic) {
                        if(name == 'designation') {
                            $(".designation").html('<option value="">Select '+name+'</option>');
                        }
                        $("#"+name+"_id").append('<option value="' + idx + '">' + topic + '</option>');
                    });
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('There was an unknown error that occurred. You will need to refresh the page to continue working.');
            },
            complete: function () {
                $('input[type="submit"]').val('Submit').removeAttr('disabled');
            }
        });
        return false;
    }
    

});


function add_person() {
    count = document.getElementById("row-count").value;
	count++;
	var tr1 = document.createElement("tr");
	tr1.id = count;
	tr1.className = "person";
    document.getElementById("row-count").value = count;
	var delLink =
		"<tr>" +
		'<th scope="row" class="person-id">' +
		count +
		"</th>" +
		'<td class="text-start col-3">' +
		'<div class="mb-2">' +
		'<input type="text" id="person_name_' + count + '" name="person_name[]" class="form-control" placeholder="Enter person name" required />' +
        '<div class="invalid-tooltip">Please enter Person name</div>' +
		'</div>' +
		"</td>" + 
		"<td class='text-start col-3'>" +
		'<div class="mb-2">' +
		'<select id="designation_id_' + count + '" class="js-example-basic-single designation" name="designation_id[]">'+
        '<option value="" selected="selected">Select Designation</option>'+
		"</div>" +
		"</td>" +
		"<td class='text-start col-2'>" +
		'<div class="mb-2">' +
		'<input type="text" id="person_email_' + count + '" name="person_email[]" class="form-control" placeholder="Enter person name" required />'+
        '<div class="invalid-tooltip">Please enter Person name</div>'+
		'</div>' +
		"</td>" +
		"<td class='text-start col-2'>" +
		'<div class="mb-2">' +
		'<input type="text" id="person_mobile_' + count + '" name="person_mobile[]" class="form-control" placeholder="Enter person name" required />'+
        '<div class="invalid-tooltip">Please enter Person name</div>'+
		'</div>' +
		"</td>" +
        '<td class="text-start col-2">'+
            '<div class="mb-2">'+
                '<div class="form-check form-checkbox-primary mb-3">'+
                    '<input class="form-check-input" type="checkbox" name="is_send_mail[]" id="send_mail_' + count + '" value="1">'+
                    '<label class="form-check-label" for="formradioRight5">Send Mail</label>'+
                '</div>'+
            '</div>'+
        '</td>'+

		'<td class="person-removal col-1">' +
		'<a class="btn btn-success">Delete</a>' +
		"</td>" +
		
		"</tr>";
    
	tr1.innerHTML = document.getElementById("newForm").innerHTML + delLink;
	document.getElementById("newperson").appendChild(tr1);
	for (var key in Designations) {
        $('#designation_id_'+count).append('<option value="' + key + '">' + Designations[key] + "</option>");
	    
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

	//isData();
	remove();
	resetPersonRow()
}

//removePerson();

$(document).ready(function () {
    $(document).on("click", ".person-removal a", function (e) {
		removeItemP(e);
		resetPersonRow();
	});
});


function resetPersonRow() {

	Array.from(document.getElementById("newperson").querySelectorAll("tr")).forEach(function (subItem, index) {
		var incid = index + 1;
		subItem.querySelector('.person-id').innerHTML = incid;

	});
}



/* Remove item from cart */
function removeItemP(removeButton) {
	removeButton.target.closest("tr").remove();
    count = document.getElementById("row-count").value;
	count--;
    document.getElementById("row-count").value = count;
	
}
