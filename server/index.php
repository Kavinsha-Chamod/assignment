<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Form fields for customer data -->
        <label>Title:</label>
        <select name="title">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select><br>

        <label>First Name:</label>
        <input type="text" name="first_name" required><br>

        <label>Middle Name:</label>
        <input type="text" name="middle_name" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br>

        <label>Contact Number:</label>
        <input type="text" name="contact_no"><br>

        <label>District:</label>
        <input type="text" name="district"><br>

        <input type="submit" value="Register Customer">
    </form>