<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Address</th>
        <th>Wallet Balance</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // echo "<pre>";
    // print_r($response);
    // echo "</pre>";
    // exit();
    $i=1;
    foreach($response as $customer){
    ?>
    <tr>
        <td><?=$i?></td>
        <td><?=$customer['first_name']?></td>
        <td><?=$customer['last_name']?></td>
        <td><?=$customer['full_address']?></td>
        <td>
            <?=$customer['wallet']['balance'].' '. $currency_symbol?></br>
            <a href="<?=route('customer_wallet', ['id' => $customer['id']])?>" >
                <span class="label label-primary">View Wallet</span>
            </a>
        </td>
        <td>
            <span class="" alt="Edit" title="Edit" data-toggle="modal" data-target="#edit-customer" onClick="edit_customer('<?=$customer_url.'/'.$customer['id'].'/edit'?>');">
                <i class='fa fa-edit' style='color:blue'></i>
            </span>
            <span class="" alt="Delete" title="Delete" onClick="delete_customer('<?=$customer_url.'/'.$customer['id'].'/delete'?>');">
                <i class='fa fa-trash' style='color:red'></i>
            </span>
        </td>
    </tr>
    <?php
    $i++;
    }
    ?>    
    </tbody>
</table>