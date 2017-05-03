<head>
    <title>Jaunumi</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
</head>
<body  onload="activeMenu('{{ active }}')">
  {{ partial("index/header") }}
  <div class="main_list">
    <div class="main_list_column article">
          <div class="news">
            <h2>Jaunumi</h2>
            {{news.content_lv}}
          </div>
      </div>
      <div class="social">
        <div class="social_tab">
          <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Flatvijaszinatnuakademija&tabs=timeline&width=280&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="280" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
        <br>
        <div class="social_tab">
          <a class="twitter-timeline"
            <a class="twitter-timeline" data-width="280" data-height="300" href="https://twitter.com/LZA_LV">National Park Tweets - Curated tweets by TwitterDev</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
      </div>
  </div>
  {{ partial("index/footer") }}
</body>
