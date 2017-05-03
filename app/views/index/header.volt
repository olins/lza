<div class="logo">
  {{ image("/img/LZA_logo.jpg")}}
  <h1 class="logo_part">Latvijas Zinātņu akadēmija</h1>
</div>
<div class="container" id="main" role="main">
  <ul class="menu">
      <li>{{link_to('/', "Sākums", 'class':'link-index')}}</li>
      <li>{{link_to('news', "Jaunumi", 'class':'link-news')}}</li>
      <li>{{link_to('aboutus/documents', "Par Mums", 'class':'link-about')}}
          <ul class="submenu">
              <li>{{link_to('aboutus/history', "Vēsture")}}</li>
              <li>{{link_to('aboutus/documents', "Dokumenti")}}</li>
              <li>{{link_to('/', "Prezidents")}}</li>
              <li>{{link_to('/', "Struktūra")}}</li>
              <li>{{link_to('/', "Nodaļas")}}</li>
              <li>{{link_to('/', "Budžets")}}</li>
              <li>{{link_to('/', "Publiskais iepirkums")}}</li>
              <li>{{link_to('/', "Simbolika")}}</li>
          </ul>
      </li>
      <li>{{link_to('/', "Akadēmijas Locekļi", 'class':'link-members')}}
          <ul class="submenu">
              <li><a href="#">ĪSTENIE LOCEKĻI</a></li>
              <li><a href="#">GODA LOCEKĻI</a></li>
              <li><a href="#">ĀRZEMJU LOCEKĻI</a></li>
              <li><a href="#">KORESPONDĒTĀJLOCEKĻI</a></li>
              <li><a href="#">GODA DOKTORI</a></li>
          </ul>
      </li>
      <li>{{link_to('/', "Starptautiskā sadarbība", 'class':'link-international')}}</li>
      <li>{{link_to('/', "Publikācijas", 'class':'link-contacts')}}</li>
      <li>{{link_to('/', "Zinātņu nodaļas", 'class':'link-map')}}</li>
  </ul>
</div>
