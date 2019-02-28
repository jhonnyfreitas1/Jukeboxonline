

    $( function(playlist) {
      // Definir playlist
                    
    var  playlist = [{
             artist: 'Daft Punk',
             title: 'Technologic',
             mp3: ' songs/technologic.mp3'
         }, {
             artist: 'Daft Punk',
             title: 'Human After All',
             mp3: 'songs/human-after-all.mp3'
         }, {
            artist: '21 Savage',
             title: 'a lot ft J Cole',
             mp3: 'songs/a lot ft J Cole.mp3'
         }]; 
        

        //playlist[2].title;

         for (i=0; i < playlist.length; i++) {
                        var listItem = (i == playlist.length-1) ? "<li class='result-list'>" : "<li>";
                        listItem += "<a href='#' id='playlist_item_"+i+"' tabindex='1'>"+ playlist[i].title;
                        $("#fila-music").append(listItem);
                                }
        
    var currentTrack = 0;
    var numTracks = playlist.length;

 var player = $('.player').jPlayer({
     ready: function () {
         // configura a faixa inicial do jPlayer
         player.jPlayer("setMedia", playlist[currentTrack])
                  // reproduzir a faixa atual. Se não quiser que o player comece a tocar automaticamente
           // retirar esta linha
         player.playCurrent();
     },
     ended: function() {
         // quando terminar de tocar uma música, ir para a próxima
         $(this).playNext();
     },
     play: function(){
         // quando começar a tocar, escrever o nome da faixa sendo executada
         $('.player-current-track').text(playlist[currentTrack].artist+' - '+playlist[currentTrack].title);
     },
     swfPath: 'js/plugins/jplayer/jquery.jplayer.swf',
     supplied: "mp3",
     cssSelectorAncestor: "",
     cssSelector: {
         play: '.player-play',
         pause: ".player-pause",
         stop: ".player-stop",
         seekBar: ".player-timeline",
         playBar: ".player-timeline-control"
     },
     size: {
         width: "1px",
         height: "1px"
     }
 });

        

  player.playCurrent = function() {
    player.jPlayer("setMedia", playlist[currentTrack]).jPlayer("play");
 }

 player.playNext = function() {
   currentTrack = (currentTrack == (numTracks -1)) ? 0 : ++currentTrack;
   player.playCurrent();
 };

 player.playPrevious = function() {
     currentTrack = (currentTrack == 0) ? numTracks - 1 : --currentTrack;
     player.playCurrent();
 };


  $('.retorno').click(function() {
    alert('bla bla');
 });



  $('.player-next').click(function() {
     player.playNext();
 });
  
 $('.player-prev').click(function() {
    player.playPrevious();
 });

        $('.retorno').click(function() {
        alert( "Handler for .click() called." );
        });

}); 

