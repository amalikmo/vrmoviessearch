<!DOCTYPE html>
<head>
  <title>Layout Test</title>
  <script src="https://rawgit.com/aframevr/aframe/c4aa63e/dist/aframe-master.min.js"></script> 
  <script src="https://unpkg.com/aframe-layout-component@4.3.1/dist/aframe-layout-component.min.js"></script>
  <script src="dist/aframe-super-keyboard.min.js"></script>
    <script src="https://unpkg.com/aframe-environment-component@1.0.0/dist/aframe-environment-component.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script> 
</head>
 
<body>
  <a-scene environment="preset: contact; skyColor: #112214; horizonColor: #478d54; ground: hills; groundTexture: checkerboard; groundColor: #4f3e4b; groundColor2: #4d3c47; dressing: none; grid: none" >
    <script>

      AFRAME.registerComponent('moviesgrid', {

        init: function () {

          movieg = this.el;


          addEventListener('movieselect', function(e){
            console.log(e.detail);
            removeAll();
            fetchAll(e.detail.title);

          });
          removeAll();

          

          function removeAll(){
            var boxinside = document.querySelectorAll('.boxinside');
            for (var i = 0; i < boxinside.length; i++) {
              boxinside[i].parentNode.removeChild(boxinside[i]);
            }
          }

          fetchAll();

          
          

          



          // for(i=0; i<5; i++){
          //   var entityEl = document.createElement('a-entity');
          //   entityEl.setAttribute('geometry', 'primitive: box');
          //   entityEl.setAttribute('material', 'color: orange');
          //   this.el.appendChild(entityEl);
          // }
          function fetchAll(title="blade"){
            $.get("http://www.omdbapi.com/?s="+title+"&apikey=10181b2b", function(data) {
            
            // console.log(data.Search);
            obj = data.Search;

            for(i=0; i<obj.length; i++){
              // console.log(obj[i]);
              var entityEl = document.createElement('a-entity');
              entityEl.setAttribute('geometry', 'primitive: plane');
              entityEl.setAttribute('class', 'boxinside');
              entityEl.setAttribute('material', 'color: white; src: '+obj[i].Poster+' ');
              

              var entityText = document.createElement('a-entity');
              entityText.setAttribute('text', 'value: '+obj[i].Title+'; align:center');
              entityText.setAttribute('geometry', 'primitive: plane; width: 1; height: 1');
              entityText.setAttribute('position', '0 0 0');
              entityText.setAttribute('material', 'color: transparent');
              entityEl.appendChild(entityText);

              movieg.appendChild(entityEl);



              }
            })
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

          var buttonm = this.el;

          this.el.addEventListener('click', function (evt) {
            // console.log('I was clicked at: ');
            // console.log(buttonm.getAttribute('text'));
            text = buttonm.getAttribute('text').value;
            // console.log(text);
            buttonm.emit('movieselect', {title: text});

          });

        },
        update: function () {
          //this.el.emit('movieselect');
        },
        
      });

      AFRAME.registerComponent('mainkeyboard', {
        init: function () {
          var elm = this.el;

          elm.addEventListener('superkeyboardinput', function(elm){
            console.log(this.components['super-keyboard'].data.value);

            this.emit('movieselect', {title: this.components['super-keyboard'].data.value});

          })

          addEventListener('showkeyboard', function(e){
            elm.components['super-keyboard'].data.show = true;
            console.log(elm);
          })

        }
      });

       AFRAME.registerComponent('cursor-listener-2', {
        init: function () {
          var buttonm = this.el;
          this.el.addEventListener('click', function (evt) {
            
            buttonm.emit('showkeyboard');

          });
        }
       })
    </script>


    <a-entity id="mouseCursor" cursor="rayOrigin: mouse"></a-entity>

    <a-entity id="keyboard" mainkeyboard super-keyboard="hand: #hand; imagePath:dist/" position="0 0.7 -1.15" rotation="-30 0 0"></a-entity>


    <a-entity moviesgrid layout="type: box; radius: 2; margin:1.2; columns:5"  position="-2.4 0.7 -3">
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
    <!-- <a-entity camera  position="0.5 3 0"> -->
<!--       <a-entity cursor="fuse: true; fuseTimeout: 500"
                position="0 0 -1"
                geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03"
                material="color: black; shader: flat">
      </a-entity> -->

    <!-- </a-entity> -->
      <a-entity  id="hand" laser-controls="hand: right" raycaster="objects: .buttonsT">
        <a-sphere radius="0.03"></a-sphere>
      </a-entity>

    <!-- <a-entity geometry="primitive: plane; height:auto; width:1" material="color:blue" text="value: inception; align:center" position="-0 3.5 -2"></a-entity> -->
    <a-entity class="buttonsT" cursor-listener geometry="primitive: plane; height:auto; width:1" material="color:blue" text="value: inception; align:center; width: 4;" position="-1.47 2.6 -2"></a-entity>
    <a-entity class="buttonsT" cursor-listener geometry="primitive: plane; height:auto; width:1" material="color:blue" text="width: 4; value: blade; align:center" position="1.5 2.6 -2"></a-entity>
    <a-entity cursor-listener-2 geometry="primitive: plane; height:0.5; width:0.5" position="0 0.5 -1.5" material="color: transparent; alphaTest: 0.9; src: search.png"></a-entity>
  </a-scene>
</body>