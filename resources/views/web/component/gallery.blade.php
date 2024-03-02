<section class="gallery_section">

    <div class="gallery_container" id="limitedGallery">
        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo2.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo2.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo3.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo3.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>
    </div>

    <div class="gallery_container" id="fullGallery" style="display: none;">
        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Image 1">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Image 1">
                <div class="overlay"></div>
            </a>
        </div>
    </div>

    <button class="show-all-button" onclick="toggleGallery()">Show All Images</button>

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>

    <!-- Showing full gallery JS -->
    <script>
        lightbox.option({
            "albumLabel" : "Obrázok %1 z %2"
        })
        function toggleGallery() {
            var limitedGallery = $("#limitedGallery");
            var fullGallery = $("#fullGallery");
            var showAllButton = $(".show-all-button");

            limitedGallery.toggle();
            fullGallery.toggle();

            if (fullGallery.is(":visible")) {
                showAllButton.text("Show Less");
            } else {
                showAllButton.text("Show All Images");
            }
            updateAfterPseudoElement(); // Call the function to update ::after visibility
        }

        // Function to update ::after visibility
        function updateAfterPseudoElement() {
            var galleryContainer = $(".gallery_container");
            galleryContainer.toggleClass("hide-after"); // Toggle the class to control the visibility
        }
    </script>
</section>

