@extends('dashboard.index')
@section('content')

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
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total RM {{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/menu') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                @if(session('cart'))
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-angle-right"></i>
                    Pay
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

