<head>
    <title>Admin sadaļa</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
</head>
<body  onload="activeMenu('{{ active }}')">
  {{ partial("index/header") }}
  <div class="main">
    <div class="admin_log">
      <h2>Admin sadaļa</h2>
    	{{form("verify_login", "method": "post")}}
        <fieldset>
        <table>
            <tr>
              <td><label for="email">Email</label></td>
              <td>{{ email_field("email") }}</td>
            </tr>
            <tr>
              <td><label for="password">Password</label></td>
              <td>{{ password_field("password", "size": 32) }}</td>
            </tr>
        </table>
        <div class="control-group">
            {{ submit_button("Ienākt", "class": "btn btn-primary") }}
        </div>
        </fieldset>
      {{ end_form() }}
    </div>
  </div>
  {{ partial("index/footer") }}
</body>
