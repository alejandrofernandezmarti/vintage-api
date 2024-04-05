@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-0 col-lg-0 col-xl-2"></div>

        <div class="col-12 col-md-11 col-lg-6 col-xl-5 pt-5 mb-5 view">
            <div class="order-form">

                <form action="{{ route('create.order') }}" method="POST">
                    @csrf
                    <h3>Información de contacto</h3>
                    <div class="form-group mt-4">
                        <label for="email"></label>
                        <input type="email" id="email"  name="email" placeholder="Correo Electrónico" required>
                    </div>
                    <h3 class="mt-5">Dirección de envío</h3>
                    <div class="row">
                        <div class="form-group mt-3 col-12 col-md-6">
                            <label for="name"></label>
                            <input type="text" id="name"  name="name" placeholder="Nombre" required>
                        </div>
                        <div class="form-group mt-3 col-12 col-md-6">
                            <label for="surname"></label>
                            <input type="text" id="surname"  name="surname" placeholder="Apellidos" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address"></label>
                        <input type="text" id="address" name="address" placeholder="Dirección" required>
                    </div>
                    <div class="row">

                        <div class="form-group col-12  col-md-4">
                            <label for="postal-code"></label>
                            <input type="text" id="postal-code"  name="postalCode" placeholder="Código Postal" required>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="city"></label>
                            <input type="text" id="city"  name="city" placeholder="Ciudad" required>
                        </div>
                        <div class="form-group col-12  col-md-4">
                            <label for="province"></label>
                            <select id="province"  name="province">
                                <option value="" class="text-muted" disabled>Provincia / Estado</option>
                                @foreach($provincias as $provincia)
                                    <option value="{{ $provincia }}">{{ $provincia }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="phone"></label>
                        <input type="tel" id="phone"  name="phone" placeholder="Teléfono" required>
                    </div>
                    <div class="checkout-payment">
                        <div class="payment-form">
                            <div class="payment-group mt--20">
                                <div class="form-row">
                                    <div class="checkout-title mt--10">
                                        <h2>Datos del pago</h2>
                                    </div>
                                </div>

                                <div  id="payment-form">
                                    <?php foreach ($productos as $index => $producto): ?>
                                    <div class="checkout-object row">
                                        <input type="hidden" name="ids[]" value="{{$producto->id }}" >
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="form-row">
                                        <label class="mt-3 mb-3" for="card-element">
                                            Credit or debit card
                                        </label>
                                        <div id="card-element" class="col-9">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <button class="mt-3">Submit Payment</button>
                                    {{ csrf_field() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-12 col-lg-6 col-xl-5 pt-5 pt-md-5 cart-check">
            <?php foreach ($productos as $index => $producto): ?>
            <div class="checkout-object row">
                <img class="col-3 img-carrito-check" src="<?php echo $producto->imagen->url_1; ?>" alt="Producto">
                <div class="col-9">
                    <p class="carrito-text"><?php echo $producto['nombre']; ?></p>
                    <p class="carrito-text"><?php echo $producto['precio']; ?> EUR</p>

                    <div class="row">
                        <p class="carrito-text col-6">Talla: <?php echo $producto->talla->real; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="final-price mt-5">
                <div class="row">
                    <p class="float-left offset-1 col-7">Subtotal</p>
                    <p class="float-left col-4"><?php echo 'hola'; ?> EUR</p>
                </div>
                <div class="row">
                    <p class="float-left offset-1 col-7">Envío</p>
                    <?php if (100 >= 65): ?>
                    <p class="float-left col-4">Gratis</p>
                    <?php else: ?>
                    <p class="float-left col-4">3.90 EUR</p>
                    <?php endif; ?>
                </div>
                <div class="borde"></div>
                <div class="row mt-4 mb-5 final">
                    <p class="float-left offset-1 col-7">TOTAL</p>
                    <p class="float-left col-4">123€</p>
                </div>
            </div>
        </div>

    </div>


    <script src="/js/card.js"></script>
    <script>
        var publishable_key = '{{ env('STRIPE_KEY') }}';
    </script>

@endsection
