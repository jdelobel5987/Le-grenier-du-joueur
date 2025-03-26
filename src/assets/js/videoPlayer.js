// const playlistId = "TLGGp7HnS8DZ_XAxOTAzMjAyNQ";
// const playlistId = document.getElementById("playlistId").value;
const videoIdsString = document.getElementById("playlistId").value;
let videoIds = videoIdsString.split(",");
let currentIndex = 0;
console.log(`playlist Id: ${playlistId}`);
let player;

// adjust player size based on device width
function adjustPlayerSize() {
    const screenWidth = window.innerWidth;
    const playerWidth = Math.min(screenWidth * 0.8, 640); // 80% of screen, max 640px
    const playerHeight = playerWidth * 9 / 16; // ratio 16:9

    const playerElement = document.getElementById("player");
    if(playerElement) {
        playerElement.style.width = `${playerWidth}px`;
        playerElement.style.height = `${playerHeight}px`;
    }

    if(player) {
        player.setSize(playerWidth, playerHeight);
    }
}

// Load youtube API
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        // height: '320',
        // width: '180',
        videoId: videoIds[currentIndex],
        playerVars: {
            // listType: 'playlist',
            // list: playlistId,
            autoplay: 0,
            controls: 1,
            rel: 0,
            modestbranding: 1
        },
        events: {
            'onReady': adjustPlayerSize,
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
    });
}

// handle resize events
window.addEventListener('resize', adjustPlayerSize);

// Auto-loading of next video on the list
function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.ENDED) {
        // console.log("Vidéo terminée, passage à la suivante...");
        // player.nextVideo();
        currentIndex++;
        if (currentIndex < videoIds.length) {
            player.loadVideoById(videoIds[currentIndex]);
        } else {
            console.log("Vidéo terminée, passage à la suivante...");
        }        
    }
}

// handle errors, auto skip unavailable videos
function onPlayerError(event) {
    console.error("Erreur détectée avec le code :", event.data);
    if (event.data === 2 || event.data === 100 || event.data === 101 || event.data === 150) {
        // in case error is non valid video (2), deleted or private video (100), or unavailable video (101, 150)
        console.log("Vidéo indisponible, passage à la suivante...");
        player.nextVideo();
    }
}