<section class="socialmedia_section">
    <h2 class="socialmedia_heading">Sociálne siete</h2>
    <div class="bar"></div>
    <p>
        Sledujte nás na rôzných sociálnych sieťach
    </p>

    <div class="socialmedia_container" id="instagram-photos-container">
        <!-- Instagram photos will be loaded here -->
    </div>

    <div class="socialmedia-buttons">
        <!-- Instagram Button -->
        <a href="https://www.instagram.com/mk_fit_marcel/" target="_blank" class="social-button">
            <i class="fa-brands fa-instagram"></i>
            Náš Instagram
        </a>

        <!-- Facebook Button -->
        <a href="https://www.facebook.com/profile.php?id=100057226549301" target="_blank" class="social-button">
            <i class="fa-brands fa-facebook"></i>
            Náš Facebook
        </a>
    </div>

    <!-- 28.2.2024 https://developers.facebook.com/community/threads/374479868862324/?post_id=374479872195657 -->
    <!--
        <script>
            // Replace 'YOUR_ACCESS_TOKEN' and 'USER_ID' with your actual values
            const accessToken = 'YOUR_ACCESS_TOKEN';
            const userId = 'USER_ID';

            // Fetch Instagram photos using Instagram Graph API
            fetch(`https://graph.instagram.com/v12.0/${userId}/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token=${accessToken}`)
                .then(response => response.json())
                .then(data => {
                    const photosContainer = document.getElementById('instagram-photos-container');

                    data.data.forEach(photo => {
                        const img = document.createElement('img');
                        img.src = photo.media_url;
                        img.alt = photo.caption;
                        photosContainer.appendChild(img);
                    });
                })
                .catch(error => console.error('Error fetching Instagram photos:', error));
        </script>
        -->
</section>
