@push('admin-css')
<style>
    .container {
        width: 100%;
        margin: 0px auto;
    }
    .custom-row {
        width: 100%;
        display: block;
    }

    .print-btn a{
        background: #CFD8DC;
        display: inline-block;
        padding: 3px 13px;
        border-radius: 5px;
        color: #000 !important;
    }
    .print-btn a:hover {
        background: #B0BEC5;
    }

    .com_address{
        color: #000 !important;
    }
    .invoice-title {
        text-align: center;
        font-weight: bold;
        font-size: 15px;
        margin-bottom: 15px;
        padding: 5px;
        border-top: 1px dotted #454545;
        border-bottom: 1px dotted #454545;
    }

    .col-xs-12 {
        width: 100%;
    }
    .col-xs-10 {
        width: 80%;
        float: left;
    }
    .col-xs-9 {
        width: 67%;
        float: left;
    }
    .col-xs-7 {
        width: 60%;
        float: left;
    }

    .col-xs-6 {
        width: 50%;
        float: left;
    }
    .col-xs-5 {
        width: 40%;
        float: left;
    }
    .col-xs-4 {
        width: 35%;
        float: left;
    }
    .col-xs-3 {
        width: 33%;
        float: left;
    }
    .col-xs-2 {
        width: 20%;
        float: left;
    }
    .b-text {
        font-weight: 500;
        font-size: 15px;
    }
    .normal-text {
        font-size: 14px;
        margin: 0px;
    }
    .invoice-details {
        width: 100%;
        border-collapse: collapse;
        border:1px solid #ccc;
    }
    .invoice-details thead {
        font-weight: 500;
        text-align:center;
    }
    .invoice-details tbody td{
        padding: 0px 5px;
    }
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
    .line {
        border-bottom: 1px dotted #454545;
        margin-bottom: 15px;
    }
    .paid-text {
        padding:30px 0px;

    }
    .mt-60 {
        margin-top: 60px;
    }
    .mr-20 {
        margin-right: 20px;
    }
    .ml-20 {
        margin-left: 20px;
    }
    .ft-fiext {
        position: fixed;
        bottom: 0;
    }
    .cls {
        clear: both;
    }

    @media print {
        .invoice-title {
            font-size: 16px;
        }
        .com_address h5{
            font-size: 25px;

        }
        .com_address p{
            font-size: 16px;
            color: #000;
        }
        .b-text{
            font-size: 16px;
        }
        .normal-text{
            font-size: 16px;
        }

        .invoice-details td{
            font-size: 16px;
        }

        .cus_total table tr td{
            font-size: 16px;
        }
    }
    .page-header{
        padding-bottom: 180px !important;
    }
</style>
@endpush
<main>
    <div class="container-fluid" id="root">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fa fa-file-pdf"></i> Customer Oreder Invoice</span>
        </div>

        <div class="container">
            <!-- order print-->
            <div class="row ml-1">
                <div class="col-xs-6 mb-2">
                    <span class="print-btn"><a href="" onclick="printDiv('invoiceContent')"><i class="fa fa-print"></i> Print</a></span>
                </div>
            </div>

            <div id="invoiceContent">
                <div class="com_content d-flex py-2">
                    <img src="{{ asset('storage/' . $content->image ?? "") }}" class="align-self-center me-2" width="180" height="100" alt="">
                    <div class="com_address">
                        <h5>{{ 'Boinama' }}</h5>
                        <p class="m-0"> {{ $content->address }}</p>
                        <p class="m-0"><strong>Mobile:</strong> {{ $content->number }}</p>
                        <p class="m-0"><strong>Email:</strong> {{ $content->gmail }}</p>
                    </div>
                </div>

                <div class="custom-row">
                    <div class="invoice-title">
                        Order Invoice
                    </div>
                </div>
                <div class="custom-row">
                    <div class="col-xs-7 cus_address">
                        <strong class="b-text">Customer  Name:</strong> <span class="normal-text">{{ $order->customer->name ?? ''}}</span><br>
                        <strong class="b-text">Customer Mobile:</strong> <span class="normal-text">{{ $order->billing_phone }}</span><br>
                        <strong class="b-text"> Address:</strong> <span class="normal-text">{{ $order->billing_email }}</span>
                    </div>
                    <div class="col-xs-5 text-right">
                        <strong class="b-text">Invoice No:</strong> <span class="normal-text">{{ $order->invoice}}</span><br>
                        <strong class="b-text">Order Date:</strong> <span class="normal-text">{{ $order->order_date }}</span>
                    </div>
                    <div class="cls"></div>
                </div>
                <div class="custom-row">
                    <div class="line">&nbsp;</div>
                </div>
                <div class="custom-row">
                    <div class="col-xs-12">
                        <table class="invoice-details table-bordered text-center">
                            <thead>
                                <tr>
                                    <td>Sl.</td>
                                    <td>Name</td>
                                    <td>Writer Name</td>
                                    <td>Qty</td>
                                    <td class="text-right">Price</td>
                                    <td class="text-right">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $key=> $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->product ? $item->product->name : '' }}</td>
                                    <td>{{ $item->writer_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td width="15%" class="text-right">৳ {{ $item->price }}</td>
                                    <td width="15%" class="text-right">৳ {{ $item->price * $item->quantity }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="custom-row">
                    <div class="col-xs-9">
                        <div class="paid-text">
                            <strong class="b-text">In Words:</strong> <span class="normal-text text-capitalize mr-20" id="words"></span>
                        </div>
                    </div>
                    <div class="col-xs-3 cus_total">
                        <table width="100%">
                            <tr>
                                <td width="40%" class="b-text">Sub Total :</td>
                                <td class="text-right fw-bold">৳ {{ $order->sub_total }}</td>
                            </tr>
                            <tr>
                                <td width="70%" class="b-text">Shipping Cost:</td>
                                <td class="text-right fw-bold">৳ {{ $order->shipping_cost }}</td>
                            </tr>
                            <tr>
                                <td width="70%" class="b-text">Discount:</td>
                                <td class="text-right fw-bold">৳ {{ $order->discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border-bottom: 1px solid rgb(204, 204, 204);"></td>
                            </tr>
                            <tr>
                                <td width="45%" class="b-text">Total:</td>
                                <td class="text-right fw-bold" style="font-family: sans-serif;">৳ {{ number_format($order->total, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@push('script')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }


    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
    var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

    function inWords (num) {
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'Taka only ' : '';
        return str;
    }
    document.getElementById('words').innerHTML = inWords({{ round($order->total) }});

</script>
@endpush
