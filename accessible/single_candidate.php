    <?php
        include "../partials/header.php";
    ?>
    <section class="promotions" id="top">
        <div class="promo">
            <div class="promo_left">
                <img src="./images/each.webp">
            </div>
            <div class="promo_right">
                <div class="single_room_details">
                    <h2>Candidate 1</h2>
                    <h3>All Progressive Congress (APC) Political Party</h3>
                    <ol>
                        <li>Free internet access</li>
                        <li>Balcony view</li>
                        <li>Room A/C</li>
                    </ol>
                </div>
                <form action="" method="post">
                    <button type="submit" name="vote">Vote</button>
                </form>
            </div>
        </div>
    </section>
    <h1>Explore More Candidates</h1>
    <section class="team">
        <div class="team_card">
            <img src="./images/couples.jpg" onclick="window.location.href='single_candidate.html'">
            <div class="team_desc">
                <h3>APC party</h3>
                <span class="team_name">Candidate 1</span>
            </div>
        </div>
    </section>
    <!--to top-->
    <div class="to_top_button"><a href="single_candidate.html#top"><ion-icon name="arrow-up-outline"></ion-icon></a></div>
    <?php
        include "../partials/footer.php";
    ?>