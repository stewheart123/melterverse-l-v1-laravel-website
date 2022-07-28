@extends('layouts.app')
@section('title', 'Markeplace')
@section('content')
<div class="container">            
    <div class="marketplace row justify-content-center ">
       
        @if($available_block_packs)
            <div class="col-md-12 shadow-sm bg-transparent">
                <h3 class="text-white">Available packs</h3>
                <div class="row d-flex flex-wrap flex-row">

                
                @foreach ($available_block_packs as $block_pack)
                <div class="marketplace__pack_card col-lg-5 card bg-dark bg-gradient text-white d-flex flex-row m-3">
                    <img class="mx-3 my-auto" src="{{$block_pack->bp_image_location}}" width="150" height="150" alt=""/>
                        <div class="d-flex flex-column p-3">
                            <h5>{{$block_pack->bp_display_name}}</h5>
                            <p>{{$block_pack->bp_description}}</p>
                            <p>$USDC: {{$block_pack->bp_price}}</p>
                            <p>Downloads: {{$block_pack->bp_total_views}}</p>
                            <button>Add to my editor</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        
        @if($purchased_block_packs)
            <div class="col-md-12 shadow-sm bg-transparent">
                <h3 class="text-white">Purchased packs</h3>
                <div class="row d-flex flex-wrap flex-row">

                @foreach ($purchased_block_packs as $purchased)
                <div class="marketplace__pack_card col-lg-5 card bg-dark bg-gradient text-white d-flex flex-row m-3">
                    <img class="mx-3 my-auto" src="{{$block_pack->bp_image_location}}" width="150" height="150" alt=""/>
                        <div class="d-flex flex-column p-3">
                            <h5>{{$purchased->bp_display_name}}</h5>
                            <p>{{$purchased->bp_description}}</p>
                            <p>$USDC: {{$purchased->bp_price}}</p>
                            <p>Downloads: {{$purchased->bp_total_views}}</p>
                            <p class="font-italic" >Already available in your editor</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

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
