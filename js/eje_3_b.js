
 var map = L.map('map').setView([-27.3698805,-55.9399215], 17);
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiNjRiaXRzanVhbiIsImEiOiJjbDJhcDVkdjMwN2d4M2pxbjRzaHY3NHlyIn0.JGc3z4I7Go_JgaZLc0VTkA'
}).addTo(map);
var marker=null;

function centrarMapa (){
    if(this.marker){
        this.marker.remove();
      }
    this.map.setView([document.getElementById('lat').value,document.getElementById('long').value], 17);
    this.marker = L.marker([document.getElementById('lat').value,document.getElementById('long').value],{title:"título a mostrar"}).addTo(map);

}
