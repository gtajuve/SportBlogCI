<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <form class="form-horizontal" method="post" action="">
        <fieldset>
            <div class="control-group  ">
                <label class="control-label" for="selectError3">Домакин</label>
                <div class="controls">
                    <select name="home_team_id" id=selectError3" >
                        <option value="">-- Избери Отбор--</option>

                        <? $country=0;$openTag=false; ?>
                        <?php foreach($teams as $team) : ?>
                            <?php if($team->country_id!=$country) {
                                $country=$team->country_id;
                                if(!$openTag){
                                    echo '<optgroup label="'.$team->country_name.'">';
                                    $openTag=true;
                                }else{
                                    echo '<//optgroup>';
                                    echo '<optgroup label="'.$team->country_name.'">';
                                    $openTag=true;
                                }

                            }
                            ?>
                            <option value="<?php echo $team->id ?>" <?php echo ($team->id==$inputData['home_team_id'])?'selected': ''?> ><?php echo $team->team_name?></option>

                        <?php endforeach; ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('home_team_id'); ?></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectError3">Гост</label>
                <div class="controls">
                    <select name="away_team_id" id=selectError3" >
                        <option value="">-- Избери Отбор--</option>

                        <? $country=0;$openTag=false; ?>
                        <?php foreach($teams as $team) : ?>
                            <?php if($team->country_id!=$country) {
                                $country=$team->country_id;
                                if(!$openTag){
                                    echo '<optgroup label="'.$team->country_name.'">';
                                    $openTag=true;
                                }else{
                                    echo '<//optgroup>';
                                    echo '<optgroup label="'.$team->country_name.'">';
                                    $openTag=true;
                                }

                            }
                            ?>
                            <option value="<?php echo $team->id ?>" <?php echo ($team->id==$inputData['away_team_id'])?'selected': ''?> ><?php echo $team->team_name?></option>

                        <?php endforeach; ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('away_team_id'); ?></span>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="inputError">Home Score</label>
                <div class="controls">
                    <input type="number" id="inputError" name="home_score" value="<?php echo $inputData['home_score'] ?>">
                    <span class="help-inline"><?php echo form_error('home_score'); ?></span>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="inputError">Guest Score</label>
                <div class="controls">
                    <input type="number" id="inputError" name="away_score" value="<?php echo $inputData['away_score'] ?>">
                    <span class="help-inline"><?php echo form_error('away_score'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                <button class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>

<?php $this->load->view('admin/include/footer');?>