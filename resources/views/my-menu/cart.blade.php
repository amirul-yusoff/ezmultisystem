@extends('dashboard.index')
@section('content')
@if(session('cart'))
{{ Form::open(['url' => route('checkout.checkout'), 'method' => 'GET'])}}

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
      @php $total = 0 @endphp
      {{-- @php dd(session('cart')); @endphp --}}
      {{-- @if(session('cart')) --}}
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
                  <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                  </td>
                  
                  
                  <td data-th="Subtotal" class="text-center">RM{{ $details['price'] * $details['quantity'] }}</td>
                  <td class="actions" data-th="">
                      <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa-regular fa-trash-can"></i> Remove</button>
                  </td>
              </tr>
          @endforeach
          <tr>
            <td>
              <label for="promo_code">Promo Code:</label>
              <input type="text" id="promo_code" name="promo_code">
            </td>
          </tr>
         
      {{-- @endif --}}
  </tbody>
  <tfoot>
      <tr>
          <td colspan="5" class="text-right"><h3><strong>Total RM {{ $total }}</strong></h3></td>
      </tr>
      <tr>
          <td colspan="5" class="text-right">
              <a href="{{ url('/home') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
              
              <a href="{{ url('/checkout') }}" class="btn btn-success"><i class="fa fa-angle-right"></i> Checkout</a>
              <button class="btn btn-primary" type="submit"><i class="fa fa-angle-right"></i>
              Pay
            </button>
          </td>
      </tr>
  </tfoot>
</table>
{{ Form::close() }}

@endif
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

