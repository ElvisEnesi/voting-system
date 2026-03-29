    <?php
        include "./partial/header.php";
    ?>
    <div class="add_form">
        <h3>Edit candidate category</h3>
        <form>
            <input type="text" name="title" placeholder="title" required>
            <textarea name="desc" placeholder="Descriptiion"></textarea>
            <button type="submit" name="edit">Submit</button>
        </form>
    </div>
    <?php
        include "../partials/footer.php";
    ?>
