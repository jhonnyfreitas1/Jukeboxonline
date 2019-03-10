$(function() {
    // Definir playlist
    // Aqui criamos a playlist apenas se ela não existir.
    // Util para o exemplo em PHP, que define a playlist antes de inserir este arquivo
    if (playlist[0] == null) {
       
        playlist = [{
            artist: 'Lista vazia',
            title: 'escolha uma musica',
            mp3: 'songs/#'
        }];
    }
       
 
      for (i=0; i < playlist.length; i++) {
                        var listItem = (i == playlist.length-1) ? "<li class='result-list'>" : "<li>";
                        listItem += "<a href='#' id='playlist_item_"+i+"' tabindex='1'>"+ playlist[i].title;
                        $("#fila-music").append(listItem);
                    }                               

    // Variável auxiliar para controlarmos a posição atual dentro da playlist
    var currentTrack = 0;

    // Variável auxiliar para ajudar a controlar a função "next"
    var numTracks = playlist.length;

    // Controles para next e prev
    $('.player-next').click(function() {
        player.playNext();
    });

    $('.player-prev').click(function() {
        player.playPrevious();
    });
    // Criar o player
  
       function adicionar(){
      for (i=0; i < playlist.length; i++) {
                        var listItem = (i == playlist.length-1) ? "<li class='result-list'>" : "<li>";
                        listItem += "<a href='#' id='playlist_item_"+i+"' tabindex='1'>"+ playlist[i].title;
                        $("#fila-music").append(listItem);
                    }
                }
    player = $(".player").jPlayer({
        ready: function () {
            // Executar a primeira música da playlist
            // Se não quiser autoplay, remova estas linhas
            player.jPlayer("setMedia", playlist[currentTrack])
            player.playCurrent();
        },
        
        ended: function() {
            // Quando terminar de tocar uma música, ir para a próxima
                
               $.ajax({
                type:'post',
                url:'update-music.php',
                datatype:'json',
                data:{id:playlist[0]['id_music']},
            success: function(response){
                alert(response);
            }
           })     
            adicionar();
            $(this).playNext();
        },
        play: function(){
            // Quando começar a tocar, escrever o nome da faixa sendo executada
            $('.player-current-track').text(playlist[currentTrack].artist+' - '+playlist[currentTrack].title);
        },
        swfPath: 'js/plugins/jplayer/',
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
    
    player.playNext = function() {
        currentTrack = (currentTrack == (numTracks -1)) ? 0 : ++currentTrack;
        player.playCurrent();
    };
    player.playPrevious = function() {
        currentTrack = (currentTrack == 0) ? numTracks - 1 : --currentTrack;
        player.playCurrent();
    };
    player.playCurrent = function() {
        player.jPlayer("setMedia", playlist[currentTrack]).jPlayer("play");
    }
});
