<!DOCTYPE HTML>
<html>
	<head>
		{{ assets.outputCss() }}
		{{ assets.outputJs() }}
	</head>
	<body>
		<div class="charts-bar">
			<div class="chartContainerTotal charts-bar-block" id="chartContainerTotal" style="height: 300px; width: 100%;">
			</div>
			<div class="chartContainerUsers charts-bar-block" id="chartContainerUsers" style="height: 300px; width: 100%;">
			</div>
		</div>
		<div class="main">
			<h1>Initials</h1>
			{{form("faq/update", "method": "post")}}
				<table>
					<thead>
						<th>Day</th>
						{% for user in users %}
							<th>{{user.name}}</th>
						{% endfor %}
					</thead>
					<tbody>
						{% for date in dates %}
							<tr>
								<td>{{date}}</td>
								{% for user in users %}
									{% for faq in faqs %}
										{% if faq.user == user.id and faq.date == date %}
											<td onclick="showFaq('{{date}}','{{user.id}}')">
												<span class="faq" id="user-{{date}}-{{user.id}}">
													{{faq.faq_count}}
												</span>
												{% set unique_id = "faq-value-"  ~ faq.date ~ "-" ~ user.id %}
												{{numeric_field(unique_id, "value": faq.faq_count, "class":"hidden", "onkeydown": "changeFaq('" ~ date ~"','" ~ user.id ~ "')")}}
											</td>
										{% endif %}
									{% endfor %}
								{% endfor %}
							</tr>
						{% endfor %}
						<tr>
							<td>Total</td>
							{% for user in users %}
								{% for user_total in user_faq_total %}
									{% if user_total.user == user.id %}
										<td>
											<span class="total" id="total-user-{{user.id}}">
												{{user_total.total}}
											</span>
										</td>
									{% endif %}
								{% endfor %}
							{% endfor %}
						</tr>
						<tr>
							<td>Target</td>
							{% for user in users %}
								<td><span class="target">{{target.target}}</span></td>
							{% endfor %}
						</tr>
					</tbody>
				</table>
			{{ end_form() }}
			<div class="targets">
				<label for="target">Target</label>
				{{ select("target", targets, 'using': ['id', 'target'], 'value': target.id, "onchange": "changeTarget(this.value)") }}
			</div>
			<div class="interval_list">
				{{form("faq", "method": "post")}}
					<label for="interval_list">Interval List</label>
					{{ select("interval_list", interval_list, 'using': ['id', 'interval'], 'value': faq_interval.id, "onchange": "this.form.submit()") }}
				{{ end_form() }}
			</div>
			<div class="serviceNow">
				{{serviceNow}}
			</div>
		</div>
	</body>
</html>
