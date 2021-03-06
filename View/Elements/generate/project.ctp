<div class="generate invoices">
	<?php 
	echo $this->Form->create('Invoice', array('url' => array('project')));
	echo $this->Form->input('Invoice.contact_id'); ?>
	<div class="projects clearfix">
		<h4>Projects</h4>
		<?php
		$i=0; foreach ($projects as $project) {
			// have to put this div in manually because Form->input(project_id) introspection caused huge delays even when it was overriden ?>
			<div class="invoiceProjects contact<?php echo $project['Project']['contact_id']; ?>">
			<?php
				echo $this->Form->checkbox('Invoice.project_id.'.$i, array('value' => $project['Project']['id']));
				echo '<span class="projectDisplayName">' . $project['Project']['name'] . '</span>';
				echo !empty($project['Invoice'][0]['created']) ? '<span class="lastInvoiceDate"> Last Invoice : ' . $this->Time->niceShort($project['Invoice'][0]['created']) . '</span>' : '';?>
			</div>
		<?php
			$i++;
		} ?>
	</div>
	<?php
	echo $this->Form->input('rate', array('label' => 'Hourly Rate'));
	echo $this->Form->input('start_date', array('type' => 'text', 'class' => 'datepicker'));
	echo $this->Form->input('end_date', array('type' => 'text', 'class' => 'datepicker'));
	echo $this->Form->end('Generate'); ?>
</div>

<script type="text/javascript">

$(document).ready(function() {
	updateProject();
	$("#InvoiceContactId").change(function () {
		updateProject();
  	});
	// put this in because radio buttons didn't work right and because 
	$("input[type=checkbox]").change(function () {
		$("input[type=checkbox]").removeAttr("checked");
		$(this).attr("checked", "checked");; 
	});
});

function updateProject() {
	var contactId = $("#InvoiceContactId").val();
	$(".invoiceProjects").hide();
	$(".contact" + contactId).show();
	$("input[type=checkbox]").removeAttr("checked");
	//$("#option").attr("checked", "checked"); // make checkboxes checked
}
</script>