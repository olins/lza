<head>
    <title>Live Info</title>

    {{ assets.outputCss() }}
    {{ assets.outputJs() }}
</head>
<body>
  <div class="tickets-bar">
    <div class="tickets-bar-block block-high">
      <h1>High</h1>
    </div>
    <div class="tickets-bar-block block-med">
      <h1>Medium</h1>
    </div>
    <div class="tickets-bar-block block-low">
      <h1>Low</h1>
    </div>
    <div class="tickets-bar-block block-plan">
      <h1>Planning</h1>
    </div>
  </div>
  <div class="main">
    <div class="main-block">
      <h1>Store opening</h1>
      <table>
        <thead>
          <th>Date</th>
          <th>PartnerID</th>
          <th>RetailStoreId</th>
          <th>Responsible person</th>
          <th>Status updated by responsible person</th>
          <th>Partner type</th>
        </thead>
        <tbody>
          {% for row in stores %}
            <tr>
              {% for key, column in row %}
                {% if key in [1, 2, 3, 7, 8, 9] %}
                  {% if column.value is defined %}
                    <td>{{column.value}}</td>
                  {% else %}
                    <td></td>
                  {% endif %}
                {% endif %}
              {% endfor %}
            </tr>
          {% endfor %}
        </tbody>
      </table>
    </div>
    <div class="main-block">
      {{serviceNow}}
    </div>
  </div>
</body>
