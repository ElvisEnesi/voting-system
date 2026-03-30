    <?php
        include "../partials/header.php"; 
        // get id from url
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        }
        // select id candidate
        $select_candidate = mysqli_prepare($connection, "SELECT * FROM candidate WHERE id = ?");
        mysqli_stmt_bind_param($select_candidate, "i", $id);
        mysqli_stmt_execute($select_candidate);
        $candidate_result = mysqli_fetch_assoc(mysqli_stmt_get_result($select_candidate));
    ?>
    <section class="promotions" id="top">
        <div class="promo">
            <div class="promo_left">
                <img src="../images/candidates/<?= htmlspecialchars($candidate_result['picture'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="promo_right">
                <div class="single_room_details">
                    <h2><?= htmlspecialchars($candidate_result['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p><?= htmlspecialchars($candidate_result['party'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
                <form action="<?= root_url ?>authentication/otp.php" method="post">
                    <button type="submit" name="vote">Vote</button>
                </form>
            </div>
        </div>
    </section>
    <h1>Explore More Candidates</h1>
    <?php
        // select all candidates
        $select_candidates = mysqli_query($connection, "SELECT * FROM candidate LIMIT 8");
    ?>
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
    <div class="to_top_button"><a href="single_candidate.php#top"><ion-icon name="arrow-up-outline"></ion-icon></a></div>
    <?php
        include "../partials/footer.php";
    ?>