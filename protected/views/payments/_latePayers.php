<div class="view">

	<table class="items">
		<thead>
			<tr>
				<th><a href="/members/index?Members_sort=nickname">Nickname</a></th>
				<th><a href="/members/index?Members_sort=first_name">First Name</a></th>
				<th><a href="/members/index?Members_sort=last_name">Last Name</a></th>
				<th><a href="/members/index?Members_sort=email">Email</a></th>
				<th><a href="/members/index?Members_sort=next_payment_date">Next Payment Date</a></th>
				<th><a href="/members/index?Members_sort=dob">Date Of  Birth</a></th>
			</tr>
		</thead>
		<tbody>
			<tr class="odd">
				<td><?php echo $data->nickname; ?></td>
				<td><?php echo $data->first_name; ?></td>
				<td><?php echo $data->last_name; ?></td>
				<td><?php echo $data->email; ?></td>
				<td><?php echo date('d M Y',strtotime($data->next_payment_date)); ?></td>
				<td><?php echo date('d M Y',strtotime($data->dob)); ?></td>
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