<!DOCTYPE html>
<html>

<head>
    <title>PetManagment - Pago con tarjeta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style type="text/css">
        .panel-title {
            display: inline;
            font-weight: bold;
        }
        
        .display-table {
            display: table;
        }
        
        .display-tr {
            display: table-row;
            text-align: center;
        }
        
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
        .container {
            text-align: center
        }
        .container h1 {
            padding-top: 8vh;
        }
        .row{
            padding-top: 0%;
            text-align: center;
        }
        .panel-title{
            text-align: center;
        }
        .flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .heh {
            height: 50vh;
        }
        .formulario {
            background: rgba(31, 45, 196, 0.659);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 30px rgb(0, 0, 0);
            color: white;
        }
        .card {
            background: transparent;
            color: white;
        }
        body {
            position: relative;
            background-image: url(./img/imagenesWeb/fotosSlider/foto-slider-4.jpg);
            background-size: cover;
            background-attachment: fixed;
}
    </style>
</head>

<body>
    <div class="container">
        <h1>Pet Management <br/></h1>
        <div class="row flex heh">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <div class="row display-tr">
                            <h3 class="panel-title display-td">Detalles del pago</h3>
                            <div class="display-td">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="panel-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <form role="form" action="{{ url('stripePost') }}" method="post" class="require-validation formulario" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Titular de la tarjeta</label> <input class='form-control' size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group card required'>
                                    <label class='control-label'>Número de tarjeta</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVV</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Mes de caducidad</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Año de caducidad</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>
                            {{-- <div class='form-row row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>Please correct the errors and try again.
                                    </div>
                                </div>
                            </div> --}}
                            <input type="hidden" id="envizr" name="preciototal" value="{{$preciototal}}">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pagar Ahora</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val(),
                    // preciototal: $('#envizr').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                // return console.log(response);
                var token = response['id'];
                var preciototal = $('#envizr').val()
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.append("<input type='hidden' name='preciototal2' value='" + preciototal + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

</html>