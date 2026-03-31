<?php
    // include files
    include "./configuration/database.php";
    include "./authorization/authorized_user.php";
    include "./authorization/logged_user.php";
    require_once '../encryption/encryption.php';
    // define logged in user
    $current_user = $_SESSION['user_id'] ?? null;
    // select users details
    $select_user = mysqli_prepare($connection, "SELECT * FROM user WHERE id=?");
    mysqli_stmt_bind_param($select_user, "i", $current_user);
    mysqli_stmt_execute($select_user);
    $user_result = mysqli_fetch_assoc(mysqli_stmt_get_result($select_user));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting system</title>
    <link rel="stylesheet" href="<?= root_url ?>./css/style.css">
</head>
<body>
    <section class="dashboard_container">
        <aside id="aside">
            <div class="first_element">
                <div class="icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="title">Dashboard</div>
            </div>
            <div class="major_links">
                <div class="link_folder links_side">
                    <div class="icon">
                        <ion-icon name="file-tray-full-outline"></ion-icon>
                    </div>
                    <a href="<?= root_url ?>admin/dashboard.php#overview">Overview</a>
                </div>
                <?php if (isset($_SESSION['user_is_admin'])) :  ?>
                    <div class="link_folder links_side">
                        <div class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                        <a href="<?= root_url ?>admin/dashboard.php#Candidates">Candidates</a>
                    </div>
                    <div class="link_folder links_side">
                        <div class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </div>
                        <a href="<?= root_url ?>admin/dashboard.php#votes">Votes</a>
                    </div>
                    <div class="link_folder links_side">
                        <div class="icon">
                            <ion-icon name="hardware-chip-outline"></ion-icon>
                        </div>
                        <a href="<?= root_url ?>admin/dashboard.php#security">Security reviews</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="minor_links">
                <div class="link_folder links_side">
                    <div class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </div>
                    <a href="<?= root_url ?>admin/index.php">Home</a>
                </div>
                <div class="link_folder links_side">
                    <div class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                    <a href="<?= root_url ?>authentication/logout.php">Log out</a>
                </div>
            </div>
        </aside>
        <main id="main">
            <div id="overview">
                <div class="head">
                    <div class="name"><?= htmlspecialchars($user_result['name'], ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="search_form">
                        <form action="" method="get">
                            <input type="search" name="dashboard_search" placeholder="Search" required>
                            <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
                        </form>
                    </div>
                    <div class="picture">
                        <img src="../images/users/<?= htmlspecialchars($user_result['avatar'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                </div>
                <div class="info">
                    <?php if (isset($_SESSION['user_is_admin'])) :  ?>
                        <div class="info_container">
                            <div class="sticker"><ion-icon name="hardware-chip-outline"></ion-icon></div>
                            <div class="info_details">
                                <div class="total">35</div>
                                <div class="desc">New security threats</div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="info_container">
                            <div class="sticker"><ion-icon name="hardware-chip-outline"></ion-icon></div>
                            <div class="info_details">
                                <div class="total">0</div>
                                <div class="desc">View details</div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="info_container">
                        <div class="sticker"><ion-icon name="bookmarks-outline"></ion-icon></div>
                        <div class="info_details">
                            <div class="total">550</div>
                            <div class="desc">Total votes</div>
                        </div>
                    </div>
                    <div class="info_container">
                        <div class="sticker"><ion-icon name="people-outline"></ion-icon></div>
                        <div class="info_details">
                            <div class="total">45</div>
                            <div class="desc">Candidates</div>
                        </div>
                    </div>
                </div>
                <h3>My votes</h3>
                <?php
                    // select users vote
                    $personal_vote = mysqli_prepare($connection, "SELECT * FROM votes WHERE user_id = ?");
                    mysqli_stmt_bind_param($personal_vote, "i", $current_user);
                    mysqli_stmt_execute($personal_vote);
                    $personal_vote_result = mysqli_stmt_get_result($personal_vote);
                ?>
                <?php if (mysqli_num_rows($personal_vote_result) > 0) : ?>
                    <?php $personal_vote_result_details = mysqli_fetch_assoc($personal_vote_result); ?>
                        <table>
                            <tr>
                                <th>Party</th>
                                <th>Time of vote</th>
                            </tr>
                            <tr>
                                <td><?= htmlspecialchars($personal_vote_result_details['party'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= date("M, d-Y, H:i", strtotime(htmlspecialchars($personal_vote_result_details['date'], ENT_QUOTES, 'UTF-8'))) ?></td>
                            </tr>
                        </table>
                <?php else : ?>
                    <div class="notice">You are yet to vote!!</div>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="table_form" id="Candidates">              
                    <?php
                        if (isset($_SESSION['add_candidate_success'])) {
                            echo "<div class='notice'>" . $_SESSION['add_candidate_success'] . "</div>";
                        }
                        unset($_SESSION['add_candidate_success']);
                    ?>            
                    <?php
                        if (isset($_SESSION['edit_candidate_success'])) {
                            echo "<div class='notice'>" . $_SESSION['edit_candidate_success'] . "</div>";
                        }
                        unset($_SESSION['edit_candidate_success']);
                    ?>        
                    <?php
                        if (isset($_SESSION['delete_candidate_success'])) {
                            echo "<div class='notice'>" . $_SESSION['delete_candidate_success'] . "</div>";
                        }
                        unset($_SESSION['delete_candidate_success']);
                    ?>
                    <h3>Candidate</h3>
                    <div class="add_more">Do you want to add more?? <div class="icon" onclick="window.location.href='<?= root_url ?>admin/add_candidate.php'">+</div></div>
                    <?php 
                        // select all candidates
                        $select_candidates = mysqli_query($connection, "SELECT * FROM candidate ORDER BY date desc LIMIT 10");
                    ?>
                    <?php if (mysqli_num_rows($select_candidates) > 0) : ?>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Party</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php while ($gotten_candidates = mysqli_fetch_assoc($select_candidates)) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($gotten_candidates['title'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($gotten_candidates['party'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= date("M, d/Y, H:i", strtotime(htmlspecialchars($gotten_candidates['date'], ENT_QUOTES, 'UTF-8'))) ?></td>
                                    <td><a href="edit_candidate.php?id=<?= htmlspecialchars($gotten_candidates['id'], ENT_QUOTES, 'UTF-8') ?>">edit</a></td>
                                    <td><a href="delete_candidate.php?id=<?= htmlspecialchars($gotten_candidates['id'], ENT_QUOTES, 'UTF-8') ?>" class="danger">delete</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    <?php else : ?>
                        <div class="notice">No Items to display</div>
                    <?php endif; ?>
                </div>
                <?php
                    // join user & votes table to fetch data
                    $joined_table = mysqli_query($connection, "SELECT u.id AS id, u.name AS name, v.user_id AS user_id, v.party AS party, 
                    u.nin AS hashed, v.date AS date FROM user u INNER JOIN votes v ON u.id = v.user_id");
                ?>
                <div class="table_form" id="votes">
                    <h3>Votes</h3>
                    <table>
                        <tr>
                            <th>User</th>
                            <th>NIN</th>
                            <th>Party</th>
                            <th>Created</th>
                        </tr>
                        <?php if (mysqli_num_rows($joined_table) > 0) : ?>
                            <?php while ($joined_table_result = mysqli_fetch_assoc($joined_table)) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($joined_table_result['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars(decrypt_data($joined_table_result['hashed']), ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($joined_table_result['party'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        On <?= date("d M, Y", strtotime(htmlspecialchars($joined_table_result['date'], ENT_QUOTES, 'UTF-8'))) ?> 
                                        at <?= date("H:i", strtotime(htmlspecialchars($joined_table_result['date'], ENT_QUOTES, 'UTF-8'))) ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <div class="notice">No vote found!!</div>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="table_form" id="security">
                    <?php 
                        // select all candidates
                        $select_threats = mysqli_query($connection, "SELECT * FROM threats ORDER BY date desc LIMIT 20");
                    ?>
                    <h3>Security reviews</h3>
                    <?php if (mysqli_num_rows($select_threats) > 0) : ?>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>IP address</th>
                                <th>Created at</th>
                            </tr>
                            <?php while ($gotten_threats = mysqli_fetch_assoc($select_threats)) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($gotten_threats['type'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($gotten_threats['ip_address'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= date("M, d/Y, H:i", strtotime(htmlspecialchars($gotten_threats['date'], ENT_QUOTES, 'UTF-8'))) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    <?php else : ?>
                        <div class="notice">No threat to display</div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </main>
    </section>
    <div class="icons">
        <div class="opensidebar"><ion-icon name="chevron-forward-outline"></ion-icon></div>
        <div class="closesidebar"><ion-icon name="chevron-back-outline"></ion-icon></div>
    </div>
    <script src="../javascript/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>