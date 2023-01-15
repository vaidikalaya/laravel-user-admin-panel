
<html>

<head>

</head>

<body>
    <table align="center" bgcolor="#EFEEEA" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="m_1089700700868615081bodyTable">
        <tbody>
            <tr>
                <td align="center" style="padding:10px" valign="top" id="m_1089700700868615081bodyCell">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="max-width:750px" width="100%">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">

                                    <table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr ">
                                                                <tr>
                                                                    <td align="left " valign="top " style="padding-top:30px; background-color: #15477b ">
                                                                        <h4 style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:30px;font-style:normal;font-weight:400;line-height:0px;letter-spacing:normal;margin:0;padding:0;text-align:center
                                                                "><img src="https://account.quantinova.ai/assets/images/white_quantinova_logo.png "></h4>
                                                                      
                                                                    </td>
                                                                </tr>
                                                                <td align="left " valign="top " style="padding-top:30px;padding-bottom:10px; background-color: #15477b ">
                                                                    <h4 style="color:#ffff;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:24px;font-style:normal;font-weight:400;line-height:0px;letter-spacing:normal;margin:0;padding:0;text-align:center "><b></b></h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-bottom:20px; background-color: #15477b " valign="top ">
                                                                    <h1 style="position: relative; color:#fff;font-family:Georgia,Times,Times New Roman,serif;font-size:20px;font-style:normal;font-weight:400;line-height:36px;letter-spacing:normal;margin:0;padding:0;text-align:center
                                                                "><img style=" width: 27px; position: absolute; padding-right: 17px; top: 5px; left: 19%; " src="https://account.quantinova.ai/assets/images/success_payment.png" > <b>Transaction Completed Successfully !</b></h1>
                                                                
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td " valign="top " style="padding-right:20px;padding-left:20px;padding-top:20px; ">

                                                                <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left;float:left; "><b>Name : {{$invoiceDetail->user->firstname.' '.$invoiceDetail->user->lastname}}</b> </strong>.</p>
                                                                <div style="width: 40%; float: right; ">
                                                                    <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0; "><b>Phone No : {{$invoiceDetail->user->phone}} </b></strong>.</p>
                                                                </div>
                                                </td>
                                                </tr>

                                                <tr>
                                                    <td style="padding-right:20px;padding-left:20px " valign="top ">

                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left;float:
                                                                left; "> <b>Payment method: {{$invoiceDetail->payments->payment_method}} </b></strong>
                                                        </p>
                                                        <div style="width: 40%; float: right; ">
                                                            <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0; "><b>Transaction Number: {{$invoiceDetail->payments->bank_transaction_id}} </b></strong>
                                                            </p>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right:20px;padding-left:20px " valign="top ">

                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left;float:
                                                                left; "> <b> Paid On: {{ \Carbon\Carbon::parse($invoiceDetail->payments->created_at)->format('d/m/Y')}}</b></strong>
                                                        </p>
                                                        <div style="width: 40%; float: right; ">
                                                            <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0; "> <b> Account type: {{$invoiceDetail->plan->plan_name}}</b> 
                                                                </strong>.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right:20px;padding-left:20px;padding-bottom:50px " valign="top ">


                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left
                                                                "> <b>The next payment is on:</b> <span style="color: #f50a0a; ">From 1 year to the day of subscription </span></strong>.</p>
                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left "><b>Big thanks for being part of our community. </b> </strong>.</p>
                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left ">New users with a fresh subscription can claim a complete refund within Seven days of payment.:</strong>.</p>

                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0;text-align:left ">Transaction charges will be non-refundable.:</strong>.</p>

                                                        <p style="color:#241c15;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:16px;font-weight:400;line-height:24px;padding-top:0;margin-top:0; ">If you have any questions or feedback, contact us at <a href="tel:+13023579981">+13023579981</a> or <a href="mailto:support@quantinova.ai">  support@quantinova.ai </a> and we'll get right back to
                                                            you.
                                                            </strong>
                                                        </p>




                                                    </td>
                                                </tr>


                                                </tbody>
                                                </table>
                                </td>
                                </tr>
                                </tbody>
                                </table>

                </td>
                </tr>
                <tr>
                    <td align="center " valign="top ">

                        <table border="0 " cellpadding="0 " cellspacing="0 " width="100% ">
                            <tbody>
                                <tr>
                                    <td align="center " valign="top " style="color:#6a655f;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:12px;font-weight:400;line-height:24px;padding-top:40px;padding-bottom:40px;text-align:center ">
                                        <p style="color:#6a655f;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:12px;font-weight:400;line-height:24px;padding-top:0;margin:0;text-align:center ">© 2021 QuantiNova<sup>®</sup>, All Rights Reserved.<br>400 Tradecenter Drive • Ste 5900 • Woburn MA 01801</p>
                                        <a href="https://app.quantinova.ai/#/terms " style="color:#007c89;font-weight:500;text-decoration:none " target="_blank ">Terms of Use</a><span>&nbsp;&nbsp;•&nbsp;&nbsp;</span><a href="https://app.quantinova.ai/#/privacy-policy "
                                            style="color:#007c89;font-weight:500;text-decoration:none " target="_blank ">Privacy Policy</a>
                                        <a href="https://app.quantinova.ai/#/terms " style="color:#007c89;font-weight:500;text-decoration:none " target="_blank ">Terms of Use</a><span>&nbsp;&nbsp;•&nbsp;&nbsp;</span><a href="https://app.quantinova.ai/refund-policy "
                                            style="color:#007c89;font-weight:500;text-decoration:none " target="_blank ">Refund Policy</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                </tbody>
                </table>

                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>