    <?php
        include "../partials/header.php";
    ?>
    <section class="dashboard_container">
        <aside id="aside">
            <div class="first_element">
                <div class="icon">
                    <ion-icon name="clipboard-outline"></ion-icon>
                </div>
                <div class="title">Dashboard</div>
            </div>
            <div class="major_links">
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="file-tray-full-outline"></ion-icon>
                    </div>
                    <a href="dashboard.html#overview">Overview</a>
                </div>
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="duplicate-outline"></ion-icon>
                    </div>
                    <a href="dashboard.html#Candidate">Candidate categories</a>
                </div>
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="bed-outline"></ion-icon>
                    </div>
                    <a href="dashboard.html#Candidates">Candidates</a>
                </div>
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="newspaper-outline"></ion-icon>
                    </div>
                    <a href="dashboard.html#votes">Votes</a>
                </div>
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="hardware-chip-outline"></ion-icon>
                    </div>
                    <a href="dashboard.html#security">Security reviews</a>
                </div>
            </div>
            <div class="minor_links">
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </div>
                    <a href="index.html">Home</a>
                </div>
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </div>
                    <a href="dashboard.html#settings">Settings</a>
                </div>
                <div class="link_folder">
                    <div class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                    <a href="logout.html">Log out</a>
                </div>
            </div>
        </aside>
        <main id="main">
            <div id="overview">
                <div class="head">
                    <div class="icon">
                        <div class="openSide">o<ion-icon name="menu-outline"></ion-icon></div>
                        <div class="closeSide">c<ion-icon name="close-outline"></ion-icon></div>
                    </div>
                    <div class="name">Elvis</div>
                    <div class="search_form">
                        <form action="" method="get">
                            <input type="search" name="dashboard_search" placeholder="Search" required>
                            <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
                        </form>
                    </div>
                    <div class="picture">
                        <img src="./images/G_2skTNXIAIRxbf.jpg">
                    </div>
                </div>
                <div class="info">
                    <div class="info_container">
                        <div class="sticker"><ion-icon name="card-outline"></ion-icon></div>
                        <div class="info_details">
                            <div class="total">550</div>
                            <div class="desc">Total votes</div>
                        </div>
                    </div>
                    <div class="info_container">
                        <div class="sticker"><ion-icon name="bed-outline"></ion-icon></div>
                        <div class="info_details">
                            <div class="total">45</div>
                            <div class="desc">Candidates</div>
                        </div>
                    </div>
                    <div class="info_container">
                        <div class="sticker"><ion-icon name="hardware-chip-outline"></ion-icon></div>
                        <div class="info_details">
                            <div class="total">35</div>
                            <div class="desc">New security threats</div>
                        </div>
                    </div>
                </div>
                <h3>My votes</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Party</th>
                        <th>Time created</th>
                    </tr>
                    <tr>
                        <td>Elvis Enesi Jatto</td>
                        <td>APC</td>
                        <td>3/24/2026</td>
                    </tr>
                </table>
            </div>
            <div class="table_form" id="Candidate">
                <h3>Candidate Categories</h3>
                <div class="add_more">Do you want to add more?? <div class="icon" onclick="window.location.href='add_candidate_category.html'">+</div></div>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Date created</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td><a href="edit_candidate_category.html">edit</a></td>
                        <td><a href="delete_candidate_category.html" class="danger">delete</a></td>
                    </tr>
                </table>
            </div>
            <div class="table_form" id="Candidates">
                <h3>Candidate</h3>
                <div class="add_more">Do you want to add more?? <div class="icon" onclick="window.location.href='add_candidate.html'">+</div></div>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>head</th>
                        <th>head</th>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td><a href="edit_candidate.html">edit</a></td>
                        <td><a href="delete_candidate.html" class="danger">delete</a></td>
                    </tr>
                </table>
            </div>
            <div class="table_form" id="votes">
                <h3>Votes</h3>
                <table>
                    <tr>
                        <th>head</th>
                        <th>head</th>
                        <th>head</th>
                        <th>head</th>
                        <th>head</th>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                        <td><a href="">edit</a></td>
                        <td><a href="" class="danger">delete</a></td>
                    </tr>
                </table>
            </div>
            <div class="table_form" id="security">
                <h3>Security reviews</h3>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>IP address</th>
                        <th>Date created</th>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>data</td>
                        <td>data</td>
                    </tr>
                </table>
            </div>
            <div class="settings" id="settings">
                <h2>Settings</h2>
                <div class="form">
                    <form action="" method="post">
                        <h3>Edit bio</h3>
                        <input type="text" name="fullname" placeholder="Full name">
                        <input type="text" name="username" placeholder="User name">
                        <input type="email" name="email" placeholder="Email">
                        <button type="submit" name="edit_bio">Submit</button>
                    </form>
                    <form action="" method="post">
                        <h3>Change password</h3>
                        <input type="password" name="current" placeholder="Current password">
                        <input type="password" name="create" placeholder="Create password">
                        <input type="password" name="confirm" placeholder="Confirm password">
                        <button type="submit" name="edit_key">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </section>
    <?php
        include "../partials/footer.php";
    ?>
