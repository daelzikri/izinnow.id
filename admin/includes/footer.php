<?php if (isset($_SESSION['admin_logged_in'])): ?>
        </main>
    </div>
    
    <!-- TinyMCE Editor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.wysiwyg-editor',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        menubar: false,
        height: 300,
        branding: false
      });
    </script>
<?php endif; ?>
</body>
</html>
