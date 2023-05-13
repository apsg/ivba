@if($lesson->video->hasCloudflare())
    <iframe
            src="https://customer-gnl8urc1wq6n6cqi.cloudflarestream.com/{{$lesson->video->cloudflare_uid}}/iframe"
            style="border: none"
            height="720"
            width="1280"
            allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"
            allowfullscreen="true"
            id="stream-player"
    ></iframe>

    <!-- Your JavaScript code below-->
    <script>
      const player = Stream(document.getElementById('stream-player'));
      player.addEventListener('play', () => {
        console.log('playing!');
      });
      player.play().catch(() => {
        console.log('playback failed, muting to try again');
        player.muted = true;
        player.play();
      });
    </script>
@endif
