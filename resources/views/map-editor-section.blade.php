@extends('layouts.app')
@section('title', 'Map Editor')


@section('head')
<link rel="shortcut icon" href="TemplateData/favicon.ico">
<link rel="stylesheet" href="TemplateData/style.css">
@endsection

@section('game-content')
<div class="container">
  <div class="row">
    <div class="col-12">
    <div class="card bg-dark bg-gradient text-white">
        <div class="card-header"><h1>Build Your World</h1></div>
        @if (!Auth::check())
        <p class="ms-4">create an account and login to save you maps</p>
        @endif
        @if (Auth::check())              
          <div class="card-body">
            <form action="token" method="POST" class="pb-2">
              To access your custom Melter Blocks, request a token. In the login screen type in the token.
              <br><br>
              Click 'Ignore' in the editor to use the default Melter Blocks. 
              <button type="submit">create access token</button>
              @csrf
            </form>
            <h3 class="info-text">{!! !empty($token_return_string) ? $token_return_string : "click 'create access token' " !!} </h3>
            @endif
            <div id="unity-container" class="unity-desktop">
      <canvas id="unity-canvas" width=960 height=600></canvas>
      <div id="unity-loading-bar">
        <div id="unity-logo"></div>
        <div id="unity-progress-bar-empty">
          <div id="unity-progress-bar-full"></div>
        </div>
      </div>
      <div id="unity-mobile-warning">
        WebGL builds are not supported on mobile devices.
      </div>
      <div id="unity-footer">
        <div id="unity-webgl-logo"></div>
        <div id="unity-fullscreen-button"></div>
        <div id="unity-build-title">Map Editor GL</div>
      </div>
    </div>
    <script>
      var buildUrl = "Build";
      var loaderUrl = buildUrl + "/Laravel Build 1.loader.js";
      var config = {
        dataUrl: buildUrl + "/Laravel Build 1.data",
        frameworkUrl: buildUrl + "/Laravel Build 1.framework.js",
        codeUrl: buildUrl + "/Laravel Build 1.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "Melterverse",
        productName: "Map Editor GL",
        productVersion: "0.3",
      };

      var container = document.querySelector("#unity-container");
      var canvas = document.querySelector("#unity-canvas");
      var loadingBar = document.querySelector("#unity-loading-bar");
      var progressBarFull = document.querySelector("#unity-progress-bar-full");
      var fullscreenButton = document.querySelector("#unity-fullscreen-button");
      var mobileWarning = document.querySelector("#unity-mobile-warning");

      // By default Unity keeps WebGL canvas render target size matched with
      // the DOM size of the canvas element (scaled by window.devicePixelRatio)
      // Set this to false if you want to decouple this synchronization from
      // happening inside the engine, and you would instead like to size up
      // the canvas DOM size and WebGL render target sizes yourself.
      // config.matchWebGLToCanvasSize = false;

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        container.className = "unity-mobile";
        // Avoid draining fillrate performance on mobile devices,
        // and default/override low DPI mode on mobile browsers.
        config.devicePixelRatio = 1;
        mobileWarning.style.display = "block";
        setTimeout(() => {
          mobileWarning.style.display = "none";
        }, 5000);
      } else {
        canvas.style.width = "960px";
        canvas.style.height = "600px";
      }
      loadingBar.style.display = "block";

      var script = document.createElement("script");
      script.src = loaderUrl;
      script.onload = () => {
        createUnityInstance(canvas, config, (progress) => {
          progressBarFull.style.width = 100 * progress + "%";
        }).then((unityInstance) => {
          loadingBar.style.display = "none";
          fullscreenButton.onclick = () => {
            unityInstance.SetFullscreen(1);
          };
        }).catch((message) => {
          alert(message);
        });
      };
      document.body.appendChild(script);
    </script>
          </div>
        </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card bg-dark bg-gradient text-white p-5">
        <h3>Controls</h3>
        <p class="text-info">Navigate Map<span class="text-white"> AWSD / directional keys</span></p>
        <p class="text-info">Rotate Map<span class="text-white"> Q</span></p>
        <p class="text-info">Plot Block onto map<span class="text-white"> Left Mouse Button</span></p>
        <p class="text-info">Rotate Block<span class="text-white"> Right Mouse Button</span></p>
        <p class="text-info">Delete a block<span class="text-white"> click 'remove' button, then click on blocks to delete</span></p>
        <p class="text-info">Increase X axis of block<span class="text-white"> 0</span></p>
        <p class="text-info">Increase Z axis of block<span class="text-white"> 8</span></p>
        <p class="text-info">Increase Y axis of block<span class="text-white"> 9</span></p>
        <p class="text-info">Decrease X axis of block<span class="text-white"> 0 + shift</span></p>
        <p class="text-info">Decrease Z axis of block<span class="text-white"> 8 + shift</span></p>
        <p class="text-info">Decrease Y axis of block<span class="text-white"> 9 + shift</span></p>
        <p class="text-info">Increase altitude of block<span class="text-white"> P or 'up UI button'</span></p>
        <p class="text-info">Decrease altitude of block<span class="text-white"> L or 'down UI button'</span></p>
      </div>
    </div>
    </div>

@endsection