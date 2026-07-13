@extends("main")

@section("content")
<div class="row">
    <div class="col-lg-6 order-lg-2">
        <div class="ui-block">
            <div class="widget w-action w-action-black">
                <svg width="50" height="50" class="list-icon c-gold"><use xlink:href="/svg-icons/sprites/icons.svg#diamond"></use></svg>

                <div class="content">
                    <h3 class="title">Virtuális gyémánt</h3>

                    <div id="pl_price" class="h1 c-white">100 000 Ft</div>

                    <div class="w-action-input">
                        <select id="pl_type" name="quantity" class="form-control form-control-sm">
                            <option value="PL1">1 db</option>
                            <option value="PL2">2 db</option>
                            <option value="PL3">3 db</option>
                        </select>

                        <div class="form-group">egy évre</div>
                    </div>

                    <div id="paypal_button"></div><br />
                    <button id="pl_submit" class="btn btn-lg btn-gold mb-4">OTP Simple</button>
                    <form action="https://sandbox.simplepay.hu/payment/order/lu.php" method="POST" id="simple_button" accept-charset='UTF-8'>
                    </form>
                    <span>Lépj be te is exkluzív tagjaink közé és vásárolj virtuális gyémántot!</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 order-lg-1">
        <div class="ui-block">
            <div class="ui-block-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                dignissim felis in libero dignissim scelerisque. Fusce nec vestibulum lectus.
                Vestibulum a neque magna. Aliquam quis nisl eu nisi molestie ultrices.
                Ut sed nibh eros. Donec a purus vel nisl efficitur vehicula. Nam ac
                condimentum tortor.</p>

                <ul class="list-with-icon">
                    <li>
                        <svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svg#tick"></use></svg>
                        Kerülj az üzenetek élére!
                    </li>
                    <li>
                        <svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svg#tick"></use></svg>
                        Kerülj a böngésző középpontjába!
                    </li>
                    <li>
                        <svg class="list-icon"><use xlink:href="/svg-icons/sprites/icons.svg#tick"></use></svg>
                        Kiemelheted a fotódat az oldalsávba: reflektorfény funkció megsokszorozza az adatlapod megtekintéseit.
                    </li>
                </ul>

                <h3>Mit nyerhetsz, ha csatlakozol?</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                dignissim felis in libero dignissim scelerisque. Fusce nec vestibulum lectus.
                Vestibulum a neque magna. Aliquam quis nisl eu nisi molestie ultrices.
                Ut sed nibh eros. Donec a purus vel nisl efficitur vehicula. Nam ac
                condimentum tortor.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script type="text/javascript">
    $("#pl_type").on("change", function () {
        jQuery.get("/payments/type/" + this.value)
        .done(function(data) { $("#pl_price").html(data.price.format(0) + " Ft"); })
    });

    $("#pl_submit").on("click", function (event) {
        event.preventDefault();
        $("#pl_submit").hide();
        jQuery.post("/payments/create/simple/" + $("#pl_type").val(), {"_token": "{{ csrf_token() }}"})
        .done(function(data) { $("#simple_button").html(data); })
    });

    paypal.Button.render({
        env: "production",
        locale: "hu_HU",
        style: {
            color: "gold",
            size: "medium",
            tagline: false,
            fundingicons: true
        },
        commit: true,
        payment: function () {
            return new paypal.Promise(function(resolve, reject) {
                jQuery.post("/payments/create/paypal/" + $("#pl_type").val(), {"_token": "{{ csrf_token() }}"})
                .done(function(data) { resolve(data.paymentID); })
                .fail(function(err) { reject(err); })
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(response) {
                switch (response.state) {
                    case "failed": jQuery.post("/payments/cancel", {"paymentID": data.paymentID, "_token": "{{ csrf_token() }}"});
                    default: window.location.replace("/payments");
                }
            });
        },
        onCancel: function(data) {
            jQuery.post("/payments/cancel", {"paymentID": data.paymentID, "_token": "{{ csrf_token() }}"});
        }
    }, "#paypal_button");
</script>
@endsection
