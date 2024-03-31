@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 bg-light text-left">
            <a href="<?=route('home')?>">
                <button type="button" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 bg-light text-center">
            <h3>Customer Name</h3>
        </div>
        <div class="col-md-6 bg-light text-center">
            <h3>Wallet Balance</h3>
        </div>
        <div class="col-md-6 bg-light text-center">            
            <h4>
                <?=$customer_info->first_name.' '.$customer_info->last_name?>
            </h4>
        </div>
        <div class="col-md-6 bg-light text-center">
            <h4>
                <?=$customer_info->wallet->balance?> <?=$currency_symbol?>
            </h4>
        </div>
        
    </div>
      
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-6 bg-light text-right">
            Add Balance
        </div>
        <div class="col-md-6">  
            <input class="form-control" type="number" name="add_balance" id="add_balance" style="display: inline;width: 50%;" />
            <button type="button" id="add_wallet_balance" class="btn btn-primary">Add</button>                
        </div>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-6 bg-light text-right">
            Deduct Balance
        </div>
        <div class="col-md-6 bg-light text-left">
            <input class="form-control" type="number" name="deduct_balance" id="deduct_balance" style="display: inline;width: 50%;" />
            <button type="button" id="deduct_wallet_balance" class="btn btn-warning">Deduct</button>
        </div>
    </div>  
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $("#add_wallet_balance").click(function() {
        var add_balance = $("#add_balance").val();
        if(add_balance!=''){
            $('#loading').show(); 
            $.ajax({
                url: "<?=$add_balance_url?>",
                method: 'PUT',
                data: {'amount': $('#add_balance').val()},
                success: function(response) {
                    $('#loading').hide();
                    Swal.fire({
                        title: "Added!",
                        text: "Balance added to the wallet successfully",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });
        }else{
            Swal.fire({
                title: "Enter the amount!",
                icon: "warning",
                showConfirmButton: true
            });
        }
    });

    $("#deduct_wallet_balance").click(function() {
        var deduct_balance = $("#deduct_balance").val();
        if(deduct_balance!=''){
            $('#loading').show(); 
            $.ajax({
                url: "<?=$ded_balance_url?>",
                method: 'PUT',
                data: {'amount': $('#deduct_balance').val()},
                success: function(response) {
                    $('#loading').hide();
                    if(response.data=='insufficient balance'){
                        Swal.fire({
                            title: "Insufficient Balance!",
                            icon: "warning",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $("#deduct_balance").val('');
                    }else{
                        Swal.fire({
                            title: "Deducted!",
                            text: "Balance deducted from the wallet successfully",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });
        }else{
            Swal.fire({
                title: "Enter the amount!",
                icon: "warning",
                showConfirmButton: true
            });
        }
    });
});
</script>