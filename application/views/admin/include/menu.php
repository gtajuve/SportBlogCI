Здравей <?=$this->session->userdata('user')->username; ?>   | <a href="<?=base_url()?>login/logout">Logout</a>

<div>
<a href="<?=base_url()?>user/index">Users</a> | <a href="<?=base_url()?>team/index">Teams</a> | <a href="<?=base_url()?>player/index">Players</a> | <a href="<?=base_url()?>game/index">Games</a>
| <a href="<?=base_url()?>country/index">Add Country</a> | <a href="<?=base_url()?>message/index">Messages</a>
</div>
<hr>