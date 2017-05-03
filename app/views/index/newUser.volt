{{ form("index/saveNewUser") }}

  <h2>Create User</h2>
<fieldset>
<table>
    <tr>
      <td><label for="name">Name</label></td>
      <td>{{ text_field("name", "size": 32) }}</td>
    </tr>
    <tr>
      <td><label for="surname">Surname</label></td>
      <td>{{ text_field("surname", "size": 32) }}</td>
    </tr>
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
    {{ submit_button("Create", "class": "btn btn-primary") }}
</div>
</fieldset>

{{ endForm() }}
