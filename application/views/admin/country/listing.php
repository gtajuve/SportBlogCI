
<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <a href="" id="show">AddCountry</a>
    <div id="add" >
        <fieldset>
        Име <input type="text"/><input type="submit" value="Add"/>
        </fieldset>
    </div>
    <table>
        <thead>
        <tr>
            <th>Име</th>

            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tboby>
            <?php foreach($countrys as $country):?>
                <tr>

                    <td><?=$country->country_name; ?></td>

                    <td><a href="update/<?=$country->id; ?>">Update</a></td>
                    <td><a href="delete/<?=$country->id; ?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </tboby>
    </table>

<?php $this->load->view('admin/include/footer');?>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>

        $('#show').on('click',function(){
            $('#add').toggle();

    })
</script>
