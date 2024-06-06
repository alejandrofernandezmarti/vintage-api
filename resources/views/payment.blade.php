@extends('layouts.app')
@section('content')
    <script src="https://js.stripe.com/v3/"></script>
    <div class="row">
        <div class="col-0 col-lg-0 col-xl-2"></div>

        <div class="col-12 col-md-11 col-lg-6 col-xl-5 pt-5 mb-5 view">
            <div class="order-form">

                <form action="{{ route('create.order') }}" method="POST" id="payment-form">
                    @csrf
                    <h3>Información de contacto</h3>
                    <div class="form-group mt-4">
                        <label for="email"></label>
                        <input type="email" id="email"  name="email" placeholder="{{ $email ?? 'Correo Electrónico' }}" value="{{ $email ?? '' }}" required>
                    </div>
                    @if(isset($id))
                        <input type="hidden" name="id" value="{{ $id }}">
                    @endif
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
                            <div class="payment-group mt-10">
                                <div class="form-row">
                                    <div class="checkout-title mt-10">
                                        <h2>Datos del pago</h2>
                                    </div>
                                    <div id="card-element" class="col-9">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>

                                    <div  id="payment-form">
                                        @foreach($productos as $index => $producto)
                                            <input type="hidden" name="productos[]" value="{{ json_encode($producto) }}">
                                        @endforeach

                                        <button class="mt-3" id="btnPay" type="submit">Confirmar Pedido</button>
                                    </div>
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
                <img class="col-4 img-carrito-check" src="{{ $producto->imagenes->url_1 }}" alt="Producto">
                <div class="col-8">
                    <p class="carrito-text">{{ $producto->nombre }}</p>
                    <p class="carrito-text">{{ $producto->precio_ud }} EUR</p>

                    <div class="row">
                        <p class="carrito-text col-6">Cantidad: {{ $producto->cantidad }}</p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="final-price mt-5">
                <div class="row">
                    <p class="float-left offset-1 col-7">Subtotal</p>
                    <p class="float-left col-4">{{ $precios['precioProductos'] }} EUR</p>
                </div>
                <div class="row">
                    <p class="float-left offset-1 col-7">Envío</p>
                    <?php if ($precios['precioEnvio'] >= 400): ?>
                    <p class="float-left col-4">Gratis</p>
                    <?php else: ?>
                    <p class="float-left col-4">{{ $precios['precioEnvio'] }} EUR</p>
                    <?php endif; ?>
                </div>
                <div class="borde"></div>
                <div class="row mt-4 mb-5 final">
                    <p class="float-left offset-1 col-7">TOTAL</p>
                    <p class="float-left col-4">{{ $precios['precioTotal'] }} EUR</p>
                </div>
            </div>
        </div>

    </div>


    <script src="../js/card.js"></script>
    <script>
        var publishable_key = '{{ env('STRIPE_KEY') }}';
    </script>

@endsection
