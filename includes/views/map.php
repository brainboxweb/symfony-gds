<?php

$locationArray = array();


$locationArray['karate-london/karate-barnes'] = array('mag' => 14, 'lat'=>51.47524700626047, 'long'=>-0.2426701784133911, 'text'=>'Kitson Hall, Barnes');
$locationArray['karate-london/barnes-green-centre'] = array('mag' => 15, 'lat'=>51.47344448185188, 'long'=>-0.24606585502624512, 'text'=>'Barnes Green Centre, Barnes');
$locationArray['karate-london/barnes-methodist-church'] = array('mag' => 15, 'lat'=>51.47189405788343, 'long'=>-0.24649500846862793, 'text'=>'Barnes Methodist Church, Barnes');

$locationArray['karate-london/st-etheldreda'] = array('mag' => 14, 'lat'=>51.47480774214944, 'long'=>-0.21461963653564453, 'text'=>'St Etheldredas Church, Fulham');
$locationArray['karate-london/st-clements'] = array('mag' => 14, 'lat'=>51.48267910524622, 'long'=>-0.21915793418884277, 'text'=>'St Clements Church Hall, Fulham');

$locationArray['karate-surrey/getting-to-rodborough-stc'] = array('mag' => 13, 'lat'=>51.16272067090049, 'long'=>-0.6494218111038208, 'text'=>'Rodborough School & Technology College, Godalming');
$locationArray['karate-surrey/getting-to-ockford-scout-hut'] = array('mag' => 14, 'lat'=>51.18211558374464, 'long'=>-0.6315663456916809, 'text'=>'Ockford Scout Hut, Godalming');?>












<script type="text/javascript" src="http://www.google.com/jsapi?key=<?php echo GOOGLE_MAPS_KEY ?>">
</script>


<script type="text/javascript" charset="utf-8">

     google.load("maps", "2");
     google.load("jquery", "1.4");
     
</script>



<script type="text/javascript" charset="utf-8">
     $(document).ready(function(){

          var map = new GMap2(document.getElementById('map'));
          
          map.addControl(new GLargeMapControl());
          
          var KitsonHall = new GLatLng(<?php echo $locationArray[$location]['lat'] ?>, <?php echo $locationArray[$location]['long'] ?>);
          map.setCenter(KitsonHall, <?php echo $locationArray[$location]['mag'] ?>);
          
          var markers = [];
          
          marker = new GMarker(KitsonHall);
          map.addOverlay(marker);
          
          
          markers[0] = marker;


          $(markers).each(function(i,marker){
                    
                    GEvent.addListener(marker, "click", function(){

                             map.panTo(marker.getPoint());
                    });
                    
                    GEvent.addListener(marker, "mouseover", function(){

                            displayPoint(marker, i);
                    });
                    
                    GEvent.addListener(marker, "mouseout", function(){
                        
                              $("#message")
                              .hide()
                    });
          });
          
          $("#message").appendTo(map.getPane(G_MAP_FLOAT_SHADOW_PANE));
          
          
          function displayPoint(marker, i){
          
          var markerOffset = map.fromLatLngToDivPixel(marker.getPoint());
          
               $("#message")
                    .show()
                    .text('<?php echo $locationArray[$location]['text'] ?>')
                    .css({ top:markerOffset.y, left:markerOffset.x });
          
          }
          
          
          
          
     });

</script>