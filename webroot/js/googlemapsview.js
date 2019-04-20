
var map = new google.maps.Map(document.getElementById('map'), {
    center: latlng,
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP
});
var marker = new google.maps.Marker({
    position: latlng,
    map: map,
    title: 'Ubicación',
    draggable: false,
    url: 'https://maps.google.com/?q='+latlng
});

google.maps.event.addListener(marker, 'click', function () {
    window.location.href = this.url;
});