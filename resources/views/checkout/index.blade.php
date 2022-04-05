@extends('dashboard.index')
@section('content')
@include('partials.message')
<table id="cart" class="table table-hover table-condensed">
  <thead>
      <tr>
          <th style="width:50%">Product</th>
          <th style="width:10%">Price</th>
          <th style="width:8%">Quantity</th>
          <th style="width:22%" class="text-center">Subtotal</th>
          <th style="width:10%"></th>
      </tr>
  </thead>
  <tbody>
    {{ Form::open(['url' => route('checkout.payment'), 'method' => 'PUT'])}}
      @php $total = 0 @endphp
      {{-- @php dd(session('cart')); @endphp --}}
      @if(session('cart'))
          @foreach(session('cart') as $id => $details)
              @php 
            //   dd($details);
              $total += $details['price'] * $details['quantity'] 
              @endphp
              <tr data-id="{{ $id }}">
                  <td data-th="Product">
                      <div class="row">
                          <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                          <div class="col-sm-9">
                              <h4 class="nomargin">{{ $details['name'] }}</h4>
                          </div>
                      </div>
                  </td>
                  <td data-th="Price">RM{{ $details['price'] }}</td>
                  <td data-th="Quantity">{{ $details['quantity'] }}</td>
                  <td data-th="Subtotal" class="text-center">RM{{ $details['price'] * $details['quantity'] }}</td>

              </tr>
          @endforeach
            @php 
            $totalTax = $details['price'] * 0.06 
            @endphp
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="nomargin">Tax</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">6 %</td>
                <td data-th="Quantity">1</td>
                <td data-th="Subtotal" class="text-center">RM{{$totalTax}}</td>
            </tr>
            @php 
            $totalServices = $details['price'] * 0.06 
            @endphp
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="nomargin">Services Charge</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">6 %</td>
                <td data-th="Quantity">1</td>
                <td data-th="Subtotal" class="text-center">RM{{$totalServices}}</td>
            </tr>
            @if ($promocode != NULL)
            <tr>
                <td data-th="Product">
                    Promo Code  
                  </td>
                  <td data-th="Price">{{$promocode->coupon_code}}</td>
                  <td data-th="Quantity"></td>
                  <td data-th="Subtotal" class="text-center">- RM{{ $promocode->amount }}</td>
            </tr>
            <tr>
                <td data-th="Product">
                  Total  
                </td>
                <td data-th="Price"></td>
                <td data-th="Quantity"></td>
                <td data-th="Subtotal" class="text-center">RM{{ $totalTax+$total+$totalServices-$promocode->amount }}</td>
            </tr>
            @endif
      @endif
  </tbody>
  <tfoot>
        {{-- <input type="hidden" id="details" name="details" value={{$details}}> --}}
        <tr>
            <td colspan="5" class="text-left"><h3><strong>Please Confirm Your Details below <br>
                Name :  {{ $user->name }}<br>
                Phone Number :  {{ $user->phone_number }}
            <br>Address : {{ $userDefaultAddress->address_1 }}<br>{{ $userDefaultAddress->address_1 }}<br>{{ $userDefaultAddress->postcode }}<br>{{ $userDefaultAddress->city }}<br>{{ $userDefaultAddress->state }}</strong></h3><br>
            Type Of Payment : <select class="form-select" aria-label="Default select example" id="type_payment" name="type_payment">
                <option value="Online Banking" selected>Online Banking</option>
                <option value="Touch and Go">Touch and Go</option>
                <option value="COD">COD</option>
              </select><br><br>
                {{-- <label for="promo_code">Promo Code:</label>
                <input type="text" id="promo_code" name="promo_code"> --}}
        </td>
        </tr>
        {{-- <tr>
            <td colspan="5" class="text-right"><h3><strong>Total RM {{ $totalTax+$total+$totalServices }}</strong></h3></td>
            <td colspan="5" class="text-right"><h3><strong> <input type="hidden" id="TotalAll" name="TotalAll" value="{{$totalTax+$total+$totalServices}}"></td>
        </tr> --}}
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/menu') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                @if(session('cart'))
                <input type="hidden" id="promocodeID" name="promocodeID" value="{{$promocode->id}}">
                <input type="hidden" id="total_price_calculate_all" name="total_price_calculate_all" value="{{$totalTax+$total+$totalServices-$promocode->amount}}">
                <input type="hidden" id="total_price" name="total_price" value="{{$total+$totalServices}}">
                <input type="hidden" id="discount" name="discount" value="{{$promocode->amount}}">
                <input type="hidden" id="tax" name="tax" value="{{$totalTax}}">
                <input type="hidden" id="service" name="service" value="{{$totalServices}}">

                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-angle-right"></i>
                    Checkout
                </button>
                @endif
               
                {{ Form::close() }}
                {{-- <a href="{{ url('/checkout') }}" class="btn btn-success"><i class="fa fa-angle-right"></i> Pay</a> --}}
            </td>
        </tr>
  </tfoot>
</table>
<script type="text/javascript">
  $(".update-cart").change(function (e) {
    e.preventDefault();
    var ele = $(this);

    $.ajax({
        url: '{{ route('updateCart.cart') }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}', 
            id: ele.parents("tr").attr("data-id"), 
            quantity: ele.parents("tr").find(".quantity").val()
        },
        success: function (response) {
            window.location.reload();
        }
    });
  });

  $(".remove-from-cart").click(function (e) {
    e.preventDefault();

    var ele = $(this);

    if(confirm("Are you sure want to remove?")) {
        $.ajax({
            url: '{{ route('remove.from.cart') }}',
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id")
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
  });

</script>
@endsection

