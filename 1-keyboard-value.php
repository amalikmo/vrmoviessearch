<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>A-Frame Super Keyboard - Basic</title>
    <meta name="description" content="Basic example for Super Keyboard."></meta>
    <script src="https://rawgit.com/aframevr/aframe/c4aa63e/dist/aframe-master.min.js"></script>
    <script src="dist/aframe-super-keyboard.min.js"></script>
    <script src="https://unpkg.com/aframe-environment-component@1.0.0/dist/aframe-environment-component.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>

    
  </head>
  <body>
    <script>
      AFRAME.registerComponent('mainkeyboard', {
        init: function () {
          var elm = this.el;

          elm.addEventListener('superkeyboardinput', function(elm){
            console.log(this.components['super-keyboard'].data.value);

          })
        }
      });
      </script>
    <a-scene environment="preset: contact; skyColor: #112214; horizonColor: #478d54; ground: hills; groundTexture: checkerboard; groundColor: #4f3e4b; groundColor2: #4d3c47; dressing: none; grid: none">

      
      
      <a-entity id="mouseCursor" cursor="rayOrigin: mouse"></a-entity>

      <a-entity id="hand" laser-controls="hand: right">
        <a-sphere radius="0.03"></a-sphere>
      </a-entity>

      <!-- Change hand to `#hand` for VR. -->
      <a-entity id="keyboard" mainkeyboard super-keyboard="hand: #mouseCursor; imagePath:dist/" position="0 1.076 -0.5" rotation="-30 0 0"></a-entity>
      <a-entity class="abdi"></a-entity>

    </a-scene>


  </body>
</html>
