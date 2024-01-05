@extends('layouts.app')
@php
  $abouts_details = '';
  if($about_type == 'ongc'){
    $abouts_details = $abouts_info->about_ongc;
    $page = 'ONGC';
  }else if($about_type == 'iew'){
    $abouts_details = $abouts_info->about_iew;
    $page = 'IEW';
  }else if($about_type == 'event_location'){
    $abouts_details = $abouts_info->about_local_event;
    $page = 'Event Location';
  }

  $pageNm = 'About '.$page;

@endphp
@section('title', $pageNm)
@section('css')
<style type="text/css">
  .card-body, .ck-balloon-panel .ck-powered-by{ display:none;  }
  .ck-editor__editable[role="textbox"] {  min-height: 300px; } 
  .ck-editor__editable, .ck-editor__editable p { background-color: transparent !important; }
</style>
@endsection
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $pageNm }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{ $pageNm }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title">{{ $pageNm }}</h3>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('about.update') }}">
          <div class="col-sm-12">
              @csrf
              <input type="hidden" name="about_type" value="{{ @$about_type }}" style="text-transform: lowercase;" >
              <textarea name="editor" id="editor" style="width:100%;">{{ @$abouts_details }}</textarea>
          </div>
          <div class="col-sm-12 mt-2">
            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
          </div>
          </form>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('javascript')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
  toolbar: {
    items: [
      //'findAndReplace', 'selectAll', 'sourceEditing', '|',
      'heading', '|',
      'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
      'bulletedList', 'numberedList', 'todoList', '|',
      'outdent', 'indent', '|',
      'undo', 'redo',
      '-',
      'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
      'alignment', '|',
      'link', 'insertImage', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', /*'codeBlock', 'htmlEmbed',*/ '|',
      'specialCharacters', 'horizontalLine', 'pageBreak'
    ],
    shouldNotGroupWhenFull: true
  },
  list: {
    properties: {
      styles: true,
      startIndex: true,
      reversed: true
    }
  },
  image: {
    toolbar: [
      'comment',
      'imageTextAlternative',
      'toggleImageCaption',
      'imageStyle:inline',
      'imageStyle:block',
      'imageStyle:side',
      'linkImage'
    ]
  },
  table: {
    contentToolbar: [
      'tableColumn',
      'tableRow',
      'mergeTableCells',
      'tableCellProperties',
      'tableProperties'
    ],
  },
  heading: {
    options: [
      { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
      { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
      { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
      { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
      { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
      { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
      { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
    ]
  },
  placeholder: 'Create your template design',
  fontFamily: {
    options: [
      'default',
      'Arial, Helvetica, sans-serif',
      'Courier New, Courier, monospace',
      'Georgia, serif',
      'Lucida Sans Unicode, Lucida Grande, sans-serif',
      'Tahoma, Geneva, sans-serif',
      'Times New Roman, Times, serif',
      'Trebuchet MS, Helvetica, sans-serif',
      'Verdana, Geneva, sans-serif'
    ],
    supportAllValues: true
  },
  fontSize: {
    options: [ 10, 12, 14, 'default', 18, 20, 22, 24, 26, 28, 30, 32, 34, 70 ],
    supportAllValues: true
  },
  htmlSupport: {
    allow: [
      {
        name: /.*/,
        attributes: true,
        classes: true,
        styles: true
      }
    ]
  },
  htmlEmbed: {
    showPreviews: true
  },
  link: {
    decorators: {
      addTargetToExternalLinks: true,
      defaultProtocol: 'https://',
      toggleDownloadable: {
        mode: 'manual',
        label: 'Downloadable',
        attributes: {
            download: 'file'
        }
      }
    }
  },
  mention: {
    feeds: [
      {
        marker: '@',
        feed: [
          '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
          '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
          '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
          '@sugar', '@sweet', '@topping', '@wafer'
        ],
        minimumCharacters: 1
      }
    ]
  },
  removePlugins: [
    'CKBox',
    'CKFinder',
    'EasyImage',
    'RealTimeCollaborativeComments',
    'RealTimeCollaborativeTrackChanges',
    'RealTimeCollaborativeRevisionHistory',
    'PresenceList',
    'Comments',
    'TrackChanges',
    'TrackChangesData',
    'RevisionHistory',
    'Pagination',
    'WProofreader',
    'MathType',
    'SlashCommand',
    'Template',
    'DocumentOutline',
    'FormatPainter',
    'TableOfContents'
  ]
}).then(editor => {
    // Your editor is ready.
    editor.editing.view.document.on('click', (evt, data) => {
        $('.ck-balloon-panel').find('.ck-powered-by').remove();
    });
});
$('.card-body').css('display', 'block');

</script>
@endsection
