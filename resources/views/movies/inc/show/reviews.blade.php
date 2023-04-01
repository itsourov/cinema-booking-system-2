   <div id="reviews-container" class="tab-content space-y-4" style="display:none;">
       <h4 class="text-base font-bold">Reviews</h4>

       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
           @foreach ($movie->videoReviews as $review)
               <div class="border rounded dark:border-gray-700  p-2">
                   <video id="video-review-{{ $review->id }}" class="rounded video-js vjs-default-skin"
                       data-setup='{"fluid": true}' controls preload="none" poster="{{ $movie->poster('w300') }}"
                       data-setup="{}">
                       <source src="{{ $review->videoUrl() }}" type="video/mp4" />
                       <p class="vjs-no-js">
                           To view this video please enable JavaScript, and consider upgrading to a
                           web browser that
                           <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5
                               video</a>
                       </p>
                   </video>
                   <div class="flex items-center mt-2 gap-3">
                       <img class="w-8 h-8 rounded-full border  border-primary-400"
                           src="{{ $review->user->getMedia('profileImages')->last()? $review->user->getMedia('profileImages')->last()->getUrl('small'): asset('images/user.png') }}"
                           alt="">
                       <div>
                           <p>{{ $review->user->name }}</p>
                           <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>


                       </div>

                   </div>
               </div>
           @endforeach
       </div>


   </div>
   <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
   <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>

   @section('scripts')
       <script>
           $(".video-js").each(function(videoIndex) {

               var videoId = $(this).attr("id");

               videojs(videoId).ready(function() {
                   this.on("play", function(e) {
                       //pause other video
                       console.log('stoping');
                       $(".video-js").each(function(index) {
                           if (videoIndex !== index) {
                               this.player.pause();
                           }
                       });
                   });
               });
           });
       </script>
   @endsection
