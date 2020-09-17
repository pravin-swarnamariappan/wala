<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-cart text-success fa-lg"></i> Check Out<small class='text-primary'> Billing Information</small></h4>
  </div>
  <div class="modal-body">
    <form action="database/data.php?q=checkout" method="POST" id="demoForm">
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" name="fname" value="<?php echo $full_name; ?>" readonly class="form-control" placeholder="(ex. John)" required>
        </div>
        <div class="form-group">
            <label>Lastname</label>
            <input type="text" name="lname" value="<?php echo $full_name; ?>" readonly class="form-control" placeholder="(ex. Doe)" required>
        </div>
        <div class="form-group">
            <label>Contact #</label>
            <input type="text" name="contact" value="<?php echo $phone; ?>" readonly class="form-control" placeholder="(ex. 0720 000 000)" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" readonly placeholder="(ex. info@yourdomain.com)" class="form-control">
        </div>
        <div class="form-group">
            <label>Enter shipping address (Location/phone/email)</label>
            <textarea name="address" class="form-control" placeholder="Nairobi CBD, 070000000" cols="4" rows="2"></textarea>
        </div>
        <div class="form-group">
            Mode of Payment<br />
            <input type="radio" name="payment" value="cash" checked> Cash on Delivery<br>
            <input type="radio" name="payment" value="mpesa"> Mpesa<br>
        </div>
        <div class="alert alert-info" style="display:none;" id="divmpesa">
            <?php $rand = rand(2345,99999);?>
            1. Select “Pay Bill” from the M-Pesa menu.<br />
            2. Enter Our business number 000000.<br />
            3. Enter transaction code as <?php echo $rand;?>.<br />
            4. Enter the amount Shs. <?php echo number_format($total,2);?>.<br />
            5. Enter your M-Pesa PIN.<br />
            6. Confirm that all details are correct.<br />
            7. You will receive a confirmation of the transaction via SMS.<br />
            8. Enter the reference number from Mpesa to complete transaction<br />
            <input type="hidden" name="transaction_code" class="form-control" value="<?php echo $rand;?>">
            <input type="text" name="mpesa_reference" class="form-control"  placeholder="Reference No.">
        </div>

        <div class="alert alert-warning">
            *** Please wait for our call/text or email for confirmation. Thank You! ***
        </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Submit</button>
      </form>
  </div>
</div>
</div>
