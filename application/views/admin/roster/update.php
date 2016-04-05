<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <form class="form-horizontal" method="post" action="<?=$game->id?>">
        <fieldset>
            <div class="form-group">
                <div class="span6" style="display: inline-table">
                    <p><?php echo $game->home_team ?></p><p><?php echo $game->score ?></p>
                    <?php foreach($playersHT as $playerHT) : ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="playersHT[]" value="<?php echo $playerHT->id ?>" <?php echo $playerHT->game_id!=null?'checked':''; ?> > <?php echo $playerHT->first_name.' '.$playerHT->last_name ?>
                            </label>
                        </div>
                        <label for="">Goals</label>
                        <input type="number" class="form-control" name="goalsHT<?php  echo $playerHT->id ?>" value=<?php echo $playerHT->goals_ongame!=null?$playerHT->goals_ongame:0 ?> >
                    <?php endforeach ; ?>
                </div>
                <div class="span6" style="display: inline-table">
                    <p><?php echo $game->away_team ?></p>
                    <?php foreach($playersAT as $playerAT) : ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="playersAT[]" value="<?php echo $playerAT->id ?>" <?php echo $playerAT->game_id!=null?'checked':''; ?> > <?php echo $playerAT->first_name.' '.$playerAT->last_name ?>
                            </label>
                        </div>
                        <label for="">Goals</label>
                        <input type="number" class="form-control" name="goalsAT<?php  echo $playerAT->id ?>" value=<?php echo $playerAT->goals_ongame!=null?$playerAT->goals_ongame:0 ?> >
                    <?php endforeach ; ?>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" name="submitPlayers">Save</button>
                    <button class="btn">Cancel</button>
                </div>
        </fieldset>
    </form>

<?php $this->load->view('admin/include/footer');?>