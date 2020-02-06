@extends('layouts.app')

@section('content')
    @if (Auth::user() != null)
        <?php $number = 1 ?>
        <?php $total = 0 ?>
        <div class="panier">

            <div class="top"><h1 class="title">Your cart</h1></div>
            <table class="info">
                <tr class ="tr">
                    <td>N °</td>
                    <td>Picture</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                </tr>
                @foreach($product as $value)
                <tr>
                    <td>{{$number}}</td>
                    <td><img src="{{$value->picture}}" class="panierimg"></td>
                    <td>{{$value->name}}</td>
                    <td><label for="text">{{$value->price}},00 $</label></td>
                        <?php $total += $value->price * $carts[$number - 1]->quantity?>

                    <td><form action="{{action('CartController@update_quantity')}}" method="post" id="product">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}"/>
                        <input type="number" name="amount" min="1" max="10"
                               value="{{$carts[$number - 1]->quantity}}" style="width:50px" required/>
                        <input type="hidden" name="id_product" value="{{$value->id}}"/>
                        <input type="hidden" name="id" value="{{$carts[$number - 1]->id}}"/>
                        <button type="submit"><i class="fas fa-edit"></i></button>
                        </form></td>
                    <td><a href="/remove/{{$carts[$number - 1]->id}}/{{Auth::user()->id}}"><i class="fas fa-times-circle"></i></a></td>
                    <?php $number++ ?>
                    @endforeach
                </tr>

            </table>
        </div>

        <div class="pay">
            <h1>Total :</h1>
            <label for="text">{{$total}},00 $</label>
            <br><br>

            <a href="/pay/{{$total}}"><div class="enjoy-css">Pay</div></a>
            <br><br>
            @if(\Session::has('message'))
                <a href="/update_profile/{{Auth::user()->id}}" style="color: #960023; text-decoration: none">{!! \Session::get('message') !!}</a>
            @endif
            <div></div>
            <br>
        </div>
    @endif
@endsection