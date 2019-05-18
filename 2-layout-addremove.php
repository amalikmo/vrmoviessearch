<!DOCTYPE html>
<head>
  <title>Layout Test</title>
  <script src="https://aframe.io/releases/0.8.0/aframe.min.js"></script> 
  <script src="https://unpkg.com/aframe-layout-component@4.3.1/dist/aframe-layout-component.min.js"></script> 
</head>
 
<body>
  <a-scene>
    <script>

      AFRAME.registerComponent('moviesgrid', {

        init: function () {

          var boxinside = document.querySelectorAll('.boxinside');

          
          for (var i = 0; i < boxinside.length; i++) {
            boxinside[i].parentNode.removeChild(boxinside[i]);
          }



          for(i=0; i<5; i++){
            var entityEl = document.createElement('a-entity');
            entityEl.setAttribute('geometry', 'primitive: box');
            entityEl.setAttribute('material', 'color: orange');
            this.el.appendChild(entityEl);
          }
          
        }

      });

      AFRAME.registerComponent('cursor-listener', {
        init: function () {
          // var lastIndex = -1;
          // var COLORS = ['red', 'green', 'blue'];
          // this.el.addEventListener('click', function (evt) {
          //   lastIndex = (lastIndex + 1) % COLORS.length;
          //   this.setAttribute('material', 'color', COLORS[lastIndex]);
          //   console.log('I was clicked at: ', evt.detail.intersection.point);
          // });

          this.el.addEventListener('click', function (evt) {
            console.log('I was clicked at: ');
          });

        }
      });
    </script>
    <a-entity moviesgrid layout="type: box; radius: 2; margin:1.2; columns:3"  position="-1 1.5 -4">
      <a-entity class="boxinside" geometry="primitive: box" material="color: blue"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: red"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: blue"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: red"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: blue"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: red"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: blue"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: red"></a-entity>
      <a-entity class="boxinside" geometry="primitive: box" material="color: red"></a-entity>
    </a-entity>
    <a-entity camera look-controls position="0.5 3 0">
        <a-entity cursor="fuse: true; fuseTimeout: 500"
                  position="0 0 -1"
                  geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03"
                  material="color: black; shader: flat">
        </a-entity>
      </a-entity>
      <a-entity cursor-listener geometry="primitive: plane; height:1; width:1" position="-1.5 4 -2" material="color: green"></a-entity>
  </a-scene>
</body>