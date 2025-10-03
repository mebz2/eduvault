<div class='error-box' id="error-box">
    <h3><?php echo isset($error_name) ? $error_name : 'Error'; ?> </h3>
    <ul>
        <?php
        foreach ($error as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        ?>
        <script>
            const box = document.getElementById('error-box');

            box.addEventListener('click', () => {
                box.style.display = "none";
            })
        </script>
</div>