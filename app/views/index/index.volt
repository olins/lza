<head>
    <title>Sākums</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
    <script src="../zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="../zabuto_calendar.min.css">
</head>
<body  onload="activeMenu('{{ active }}')">
  {{ partial("index/header") }}
  <div class="main">
    <div class="main_list">
      <div class="main_list_column">
        <div class="catalog_list">
          <div class="catalog">
            <span>{{mission.content_lv}}</span>
          </div>
          <div class="catalog">
            <h3>Jaunumi</h3>
            <ul>
              {% for news in latest_news %}
                <li><a href="/news/{{news.id}}">{{news.name}}</a></li>
              {% endfor %}
            </ul>
          </div>
        </div>
        <div class="catalog_list">
          <div class="catalog_row">
            <div class="ekosoc">
              {{ image("img/EKOSOC-LV_small.png") }}
            </div>
            <div class="letonika">
              {{ image("img/Letonika_logo.png") }}
            </div>
          </div>
          <div class="catalog">
            <h3>Pasākumi</h3>
            <ul>
              {% for activities in latest_activities %}
                <li><a href="/activities/{{activities.id}}">{{activities.name}}</a></li>
              {% endfor %}
            </ul>
          </div>
        </div>
      </div>
      <div class="social">
        <div class="social_tab">
          <div class="monthly monthly-locale-en monthly-locale-en-us" id="mycalendar">
        </div>
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
  </div>
  {{ partial("index/footer") }}
</body>
