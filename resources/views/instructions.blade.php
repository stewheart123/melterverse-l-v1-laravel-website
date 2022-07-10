@extends('layouts.app')

@section('content')
<div class="container">            
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark bg-gradient text-white">
                <div class="card-header"><h1>Knowledge Base</h1></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    There's nothing more annoying than getting lost in the jargon of tec.<br>
                     We're constantly documenting as we build and hope to offer all the information you could possibly need, 
                     plus assuming that you're brand new to this.
                     <br> <br>
                     <h3>Our Principles</h3>                     
                     <ul>
                        <li><strong class="text-info">A place that's safe, comfortable and transparent for all users.</strong></li>
                        <li><strong class="text-info">You are the creator of your world. You decide it's content.</strong></li>
                        <li><strong class="text-info">Can't find the 3D asset you're looking for? Let us know.</strong></li>
                     </ul>
                     

                     <h4>What is MelterVerse?</h4>
                     <ul>
                        <li>Melterverse allows you to build a custom 3D environment via our website or desktop app. The current 3D objects in the editor 'palette'
                             are currently free.</li>
                        <li>After creating a map, you can access it in VR via our app + an occulus Quest 2.</li>
                        <li>It's also possible to experience the map in a 2D viewer version.</li>
                        <li>You can invite people to your world just like a multiplayer game, complete with VOIP.</li>
                        <li>When you're in your custom world you can open your 'treasure chest', here you will find things to entertain you, such as
                            sports / games equipment, transport, music etc.
                        </li>
                     </ul>

                     <h4>Upcoming Features</h4>
                     <ul>
                        <li>Upload your own custom 3D objects to add to your world</li>
                        <li>More interactive objects for your treasure chest - including jetpacks and e-scooters!</li>
                        <li>Creator platform - become a creator and sell your own custom blocks for USDC.</li>
                        <li>More precision for the map editor.</li>
                     </ul>
                     
                     <h4>How to use MelterVerse</h4>
                     <ul>
                        <li>How do I build a map?</li>
                        <li>Are there any hidden costs?</li>
                        <li>Is this suitable for children?</li>
                        <li>How do I invite people to my world?</li>
                        <li>What's the difference between a 'world' and a 'map'</li>
                        <li>Is there a difference between the online map editor and the desktop version?</li>
                        <li></li>
                     </ul>

                     <h4>Safety guidlines</h4>
                     <ul>
                        <li>How do I build a map?</li>
                        <li>Are there any hidden costs?</li>
                        <li>Is this suitable for children?</li>
                        <li>How do I invite people to my world?</li>
                        <li>What's the difference between a 'world' and a 'map'</li>
                        <li>Is there a difference between the online map editor and the desktop version?</li>
                        <li></li>
                     </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection