    <?php
        include "../partials/header.php";
        // select all candidates
        $select_candidates = mysqli_query($connection, "SELECT * FROM candidate LIMIT 8");
    ?>
    <!--hero-->
    <section class="hero" id="top">
        <div class="hero_content">
            <h1>CUSTECH voting system</h1>
            <p>Vote from the comfort of your homes...</p>
        </div>
    </section>
    <p class="desc">
        Every great stay begins with a vision. For Tafari Hotel, that vision started years ago with a simple belief: that travel should never feel like a compromise. We saw a world of generic lobbies and impersonal service, and we decided to build something different—a sanctuary where the pulse of the city meets the tranquility of home.
        What began as a single architectural dream has blossomed into a premier destination for travelers from across the globe. Our foundation is built on the art of thoughtful hospitality. We don’t just provide a room; we provide a curated environment where every texture, scent, and service is designed to elevate your day. From the hand-selected local art gracing our corridors to the precise ergonomics of our suites, we have obsessed over the details so that you don't have to.
    </p>
    <h1 id="candidates">Candidates</h1>
    <?php if (mysqli_num_rows($select_candidates) > 0) : ?>
        <section class="team">
            <?php while ($gotten_candidates = mysqli_fetch_assoc($select_candidates)) : ?>
                <div class="team_card">
                    <img 
                        src="../images/candidates/<?= htmlspecialchars($gotten_candidates['picture'], ENT_QUOTES, 'UTF-8') ?>" 
                        onclick="window.location.href='<?= root_url ?>accessible/single_candidate.php?id=<?= htmlspecialchars($gotten_candidates['id'], ENT_QUOTES, 'UTF-8') ?>'"
                    >
                    <div class="team_desc">
                        <h3><?= htmlspecialchars($gotten_candidates['party'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <span class="team_name"><?= htmlspecialchars($gotten_candidates['title'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    <?php else : ?>
        <div class="notice">No candidate to display</div>
    <?php endif; ?>
    <!--to top-->
    <div class="to_top_button"><a href="<?= root_url ?>accessible/index.php#top"><ion-icon name="arrow-up-outline"></ion-icon></a></div>
    <?php
        include "../partials/footer.php";
    ?>
