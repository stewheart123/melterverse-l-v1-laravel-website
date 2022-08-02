@extends('layouts.app')
@section('title', 'Markeplace')
@section('content')
<div class="container">            
    <div class="marketplace row justify-content-center ">
       
        
        <div class="col-lg-12 shadow-sm bg-dark bg-gradient my-3 py-3" style="--bs-bg-opacity: .8;">
            <h3 class="text-white">Available packs</h3>
            
                <p class="text-white">You can create your own packs and <a href="/upload">upload</a> them to the marketplace!</p>
                <div class="row d-flex flex-wrap flex-row">                                    
                @foreach ($available_block_packs as $block_pack)
                <div class="marketplace__pack_card col-lg-5 card bg-dark bg-gradient text-white d-flex flex-row m-3">
                    <img class="mx-3 my-auto" src="{{$block_pack->bp_image_location}}" width="150" height="150" alt=""/>
                        <div class="d-flex flex-column p-3">
                            <h5>{{$block_pack->bp_display_name}}</h5>
                            <p>{{$block_pack->bp_description}}</p>
                            <p>$USDC: {{$block_pack->bp_price}} (FREE)</p>
                            <p>Downloads: {{$block_pack->bp_total_views}}</p>
                            <form action="addBlockPackToAccount" method="POST" enctype="multipart/form-data">
                                 {{ csrf_field() }}
           
                                 <input type = "hidden" name = "pack_id_order" value = "{{$block_pack->bp_id}}" />
                            <button type="submit" class="btn btn-primary btn-sm">Add to my editor</button>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        
        @if($purchased_block_packs)
            <div class="col-lg-12 shadow-sm bg-dark bg-gradient my-3 py-3" style="--bs-bg-opacity: .8;">
                <h3 class="text-white">Purchased packs</h3>
                <div class="row d-flex flex-wrap flex-row">

                @foreach ($purchased_block_packs as $purchased)
                <div class="marketplace__pack_card col-lg-5 card bg-dark bg-gradient text-white d-flex flex-row m-3">
                    <img class="mx-3 my-auto" src="{{$purchased->bp_image_location}}" width="150" height="150" alt=""/>
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

        @if($your_created_packs)
            <div class="col-lg-12 shadow-sm bg-dark bg-warning bg-gradient my-3 py-3" style="--bs-bg-opacity: .8;">
                <h3 class="text-white">Your created packs</h3>
                <div class="row d-flex flex-wrap flex-row">

                @foreach ($your_created_packs as $creation)
                <div class="marketplace__pack_card col-lg-5 card bg-dark bg-gradient text-white d-flex flex-row m-3">
                    <img class="mx-3 my-auto" src="{{$creation->bp_image_location}}" width="150" height="150" alt=""/>
                        <div class="d-flex flex-column p-3">
                            <h5>{{$creation->bp_display_name}}</h5>
                            <p>{{$creation->bp_description}}</p>
                            <p>$USDC: {{$creation->bp_price}}</p>
                            <p>Downloads: {{$creation->bp_total_views}}</p>
                            <form action="destroyBlockPack" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type = "hidden" name = "block_pack" value = "{{$creation->bp_id}}" />
                                <button type="submit" class="btn btn-outline-danger">Delete Pack</button>
                            </form>
                            
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
                <p>Find unqiue avatars - from the formal to the abstract. Human, mech, animal, surreal. </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
