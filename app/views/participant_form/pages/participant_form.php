<?php ob_start(); ?>
<form method="POST" >
    <h3>Participation Form</h3>
    <div>
        <label>Apply Date</label>
        <input type="date" name="participateApplyDate" value ='<?= gmdate("Y-m-d H:i:s") ?>' required />
    </div>
    <div>
        <label>Participants</label>
        <input type="number" name="participants" min="1" max="9" required />
    </div>
    <div>
        <label>Note</label>
        <input type="text" name="note" />
    </div>
    <fieldset>
       <legend>Select Payment</legend>
        <?php
            function getBoolValue(String $paymentType) : int{
                switch($paymentType){
                    case PaymentType::CASH :
                        return 0;
                    case PaymentType::NoPayment :
                        return 0;
                    default :
                        return 1;    
                }
            }

            for($a = 0; $a < count($arrayPaymentType); $a++){
                $paymentName = $arrayPaymentType[$a];
                $toggleValue = getBoolValue($arrayPaymentType[$a]);
                echo "
                    <div>
                        <label>$paymentName</label>
                        <input type='radio' name='paymentType' value='$paymentName' onClick='togglePaymentTable($toggleValue)'/> 
                    </div>
                ";
            } 
        ?>
        <table id="paymentTable">
            <tr>
                <th>Card No</th>
                <td>
                    <input type="text" name="code" placeholder="0000 0000 0000 0000"  />
                </td>
            </tr>
            <tr>
                <th>CVC</th>
                <td>
                    <input type="text" name="cvc" placeholder="0000"  />
                </td>
            </tr>
        </table>
    </fieldset>
    <div>
        <label>Contact Email</label>
        <input type="email" name="contactEmail" />
    </div>
    <div>
        <label>Contact Phone Number</label>
        <input type="tel" name="contactPhoneNumber" />
    </div>
    
    <button type="submit" name="btnParticipate">Start Participate</button>
</form>
<details>
    <h4>Campaign Details</h4>
    <p><?= $campaignModel->getCampaignName() ?></p>
</details>
<?php $content = ob_get_clean(); ?>

<?php include __DIR__."/../../../../layout.php"; ?>

<script type="text/javascript">
    function togglePaymentTable(showValue){
        console.log(showValue);
        let paymentTable = document.getElementById("paymentTable");
        paymentTable.style.visibility =showValue === 1 ? "visible" : "hidden";
    }
</script>