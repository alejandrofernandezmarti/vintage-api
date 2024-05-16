@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="/css/stripe.css"/>
    <script src="https://js.stripe.com/v3/"></script>

    <div id="content" class="main-content-wrapper">
        <form action="{{ route('post.payment') }}" method="POST" class="page-content-inner" id="payment-form">
            <div class="container" style="padding-top: 15vh !important;">
                <div class="row pb--80 pb-md--60 pb-sm--40">
                    <!-- Checkout Area Start -->
                    <div class="col-lg-6">
                        <div class="checkout-title mt--10">
                            <h2>Detalles del pedido</h2>
                        </div>
                        <div class="checkout-form">
                            <form action="#" class="form form--checkout">
                                <div class="form-row mb--30">
                                    <div class="form__group col-md-6 mb-sm--30">
                                        <label for="billing_fname" class="form__label form__label--2">Nombre
                                            <span class="required">*</span></label>
                                        <input required placeholder="Escribe tu nombre" type="text" name="name"
                                               id="billing_fname"
                                               class="form__input form__input--2">
                                    </div>
                                    <div class="form__group col-md-6">
                                        <label for="billing_lname" class="form__label form__label--2">Apellidos
                                            <span class="required">*</span></label>
                                        <input required placeholder="Escribe tus apellidos" type="text" name="surnames"
                                               id="billing_lname"
                                               class="form__input form__input--2">
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="billing_streetAddress" class="form__label form__label--2">Dirección
                                            de entrega
                                            <span class="required">*</span></label>

                                        <input required type="text" name="address" id="billing_streetAddress"
                                               class="form__input form__input--2 mb--30"
                                               placeholder="Escribe la dirección de entrega">

                                    </div>
                                </div>
                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="billing_city" class="form__label form__label--2">Provincia
                                            <span class="required">*</span></label>
                                        <input required placeholder="Escribe tu provincia" type="text" name="province"
                                               id="billing_city"
                                               class="form__input form__input--2">
                                    </div>
                                </div>
                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="billing_state" class="form__label form__label--2">Población
                                            <span class="required">*</span></label>
                                        <input required placeholder="Escribe tu población" type="text" name="town"
                                               id="billing_state"
                                               class="form__input form__input--2">
                                    </div>
                                </div>
                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="billing_phone" class="form__label form__label--2">Teléfono </label>
                                        <input placeholder="Escribe tu teléfono" type="text" name="phone"
                                               id="billing_phone"
                                               class="form__input form__input--2">
                                    </div>
                                </div>
                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="billing_email" class="form__label form__label--2">Correo electrónico
                                            <span class="required">*</span></label>
                                        <input required placeholder="Escribe tu email" type="email" name="email"
                                               id="billing_email"
                                               class="form__input form__input--2">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form__group col-12">
                                        <label for="orderNotes" class="form__label form__label--2">Información adicional
                                            de la entrega</label>
                                        <textarea class="form__input form__input--2 form__input--textarea"
                                                  id="orderNotes" name="order_notes"
                                                  placeholder="Puedes insertar cualquier aclaración para el repartidor."></textarea>
                                    </div>
                                </div>
                                @if(isset($nombre))
                                    <input name="descuento" type="hidden" value="{{$nombre}}">
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-5 offset-xl-1 col-lg-6 mt-md--40">
                        <div class="order-details">
                            <div class="checkout-title mt--10">
                                <h2>Tu pedido</h2>
                            </div>
                            <div class="table-content table-responsive mb--30">
                                <table class="table order-table order-table-2">
                                    <thead>
                                    <tr>
                                        <th>Productos</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\Cart::getContent() as $pr)
                                        <tr>
                                            <th>{{$pr->name}}
                                                <strong><span>&#10005;</span>{{$pr->quantity}}</strong>
                                            </th>
                                            <td class="text-right">{{$pr->price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td class="text-right">{{\Cart::getTotal()}} €</td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Envío</th>
                                        <td class="text-right">
                                            <span>{{\App\Product::PRECIO_ENVIO}} €</span>
                                        </td>
                                    </tr>
                                    @if(isset($nombre))
                                        <tr class="shipping">
                                            <th><b>Descuento</b></th>
                                            <td class="text-right">
                                                <span><b>-{{$descuentoTotal}} €</b></span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th><b>Total del pedido 🔥</b></th>
                                            <td class="text-right"><span class="order-total-ammount">{{$total + \App\Product::PRECIO_ENVIO}} €</span>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="order-total">
                                            <th><b>Total del pedido</b></th>
                                            <td class="text-right"><span class="order-total-ammount">{{\Cart::getTotal() + \App\Product::PRECIO_ENVIO}} €</span>
                                            </td>
                                        </tr>
                                    @endif
                                    </tfoot>
                                </table>
                            </div>
                            <div class="checkout-payment">
                                <div class="payment-form">
                                    <div class="payment-group mt--20">
                                        {{--                                        <p class="mb--15">Your personal data will be used to process your order,--}}
                                        {{--                                            support your experience throughout this website, and for other purposes--}}
                                        {{--                                            described in our privacy policy.</p>--}}

                                        <div class="form-row">
                                            <div class="checkout-title mt--10">
                                                <h2>Datos del pago</h2>
                                            </div>
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>

                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                        {{ csrf_field() }}
                                        <img src="/imgs/payments/securegateway.png"
                                             style="width: 100%;margin-bottom: 20px;margin-top: 20px" alt="">

                                        @if(isset($nombre))
                                            <button id="btnPay" type="submit" class="btn btn-fullwidth btn-style-1">
                                                PAGAR
                                                AHORA {{$total + \App\Product::PRECIO_ENVIO}} €
                                            </button>
                                        @else
                                            <button id="btnPay" type="submit" class="btn btn-fullwidth btn-style-1">
                                                PAGAR
                                                AHORA {{\Cart::getTotal() + \App\Product::PRECIO_ENVIO}} €
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            var publishable_key = '{{ \App\Http\Controllers\PaymentController::getPublishKey() }}';
        </script>
        <script src="/js/card.js"></script>

@endsection
