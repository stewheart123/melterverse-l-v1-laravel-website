@extends('layouts.app')
@section('title', 'Markeplace')
@section('content')
<div class="container">            
    <div class="marketplace row justify-content-center ">
    <p>purchased packs : {{ !empty($purchase_pack_array) ? $purchase_pack_array[0] : ''}}</p>
       
        <div class="col-md-8">
            @foreach ($block_packs as $block_pack)
            <div class="marketplace__pack_card card bg-dark bg-gradient text-white d-flex flex-row">
                <img src="{{$block_pack->bp_image_location}}" width="150" height="150"/>
                    <div class="d-flex flex-column">
                        <h5>{{$block_pack->bp_display_name}}</h5>
                        <p>{{$block_pack->bp_description}}</p>
                        <p>$USDC: {{$block_pack->bp_price}}</p>
                        <p>Downloads: {{$block_pack->bp_total_views}}</p>
                        @if($purchase_pack_array)
                            @php
                                $purchase;
                            @endphp
                            @foreach ($purchase_pack_array as $pp)
                                @if($pp == $block_pack->bp_id) 
                                @php
                                    $purchase = 'true';
                                @endphp
                                @endif
                            @endforeach
                                @if ($purchase == 'true')
                                    <p>already purchased</p>
                                @else
                                    <button>Get this</button>
                                @endif
                        @else    
                        <button>Get this</button>
                        @endif
                        <p>{{$block_pack->bp_id}}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8">
            <div class="card bg-dark bg-gradient text-white">
                <div class="card-header"><h1>Marketplace - coming soon</h1></div>
                <div class="card-body">
                <h4>Melter-Blocks</h4>
                   <p>Talented 3D artist? Why not create custom objects aka 'Melter-Blocks' for the Melterverse?</p>  
                   <p>Set your own price in USDC and connect to your private wallet</p>
                   <p>Looking for a particular Melter-Block but can't find it? Why not create a request for a Melter-Block...</p>

                <br><br>

                <h4>Treasure Chest items</h4>
                <p>Obtain new items to add to your treasure chest to further enhance your experience</p>
                <p>Weapon packs</p>
                <p>Musical Instruments</p>
                <p>Sports equipment</p>
                <p>Transportation</p>
                <p>Music</p>
                <p>Devices</p>

                <br><br>

                <h4>Custom Avatars</h4>
                <p>Find unqiue avatars - from the mundane to the abstract</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
