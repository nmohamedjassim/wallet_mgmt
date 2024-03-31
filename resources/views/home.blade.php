@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 bg-light text-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add-customer"><i class="fa fa-plus"></i> Add Customer</button>
        </div>
    </div>
    <div class="table-responsive response_tbl">          
        
    </div>   
    
    <!-- Add Customer Modal Start -->
    <div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <span class="modal-title" id="exampleModalLabel">Create Customer</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" name="add-customer-form" id="add-customer-form" action="#">
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="full_address">Full Address</label>
                        <input type="text" class="form-control" id="full_address" name="full_address" placeholder="Enter full address">
                    </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                    @csrf
                    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Customer Modal End -->

     <!-- Edit Customer Modal Start -->
     <div class="modal fade" id="edit-customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <span class="modal-title" id="exampleModalLabel">Edit Customer</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" name="edit-customer-form" id="edit-customer-form" action="#">
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_first_name">First Name</label>
                        <input type="text" class="form-control" id="edit_first_name" name="edit_first_name" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="edit_last_name">Last Name</label>
                        <input type="text" class="form-control" id="edit_last_name" name="edit_last_name" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="edit_full_address">Full Address</label>
                        <input type="text" class="form-control" id="edit_full_address" name="edit_full_address" placeholder="Enter full address">
                        <input type="hidden" name="put_url_hidden" id="put_url_hidden" value="" />
                    </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                    @csrf
                    <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Customer Modal End -->
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
function edit_customer(edit_show_url)
{
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $('#loading').show(); 
    $.ajax({
        method: 'get',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        url: edit_show_url,
        success: function (result) {
            console.log(result.data);
            $("#edit_first_name").val(result.data.first_name);
            $("#edit_last_name").val(result.data.last_name);
            $("#edit_full_address").val(result.data.full_address);
            $("#put_url_hidden").val(edit_show_url);
            $('#loading').hide();
        }
    });
}

function delete_customer(delete_show_url)
{
    Swal.fire({
        title: "Do you want to delete this customer?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Delete",
        denyButtonText: "No"
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                url: delete_show_url,
                method: 'DELETE',
                success: function(response) {
                    $('#loading').hide();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Customer deleted successfully",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });            
        } else if (result.isDenied) {
            // Swal.fire("Changes are not saved", "", "info");
        }
    });
}

$(document).ready(function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $('#loading').show();    
    $.ajax({
        method: 'get',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        url: '<?=$customer_url?>',
        success: function (result) {
            //console.log(result.data);
            api_data_to_table(result.data);
        }
    });

    function api_data_to_table(res_data)
    {        
        $.ajax({
            url: '{{ route('api_data_to_table') }}',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            method: 'post',
            data: JSON.stringify(res_data),
            processData: false,
            contentType: false,
            success: function (result) {
                $(".response_tbl").html(result.customer_html);
                $('#loading').hide();
            }
    });
    }

    // Add Customer Form Validation Start
    $("#add-customer-form").validate({
        errorElement: "div",
        errorClass: "form-error-block",
        rules: {
            'first_name': {
                required: true,
                minlength: 3
            },                 
            'last_name': {
                required: true,
                minlength: 3
            },                 
            'full_address': {
                required: true,
                minlength: 5
            },                 
        },
        messages: {
            'first_name': {
                required: "Please enter first name",
            },                 
            'last_name': {
                required: "Please enter last name",
            },                 
            'full_address': {
                required: "Please enter full address",
            },                 
        },
        submitHandler: function(form) {      
            $('#loading').show(); 
            $.ajax({
                url: "<?=$api_url.'customers'?>",
                method: 'post',
                data: $('#add-customer-form').serialize(),
                cache: false,
                success: function(response) {
                    $('#loading').hide();
                    $("#add-customer-form")[0].reset();
                    $("#add-customer .close").click();                    
                    Swal.fire({
                        title: "Customer Added",
                        text: "Customer added successfully",
                        icon: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        }
    });
    // Add Customer Form Validation End

    // Edit Customer Form Validation Start
    $("#edit-customer-form").validate({
        errorElement: "div",
        errorClass: "form-error-block",
        rules: {
            'edit_first_name': {
                required: true,
                minlength: 3
            },                 
            'edit_last_name': {
                required: true,
                minlength: 3
            },                 
            'edit_full_address': {
                required: true,
                minlength: 5
            },                 
        },
        messages: {
            'edit_first_name': {
                required: "Please enter first name",
            },                 
            'edit_last_name': {
                required: "Please enter last name",
            },                 
            'edit_full_address': {
                required: "Please enter full address",
            },                 
        },
        submitHandler: function(form) {      
            $('#loading').show(); 
            $.ajax({
                url: $("#put_url_hidden").val(),
                method: 'PUT',
                data: $('#edit-customer-form').serialize(),
                success: function(response) {
                    $('#loading').hide();
                    $("#edit-customer-form")[0].reset();
                    $("#edit-customer .close").click();                    
                    Swal.fire({
                        title: "Customer Updated",
                        text: "Customer updated successfully",
                        icon: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        }
    });
    // Edit Customer Form Validation End
    
});
</script>

