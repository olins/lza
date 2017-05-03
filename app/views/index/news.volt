<head>
    <title>Jaunumi</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
</head>
<body  onload="activeMenu('{{ active }}')">
  {{ partial("index/header") }}
  <div class="main_list">
    <div class="main news_main">
        <div class="news_list">
          <div class="news">
            <h2>Jaunumi</h2>
            <table>
              {% for item in page.items %}
                <tr>
                  <td>
                    <span>{{item.date}}</span>
                  </td>
                  <td>
                    <span><a href="/news/{{item.id}}">{{item.name}}</a></span>
                  </td>
                </tr>
              {% endfor %}
            </table>
          </div>
        </div>
      <div class="paging">
        {{link_to('news', "Pirmā", 'class':'btn')}}
        <a href="/news?page={{page.before}}" class = 'btn'>Iepriekšējā</a>
        <a href="/news?page={{page.next}}" class = 'btn'>Nākošā</a>
        <a href="/news?page={{page.last}}" class = 'btn'>Pēdējā</a>
      </div>
      <h3>Jūs atrodaties lapā {{page.current}} no  {{page.total_pages}}</h3>
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
