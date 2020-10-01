<div>
    <h3>Add</h3>
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required="required" />
    </div>
    <div>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required="required" />
    </div>
    <div>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" min="-999" max="2020" required="required" />
    </div>
    <div>
        <label for="rating">My rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" />
    </div>
    <div>
        <label for="genre">Genre:</label>
        <select id="genre" name="genre" required="required">
            <option value="Fiction">Fiction</option>
            <option value="Non-fiction">Non-fiction</option>
        </select>
    </div>
    <div>
        <input type="submit" name="addBook" value="Add book!" class="addSubmit" />
    </div>
    <div>
        <?php notifyEdit(); ?>
    </div>
</div>
