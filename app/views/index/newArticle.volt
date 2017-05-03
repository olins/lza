<head>
    <title>Jauns ieraksts</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
    <!-- Include external CSS. -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

      <!-- Include Editor style. -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>
<body  onload="activeMenu('{{ active }}')">
  {{ partial("index/header") }}
  <div class="main news_main">
      <div class="news_list">
        <h2>Jauns ieraksts</h2>
        <div class="targets">
          <label for="target">Kategorija</label>
          <select id="type">
            <option value="volvo">Jaunumi</option>
            <option value="saab">Pasākums</option>
          </select>
          <!-- Create a tag that we will use as the editable area. -->
          <!-- You can use a div tag as well. -->
          <textarea></textarea>
          <div id="froala-editor"></div>

          <!-- Include external JS libs. -->
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

          <!-- Include Editor JS files. -->
          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>

          <!-- Initialize the editor. -->
          <script> $(function() { $('textarea').froalaEditor() }); </script>
        </div>
      </div>
  </div>
  {{ partial("index/footer") }}
</body>
