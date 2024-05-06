<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel - Razorpay Payment Gateway Integration</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    let options = {
        "key": "<?php echo request()->key; ?>",
        "amount": "<?php echo request()->amount; ?>",
        "currency": "INR",
        "name": "Manorama Horizon",
        "description": "Manorama Horizon DESCRIPTION",
        "image": "YOUR COMPANY IMAGE",
        "order_id": "<?php echo request()->order; ?>",
        "handler": function(response) {
            alert(response.razorpay_payment_id);
            alert(response.razorpay_order_id);
            alert(response.razorpay_signature)
        },
        "theme": {
            "color": "#F37254"
        }
    };
    options.handler = function(response) {
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.getElementById('razorpay_status').value = 'success';
        document.razorpayform.submit();
    };
    options.theme.image_padding = false;
    options.modal = {
        ondismiss: function() {
            window.location.href = "<?php echo route('payment.cancel', ['order' => request()->order]); ?>";
        },
        escape: true,
        backdropclose: false
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function(response) {
        // alert(response.error.code);
        // alert(response.error.description);
        // alert(response.error.source);
        // alert(response.error.step);
        // alert(response.error.reason);
        // alert(response.error.metadata.order_id);
        // alert(response.error.metadata.payment_id);
        document.getElementById('razorpay_status').value = 'failed';
        document.getElementById('razorpay_order_id').value = response.error.metadata.order_id;
        document.getElementById('razorpay_payment_id').value = response.error.metadata.payment_id;
        document.razorpayform.submit();
    });
    rzp1.open();
    </script>
</head>
<body>
    <form name='razorpayform' action="{{ route('payment.verify') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="status" id="razorpay_status">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    </form>
</body>