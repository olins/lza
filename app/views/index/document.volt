<head>
    <title>Dokumenti</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
</head>
<body  onload="activeMenu('{{ active }}')">
  {{ partial("index/header") }}
  <div class="main_list">
    <div class="main_list_column article">
          <h2>Dokumenti</h2>
          <div class="news">
            <h3>{{document.name}}<h3>
            {{document.content_lv}}
          </div>
      </div>
  </div>
  {{ partial("index/footer") }}
</body>
