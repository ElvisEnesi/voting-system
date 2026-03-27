    <?php
        include "partial/header.php";
    ?>
    <div class="add_form">
        <h3>Add Candidate</h3>
        <form>
            <input type="text" name="title" placeholder="Title">
            <input type="number" name="price" placeholder="Price">
            <select name="">
                <option value="">Deluxe</option>
            </select>
            <input type="text" name="desc1" placeholder="Description 1">
            <input type="text" name="desc2" placeholder="Description 2">
            <input type="text" name="desc3" placeholder="Description 3">
            <input type="file" name="avatar">
            <button type="submit" name="add">Submit</button>
        </form>
    </div>
    <?php
        include "../partials/footer.php";
    ?>
