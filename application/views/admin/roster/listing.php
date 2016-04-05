<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <a href="<?=base_url()?>roster/create/<?=$game->id?>">Insert roster</a> | <a href="<?=base_url()?>roster/update/<?=$game->id?>">Update roster</a>  | <a href="<?=base_url()?>roster/delete/<?=$game->id?>">Reset roster</a>
    <div class="row-fluid">
        <div class="span6" style="display: inline-table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo $game->home_team; ?></th>
                    <th><?php echo $game->score ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($gameInfo as $player): ?>
                    <tr>
                        <?php
                        if($player->team_id==$game->home_team_id){
                            echo '<td>'.$player->first_name.' '.$player->last_name .'</td><td>';
                            if($player->goals_ongame>0){
                                echo $player->goals_ongame.' goal';
                                echo $player->goals_ongame>1?'s':'';
                            }
                            echo '</td>';
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="span6" style="display: inline-table">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo $game->away_team ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($gameInfo as $player): ?>
                    <tr>
                        <?php
                        if($player->team_id==$game->away_team_id){
                            echo '<td>'.$player->first_name.' '.$player->last_name .'</td><td>';
                            if($player->goals_ongame>0){
                                echo $player->goals_ongame.' goal';
                                echo $player->goals_ongame>1?'s':'';
                            }
                            echo '</td>';
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $this->load->view('admin/include/footer');?>