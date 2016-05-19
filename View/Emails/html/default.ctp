<p>Hi <?php echo $pic['User']['fullname']; ?>,</p>

<p>New ticket has been created. Detail ticket below</p>

<table>
	<tr>
		<td style="font-weight: bold;">Created date</td>
		<td><?php echo $tix['HelpdeskTicket']['created']; ?></td>
	</tr>

	<tr>
		<td style="font-weight: bold;">Created by</td>
		<td><?php echo $tix['CreatedInfo']['username']; ?></td>
	</tr>

	<tr>
		<td style="font-weight: bold;">Ticket number</td>
		<td><?php echo $tix['HelpdeskTicket']['ticket_number']; ?></td>
	</tr>

	<tr>
		<td style="font-weight: bold;">Customer name</td>
		<td><?php echo $tix['HelpdeskTicket']['customer_name']; ?></td>
	</tr>

	<tr>
		<td style="font-weight: bold;">Phone number</td>
		<td><?php echo $tix['HelpdeskTicket']['phonenumber']; ?></td>
	</tr>

	<tr>
		<td style="font-weight: bold;">Customer email</td>
		<td><?php echo $tix['HelpdeskTicket']['customer_email']; ?></td>
	</tr>

	<tr>
		<td style="font-weight: bold;">Trx unit</td>
		<td><?php echo $tix['HelpdeskTransactionUnit']['unit_name']; ?></td>
	</tr>
</table>