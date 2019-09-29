@section('tinyMCE')
<script>
    tinymce.init({
        selector: '#content',
        toolbar: [
            'undo redo | styleselect | bold italic underline | link image | alignleft aligncenter alignright | cut copy paste | outdent indent',

        ],
        menubar: false,
        width: 800,
        height: 500,
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table directionality emoticons template paste'
        ]
    });
</script>
@endsection