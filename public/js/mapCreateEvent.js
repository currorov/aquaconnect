var map = L.map('map').setView([39.130969, -0.243441], 12); 
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([39.130969, -0.243441], { draggable: true }).addTo(map);  

    marker.on('dragend', function (e) {
        var latlng = e.target.getLatLng();
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        document.getElementById('location').value = '(' + latlng.lat + ', ' + latlng.lng + ')';
    });

    document.getElementById('latitude').addEventListener('input', function() {
        var lat = parseFloat(this.value);
        var lng = parseFloat(document.getElementById('longitude').value);
        marker.setLatLng([lat, lng]);
        map.panTo([lat, lng]);
        document.getElementById('location').value = '(' + lat + ', ' + lng + ')';
    });

    document.getElementById('longitude').addEventListener('input', function() {
        var lat = parseFloat(document.getElementById('latitude').value);
        var lng = parseFloat(this.value);
        marker.setLatLng([lat, lng]);
        map.panTo([lat, lng]);
        document.getElementById('location').value = '(' + lat + ', ' + lng + ')';
    });