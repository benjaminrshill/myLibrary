<div>
    <h3 class="noMobile">Add a book</h3>
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="What's it called?" required="required" />
    </div>
    <div>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" placeholder="Who wrote it?" required="required" />
    </div>
    <div>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" placeholder="When was it published?" min "-999" max="2020" required="required" />
    </div>
    <div>
        <label for="rating">My rating:</label>
        <input type="number" id="rating" name="rating" placeholder="Rate it from 1 to 5!" min="1" max="5" />
    </div>
    <div>
        <label for="genre">Genre:</label>
        <select id="genre" name="genre" required="required">
            <option value="Fiction">Fiction</option>
            <option value="Non-fiction">Non-fiction</option>
        </select>
    </div>
    <div>
        <input type="submit" value="Add book!" class="addSubmit" />
    </div>
</div>
