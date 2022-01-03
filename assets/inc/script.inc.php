<!-- SCRIPT JQUERY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- SCRIPT BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php
if (!strpos($_SERVER["PHP_SELF"], "admin")) {
?>
    <!-- SCRIPT -->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/sendMail.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
} else { ?>
    <script src="../assets/js/kothing-editor.min.js"></script>
    <script>
        /**
         * ID : 'my-editor'
         * ClassName : 'kothing-editor'
         */
        // ID or DOM object
        KothingEditor.create(document.getElementById('my-editor'), {
            // All of the plugins are loaded in the "window.KothingEditor" object in kothing-editor.min.js file
            // Insert options
            mode: 'classic',
            width: '100%',
            height: 300,
            fontSize: [
                8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 22, 24, 26, 28, 36, 48, 72
            ],
            formats: [
                'p', 'blockquote', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
            colorList: [
                ['#d6744a', '#f4f4f4', '#d3cec6', '#7699b6', '#627989', '#e1d5c9', '#ffffff', '#000000'],
                ['#e7e4e0', '#e29f82', '#686362', 'red', 'yellow', 'blue', 'green', 'orange'],
                ['transparent', 'pink', 'brown', 'lightgreen', 'lightblue', 'Gold', 'OrangeRed', 'Darkviolet'],
                ['RoyalBlue', 'SaddleBrown', 'SlateGray', 'BurlyWood', 'DeepPink', 'FireBrick', 'SeaGreen', 'DarkBlue']
            ],
            toolbarItem: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock', 'lineHeight'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor'],
                ['outdent', 'indent', 'align', 'list', 'horizontalRule'],
                ['link', 'image'],
                ['paragraphStyle', 'textStyle'],
                ['showBlocks', 'codeView'],
                ['preview', 'fullScreen'],
                ['removeFormat']
            ]
        });
        $('.valider').click(function() {
            var zone = $('#my-editor');
            var edit = $('.kothing-editor-editable').html();
            var res = edit.replace(/\&quot;/g, '');
            zone.text(res);
        });
    </script>
<?php
}
?>

</body>

</html>