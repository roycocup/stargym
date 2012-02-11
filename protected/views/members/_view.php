<div class="view">

	<table class="items">
		<thead>
			<tr>
				<th id="yw2_c0"><a href="/members/index?Members_sort=nickname">Nickname</a></th>
				<th id="yw2_c1"><a href="/members/index?Members_sort=first_name">First Name</a></th>
				<th id="yw2_c2"><a href="/members/index?Members_sort=last_name">Last Name</a></th>
				<th id="yw2_c3"><a href="/members/index?Members_sort=email">Email</a></th>
				<th id="yw2_c4"><a href="/members/index?Members_sort=next_payment_date">Next Payment Date</a></th>
				<th id="yw2_c5"><a href="/members/index?Members_sort=dob">Date Of  Birth</a></th>
			</tr>
		</thead>
		<tbody>
			<tr class="odd">
				<td><?php echo $data->nickname; ?></td>
				<td><?php echo $data->first_name; ?></td>
				<td><?php echo $data->last_name; ?></td>
				<td><?php echo $data->email; ?></td>
				<td><?php echo $data->next_payment_date; ?></td>
				<td><?php echo $data->dob; ?></td>
			</tr>
		</tbody>
	</table>
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Last Payments')); ?>:</b><br/>
	<?php
		foreach ($data->payments as $payment)
		{
			echo date('d-M-Y h:i:s', strtotime($payment->created))."<br/>";
		}
	?>

</div>