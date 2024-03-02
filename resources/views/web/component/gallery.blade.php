<section class="gallery_section">

    <div class="gallery_container" id="limitedGallery">
        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo2.jpg')}}" data-lightbox="gallery" data-title="Kardio zariadenia">
                <img src="{{asset('resources/img/photos/photo2.jpg')}}" alt="Kardio zariadenia">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo3.jpg')}}" data-lightbox="gallery" data-title="Posilňovací stroj">
                <img src="{{asset('resources/img/photos/photo3.jpg')}}" alt="Posilňovací stroj">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo4.jpg')}}" data-lightbox="gallery" data-title="Posilňovacía veža">
                <img src="{{asset('resources/img/photos/photo4.jpg')}}" alt="Posilňovacía veža">
                <div class="overlay"></div>
            </a>
        </div>
    </div>

    <div class="gallery_container" id="fullGallery" style="display: none;">
        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo2.jpg')}}" data-lightbox="gallery" data-title="Kardio zariadenia">
                <img src="{{asset('resources/img/photos/photo2.jpg')}}" alt="Kardio zariadenia">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo3.jpg')}}" data-lightbox="gallery" data-title="Posilňovací stroj">
                <img src="{{asset('resources/img/photos/photo3.jpg')}}" alt="Posilňovací stroj">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo4.jpg')}}" data-lightbox="gallery" data-title="Posilňovacía veža">
                <img src="{{asset('resources/img/photos/photo4.jpg')}}" alt="Posilňovacía veža">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo6.jpg')}}" data-lightbox="gallery" data-title="Výber činiek">
                <img src="{{asset('resources/img/photos/photo6.jpg')}}" alt="Výber činiek">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo5.jpg')}}" data-lightbox="gallery" data-title="Naši zamestnanci a Silvester">
                <img src="{{asset('resources/img/photos/photo5.jpg')}}" alt="Naši zamestnanci a Silvester">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo16.jpg')}}" data-lightbox="gallery" data-title="MK FIT merch">
                <img src="{{asset('resources/img/photos/photo16.jpg')}}" alt="MK FIT merch">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo1.jpg')}}" data-lightbox="gallery" data-title="Vysoko kvalitné cvičebné zariadenia">
                <img src="{{asset('resources/img/photos/photo1.jpg')}}" alt="Vysoko kvalitné cvičebné zariadenia">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo14.jpg')}}" data-lightbox="gallery" data-title="MK FIT vybavenie">
                <img src="{{asset('resources/img/photos/photo14.jpg')}}" alt="MK FIT vybavenie">
                <div class="overlay"></div>
            </a>
        </div>

        <div class="gallery_item">
            <a href="{{asset('resources/img/photos/photo15.jpg')}}" data-lightbox="gallery" data-title="MK FIT vybavenie">
                <img src="{{asset('resources/img/photos/photo15.jpg')}}" alt="MK FIT vybavenie">
                <div class="overlay"></div>
            </a>
        </div>
    </div>

    <button class="show-all-button" onclick="toggleGallery()">Zobraziť všetko</button>

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
                showAllButton.text("Zobraziť menej");
            } else {
                showAllButton.text("Zobraziť všetko");
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

