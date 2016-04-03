<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>

<?php echo '<pre>'.print_r($this->session->userdata('user'),true).'</pre>';?>
<?php $this->load->view('admin/include/footer');?>
