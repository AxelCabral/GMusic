$('.example3 .playlist').on('init', function (event, slick) {
    $(".example3").musicPlayer({
        playlistItemSelector: '.slick-slide:not(.slick-cloned) .song-item',
        elements: ['artwork', 'information', 'controls', 'progress', 'time', 'volume'], // ==> This will display in  the order it is inserted
        //elements: [ 'controls' , 'information', 'artwork', 'progress', 'time', 'volume' ],
        //controlElements: ['backward', 'play', 'forward', 'stop'],
        timeElements: ['current', 'duration'],
        //timeSeparator: " : ", // ==> Only used if two elements in timeElements option
        //infoElements: [  'title', 'artist' ],
        volume: 10,
        autoPlay: true,
        loop: true,
        onPlay: function () {},
        onPause: function () {},
        onStop: function () {},
        onFwd: function () {
            slideToActive();
        },
        onRew: function () {
            slideToActive();
        },
        volumeChanged: function () {},
        seeked: function () {},
        trackClicked: function () {},
        onMute: function () {},
    }); 
});
//slick slider initialisation
$(".example3 .playlist").slick({
    arrows: false
});